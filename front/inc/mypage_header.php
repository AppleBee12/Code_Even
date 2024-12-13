<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/mypage_main.js\"></script>";
?>

<div class="white"> <!-- 이 끝은 각자php안에! -->
  <div class="container">
    <section class="mypage_header">
      <div class="row">
        <div class="col-4 row">
          <div class="col-3 profile_image"></div>
          <div class="col-9 profile_detail">
            <?= ($_SESSION[''])?>
              <p><span><?= $_SESSION['AUNAME'] ?></span> 님,</p>
              <p>오늘 하루도 화이팅!</p>
              <p>2024월 12월 09일</p>

          </div>
        </div>
        <div class="col-4"></div>
        <div class="col-4"></div>
      </div>
    </section>
