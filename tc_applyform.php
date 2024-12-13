<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/CODE_EVEN/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

// 로그인 여부 확인
// if (!isset($_SESSION['AUID'])) {
//     echo "<script>
//         alert('로그인이 필요합니다.');
//         // location.href='/CODE_EVEN/';
//         history.back();
//     </script>";
//     exit;
// }

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
  <section class="mb-5 s_h pt-5">
    <div class="container d-flex justify-content-center">
      <div class="data d-flex">
        <img src="front/images/data.png" class="my-3 img_w" alt="data.png">
        <div class="value_cover">
          <div class="headt5">1인 평균 누적수입</div>
          <div class="headt3">5783만원</div>
        </div>
      </div>
      <div class="data d-flex b_l">
        <img src="front/images/graduated.png" class="my-3 img_w" alt="data.png">
        <div>
          <div class="headt5">총 회원수</div>
          <div class="headt3">100만명</div>
        </div>
      </div>
      <div class="data d-flex b_l">
        <img src="front/images/group.png" class="my-3 img_w" alt="data.png">
        <div>
          <div class="headt5">누적 수강생</div>
          <div class="headt3">500만명</div>
        </div>
      </div>
    </div>
  </section>
  <section class="mb-5 bc_w white">
    <div class="container ">
      <div class="data d-flex justify-content-center ">
        <div class="value_cover">
          <div class="d-flex justify-content-center img_b">
            <img src="admin/images/txt_logo.png" class="my-3" alt="data.png">
          </div>
          <div class="headt2">왜 코드이븐일까요?</h2>
        </div>
      </div>
      <div class="d-flex justify-content-center g_new">
        <div class="in_sz">
          <div class="d-flex justify-content-center mb-3">
            <img src="front/images/lock_up.png" class="my-3" alt="data.png">
          </div>
          <div class="text_agn">
            <div class="fz_1">지식 콘텐츠를 함부로 다루지 않습니다.</div><br>
            <div class="fz_2">
              <div>여러분의 지식은 <br>그 자체로 고유한 가치와 의미를 지닌 자산입니다.</div> <br>
              <span>플랫폼 내에서 강의자의 콘텐츠는 철저히 관리되고,<br> 지식이 손상되거나 남용되지 않도록 노력합니다.<br>여러분의 노력이 온전히 빛날 수 있는 환경을 제공합니다.</span>
            </div>
          </div>
        </div>
        <div class="in_sz">
          <div class="d-flex justify-content-center mb-3">
            <img src="front/images/management.png" class="my-3" alt="data.png">
          </div>
          <div class="text_agn">
            <div class="fz_1">수익이 가능한 유일한 곳</div><br>
            <div class="fz_2">
              <div>
                우리가 제공하는 플랫폼은 단순한 지식 공유를 넘어 강의자가<br>
                안정적인 수익을 창출할 수 있도록 돕는 시스템을 운영합니다.
              </div> <br>
              <span>
                강의자의 성과에 따라 공정하게 보상받는 구조를 갖추고 있습니다. <br>여러분의 가치를 제대로 인정받으며 경제적 성과까지 <br>
                거둘 수 있는 곳 입니다.
              </span>
            </div>
          </div>
        </div>
        <div class="in_sz">
          <div class="d-flex justify-content-center mb-3">
            <img src="front/images/green.png" class="my-3" alt="data.png">
          </div>
          <div class="text_agn">
            <div class="fz_1">사회적 가치를 실현하세요</div><br>
            <div class="fz_2">
              <div>
                여러분이 공유하는 지식은<br> 수강생의 삶을 바꾸고 긍정적인 영향을 미칠 수 있습니다.
              </div> <br>
              <span>
                코드이븐은 강의자가 자신의 전문성을 통해<br> 사회적 가치를 실현할 수 있도록 지원을 아끼지 않습니다. <br>더 나은 미래를 만들어가는 원동력이 되어주세요.
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container col-3 w_ed p_ud">
      <h1 class=" mb-5 d-flex justify-content-center">강사 신청</h1>
      <br>
      <form action="tc_apply_ok.php" method="POST" class="signup_con">
        <div class="d_f">
          <label for="username" class="form-label align-self-center">이름</label>
          <input type="text" class="form-control" id="name" name="username" value="<?= $user_data->username; ?>" disabled readonly>
        </div>
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
