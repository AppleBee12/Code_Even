<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/CODE_EVEN/admin/inc/dbcon.php');

// 로그인 여부 확인
if (!isset($_SESSION['AUID'])) {
    echo "<script>
        alert('로그인이 필요합니다.');
        // location.href='/CODE_EVEN/';
        history.back();
    </script>";
    exit;
}

$userid = $_SESSION['AUID']; // 세션에서 로그인된 사용자 ID 가져오기

// 사용자 정보 가져오기
$user_sql = "SELECT username, userphonenum, useremail FROM user WHERE userid = '$userid'";
$user_result = $mysqli->query($user_sql);
if ($user_result && $user_result->num_rows > 0) {
    $user_data = $user_result->fetch_object();
} else {
    echo "<p>사용자 정보를 찾을 수 없습니다.</p>";
    exit;
}

// 'code'가 'A'로 시작하는 category 데이터를 가져오기
$category_sql = "SELECT * FROM category WHERE code LIKE 'A%' ORDER BY cgid ASC";
$category_result = $mysqli->query($category_sql);

while($data = $category_result->fetch_object()){
    $categories[] = $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/common.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/css/main.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/css/tc_applyform.css">
  <title>CodeEven</title>
</head>
<body>
  <div class=" gap-5  bgsz">
  <section class="d-flex justify-content-center mb-5 s_h pt-5">
    <div class="data d-flex">
      <img src="images/data.png" class="my-3" alt="data.png">
      <div class="value_cover">
        <h5>1인 평균 누적수입</h5>
        <h3>5783만원</h3>
      </div>
    </div>
    <div class="data d-flex b_l">
      <img src="images/graduated.png" class="my-3" alt="data.png">
      <div>
        <h5>총 회원수</h5>
        <h3>100만명</h3>
      </div>
    </div>
    <div class="data d-flex b_l">
      <img src="images/group.png" class="my-3" alt="data.png">
      <div>
        <h5>누적 수강생</h5>
        <h3>500만명</h3>
      </div>
    </div>
  </section>
  <div class="container col-3 mb-5 mt-5 w_ed">
      <h1 class=" mb-5 d-flex justify-content-center">강사 신청</h1>
      <br>
      <form action="tc_apply_ok.php" method="POST" class="signup_con">
        <div class="d_f">
          <label for="username" class="form-label align-self-center">이름</label>
          <input type="text" class="form-control" id="name" name="username" value="<?= $user_data->username; ?>" disabled readonly>
        </div>
        <!-- <div class="wrappers d-flex ">
          <label for="username" class="form-label w-25 align-self-center">이름 </label>
          <input type="text" id="name" name="username" class="form-control" value="<?= $user_data->username; ?>" disabled readonly>
        </div> -->
        <div class="d_f">
          <label for="tc_userphone" class="form-label">연락처</label>
          <input type="text" class="form-control" id="contact" name="tc_userphone" value="<?= $user_data->userphonenum; ?>" disabled readonly>
        </div>
        <div class="d_f">
          <label for="tc_email" class="form-label">이메일</label>
          <input type="email" class="form-control" id="email" name="tc_email" value="<?= $user_data->useremail; ?>" disabled readonly>
        </div>
        <div class="d_f h_ed">
          <label for="tc_intro" class="form-label">소개글 <b>*</b></label>
          <textarea class="form-control " id="tc_intro" rows="3" name="tc_intro" placeholder="간단한 자기소개 부탁드려요."></textarea>
        </div>
        <div class="mb-1 d_f ">
          <label for="tc_url" class="form-label">URL</label>
          <input type="text" class="form-control" id="tc_url" name="tc_url" value="" placeholder="https://"> 
        </div>
          <p class="p_c">* 활동 중인 SNS, 대표 사이트를 첨부해주세요</p>
        <div class="mb-3 mt-5 d-flex gap-2">
          <label for="categories" class="form-label">희망분야 <b>*</b></label><br>
            <div>
              <?php if (isset($categories)) {
                foreach ($categories as $category) { ?>
                  <input type="radio" id="category<?= $category->cgid; ?>" name="category" value="<?= $category->cgid; ?>">
                  <label for="category<?= $category->cgid; ?>"><?= $category->name; ?></label><br>
              <?php }} else { ?>
                <p>선택 가능한 희망 분야가 없습니다.</p>
              <?php } ?>
            </div>
        </div>
        <div class="form-check my-3 p_c">
          <input class="form-check-input" type="checkbox" value="" id="agree">
          <label class="form-check-label" for="agree">
            [필수] 개인정보 수집  및 이용에 동의합니다.
          </label>
        </div>
        
        <button type="submit" class="btn tc_btn w_ed mt-3 mb-5">신청하기</button>
      </form>
  </div>
</div>
<script>
$(document).ready(function(){
  $(".signup_con").on("submit", function(event){
    // 체크박스가 체크되지 않은 경우
    if(!$("#agree").is(":checked")){
      alert("이용약관에 동의해 주세요.");
      event.preventDefault(); // 폼 제출 중단
    }
  });
});
</script>


</body>
</html>
