<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>CodeEven</title>
</head>
<body>
  <div class="mx-auto pt-5" style="width: 320px;">
    <img src="admin/images/sb_logo.png" width="300" height="200" alt="코드이븐로고">
    <div>To be continue...</div>
    <p>코드이븐 프론트 페이지는 제작예정입니다</p>
    <ul class="list-group pt-3">
      <li class="list-group-item"><a href="tc_applyform.php" class="link-underline-danger link-offset-2 link-body-emphasis">강의자신청(임시)</a></li>
      <li class="list-group-item"><a href="" class="link-underline-danger link-offset-2 link-body-emphasis">결제페이지(임시)</a></li>
    </ul>
  </div>

  <div class="d-flex gap-5 align-items-center bgsz ">
      <div class="img-wrap  w-50 d-flex justify-content-center">
        <div class="images1">
          <img src="../images/sb_logo.png" alt="">
        </div>
      </div>
      <div class="w-50 container d-flex justify-content-center align-items-center">
        <div class="w-50 d-flex flex-column align-items-center">
          <img src="../images/txt_logo.png" class="images2" alt="">
          <h1 class="mt-5">로그인</h1>
          <form action="member/login/login_ok.php" method="POST" class="w-100">
            <label for="inputId" class="form-label mt-3">아이디</label>
            <input type="text" id="inputId" class="form-control" placeholder="아이디를 입력하세요" name="userid" required>
            
            <label for="inputPassword" class="form-label mt-3">비밀번호</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="비밀번호를 입력하세요" name="userpw" required>
            
            <button class="btn btn-primary mt-3 w-100">로그인</button>
            
            <div class="mt-3 d-flex flex-columns justify-content-center gap-3">
              <a href="#" class="link-body-emphasis ">아이디 찾기</a>
              <a href="#" class="link-body-emphasis">비밀번호 찾기</a>
              <a href="admin/signup/signup.php" class="link-body-emphasis text-decoration-underline">회원가입</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</body>
</html>