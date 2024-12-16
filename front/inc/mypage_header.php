<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/mypage_main.js\"></script>";

$userid = $_SESSION['AUID']; // 세션에서 로그인된 사용자 ID 가져오기

//사용자 정보 가져오기
 $user_sql = "SELECT username, userphonenum, useremail FROM user WHERE userid = '$userid'";
$user_result = $mysqli->query($user_sql);
if ($user_result && $user_result->num_rows > 0) {
  $user_data = $user_result->fetch_object();
} else {
  echo "<p>사용자 정보를 찾을 수 없습니다.</p>";
  exit;
}

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
                <div class="headt6">
                  <p>
                    <span class="">
                      <?php //echo $_SESSION['AUNAME'];
                      ?>
                      이븐 학생
                    </span> 님,
                  </p>
                  <p>오늘 하루도 화이팅!</p>
                </div>
                <p class="today mt-2">2024월 12월 15일</p>
              </div>
            </div>
          </div>
        </div>
        <div class="attendance_check col-5">
          <div class="my_border">
            <p><i class="bi bi-calendar-week"></i> 12월 출석체크</p>
            <ul class="attendance_oneday d-flex">
              <li>
                <div class="attendance_date checked">16</div>
                <div class="attendance_day">월</div>
              </li>
              <li>
                <div class="attendance_date">17</div>
                <div class="attendance_day">화</div>
              </li>
              <li>
                <div class="attendance_date">18</div>
                <div class="attendance_day">수</div>
              </li>
              <li>
                <div class="attendance_date">19</div>
                <div class="attendance_day">목</div>
              </li>
              <li>
                <div class="attendance_date">20</div>
                <div class="attendance_day">금</div>
              </li>
              <li>
                <div class="attendance_date">21</div>
                <div class="attendance_day">토</div>
              </li>
              <li>
                <div class="attendance_date">22</div>
                <div class="attendance_day">일</div>
              </li>
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
              <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/mypage/mypage_lecture.php"><i class="fa-solid fa-chalkboard-user"></i>진행 / 종료 강좌</a></li>
              <li><a href=""><i class="bi bi-question-circle"></i>내 문의글</a></li>
              <li><a href=""><i class="bi bi-pencil"></i>내가 쓴 글 / 댓글</a></li>
              <li><a href=""><i class="fa-solid fa-file-pen"></i>내 강의 후기</a></li>
              <li class="mynav_title"><i class="bi bi-mortarboard"></i>수강신청 관리</li>
              <li><a href=""><i class="bi bi-receipt"></i>결제 내역</a></li>
              <li><a href=""><i class="bi bi-cart-check"></i>장바구니</a></li>
              <li><a href=""><i class="bi bi-heart"></i>찜한 강좌</a></li>
              <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/mypage/mypage_coupons.php"><i class="bi bi-ticket-perforated"></i></i>보유 쿠폰</a></li>
              <li class="mynav_title"><i class="bi bi-gear-fill"></i></i>설정</li>
              <li><a href=""><i class="bi bi-person-lines-fill"></i>기본 정보 설정</a></li>
            </ul>
          </nav>
        </div>
        <div class="col-10 mypage_main"> <!-- 이 끝은 각자php안에! -->