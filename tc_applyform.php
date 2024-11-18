<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/CODE_EVEN/admin/inc/dbcon.php');

// 로그인 여부 확인
if (!isset($_SESSION['AUID'])) {
    echo "<script>
        alert('로그인이 필요합니다.');
        location.href='/CODE_EVEN/admin/login/login.php';
    </script>";
    exit;
}

$userid = $_SESSION['AUID']; // 세션에서 로그인된 사용자 ID 가져오기

// 사용자 정보 가져오기
$user_sql = "SELECT username, userphonenum, useremail FROM user WHERE userid = '$userid'";
$user_result = $mysqli->query($user_sql);
if ($user_result && $user_result->num_rows > 0) {
    $user_data = $user_result->fetch_object();
} else {
    echo "<p>사용자 정보를 찾을 수 없습니다.</p>";
    exit;
}

// 'code'가 'A'로 시작하는 category 데이터를 가져오기
$category_sql = "SELECT * FROM category WHERE code LIKE 'A%' ORDER BY cgid ASC";
$category_result = $mysqli->query($category_sql);

while($data = $category_result->fetch_object()){
    $categories[] = $data;
}
?>

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
<div class="container mt-5 col-3">
    <h1 class="mb-5">강사 신청(임시)</h1>
    <form action="tc_apply_process.php" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">이름</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $user_data->username; ?>" disabled readonly>
      </div>
      <div class="mb-3">
        <label for="contact" class="form-label">연락처</label>
        <input type="text" class="form-control" id="contact" name="contact" value="<?= $user_data->userphonenum; ?>" disabled readonly>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">이메일</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $user_data->useremail; ?>" disabled readonly>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">소개글</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="간단한 자기소개 부탁드려요."></textarea>
      </div>
      <div class="mb-3">
        <label for="contact" class="form-label">URL</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="tc_url" value="" placeholder="https://">
      </div>
      <div class="mb-3">
            <label for="categories" class="form-label">희망 분야</label><br>
            <?php if (isset($categories)) {
                foreach ($categories as $category) { ?>
                    <input type="radio" id="category<?= $category->cgid; ?>" name="category" value="<?= $category->cgid; ?>">
                    <label for="category<?= $category->cgid; ?>"><?= $category->name; ?></label><br>
            <?php }} else { ?>
                <p>선택 가능한 희망 분야가 없습니다.</p>
            <?php } ?>
        </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          이메일 수신동의
        </label>
      </div>
      <button type="submit" class="btn btn-primary">신청하기</button>
    </form>
</div>
</body>
