<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container_login ">
  <img src="images/txt_logo.png" alt="">
  <h1>로그인</h1>
  <h2>관리자 로그인</h2>
  <form action="login_ok.php" method="POST">
      <label for="inputPassword5" class="form-label  mt-3">아이디</label>
      <input type="text" id="inputPassword5" class="form-control  w-25" aria-describedby="passwordHelpBlock" placeholder="아이디를 입력하세요" required>
      <label for="inputPassword5" class="form-label mt-3">비밀번호</label>
      <input type="password" id="inputPassword5" class="form-control  w-25" aria-describedby="passwordHelpBlock" placeholder="비밀번호를 입력하세요" required>

    <div class="d-flex flex-column justify-content-center">
      <button class="btn btn-primary mt-3 w-25">로그인</button>
      <div class="d-flex gap-3  mt-3">
        <a href="" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">아이디 찾기</a>
        <a href="" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">비밀번호 찾기</a>
        <a href="signup.php" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">회원가입</a>
      </div>
    </div>
  </form>
</div>