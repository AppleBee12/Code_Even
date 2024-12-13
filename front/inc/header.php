<?php
session_start(); 
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/check_cookie.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');


if (!isset($title)) {
  $title = '';
}


//카카오 간편 로그인 --시작

//카카오 간편 로그인 --끝


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>코드이븐 <?= $title ?>페이지에 오신것을 환영합니다.</title>

  <!-- 공통 CSS -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/admin/css/reset.css">
  <link href="https://cdn.jsdelivr.net/gh/sun-typeface/SUIT@2/fonts/static/woff2/SUIT.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css"
    integrity="sha256-IKhQVXDfwbVELwiR0ke6dX+pJt0RSmWky3WB2pNx9Hg=" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/css/common.css">


  <!-- 개인 CSS -->
  <?php
  $page = basename($_SERVER['PHP_SELF']); // 현재 실행 중인 페이지 이름을 가져옵니다
  switch ($page) { //main.css
    case 'index.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/main.css">';
      break;
  }
  switch ($page) { //mypage_header.css
    case 'mypage_header.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/css/mypage_header.css">';
      break;
  }
  ?>

  <!-- jquery, swiper 제외한 모든 js는 푸터 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


</head>

<body>
  <header>
    <div class="container">
      <div class="header_grade1 d-flex justify-content-between align-items-center">
        <div class="header_logo">
          <h1 class="logo"><a href="">CODE EVEN</a></h1>
        </div>
        <div>
          <ul class="d-flex gap-3">
            <?php if (!isset($_SESSION['AUID'])) { ?>
              <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModaltest" data-bs-whatever="@mdo">로그인</a>
              </li>
            <?php
              }else{
              ?>
            <li> 
              <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/members/login/logout.php">로그아웃</a>
            </li>
              <?php
                } 
              ?>
                <li><a href="members/signup/signup.php">회원가입</a></li>
            <li>고객센터
              <ul>
                <li>공지사항</li>
                <li>FAQ</li>
              </ul>
            </li>
          </ul>
        </div>
      </div> 
      <div class="header-grade2 d-flex">
        <nav class="header-menu">
          <ul class="d-flex gap-3">
            <li>
              강좌
              <ul>
                <li>중분류1
                  <ul>
                    <li><a href="">소분류1-1</a></li>
                  </ul>
                </li>
                <li>중분류2
                  <ul>
                    <li><a href="">소분류2-1</a></li>
                  </ul>
                </li>
                <li>중분류3
                  <ul>
                    <li><a href="">소분류3-1</a></li>
                  </ul>
                </li>
                <li>중분류4
                  <ul>
                    <li><a href="">소분류4-1</a></li>
                  </ul>
                </li>
                <li>중분류5
                  <ul>
                    <li><a href="">소분류5-1</a></li>
                  </ul>
                </li>
                <li>중분류6
                  <ul>
                    <li><a href="">소분류6-1</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="">'레시피 강좌'란?</a></li>
            <li>커뮤니티
              <ul>
                <li><a href="">고민상담</a></li>
                <li><a href="">팀 프로젝트</a></li>
                <li><a href="">블로그</a></li>
              </ul>
            </li>
          </ul>
        </nav>
        <div class="header-search">
          <div>
            <i class="bi bi-search"></i>
          </div>
        </div>
        <div class="header-icon visually-hidden">
          <div><a href="">장바구니</a></div>
          <div><a href="">알람</a></div>
          <div class="mini-profile">
            미니 프로필
            <div>
              <img src="" alt="">프로필사진
            </div>
            <ul>
              <li>
                <a href=""><img src="" alt="">프로필사진</a>
                <div>쿠폰 <span></span> </div>
                <div>수강 중인 강좌 <span></span> </div>
              </li>
              <hr>
              <li><a href="">나의 수업</a></li>
              <hr>
              <li><a href="">장바구니</a></li>
              <li><a href="">찜한 강좌</a></li>
              <hr>
              <li><a href="">기본 정보 설정</a></li>
              <li><a href="">로그아웃</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>


  <div class="modal fade" id="exampleModaltest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog w_c">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-header d-flex justify-content-center">
          <div class="wrappers d-flex row justify-content-center">
            <img src="admin/images/txt_logo.png" class="mt-5" width="309" height="46" alt="코드이븐로고">
            <h1 class="modal-title fs-5 mt-5 d-flex justify-content-center" id="exampleModalLabel login">로그인</h1>
          </div>
        </div>
        <div class="modal-body">
          <form action="members/login/login_ok.php" method="POST">
            <div class="mb-3 d-flex justify-content-center gap-4 mid">
              <label for="inputId" class="col-form-label align-self-center">아이디</label>
              <input type="text" class="form-control id" id="inputId" placeholder="아이디를 입력하세요" name="userid" required>
            </div>
            <div class="mb-3 d-flex justify-content-center gap-3 mpw">
              <label for="inputPassword" class="col-form-label align-self-center">비밀번호</label>
              <input type="password" class="form-control pw" id="inputPassword" placeholder="비밀번호를 입력하세요" name="userpw" required>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <div class="d-flex row">
                <button class="btn loginbtn redbtn">로그인</button>
                <a href="https://kauth.kakao.com/oauth/authorize?client_id=<?= $REST_API_KEY ?>&response_type=code&redirect_uri=<?= $REDIRECT_URI ?>" class="kakao"><img src="front/images/kakaobtn.png" width="360" height="34" class="mt-1 " /></a>
              </div>

              <div class="mt-3 d-flex justify-content-center gap-3 mb-5">
                <a href="#" class="link-body-emphasis ">아이디 찾기</a>
                <a href="#" class="link-body-emphasis">비밀번호 찾기</a>
                <a href="members/signup/signup.php" class="link-body-emphasis text-decoration-underline">회원가입</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="main_wrapper">