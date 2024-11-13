<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<div class="container">
  <img src="images/txt_logo.png" alt="">
  <h1 class="mt-3">회원가입</h1>
    <form action="signup_ok.php" method="POST">
      
      <label for="username" class="form-label mt-3">이름</label>
    <input type="text" id="username" name="username" class="form-control w-25" placeholder="홍이븐" required>
    
    <label for="usernick" class="form-label mt-3">닉네임</label>

    <div class="d-flex gap-1">
      <input type="text" id="usernick" name="usernick" class="form-control w-25" placeholder="이븐이">
      <button type="button" class="btn btn-outline-secondary">중복확인</button>
    </div>

    <label for="userid" class="form-label mt-3">아이디</label>

    <div class="d-flex gap-1" id="signup_form">
      <input type="text" id="userid " class="form-control w-25" placeholder="code_even123" name="userid" required>
      <button type="button" class="btn btn-outline-secondary" >중복확인</button>
    </div>

    <label for="password" class="form-label mt-3">비밀번호</label>
    <input type="password" id="userpw" class="form-control w-25" placeholder="숫자/영문/특수문자를 조합한 6~16자 이하" name="userpw" required>

    <div class=" mt-3 ">
      <div class="">
        <label for="userphonenum" class="form-label mt-3">연락처</label>
        <input type="text" id="userphonenum" class="form-control w-25" placeholder="010-1234-5678" name="userphonenum" required>
      </div>
      
      <div class="">
        <label for="useremail" class="form-label mt-3">이메일</label>
        <input type="email" id="useremail" class="form-control w-25" aria-describedby="passwordHelpBlock" placeholder="code@even.com" name="useremail" required>
      </div>
    </div>


    <div class="form-check mt-3">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
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
    <button class="btn btn-secondary mt-3 w-25">회원가입</button>
    </form>
  </div>
</body>
</html>