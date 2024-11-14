<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/common.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/main.css">
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
    <!-- <div class="container">
      <img src="images/txt_logo.png" alt="">
      <h1 class="mt-3">로그인</h1>
      <h2>관리자 로그인</h2>
      <form action="login_ok.php" method="POST">
        <label for="inputPassword5" class="form-label  mt-3">아이디</label>
        <input type="text" id="inputPassword5" class="form-control  w-25" aria-describedby="passwordHelpBlock" placeholder="아이디를 입력하세요" name="userid" required>
        <label for="inputPassword5" class="form-label mt-3">비밀번호</label>
        <input type="password" id="inputPassword5" class="form-control  w-25" aria-describedby="passwordHelpBlock" placeholder="비밀번호를 입력하세요" name="userpw" required>

        <div class="d-flex flex-column">
          <button class="btn btn-primary mt-3 w-25">로그인</button>
          <div class="d-flex gap-3 mt-3 findpw justify-content-end">
            <a href="" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">아이디 찾기</a>
            <a href="" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">비밀번호 찾기</a>
            <a href="../signup/signup.php" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">회원가입</a>
          </div>
        </div>
      </form>
    </div> -->
    <div class="d-flex gap-5 align-items-center bgsz">
      <div class="img-wrap  w-50 d-flex justify-content-center">
        <div class="images1">
          <img src="../../images/sb_logo.png" alt="">
        </div>
      </div>
      <div class="w-50 d-flex justify-content-center">
        <div>
          <div class="d-flex row">
            <img src="../../images/txt_logo.png"  class="images2" alt="">
            <h1 class="mt-3">로그인</h1>
            <h2>관리자 로그인</h2>
          </div>
          <form action="login_ok.php" method="POST">
            <label for="inputPassword5" class="form-label  mt-3">아이디</label>
            <input type="text" id="inputPassword5" class="form-control  w-75" aria-describedby="passwordHelpBlock" placeholder="아이디를 입력하세요" name="userid" required>
            <label for="inputPassword5" class="form-label mt-3">비밀번호</label>
            <input type="password" id="inputPassword5" class="form-control w-75" aria-describedby="passwordHelpBlock" placeholder="비밀번호를 입력하세요" name="userpw" required>

            <div class="">
              <button class="btn btn-primary mt-3 w-75">로그인</button>
              <div class="d-flex gap-3 mt-3 findpw">
                <a href="" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">아이디 찾기</a>
                <a href="" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">비밀번호 찾기</a>
                <a href="../signup/signup.php" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">회원가입</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>