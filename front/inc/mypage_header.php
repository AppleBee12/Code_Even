<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/mypage_main.js\"></script>";

if (isset($_SESSION['AUID'])) {
  $userid = $_SESSION['AUID'];
} elseif (isset($_SESSION['KAKAO_UID'])) {
  $userid = $_SESSION['KAKAO_UID'];
} else {
  echo "<script>
      alert('로그인이 필요합니다.');
      history.back();
    </script>";
  exit;
}

// 사용자 정보 가져오기 (Prepared Statement 사용)
$user_sql = "SELECT username, userphonenum, useremail FROM user WHERE userid = ?";
$stmt = $mysqli->prepare($user_sql);

if ($stmt) {
  $stmt->bind_param("s", $userid);
  $stmt->execute();
  $user_result = $stmt->get_result();

  if ($user_result && $user_result->num_rows > 0) {
    $user_data = $user_result->fetch_object();
  } else {
    echo "<p>사용자 정보를 찾을 수 없습니다.</p>";
    exit;
  }
  $stmt->close();
} else {
  die("쿼리 준비 실패: " . $mysqli->error);
}



// 출석 체크 처리 (로그인한 사용자만)
if (isset($_SESSION['UID'])) {
  $uid = $_SESSION['UID'];
  $today = date('Y-m-d');
  $formattedToday = date('Y년 n월 j일', strtotime($today)); // 2024년 12월 22일
  $one_week_ago = date('Y-m-d', strtotime('-1 week'));

  // 최근 일주일간 출석 여부 확인
  $attendance_sql = "SELECT check_date FROM attendance_data 
  WHERE uid = ? AND check_date BETWEEN ? AND ?";
  $attendance_date = $mysqli->prepare($attendance_sql);
  $attendance_date->bind_param("iss", $uid, $one_week_ago, $today);
  $attendance_date->execute();
  $result = $attendance_date->get_result();
  $attendance_dates = [];

  while ($row = $result->fetch_assoc()) {
    $attendance_dates[] = $row['check_date'];
  }
  $attendance_date->close();

  // 최종 최근 일주일 동안 출석한 날짜
  //print_r($attendance_dates); // 출석 날짜 배열 =Array ( [0] => 2024-12-21 [1] => 2024-12-22 )

  // 이번 주 월요일부터 일요일까지 날짜 계산
  $startOfWeek = date('Y-m-d', strtotime('monday this week'));
  $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

  // 이번 주 날짜 배열 생성 (월요일부터 일요일까지)
  //+ 이번 달 데이터 표시
  $weekDates = [];
  $weekMonths = [];
  for ($i = 0; $i < 7; $i++) {
    $currentDate = date('Y-m-d', strtotime("+$i days", strtotime($startOfWeek)));
    $weekDates[] = $currentDate;
    $weekMonths[] = date('n월', strtotime($currentDate)); // 해당 날짜의 월 추가
  }
  //만약 달 2개가 겹친다면 두 달을 모두 표시
  $uniqueMonths = array_unique($weekMonths);
}

 //var_dump($attendance_count); // 오늘 출석 여부 확인
 //var_dump($today);

?>

<div class="white"> <!-- 이 끝은 각자php안에! -->
  <div class="container">
    <section class="mypage_header">
      <div class="row pt-3 pb-3 d-flex">
        <div class="my_header_profile col-3">
          <div class="row d-flex align-self-center my_border">
            <div class="col-4 profile_image">
              <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/images/profile.png" alt="">
            </div>
            <div class="col-8 profile_detail">
              <div>
                <div>
                  <p class="headt6 d-flex">
                    <span><?= $_SESSION['AUNAME']; ?></span> 님,
                  </p>
                  <p>오늘 하루도 화이팅!</p>
                </div>
                <p class="today mt-2"><?= $formattedToday ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="attendance_check col-5">
          <div class="my_border">
            <p><i class="bi bi-calendar-week"></i> <?= implode(' / ', $uniqueMonths)  ?> 출석체크</p>
            <ul class="attendance_oneday d-flex">
              <?php
              foreach ($weekDates as $date) {
                $dayNumber = date('d', strtotime($date)); // 일자만 추출
                $dayName = ['일', '월', '화', '수', '목', '금', '토'][date('w', strtotime($date))]; // 요일 이름
                $checkedClass = in_array($date, $attendance_dates) ? 'checked' : ''; // 출석 여부 확인
              ?>
                <li>
                  <div class="attendance_date <?= $checkedClass; ?>"><?= $dayNumber; ?></div>
                  <div class="attendance_day"><?= $dayName; ?></div>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
        <div class="my_noti col-4">
          <div class="my_border">
            <p><i class="bi bi-chat-dots"></i> 나의 알림</p>
            <div class="my_noti_desc body2">
              <p>답변이 달린 문의글이 <span>2건</span> 있습니다.</p>
              <p>답변이 달린 문의글이 <span>2건</span> 있습니다.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="mypage_basic"> <!-- 이 끝은 각자php안에! -->
      <div class="row"> <!-- 이 끝은 각자php안에! -->
        <div class="col-2">
          <nav class="mypage_nav">
            <ul>
              <li class="mynav_title"><i class="fa-solid fa-school"></i>나의 수업</li>
              <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/mypage/mypage_lecture.php"><i class="fa-solid fa-chalkboard-user"></i>진행 / 종료 강좌</a></li>
              <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/mypage/mypage_qna.php"><i class="bi bi-question-circle"></i>내 문의글</a></li>
              <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/mypage/mypage_write_comment.php"><i class="bi bi-pencil"></i>내가 쓴 글 / 댓글</a></li>
              <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/mypage/mypage_reivew.php"><i class="fa-solid fa-file-pen"></i>내 강의 후기</a></li>
              <li class="mynav_title"><i class="bi bi-mortarboard"></i>수강신청 관리</li>
              <li><a href=""><i class="bi bi-receipt"></i>결제 내역</a></li>
              <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/cart/cart.php"><i class="bi bi-cart-check"></i>장바구니</a></li>
              <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/mypage/mypage_wishlist.php"><i class="bi bi-heart"></i>찜한 강좌</a></li>
              <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/mypage/mypage_coupons.php"><i class="bi bi-ticket-perforated"></i></i>보유 쿠폰</a></li>
              <li class="mynav_title"><i class="bi bi-gear-fill"></i></i>설정</li>
              <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/mypage/mypage_info_edit.php"><i class="bi bi-person-lines-fill"></i>기본 정보 설정</a></li>
            </ul>
          </nav>
        </div>
        <div class="col-10 mypage_main"> <!-- 이 끝은 각자php안에! -->