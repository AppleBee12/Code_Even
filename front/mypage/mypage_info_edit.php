<?php
$title = '마이페이지-강좌보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/mypage_main.js\"></script>";




// 사용자 정보 가져오기 (Prepared Statement 사용)
$user_sql = "SELECT userid, usernick, username, userpw, userphonenum, useremail, post_code, addr_line1, addr_line2, addr_line3, email_ok 
             FROM user 
             WHERE userid = ?";

$stmt = $mysqli->prepare($user_sql);

if ($stmt) {
    $stmt->bind_param("s", $userid); // userid 바인딩
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // 사용자 데이터 가져오기
        $user_data = $result->fetch_object();
    } else {
        echo "사용자 데이터를 찾을 수 없습니다.";
        exit;
    }
    $stmt->close();
} else {
    echo "쿼리 준비 실패: " . $mysqli->error;
    exit;
}

?>
<!--탭 메뉴 시작-->
  <div class="mypage_tap_wrapper headt5">
    <div class="mypage_tap nav-link active">기본 정보 수정</div>
  </div>

  <form action="mypage_info_edit_ok.php" method="POST">
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
                <input type="password" class="form-control" id="userpw" name="userpw" value="" placeholder="* 비밀번호는 변경시에만 입력해주세요.">
              </div>
            </div>
            <div class="d-flex info_wrapper align-items-center mt-3">
              <div class="col-2">
                <label for="userpw" class="form-label align-self-center">비밀번호 확인</label>
              </div>
              <div class="col-6 user_info">
                <input type="password" class="form-control" id="userpw_check" name="userpw" value="" placeholder="* 비밀번호는 변경시에만 입력해주세요.">
              </div>
            </div>
            <div class="d-flex info_wrapper align-items-center mt-3">
              <div class="col-2">
                <label for="userphonenum" class="form-label align-self-center">연락처</label>
              </div>
              <div class="col-6 user_info">
                <input type="text" class="form-control" id="userphonenum" name="userphonenum" value="<?= $user_data->userphonenum; ?>">
              </div>
              <div id="phonenumberError" class="text-danger mt-2 col-3 color_gray mx-3" style="display: none;">
                연락처는 11자리로 입력해주세요.
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
                <input type="text" class="form-control" id="sample6_postcode" name="post_code" value="<?= $user_data->post_code; ?>">
              </div>
              <div class="btn post_btn">
              <input type="button" class="post_search_btn" onclick="sample6_execDaumPostcode()" value="우편번호 찾기">
              </div>
            </div>
            <div class="d-flex info_wrapper align-items-center mt-3">
              <div class="col-2">
                <label for="addr_line1" class="form-label align-self-center">기본주소</label>
              </div>
              <div class="col-6 user_info">
                <input type="text" class="form-control" id="sample6_address" name="addr_line1" value="<?= $user_data->addr_line1; ?>">
              </div>
            </div>
            <div class="d-flex info_wrapper align-items-center mt-3">
              <div class="col-2">
                <label for="addr_line3" class="form-label align-self-center"></label>
              </div>
              <div class="col-6 user_info">
                <input type="text" class="form-control" id="sample6_extraAddress" name="addr_line3" value="<?= $user_data->addr_line3; ?>">
              </div>
            </div>
            <div class="d-flex info_wrapper align-items-center mt-3">
              <div class="col-2">
                <label for="addr_line2" class="form-label align-self-center">상세주소</label>
              </div>
              <div class="col-6 user_info">
                <input type="text" class="form-control" id="sample6_detailAddress" name="addr_line2" value="<?= $user_data->addr_line2 ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="my_info_wrapper mb-3">
          <div class="my_info">
            <div class="header_grade2">마케팅 수신 동의 (선택)</div>
            <div class="d-flex info_wrapper align-items-center">
              <div class="col-2">
                <label class="form-label align-self-center">이메일 수신</label>
              </div>
              <div class="d-flex gap-3">
                <!-- 동의 -->
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="1" name="email_ok" id="email_ok_yes" 
                    <?= (isset($user_data->email_ok) && intval($user_data->email_ok) === 1) ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="email_ok_yes">동의</label>
                </div>
                <!-- 동의하지 않음 -->
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="0" name="email_ok" id="email_ok_no" 
                    <?= (isset($user_data->email_ok) && intval($user_data->email_ok) === 0) ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="email_ok_no">동의하지 않음</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="info_btn mb-5 d-flex justify-content-between align-items-center">
          <a href="#" class="link-body-emphasis text-decoration-underline">계정 탈퇴하기</a>
          <button type="submit" class="btn">저장</button>
        </div>
      </div>
    </div>
  </form>
</div>
</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>


function sample6_execDaumPostcode() {
  new daum.Postcode({
    oncomplete: function(data) {
      // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

      // 각 주소의 노출 규칙에 따라 주소를 조합한다.
      // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
      var addr = ''; // 주소 변수
      var extraAddr = ''; // 참고항목 변수

      //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
      if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
        addr = data.roadAddress;
      } else { // 사용자가 지번 주소를 선택했을 경우(J)
        addr = data.jibunAddress;
      }

      // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
      if(data.userSelectedType === 'R'){
        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
            extraAddr += data.bname;
        }
        // 건물명이 있고, 공동주택일 경우 추가한다.
        if(data.buildingName !== '' && data.apartment === 'Y'){
            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
        }
        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
        if(extraAddr !== ''){
            extraAddr = ' (' + extraAddr + ')';
        }
        // 조합된 참고항목을 해당 필드에 넣는다.
        document.getElementById("sample6_extraAddress").value = extraAddr;
      
      } else {
        document.getElementById("sample6_extraAddress").value = '';
      }

      // 우편번호와 주소 정보를 해당 필드에 넣는다.
      document.getElementById('sample6_postcode').value = data.zonecode;
      document.getElementById("sample6_address").value = addr;
      // 커서를 상세주소 필드로 이동한다.
      document.getElementById("sample6_detailAddress").focus();
    }
  }).open();
}




document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('userpw');
    const passwordError = document.getElementById('passwordError');

    passwordInput.addEventListener('input', function () {
      const passwordLength = passwordInput.value.length;

      if (passwordLength > 0 && (passwordLength <= 4 || passwordLength > 10)) {
        passwordError.style.display = 'block';
      } else {
        passwordError.style.display = 'none';
      }
    });
  });
  document.addEventListener('DOMContentLoaded', function () {
    const phoneNumberInput = document.getElementById('userphonenum');
    const phoneNumberError = document.getElementById('phonenumberError');

    // 하이픈 자동 추가 함수
    const formatPhoneNumber = (value) => {
      return value
        .replace(/[^0-9]/g, '') // 숫자만 추출
        .replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`); // 하이픈 추가
    };

    phoneNumberInput.addEventListener('input', function () {
      // 현재 입력값에서 하이픈 추가
      const numericValue = phoneNumberInput.value.replace(/[^0-9]/g, '');
      phoneNumberInput.value = formatPhoneNumber(phoneNumberInput.value);

      // 유효성 검사 (정확히 11자리인지 확인)
      if (numericValue.length > 0 && numericValue.length !== 11) {
        phoneNumberError.style.display = 'block';
      } else {
        phoneNumberError.style.display = 'none';
      }
    });
  });

</script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>