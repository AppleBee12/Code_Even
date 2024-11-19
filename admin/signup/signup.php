<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/common.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>

  <style>
    .signup_con{
      /* width: 420px;s */
    }
  </style>

<body>
  <div class="d-flex gap-5 align-items-center bgsz">
    <div class="img-wrap  w-50 d-flex justify-content-center">
      <div class="images1">
        <img src="../images/sb_logo.png" alt="">
      </div>
    </div>
    <div class="w-50 container d-flex justify-content-center align-items-center">
      <div class="w-50 d-flex flex-column align-items-center">
        <img src="../images/txt_logo.png" alt="">
        <h1 class="mt-5">회원가입</h1>
        <form action="../signup/signup_ok.php" method="POST" class="signup_con">
          <label for="username" class="form-label mt-3">이름 <b>*</b></label>
          <input type="text" id="username" name="username" class="form-control" placeholder="홍이븐" required>
        
          <label for="usernick" class="form-label mt-3">닉네임</label>

          <div class="d-flex gap-1">
            <input type="text" id="usernick" name="usernick" class="form-control" placeholder="이븐이">
            <button type="button" class="btn btn-outline-secondary col-md-4">중복확인</button>
          </div>

          <label for="userid" class="form-label mt-3">아이디 <b>*</b></label>

          <div class="d-flex gap-1" id="signup_form">
            <input type="text" id="userid" class="form-control" placeholder="code_even123" name="userid" required>
            <button type="button" id="idcheck" class="btn btn-outline-secondary col-md-4" >중복확인</button>
          </div>
          

          <label for="password" class="form-label mt-3">비밀번호 <b>*</b></label>
          <input type="password" id="userpw" class="form-control" placeholder="숫자/영문/특수문자를 조합한 6~16자 이하" name="userpw" required>

          <div class=" mt-3 ">
            <div class="">
              <label for="userphonenum" class="form-label mt-3">연락처 <b>*</b></label>
              <input type="text" id="userphonenum" class="form-control" placeholder="010-1234-5678" name="userphonenum" required>
            </div>
            
            <div class="">
              <label for="useremail" class="form-label mt-3">이메일 <b>*</b></label>
              <input type="email" id="useremail" class="form-control" aria-describedby="passwordHelpBlock" placeholder="code@even.com" name="useremail" required>
            </div>
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
          <button class="btn btn-secondary mt-3 w-100">회원가입</button>
        </form>
      </div>
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

    function idCheck_func(userid){
      let data = {
        userid:userid
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
            $('#userid').attr('readonly','readonly');
            return;
          }else if(returned_data.result == 'error'){
            alert('중복되는 아이디입니다.');
            return;
          }
        }
      })
    }
  </script>
</body>
</html>