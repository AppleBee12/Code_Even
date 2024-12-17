<?php
$title = '마이페이지-강좌보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/mypage_main.js\"></script>";


// 사용자 정보 가져오기 (Prepared Statement 사용)
$user_sql = "SELECT * FROM user";
$result = $mysqli->query($user_sql);

if ($result->num_rows > 0) {
  // 첫 번째 행의 데이터를 가져옴
  $user_data = $result->fetch_object();
} else {
  echo "데이터가 없습니다.";
  exit;
}

?>
<!--탭 메뉴 시작-->
  <div class="mypage_tap_wrapper headt5">
    <div class="mypage_tap nav-link active">기본 정보 수정</div>
  </div>
<!--탭 메뉴 끝-->
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab">
    <div class="my_info_wrapper mb-5">
      <div class="my_info">
        <div class="header_grade2">개인정보</div>
        <div class="d-flex info_wrapper align-items-center">
          <div class="col-2">
            <label for="userid" class="form-label align-self-center">아이디</label>
          </div>
          <div class="col-6 user_info">
            <input type="text" class="form-control" id="userid" name="userid" value="<?= $user_data->userid; ?>" disabled readonly>
          </div>
          <div class="col-3 color_gray mx-3">
            <span class="subtitle2">* 아이디는 수정할 수 없습니다.</span>
          </div>
        </div>
        <div class="d-flex info_wrapper align-items-center mt-3">
          <div class="col-2">
            <label for="usernick" class="form-label align-self-center">닉네임</label>
          </div>
          <div class="col-6 user_info">
            <input type="text" class="form-control" id="usernick" name="usernick" value="<?= $user_data->usernick; ?>">
          </div>
        </div>
        <div class="d-flex info_wrapper align-items-center mt-3">
          <div class="col-2">
            <label for="username" class="form-label align-self-center">이름</label>
          </div>
          <div class="col-6 user_info">
            <input type="text" class="form-control" id="username" name="username" value="<?= $user_data->username; ?>">
          </div>
        </div>
        <div class="d-flex info_wrapper align-items-center mt-3">
          <div class="col-2">
            <label for="userpw" class="form-label align-self-center">비밀번호</label>
          </div>
          <div class="col-6 user_info">
            <input type="password" class="form-control" id="userpw" name="userpw" value="<?= $user_data->userpw; ?>">
          </div>
        </div>
        <div class="d-flex info_wrapper align-items-center mt-3">
          <div class="col-2">
            <label for="userpw" class="form-label align-self-center">비밀번호 확인</label>
          </div>
          <div class="col-6 user_info">
            <input type="password" class="form-control" id="userpw" name="userpw" value="<?= $user_data->userpw; ?>">
          </div>
        </div>
        <div class="d-flex info_wrapper align-items-center mt-3">
          <div class="col-2">
            <label for="userphonenum" class="form-label align-self-center">연락처</label>
          </div>
          <div class="col-6 user_info">
            <input type="text" class="form-control" id="userphonenum" name="userphonenum" value="<?= $user_data->userphonenum; ?>">
          </div>
        </div>
        <div class="d-flex info_wrapper align-items-center mt-3">
          <div class="col-2">
            <label for="useremail" class="form-label align-self-center">이메일</label>
          </div>
          <div class="col-6 user_info">
            <input type="text" class="form-control" id="useremail" name="useremail" value="<?= $user_data->useremail; ?>">
          </div>
        </div>
      </div>
    </div>
    <div class="my_info_wrapper mb-5">
      <div class="my_info">
        <div class="header_grade2">배송 주소</div>
        <div class="d-flex info_wrapper align-items-center">
          <div class="col-2">
            <label for="post_code" class="form-label align-self-center">우편번호</label>
          </div>
          <div class="col-6 user_info">
            <input type="text" class="form-control" id="post_code" name="post_code" value="<?= $user_data->post_code; ?>">
          </div>
          <div class="btn">
            <button type="button" class="btn btn-light">우편번호찾기</button>
          </div>
        </div>
        <div class="d-flex info_wrapper align-items-center mt-3">
          <div class="col-2">
            <label for="addr_line1" class="form-label align-self-center">기본주소</label>
          </div>
          <div class="col-6 user_info">
            <input type="text" class="form-control" id="addr_line1" name="addr_line1" value="<?= $user_data->addr_line1; ?>">
          </div>
        </div>
        <div class="d-flex info_wrapper align-items-center mt-3">
          <div class="col-2">
            <label for="addr_line2" class="form-label align-self-center">상세주소</label>
          </div>
          <div class="col-6 user_info">
            <input type="text" class="form-control" id="addr_line2" name="addr_line2" value="<?= $user_data->addr_line2; ?>">
          </div>
        </div>
      </div>
    </div>
    <div class="my_info_wrapper mb-5">
      <div class="my_info">
        <div class="header_grade2">마케팅 수신 동의 (선택)</div>
        <div class="d-flex info_wrapper align-items-center">
          <div class="col-2">
            <label for="email_ok" class="form-label align-self-center">우편번호</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="text" value="<?= $user_data->email_ok; ?>" name="email_ok" id="email_ok">
            <label class="form-check-label" for="email_ok">
              동의
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>