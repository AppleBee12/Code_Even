<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/common.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/student/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>


<body>
  <div class="d-flex gap-5 align-items-center bgsz">
    <div class="img-wrap  w-50 d-flex justify-content-center">
      <div class="images1">
        <img src="../../admin/images/txt_logo.png" alt="">
      </div>
    </div>
    <div class="w-50 container d-flex justify-content-center align-items-center">
      <div class="w-50 d-flex flex-column align-items-center mt-5 mb-5">
        <h1 class="mt-5 mb-5">회원가입</h1>
        <form action="../signup/signup_ok.php" method="POST" class="signup_con">
          <div class="wrappers d-flex gap-3">
            <label for="username" class="form-label w-25 align-self-center">이름 <b>*</b></label>
            <input type="text" id="username" name="username" class="form-control" placeholder="홍이븐" required>
          </div>
          <div class="wrappers d-flex gap-3">
            <label for="usernick" class="form-label align-self-center">닉네임 <b>*</b></label>
            <div class="d-flex gap-1 w_input">
              <input type="text" id="usernick" name="usernick" class="form-control w_input2" placeholder="이븐이">
              <button type="button" id="idcheck2" class="btn btn-secondary col-md-4">중복확인</button>
            </div>
          </div>

          <div class="wrappers d-flex gap-3">
            <label for="userid" class="form-label align-self-center">아이디 <b>*</b></label>
            <div class="d-flex gap-1 w_input" id="signup_form">
              <input type="text" id="userid" class="form-control " placeholder="code_even123" name="userid" required>
              <button type="button" id="idcheck" class="btn btn-secondary col-md-4" >중복확인</button>
            </div>
          </div>
          
          <div class="wrappers d-flex gap-3">
            <label for="password" class="form-label align-self-center">비밀번호 <b>*</b></label>
            <input type="password" id="userpw" class="form-control" placeholder="5~10자 이하로 입력하세요" name="userpw" required>
            <div id="passwordError" class="text-danger mt-2" style="display: none;">
              비밀번호는 5자리 ~ 10자리 이내로 입력해주세요.
            </div>
          </div>

          <div class="wrappers d-flex gap-3">
              <label for="userphonenum" class="form-label align-self-center">연락처 <b>*</b></label>
              <input type="text" id="userphonenum" class="form-control" placeholder="010-1234-5678" name="userphonenum"  required>
              <div id="phonenumberError" class="text-danger mt-2" style="display: none;">
                연락처는 11자리로 입력해주세요.
              </div>
          </div>
            
          <div class="wrappers d-flex gap-3">
            <label for="useremail" class="form-label align-self-center">이메일 <b>*</b></label>
            <input type="email" id="useremail" class="form-control" aria-describedby="passwordHelpBlock" placeholder="code@even.com" name="useremail" required>
          </div>


          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" value="" id="agree">
            <label class="form-check-label" for="flexCheckDefault" checked >
              [필수] 개인정보 수집  및 이용에 동의합니다.
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
            <label class="form-check-label" for="flexCheckChecked">
              [선택] 광고성 이메일 수신에 동의합니다.
            </label>
          </div>
          <button class="btn btn-secondary mt-3 w-100 mb-5 redbtn">회원가입</button>
        </form>
      </div>
    </div>
  </div>

  <script>
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

 

 



  $(document).ready(function(){
    $(".signup_con").on("submit", function(event){
      // 체크박스가 체크되지 않은 경우
      if(!$("#agree").is(":checked")){
        alert("이용약관에 동의해 주세요.");
        event.preventDefault(); // 폼 제출 중단
      }
    });
  });


    let idChecked = false;

    $('#idcheck').click(function(){
      let userid = $('#userid').val();
      if(userid == ''){
        alert('아이디를 입력해주세요.');
        $('#userid').focus();
      }else{
        idCheck_func(userid);
      }
    });
    $('#idcheck2').click(function(){
      let usernick = $('#usernick').val();
      if(usernick == ''){
        alert('닉네임을 입력해주세요.');
        $('#usernick').focus();
      }else{
        idCheck_func(usernick);
      }
    });

    function idCheck_func(userid){
      let data = {
        userid:userid,
      }

      $.ajax({
        async:false,
        url:'id_check.php',
        data:data,
        type : 'post',
        dataType:'json',
        success:function(returned_data){
          if(returned_data.result == 'ok'){
            alert('사용할 수 있는 아이디입니다.');
            idChecked = true;
            return;
          }else if(returned_data.result == 'error'){
            alert('중복되는 아이디입니다.');
            return;
          }
        }
      })
    }
    function idCheck_func(usernick){
      let data = {
        usernick:usernick
      }

      $.ajax({
        async:false,
        url:'id_check.php',
        data:data,
        type : 'post',
        dataType:'json',
        success:function(returned_data){
          if(returned_data.result == 'ok'){
            alert('사용할 수 있는 닉네임입니다.');
            idChecked = true;
            return;
          }else if(returned_data.result == 'error'){
            alert('중복되는 닉네임입니다.');
            return;
          }
        }
      })
    }

//     function checkDuplication(field, value) {
//     let data = {};
//     data[field] = value; // field(아이디 또는 닉네임) 값 전송

//     $.ajax({
//       async: false,
//       url: 'id_check.php', // 동일한 PHP 파일 사용
//       data: data,
//       type: 'post',
//       dataType: 'json',
//       success: function(returned_data) {
//         if (returned_data.result === 'ok') {
//           alert('사용할 수 있는 아이디입니다.');
//           // 닉네임, 아이디에 맞게 처리
//           if (field === 'userid') {
//             idChecked = true;
//           } else if (field === 'usernick') {
//             nicknameChecked = true;
//           }
//         } else if (returned_data.result === 'error') {
//           alert(`${field}은(는) 이미 사용 중입니다.`);
//         }
//       }
//     });
// }

// function idCheck_func(userid) {
//     checkDuplication('userid', userid); // userid 중복 체크
// }

// function nicknameCheck_func(usernick) {
//     checkDuplication('usernick', usernick); // nickname 중복 체크
// }

  </script>
</body>
</html>