<?php
// include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container_login">
  <h1>로그인</h1>
  <h2>관리자 로그인</h2>
  <form action="login_ok.php" method="POST">
    <div class="form-floating mb-3">
      <input type="text" class="form-control w-50" id="userid" placeholder="아이디를 입력하세요" name="userid">
      <label for="userid">아이디</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control w-50" id="userpw" placeholder="비밀번호를 입력하세요" name="userpw">
      <label for="userpw">비밀번호</label>
    </div>
    <button class="btn btn-primary mt-3 w-50">로그인</button>
  </form>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>