<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/common.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>

  <style>
    .findpw a{
      /* display: none; */
 
    }
    .bgsz{
      margin-top: 10%;
    }
    .images2{
      /* background: #000; */
      width: 300px;
    }
    .img-wrap{
    }
</style>

  <body>
    <div class="d-flex gap-5 align-items-center bgsz">
      <div class="img-wrap  w-50 d-flex justify-content-center">
        <div class="images1">
          <img src="../../admin/images/sb_logo.png" alt="">
        </div>
      </div>
      <div class="w-50 container d-flex justify-content-center align-items-center">
        <div class="w-50 d-flex flex-column align-items-center">
          <img src="../../admin/images/txt_logo.png" class="images2" alt="">
          <h1 class="mt-5">로그인</h1>
          <h2>강사 로그인</h2>
          <form action="login_ok.php" method="POST" class="w-100">
            <label for="inputId" class="form-label mt-3">아이디</label>

            <input type="text" id="inputId" class="form-control" placeholder="아이디를 입력하세요" name="userid" required>
            
            <label for="inputPassword" class="form-label mt-3">비밀번호</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="비밀번호를 입력하세요" name="userpw" required>
            
            <button class="btn btn-primary mt-3 w-100">로그인</button>
            
            <div class="mt-3 d-flex flex-columns justify-content-center gap-3">
              <a href="#" class="link-body-emphasis ">아이디 찾기</a>
              <a href="#" class="link-body-emphasis">비밀번호 찾기</a>
              <a href="../signup/signup.php" class="link-body-emphasis text-decoration-underline">회원가입</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>