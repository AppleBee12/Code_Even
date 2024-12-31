<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');


if (!isset($_SESSION['AUID'])) {
  echo '<script>
      alert("로그인을 해주세요");
      location.href = "http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/login/login.php";
  </script>';
}


if (!isset($title)) {
  $title = '';
}

$current_page = basename($_SERVER['REQUEST_URI'], ".php");
$level = $_SESSION['AULEVEL'];
$uid = $_SESSION['UID'];
$username = $_SESSION['AUNAME'];

$name_sql = "SELECT username, useremail FROM user WHERE uid = $uid";
$result = $mysqli->query($name_sql);
$userdata = $result->fetch_object();
$realusername = $userdata->username;
$realuseremail = $userdata->useremail;


if ($level == 10) {
  

  $sql = "SELECT * FROM teachers WHERE uid = $uid";
  $result = $mysqli->query($sql);
  $tc = $result->fetch_object();

  $teacher_id = $uid;
  $keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';

  $sql = "
        SELECT COUNT(*) AS unanswered_count
        FROM student_qna sq
        JOIN class_data cd ON sq.cdid = cd.cdid
        JOIN lecture l ON cd.leid = l.leid
        LEFT JOIN teacher_qna tq ON sq.sqid = tq.sqid
        WHERE l.lecid = '$teacher_id'
          AND tq.sqid IS NULL
          AND (sq.qtitle LIKE '%$keywords%' OR l.title LIKE '%$keywords%');
      ";

  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();

  $unanswered_count = $row['unanswered_count'];
}
if ($level == 100) {
  $tc_sql = "SELECT COUNT(*) as cnt FROM teachers WHERE tc_ok = 0";
  $result = $mysqli->query($tc_sql);
  $row = $result->fetch_assoc();
  $tc_count = $row['cnt'];
}

?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>코드이븐-<?= $title ?> 관리자 페이지</title>

  <!-- 공통 Style CSS -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/reset.css">
  <link href="https://cdn.jsdelivr.net/gh/sun-typeface/SUIT@2/fonts/static/woff2/SUIT.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css"
    integrity="sha256-IKhQVXDfwbVELwiR0ke6dX+pJt0RSmWky3WB2pNx9Hg=" crossorigin="anonymous">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/common.css">

  <?php
  if (isset($jqueryui_css)) {
    echo $jqueryui_css;
  }
  ?>

  <!-- 개인 Style CSS -->
  <?php
  $page = basename($_SERVER['PHP_SELF']); // 현재 실행 중인 페이지 이름을 가져옴
  switch ($page) { //main.css
    case 'index.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/main.css">';
      break;
  }
  switch ($page) { //t_main.css
    case 'teacher_index.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/t_main.css">';
      break;
  }
  switch ($page) { //user.css
    case 'user_list.php':
    case 'user_edit.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/user.css">';
      break;
  }
  switch ($page) { //teacher.css
    case 'teacher_list.php':
    case 'teacher_edit.php':
    case 'user_edit.php':
    case 'my_details.php':
    case 'lecture_sales.php':
    case 'book_sales.php':
    case 'teacher_details.php':
    case 'store.php':
    case 'counsel_edit.php':
    case 'team_project_edit.php':
    case 'blog_edit.php':
    case 'blog_write.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/teacher.css">';
      break;
  }
  switch ($page) { //order.css
    case 'delivery_list.php':
    case 'orders_list.php':
    case 'orders_details.php':
    case 'refunds_list.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/orders.css">';
      break;
  }
  switch ($page) { //sales.css
    case 'book_sales.php':
    case 'lecture_sales.php':
    case 'monthly_sales.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/sales.css">';
      break;
  }
  switch ($page) { //student_inquiry.css
    case 'student_list.php':
    case 'student_details.php':
    case 'student_question.php':
    case 'student_question_answer.php':
    case 'student_question_details.php':
    case 'send_email.php':
    case 'course_reviews.php':
    case 'course_reviews_details.php':
    case 'notice.php':
    case 'notice_write.php':
    case 'notice_details.php':
    case 'notice_modify.php':
    case 'student_faq.php':
    case 'teacher_faq.php':
    case 'faq_write.php':
    case 'faq_details.php':
    case 'faq_modify.php':
    case 'admin_qna.php':
    case 'admin_qna_details.php':
    case 'admin_qna_question.php':
    case 'admin_qna_answer.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/student_inquiry.css">';
      break;
  }
  switch ($page) { //lecture_list.css
    case 'lecture_list.php':
    case 'quiz_test_list.php':
    case 'quiz_test_outcome.php':
    case 'book_list.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/lecture_list.css">';
      break;
  }
  switch ($page) { //lecture.css
    case 'lecture_up.php':
    case 'lecture_view.php':
    case 'lecture_edit.php':
    case 'quiz_test_up.php':
    case 'quiz_test_edit.php':
    case 'book_up.php':
    case 'book_edit.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/lecture.css">';
      break;
  }

  switch ($page) { //counsel.css
    case 'counsel.php':
    case 'blog.php':
    case 'team_project.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/counsel.css">';
      break;
  }
  switch ($page) { //manual.css
    case 'for_admin.php':
    case 'for_teacher.php':
    case 'manual_contents.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/manual.css">';
      break;
  }
  ?>

  <!-- 공통js 추가 -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 

  <!-- 개인 추가 js -->
  <?php
  if (isset($chart_js)) {
    echo $chart_js;
  }
  if (isset($main_js)) {
    echo $main_js;
  }
  if (isset($t_main_js)) {
    echo $t_main_js;
  }
  if (isset($address_js)) {
    echo $address_js;
  }
  if (isset($store_js)) {
    echo $store_js;
  }
  if (isset($manual_js)) {
    echo $manual_js;
  }

  ?>


</head>

<body>
  <header class="header d-flex justify-content-between">
    <h1 class="logo">
      <a href="http://<?php
                      $link = '';
                      if ($level == 100) {
                        $link = '/code_even/admin/index.php';
                      } elseif ($level == 10) {
                        $link = '/code_even/admin/teacher_index.php';
                      }
                      if (!empty($link)) {
                        echo trim($_SERVER['HTTP_HOST']) . $link;
                      } ?>">code even</a>
    </h1>
    <div class="header_profile d-flex justify-content-between align-items-center">
      <div class="alarm d-flex flex-column align-items-end justify-content-end">
        <i class="bi bi-bell">
          <?php if ($level == 100) { ?>
            <span class="<?= ($level == 100 && $tc_count == 0) ? 'visually-hidden' : '' ?> position-absolute top-40 start-80 translate-middle badge rounded-pill bg-danger">
              <?= $tc_count ?>
            </span>
          <?php } else if ($level == 10) { ?>
            <span class="<?= ($level == 10 && $unanswered_count == 0) ? 'visually-hidden' : '' ?> position-absolute top-40 start-80 translate-middle badge rounded-pill bg-danger">
              <?= $unanswered_count ?>
            </span>
          <?php }; ?>
        </i>
        <div class="alert alert-light alert-dismissible fade " role="alert">
          <i class="bi bi-info-circle-fill"></i>
          <?php if ($level == 100 && $tc_count > 0) { ?>
            강사
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/teacher/teacher_list.php"
              class="alert-link"><?= $tc_count ?>명</a> 의 수강승인이 필요합니다.
          <?php } else if ($level == 10 && $unanswered_count > 0) { ?>
            답변이 필요한 학생 문의가
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/student_question.php"
              class="alert-link"><?= $unanswered_count ?>명</a> 있습니다.
          <?php }; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <div class="greet_name bd">
        <p>
          <?php if (isset($username)) { ?>
            <?= $username ?> 님
          <?php } else { ?>
            <span>로그인이 필요합니다.</span>
          <?php }; ?>
        <p>환영합니다.</p>
      </div>
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link"
            <?php if ($level == 100) { ?>
            href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/myprofile/my_details.php">
            <img class="profile_image" src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/images/adminprofile.png" alt="관리자 프로필사진">
          </a>
        <?php } else if ($level == 10) { ?>
          href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/teacher_page/myprofile/teacher_details.php">
          <img class="profile_image" src="http://<?= $_SERVER['HTTP_HOST']; ?>/<?= empty($tc->tc_thumbnail) ? 'code_even/admin/images/adminprofile.png' : $tc->tc_thumbnail; ?>" alt="강사 프로필 사진">
          </a>
        <?php }; ?>

        </li>
        <li class="nav-item dropdown d-flex align-items-center">
          <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"></button>
          <ul class="dropdown-menu">
            <?php if ($level == 100) { ?>
              <li><a class="dropdown-item"
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/myprofile/my_details.php">내 프로필 수정</a></li>
            <?php } else if ($level == 10) { ?>
              <li><a class="dropdown-item"
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/teacher_page/myprofile/teacher_details.php">내
                  프로필 수정</a></li>
            <?php }; ?>
            <?php if ($level == 100) { ?>
              <li><a class="dropdown-item" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/manual/for_admin.php">관리자 매뉴얼</a></li>
            <?php } else if ($level == 10) { ?>
              <li><a class="dropdown-item" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/manual/for_teacher.php">강사 매뉴얼</a></li>
            <?php }; ?>      
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item"
                href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/login/logout.php">로그아웃</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </header>
  <div class="nav_wrapper d-flex">
    <nav class="nav navbar-expand-lg d-flex flex-column justify-content-between">
      <div>
        <ul class="list-group line">
          <?php if ($level == 100) { ?>
            <li class="list-group-item" data-link="admin"><a
                href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/index.php">　<i class="bi bi-grid"></i> 　 대시보드</a></li>
          <?php } else if ($level == 10) { ?>
            <li class="list-group-item" data-link="admin"><a
                href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/teacher_index.php">　<i class="bi bi-grid"></i> 　 대시보드</a></li>
          <?php }; ?>
        </ul>
        <ul class="list-group line">
          <?php if ($level == 100) { ?>
            <li class="list-group-item" data-link="category">
              <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/category/category.php">　<i class="bi bi-tags"></i> 　 카테고리 관리
              </a>
            </li>
          <?php }; ?>
          <li class="pr list-group-item" data-link="lecture">　<i class="bi bi-collection-play"></i> 　 강좌 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#lecture_collapse"
              aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="lecture_collapse">
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/lecture/lecture_list.php">　　-　강좌 목록</a>
              </li>
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/lecture/lecture_up.php">　　-　강좌 등록</a></li>
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/lecture/quiz_test_list.php">　　-　퀴즈 / 시험
                  목록</a></li>
              <?php if ($level == 10) { ?>
                <li class="list-group-item dropdown-item"><a
                    href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/lecture/quiz_test_up.php">　　-　퀴즈 / 시험
                    등록</a></li>
              <?php }; ?>
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/lecture/quiz_test_outcome.php">　　-　퀴즈 / 시험
                  결과 관리</a></li>
            </ul>
          </li>
          <li class="pr list-group-item" data-link="book">　<i class="bi bi-book"></i> 　 교재 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#book_collapse"
              aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="book_collapse">
              <li class="list-group-item dropdown-item"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/book/book_list.php">　　-　교재 목록</a></li>
              <li class="list-group-item dropdown-item"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/book/book_up.php">　　-　교재 등록</a></li>
            </ul>
          </li>
        </ul>
        <ul class="list-group line">
          <?php if ($level == 100) { ?>
            <li class="list-group-item" data-link="user">　<a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/user/user_list.php"><i class="bi bi-people"></i> 　 전체 회원 관리</a></li>
            <li class="list-group-item" data-link="teacher"><a
                href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/teacher/teacher_list.php">　<i
                  class="bi bi-incognito"></i> 　 강사 관리</a>
            </li>
          <?php }; ?>
          <li class="pr list-group-item" data-link="student">　<i class="bi bi-mortarboard"></i> 　 수강생 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#student_collapse"
              aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="student_collapse">
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/student_list.php">　　-　수강생 목록</a>
              </li>
              <li class="list-group-item"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/student_question.php">　　-　수강생
                  질문</a>
              </li>
              <?php if ($level == 100) { ?>
                <li class="list-group-item"><a
                    href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/send_email.php">　　-　이메일 발송</a></li>
              <?php }; ?>
              <li class="list-group-item"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/course_reviews.php">　　-　수강 후기</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="list-group line">
          <?php if ($level == 100) { ?>
            <li class="pr list-group-item" data-link="orders">　<i class="bi bi-truck"></i> 　 결제/배송 관리
              <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#payment_collapse"
                aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
              <ul class="collapse btn-toggle-nav" id="payment_collapse">
                <li class="list-group-item dropdown-item"><a
                    href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/orders/orders_list.php">　　-　주문결제 목록</a>
                </li>
                <li class="list-group-item dropdown-item"><a
                    href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/orders/delivery_list.php">　　-　교재 배송관리</a>
                </li>
                <li class="list-group-item dropdown-item"><a
                    href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/orders/refunds_list.php">　　-　환불 관리</a></li>
              </ul>
            </li>
            <li class="list-group-item" data-link="coupons"><a
                href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/coupons/coupons.php">　<i
                  class="bi bi-ticket"></i> 　 쿠폰 관리</a></li>
          <?php }; ?>
          <li class="pr list-group-item" data-link="sales">　<i class="bi bi-graph-up-arrow"></i> 　 매출통계 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#sales_collapse"
              aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="sales_collapse">
              <li class="list-group-item dropdown-item"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/sales/lecture_sales.php">　　-　강좌 매출통계</a></li>
          <?php if ($level == 100) { ?>
              <li class="list-group-item dropdown"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/sales/book_sales.php">　　-　교재 매출통계</a></li>
          <?php }; ?>
              <li class="list-group-item dropdown"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/sales/monthly_sales.php">　　-　월별 매출통계</a></li>
            </ul>
          </li>
        </ul>
        <ul class="list-group line">
          <li class="pr list-group-item" data-link="inquiry">　<i class="bi bi-patch-question"></i> 　 문의 게시판 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#bulletinboard_collapse"
              aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="bulletinboard_collapse">
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice.php">　　-　전체 공지사항</a></li>

              <?php if ($level == 100) { ?>
                <li class="list-group-item dropdown"><a
                    href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/student_faq.php">　　-　수강생 FAQ</a>
                </li>
              <?php }; ?>

              <li class="list-group-item dropdown"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/teacher_faq.php">　　-　강사 FAQ</a>
              </li>

              <?php if ($level == 100) { ?>
                <li class="list-group-item dropdown"><a
                    href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/admin_qna.php">　　-　1:1 문의</a></li>
              <?php }; ?>
            </ul>
          </li>

          <?php if ($level == 100) { ?>
            <li class="pr list-group-item" data-link="community">　<i class="bi bi-chat-dots"></i> 　 커뮤니티 관리
              <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#community_collapse"
                aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
              <ul class="collapse btn-toggle-nav" id="community_collapse">
                <li class="list-group-item dropdown-item"><a
                    href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/counsel.php">　　-　고민상담</a></li>
                <li class="list-group-item dropdown"><a
                    href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/team_project.php">　　-　팀 프로젝트</a>
                </li>
                <li class="list-group-item dropdown"><a
                    href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/blog.php">　　-　블로그</a></li>
              </ul>
            </li>
          <?php }; ?>
        </ul>
      </div>
      <ul class="no_line list-group">

        <?php if ($level == 10) { ?>
          <li class="list-group-item" data-link=""><a
              href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/admin_qna.php">　<i
                class="bi bi-chat-dots"></i> 　 1:1 문의하기</a></li>
          <li class="list-group-item" data-link="manual"><a
              href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/manual/for_teacher.php">　<i
                class="bi bi-journal-bookmark-fill"></i> 　 강사 매뉴얼</a></li>
        <?php }; ?>
        <?php if ($level == 100) { ?>

          <li class="list-group-item" data-link="manual"><a
              href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/manual/for_admin.php">　<i
                class="bi bi-journal-bookmark-fill"></i> 　 관리자 매뉴얼</a></li>
          <li class="list-group-item" data-link="setting"><a
              href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/setting/store.php">　<i
                class="bi bi-gear-fill"></i> 　 상점 관리</a></li>
        <?php }; ?>
      </ul>
    </nav>
    <div class="nav_sibling">