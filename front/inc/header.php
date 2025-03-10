<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/check_cookie.php');

// 로그인하지 않은 상태에서 현재 URL 저장
if (!isset($_SESSION['AUID'])) {
  $_SESSION['return_url'] = $_SERVER['REQUEST_URI']; // 현재 페이지 URL 저장
}


$session_id = session_id();


if(isset($_SESSION['UID'])){
  $uid = $_SESSION['UID'];
  $userid = $_SESSION['AUID'];
} else {
  $uid = '';
  $userid =  '';
}

// 타이틀 초기화
if (!isset($title)) {
  $title = '';
}

// 카카오 간편 로그인 시작
if (isset($_GET['code'])) {
  $code = $_GET['code'];
  $client_id = 'dc8b785f75c0ed7ecca5dad87f2b18ff';
  $redirect_uri = 'http://localhost/code_even/';

  // 1. 토큰 요청
  $url = 'https://kauth.kakao.com/oauth/token';
  $data = [
    'grant_type' => 'authorization_code',
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'code' => $code
  ];

  $options = [
    'http' => [
      'header' => 'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
      'method' => 'POST',
      'content' => http_build_query($data)
    ],
    'ssl' => [
      'verify_peer' => false, // SSL 인증서 확인 비활성화 (개발용)
      'verify_peer_name' => false
    ]
  ];

  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  $response = json_decode($result, true);

  if (isset($response['access_token'])) {
    $ACCESS_TOKEN = $response['access_token'];

    // 2. 사용자 정보 요청
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://kapi.kakao.com/v2/user/me");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Authorization: Bearer $ACCESS_TOKEN"
    ]);

    $response_result = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $resultArr = json_decode($response_result, true);

    if ($status === 200) {
      // DB 연결
      $mysqli = new mysqli('localhost', 'code_even', '12345', 'code_even');
      if ($mysqli->connect_errno) {
        die('연결 실패: ' . $mysqli->connect_error);
      }

      // 사용자 정보 저장
      $userid = $resultArr['id'] ?? '';
      $userNick = $resultArr['properties']['nickname'] ?? '닉네임 없음';
      $userName = $resultArr['kakao_account']['profile']['nickname'] ?? '이름 없음';

      $tempsql = "INSERT INTO user (userid, usernick, username) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE usernick = VALUES(usernick), username = VALUES(username)";
      $sql = $mysqli->prepare($tempsql);

      if ($sql) {
        $sql->bind_param("sss", $userid, $userNick, $userName);
        if ($sql->execute()) {
          $_SESSION['KAKAO_UID'] = $userid; // 카카오 로그인 성공 시 세션 저장
          $_SESSION['USER_NICK'] = $userNick;
          $_SESSION['AUNAME'] = $userName;
        }
        $sql->close();
      } else {
        die("쿼리 준비 실패: " . $mysqli->error);
      }

      // $mysqli->close();
    } else {
      echo "사용자 정보 요청 실패: {$status}";
    }
  } else {
    echo "토큰 요청 실패: " . ($response['error_description'] ?? '알 수 없는 오류');
  }
}

  // 카트 조회
  $cart_sql = "SELECT 
  c.*, 
  l.leid, 
  l.image, 
  l.title, 
  l.name, 
  l.price AS lecture_price, 
  b.book AS book_name, 
  b.price AS book_price,
  b.writer AS book_writer,
  b.company AS book_company
  FROM 
  cart c
  LEFT JOIN 
  lecture l ON c.leid = l.leid
  LEFT JOIN 
  book b ON c.boid = b.boid
  WHERE 
  c.ssid = '$session_id' OR c.uid = '$uid'
  ";


  $cart_result = $mysqli->query($cart_sql);
  $cartArr = [];
  while ($cart_data = $cart_result->fetch_object()) {
  $cartArr[] = $cart_data;
  }

  // 장바구니 개수 계산
  $cart_count = sizeof($cartArr);

  $sql_count_available = "
  SELECT COUNT(*) AS available_count 
  FROM user_coupons uc
  JOIN coupons c ON uc.couponid = c.cpid 
  WHERE uc.userid = ? AND uc.status = 1 AND uc.use_max_date >= CURDATE()";
  $stmt_count_available = $mysqli->prepare($sql_count_available);
  $stmt_count_available->bind_param('s', $userid);
  $stmt_count_available->execute();
  $result_count_available = $stmt_count_available->get_result();
  $row_count = $result_count_available->fetch_assoc();
  $available_count = $row_count['available_count'];
  $sql_available = "
  SELECT 
    c.coupon_name, 
    c.coupon_image, 
    c.max_value, 
    c.use_min_price, 
    uc.use_max_date, 
    uc.status 
  FROM 
    user_coupons uc
  JOIN 
    coupons c ON uc.couponid = c.cpid 
  WHERE 
    uc.userid = ? AND uc.status = 1
  ORDER BY 
    uc.couponid DESC";
  $stmt_available = $mysqli->prepare($sql_available);
  $stmt_available->bind_param('s', $userid);
  $stmt_available->execute();
  $result_available = $stmt_available->get_result();
  $data_available = $result_available->fetch_all(MYSQLI_ASSOC);
  
  // 사용 완료 또는 기간 만료 쿠폰 조회
  $sql_expired = "
  SELECT 
      c.coupon_name, 
      c.coupon_image, 
      c.max_value, 
      c.use_min_price, 
      uc.use_max_date, 
      uc.status 
  FROM 
      user_coupons uc
  JOIN 
      coupons c ON uc.couponid = c.cpid 
  WHERE 
      uc.userid = ? AND uc.status = 0
  ORDER BY 
      uc.couponid DESC";

  $stmt_expired = $mysqli->prepare($sql_expired);
  $stmt_expired->bind_param('s', $userid);
  $stmt_expired->execute();
  $result_expired = $stmt_expired->get_result();
  $data_expired = $result_expired->fetch_all(MYSQLI_ASSOC);

  // 사용 가능한 쿠폰 조회
  $sql_available_count = "
                          SELECT COUNT(*) as available_count
                          FROM user_coupons
                          WHERE userid = ? AND status = 1";

  $stmt_available = $mysqli->prepare($sql_available_count);
  $stmt_available->bind_param('s', $userid);
  $stmt_available->execute();
  $result_available = $stmt_available->get_result();
  $row = $result_available->fetch_assoc();
  $available_coupon_count = $row['available_count']; 



  // 수강중인 강좌 개수 가져오기
  $ongoing_count_sql = "SELECT COUNT(*) AS ongoing_count 
  FROM class_data 
  WHERE uid = ?";
  $stmt_ongoing_count = $mysqli->prepare($ongoing_count_sql);
  $stmt_ongoing_count->bind_param('i', $uid);
  $stmt_ongoing_count->execute();
  $result_ongoing_count = $stmt_ongoing_count->get_result();
  $row_ongoing_count = $result_ongoing_count->fetch_assoc();
  $ongoing_count = $row_ongoing_count['ongoing_count'] ?? 0;
  


 // 알림벨- 새로운'선생님 답변' 갯수 구하기

 $student_id = $_SESSION['UID'] ?? $_SESSION['KAKAO_UID'] ?? null;
 
 if ($student_id) {
  $sql_new_answer = "SELECT 
                        (SELECT COUNT(*) 
                         FROM teacher_qna tq
                         JOIN student_qna sq ON tq.sqid = sq.sqid
                         JOIN class_data cd ON sq.cdid = cd.cdid
                         WHERE cd.uid = '$student_id') 
                        - 
                        (SELECT COUNT(*) 
                         FROM teacher_qna tq
                         JOIN student_qna sq ON tq.sqid = sq.sqid
                         JOIN class_data cd ON sq.cdid = cd.cdid
                         WHERE cd.uid = '$student_id' AND sq.is_read = '1') 
                      AS new_answers;";
                      $result = $mysqli->query($sql_new_answer);
                      if ($result) {
                          $row = $result->fetch_assoc();
                          $new_answers = $row['new_answers'];
                      } else {
                          echo "쿼리 실행 오류: " . $mysqli->error;
                      }
                  } else {
                      $new_answers = '0'; // 로그인하지 않았을 경우 빈 값 반환
                  }

?>




<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>코드이븐 <?= $title ?></title>

  <!-- 공통 CSS -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/admin/css/reset.css">
  <link href="https://cdn.jsdelivr.net/gh/sun-typeface/SUIT@2/fonts/static/woff2/SUIT.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css"
    integrity="sha256-IKhQVXDfwbVELwiR0ke6dX+pJt0RSmWky3WB2pNx9Hg=" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/css/common.css">
  

  <!-- 개인 CSS -->
  <?php
  $page = basename($_SERVER['PHP_SELF']); // 현재 실행 중인 페이지 이름을 가져옵니다
  switch ($page) { //main.css
    case 'index.php':
    case 'tc_applyform.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/main.css">';
      break;
  }

  switch ($page) { //mypage_common.css, 마이페이지가 추가되면 이 아래에 php이름을 추가하세요
    case 'mypage_header.php':
    case 'mypage_lecture.php':
    case 'mypage_coupons.php':
    case 'mypage_info_edit.php':
    case 'mypage_paid.php':
    case 'mypage_qna.php':
    case 'mypage_qna_question.php':
    case 'mypage_qna_question_details.php':
    case 'mypage_class_qna_question.php':
    case 'mypage_class_qna_question_details.php':
    case 'mypage_reivew.php':
    case 'mypage_review_write.php':
    case 'mypage_review_details.php':
    case 'mypage_write_comment.php':
    case 'mypage_wishlist.php':
    case 'mypage_payment_history.php':
    case 'mypage_copy.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/mypage_common.css">';
      break;
  }
  switch ($page) { //mypage_lecture.css
    case 'mypage_lecture.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/mypage_lecture.css">';
      break;
  }
  switch ($page) { //mypage_write_comment.css
    case 'mypage_write_comment.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/mypage_write_comment.css">';
      break;
  }
  switch ($page) { //what_recipe.css
    case 'what_recipe.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/what_recipe.css">';
      break;
  }
  switch ($page) { //community.css
    case 'counsel.php':
    case 'counsel_detail.php':
    case 'counsel_write.php':
    case 'counsel_edit.php':
    case 'teamproject.php':
    case 'teamproject_detail.php':
    case 'teamproject_write.php':
    case 'teamproject_edit.php':
    case 'blog.php':
    case 'blog_detail.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/community.css">';
      break;
  }
  switch ($page) { //tc_applyform.css
    case 'tc_applyform.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/tc_applyform.css">';
      break;
  }
  switch ($page) { //mypage_coupons.css
    case 'mypage_coupons.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/mypage_coupons.css">';
      break;
  }
  switch ($page) { //mypage_coupons.css
    case 'mypage_info_edit.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/mypage_info.css">';
      break;
  }
  switch ($page) { //lecture.css
    case 'lecture_list.php':
    case 'lecture_view.php':
    case 'mypage_wishlist.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/lecture.css">';
      break;
  }
  switch ($page) { //mypage_payment.css
    case 'mypage_payment_history.php':
    case 'cart.php':
    case 'checkout.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/mypage_payment.css">';
      break;
  }
  switch ($page) { //mypage_wishlist.css
    case 'mypage_wishlist.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/mypage_wishlist.css">';
      break;
  }
  switch ($page) { //mypage_qna.css, mypage_reivew.php
    case 'mypage_qna.php':
    case 'mypage_qna_question.php':
    case 'mypage_qna_question_details.php':
    case 'mypage_class_qna_question.php':
    case 'mypage_class_qna_question_details.php':
    case 'mypage_write_comment.php':  
    case 'mypage_reivew.php':
    case 'mypage_review_write.php':
    case 'mypage_review_details.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/mypage_qna_review.css">';
      break;
  }
  switch ($page) { //service.css
    case 'faq.php':
    case 'notice.php':
    case 'notice_details.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/service.css">';
      break;
  }

  ?>

  <!-- jquery, swiper 제외한 모든 js는 푸터 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<?php

  switch ($page) { //teamproject_write.css
    case 'teamproject_write.php':
      echo '<script type="text/javascript" src="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/js/bootstrap-multiselect.js"></script>';
      break;
  }

  switch ($page) { //teamproject_write.css
    case 'teamproject_write.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/bootstrap-multiselect.css" type="text/css">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
      ';
      break;
  }
?>

</head>

<body>
  <header>
    <div class="container">
        <div class="header_grade1 d-flex justify-content-end align-items-center">
          <div class="header_logo">
            <h1 class="logo text-center"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/index.php">CODE EVEN</a>
            </h1>
          </div>
          <div class="header_join">
            <ul class="d-flex justify-content-end">
              <?php if (!isset($_SESSION['AUID']) && !isset($_SESSION['KAKAO_UID'])) { ?>
                <li>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModaltest" data-bs-whatever="@mdo">로그인</a>
                </li>
                <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/signup/signup.php">회원가입</a></li>
              <?php } else { ?>
                <li>
                  <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/login/logout.php">로그아웃</a>
                </li>
                <?php
              }
              ?>
              <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/service/faq.php">고객센터</a></li>
            </ul>
          </div>
        </div>

        <div class="header_grade2 d-flex justify-content-between align-items-center">
          <!-- 메인메뉴 -->
          <nav class="header_menu">
            <ul class="d-flex align-items-center">
              <li class="menu_depth1">
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php">강좌</a>
                <div class="menu_depth2">
                  <ul class="depth2_lec">
                    <li>
                      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=B0001">프론트엔드</a>
                      <div class="menu_depth3">
                        <ul>
                        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0001">HTML/CSS</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0002">JavaScript</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0003">jQuery</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0004">React</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0005">Angular</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0006">Vue.js</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0007">TypeScript</a></li>
                        </ul>
                      </div>
                    </li>
                    <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=B0002">백엔드</a>
                      <div class="menu_depth3">
                        <ul>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0008">Java</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0009">PHP</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0010">Next.js</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0011">Node.js</a></li>
                        </ul>
                      </div>
                    </li>
                    <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=B0003">클라우드 컴퓨팅</a>
                      <div class="menu_depth3">
                        <ul>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0012">AWS</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0013">Azure</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0014">Google Cloud Platform</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0015">DevOps</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0016">kubernetes</a></li>
                        </ul>
                      </div>
                    </li>
                    <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=B0004">데이터베이스</a>
                      <div class="menu_depth3">
                        <ul>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0017">SQL</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0018">MySQL</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0019">PostgreSQL</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0020">Oracle</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0021">NoSQL</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0022">MongoDB</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0023">Cassandra</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0024">Couchbase</a></li>
                        </ul>
                      </div>
                    </li>
                    <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=B0005">네트워크 관리</a>
                      <div class="menu_depth3">
                        <ul>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0025">TCP/IP</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0026">C/C++</a></li>
                        </ul>
                      </div>
                    </li>
                    <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=B0006">보안</a>
                      <div class="menu_depth3">
                        <ul>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0027">CPPG</a></li>
                          <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php?category=C0028">Security</a></li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="menu_depth1"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/what_recipe/what_recipe.php">'레시피 강좌'란?</a>
              </li>
              <li class="menu_depth1">
                커뮤니티
                <div class="menu_depth2">
                  <ul>
                    <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/counsel.php">고민상담</a></li>
                    <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/teamproject.php">팀 프로젝트</a>
                    </li>
                    <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/blog.php">블로그</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </nav>

          <!-- 검색창 -->
          <div class="header_search">
            <form action="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/lecture_list.php" method="get"  class="d-flex align-items-center header_search_inner">
              <button type="submit" class="search_btn d-flex align-items-center">
                <i class="bi bi-search"></i>
              </button>
              <label for="searchInput" class="visually-hidden">검색창</label>
              <input type="search" id="searchInput" name="search" class="form-control" 
              placeholder="무엇을 배우고 싶으신가요?" 
              value="<?= htmlspecialchars($search ?? '') ?>" 
              autocomplete="off">
              <button type="button" id="clearSearch"
                class="btn btn-clear d-flex align-items-center justify-content-center">
                <i class="bi bi-x-circle-fill"></i>
              </button>
            </form>
          </div>

          <!-- 아이콘 퀵메뉴 -->
          <div class="header_icon d-flex gap-3">
          <div class="mini_cart">
            <a href="" id="cartIcon">
              <i class="bi bi-cart"></i>
              <?php if ($cart_count > 0): ?>
                <!-- 장바구니 개수가 1개 이상일 때만 뱃지 표시 -->
                <span class="cart_cnt d-flex align-items-center justify-content-center"><?= $cart_count; ?></span>
              <?php endif; ?>
            </a>
            <div id="miniCartContent" class="cart_dropdown">
              <div class="mncart_header">
                <h4>장바구니<span id="cartCount"><?= $cart_count; ?></span></h4>
              </div>
              <div class="mncart_list">
                <?php if ($cart_count > 0): ?>
                  <!-- 장바구니에 담긴 강좌 정보 출력 -->
                  <ul>
                    <?php
                    $total = 0;
                    foreach ($cartArr as $cart):
                      $total += $cart->lecture_price;
                    ?>
                      <li>
                        <div class="item_tit d-flex">
                          <img src="http://<?= $_SERVER['HTTP_HOST'] ?><?= $cart->image; ?>" alt="상품 이미지">
                          <p><?= $cart->title; ?><span><?= $cart->name; ?></span></p>
                        </div>
                        <div class="item_price">
                          <p><span class="number"><?= $cart->lecture_price; ?></span>원</p>
                        </div>
                        <?php if (!empty($cart->boid)): ?>
                          <div class="book_price d-flex justify-content-between align-items-center">
                            <span class="badge_custom book_badge">교재포함강좌</span>
                            <p> +<span class="number"><?= $cart->book_price; ?></span>원 </p>
                          </div>
                        <?php
                          $total += $cart->book_price;
                        endif;
                        ?>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php else: ?>
                  <!-- 장바구니가 비었을 때 표시되는 메시지 -->
                  <div class="empty_cart text-center">
                    <p>장바구니가 비어 있습니다.</p>
                    <div class="d-flex justify-content-evenly my-3">  
                      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php" class="go_class">강좌 보러가기</a>
                      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/cart/cart.php" class="go_class">장바구니로 이동</a>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
              <div class="mncart_footer">
                <?php if ($cart_count > 0): ?>
                  <!-- 총 결제 금액 및 이동 버튼 -->
                  <div class="mncart_total d-flex justify-content-between">
                    <p>총 결제 금액: </p>
                    <div class="price">
                      <span class="number"><?= $total ?></span>
                      <span>원</span>
                    </div>
                  </div>
                  <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/cart/cart.php" class="goto_cart">장바구니로 이동</a>              
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php if (isset($_SESSION['AUID']) || isset($_SESSION['KAKAO_UID'])) { ?>
            <div class="mini_bell alarm">
              <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna.php" class="alarmbell_badge">
                <i class="bi bi-bell"></i>
                <?php if ($new_answers > 0): ?>
                  <!-- 달린 답변 개수가 1개 이상일 때만 뱃지 표시 -->
                  <span class="alarm_cnt d-flex align-items-center justify-content-center badge"><?= $new_answers; ?></span>
                <?php endif; ?>
              </a>
              <!-- 알림bell버튼 클릭시 나올 설명-->
              <div class="alarmbell_dropdown">
                <div class="mncart_header d-flex justify-content-between">
                  <h4>새로운 알림<span id="newAnswers"><?= $new_answers; ?></span></h4>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="mncart_list alert">
                  <div class="alert new_answer text-center" role="alert">
                    <?php if ($new_answers > 0): ?>
                      <p><i class="bi bi-info-circle-fill"> </i>확인하지 않은 새 강의 문의 답변이 <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna.php?tab=lecture"
                      class="alert-link"><span><?= $new_answers ?>건</span></a> 있습니다.</p>
                    <?php elseif ($new_service_answers > 0): ?>
                      <p><i class="bi bi-info-circle-fill"> </i>확인하지 않은 새 서비스 문의 답변이 <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna.php?tab=service"
                      class="alert-link"><span><?= $new_service_answers ?>건</span></a> 있습니다.</p>
                    <?php else: ?>
                      <p>새로운 알림이 없습니다.</p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="mini_profile">
              <a id="profileIcon" href="">
                <i class="bi bi-person"></i>
              </a>
              <div class="profile_menu">
                <div class="profile_menu_top">
                  <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_info_edit.php">
                    <div class="profile_header d-flex align-items-center">
                      <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/images/profile.png" alt="기본프로필이미지">
                      <p><?= $_SESSION['AUNAME'] ?>님</p>
                      <i class="bi bi-chevron-right"></i>
                    </div>
                  </a>
                  <div class="profile_btn d-flex gap-2">
                    <div class="d-flex">
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_coupons.php">쿠폰 <span><?php echo $available_coupon_count; ?></span>
                  </a>
                        </div>
                    <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/mypage/mypage_lecture.php">수강중인강좌 <span
                        class="ms-1"><?= $ongoing_count; ?></span></a>
                  </div>
                </div>
                <div class="profile_menu_list">
                  <ul>
                    <li class="list_pt list_pb"><a
                        href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_lecture.php"><i
                          class="bi bi-book"></i><span>나의 수업</span></a></li>
                    <li class="list_pt"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/cart/cart.php"><i
                          class="bi bi-cart"></i><span>장바구니</span></a></li>
                    <li class="list_pb"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_wishlist.php"><i class="bi bi-heart"></i><span>찜한 강좌</span></a></li>
                    <li class="list_pt"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_info_edit.php"><i class="bi bi-person-circle"></i><span>기본 정보 설정</span></a></li>
                    <li class="list_pb"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/login/logout.php"><i
                          class="bi bi-box-arrow-right"></i><span>로그아웃</span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
  </header>


  <div class="modal fade" id="exampleModaltest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog w_c">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-header m_h d-flex justify-content-center">
          <div class="wrappers d-flex row justify-content-center">
            <div class="header_logo">
              <h1 class="login_logo logo text-center"><a
                  href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/index.php">CODE EVEN</a></h1>
            </div>
            <h1 class="modal-title headt4 mt-3 d-flex justify-content-center" id="exampleModalLabel">로그인</h1>
          </div>
        </div>
        <div class="modal-body">
          <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/login/login_ok.php" method="POST">
            <div class="mb-3 d-flex justify-content-center gap-4 mid">
              <label for="inputId" class="col-form-label align-self-center">아이디</label>
              <input type="text" class="form-control id" id="inputId" placeholder="아이디를 입력하세요" name="userid" required>
            </div>
            <div class="mb-3 d-flex justify-content-center gap-3 mpw">
              <label for="inputPassword" class="col-form-label align-self-center">비밀번호</label>
              <input type="password" class="form-control pw" id="inputPassword" placeholder="비밀번호를 입력하세요" name="userpw"
                required>
            </div>
            <div class="modal-footer m_f d-flex justify-content-center">
              <div class="d-flex row gap-1">
                <button class="btn loginbtn redbtn">로그인</button>
                <a href="https://kauth.kakao.com/oauth/authorize?response_type=code&client_id=dc8b785f75c0ed7ecca5dad87f2b18ff&redirect_uri=http://localhost/code_even/" class="btn kakao_loginbtn yellowbtn">
                  
                    <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/images/kakao_icon.png" alt="">
                    카카오 로그인
                  
                </a>
              </div>

              <div class="mt-3 d-flex justify-content-center gap-3 mb-5">
                <!-- <a href="#" class="link-body-emphasis ">아이디 찾기</a>
                <a href="#" class="link-body-emphasis">비밀번호 찾기</a> -->
                <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/signup/signup.php"
                  class="link-body-emphasis text-decoration-underline">회원가입</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="main_wrapper">