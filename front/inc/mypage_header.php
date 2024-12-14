<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/mypage_main.js\"></script>";


//$userid = $_SESSION['AUID']; // 세션에서 로그인된 사용자 ID 가져오기

// 사용자 정보 가져오기
//나중에 풀기 $user_sql = "SELECT username, userphonenum, useremail FROM user WHERE userid = '$userid'";
//$user_result = $mysqli->query($user_sql);
// if ($user_result && $user_result->num_rows > 0) {
//   $user_data = $user_result->fetch_object();
// } else {
//   echo "<p>사용자 정보를 찾을 수 없습니다.</p>";
//   exit;
// }

?>

<div class="white"> <!-- 이 끝은 각자php안에! -->
  <div class="container">
    <section class="mypage_header">
      <div class="row pt-3 pb-3">
        <div class="my_header_profile col-4 row d-flex">
          <div class="col-3 profile_image">
            <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/images/profile.png" alt="">
          </div>
          <div class="col-9 profile_detail">
            <div class="headt6">
              <p>
                <span class="headt5">
                  <?php //echo $_SESSION['AUNAME'];
                  ?>
                  이븐 학생
                </span> 님,
              </p>
              <p>오늘 하루도 화이팅!</p>
            </div>
            <p class="today lineh30 mt-2">2024월 12월 15일</p>
          </div>
        </div>
        <div class="attendance_check col-4">
          <div class="my_border">
            <p>12월 출석체크</p>
            <ul class="attendance_oneday d-flex">
              <li>
                <div class="attendance_date">16</div>
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
        <div class="my_notification col-4">
          <div class="my_border">
            <p>나의 알림</p>
            <div>
              <p>답변이 달린 문의글이 <span>2건</span>있습니다.</p>
              <p>답변이 달린 문의글이 <span>2건</span>있습니다.</p>
            </div>
          </div>
        </div>
      </div>
    </section>