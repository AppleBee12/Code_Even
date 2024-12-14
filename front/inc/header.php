<?php
session_start(); 
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/check_cookie.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');


if (!isset($title)) {
  $title = '';
}


//카카오 간편 로그인 --시작
if(isset($_GET['code'])){
  $code = $_GET['code'];
  $client_id = 'a292c01fc2579fbd7965ca9524a3032f';
  $redirect_uri = 'http://localhost/code_even/';

  //토큰 요청
  $url = 'https://kauth.kakao.com/oauth/token';
  $data = [
    'grant_type' => 'authorization_code',
    'client_id'=> $client_id,
    'redirect_uri'=> $redirect_uri,
    'code'=> $code
  ];
  $options = [
    'http'=> [
      'header'=>'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
      'method'=> 'POST',
      'content'=> http_build_query($data)
    ]
  ];
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  $response = json_decode($result, true);
  // echo '<pre>';
  // print_r($response);
  // echo '</pre>';

  //사용자 정보요청
  $ACCESS_TOKEN = $response['access_token'];
  $ch = curl_init(); //새로운 세션 생성 / 초기화
  curl_setopt($ch, CURLOPT_URL, "https://kapi.kakao.com/v2/user/me");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 결과를 문자열로 반환
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $ACCESS_TOKEN"
  ]);

  $response_result = curl_exec($ch);
  $status = curl_getinfo($ch,CURLINFO_HTTP_CODE);

  curl_close($ch);

  $resultArr = json_decode($response_result, true);

  // echo '<pre>';
  // print_r($resultArr);
  // echo '</pre>';

  if($status === 200) {
    $mysqli = new mysqli('localhost','code_even', '12345', 'code_even');
    if($mysqli->connect_errno){
      die('연결실패'. $mysqli->connect_errno);
    }
    $userId = $resultArr['id'];
    $userName = $resultArr['properties']['nickname'] ?? '';
    $profileImg= $resultArr['properties']['thumbnail_image'] ??'';

    // echo $userId;
    // echo $userName;
    // echo $profileImg;

    $tempsql = "INSERT INTO members (userid, name, profile_image) VALUES(?,?,?)";
    $sql = $mysqli->prepare($tempsql);

    if($sql){
      $sql->bind_param("sss", $userId, $userName, $profileImg);
      if($sql->execute()){
       // echo "<p>유저 정보 입력 성공</p>";
      }
      $sql->close();
    }else{
     // echo "<p>쿼리준비 실패".$mysqli->error."</p>";
    }
    $mysqli->close();
  }
}
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
      <div class="header_grade1 d-flex justify-content-end align-items-center">
        <div class="header_logo">
          <h1 class="logo text-center"><a href="">CODE EVEN</a></h1>
        </div>
        <div class="header_join">
          <ul class="d-flex justify-content-end">
            <?php if (!isset($_SESSION['AUID'])) { ?>
              <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModaltest" data-bs-whatever="@mdo">로그인</a>
              </li>
              <li><a href="members/signup/signup.php">회원가입</a></li>
              <?php }else{?>
            <li> 
              <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/members/login/logout.php">로그아웃</a>
            </li>
              <?php
                } 
              ?>
            <li><a href="#">고객센터</a></li>
          </ul>
        </div>
      </div> 
      <div class="header_grade2 d-flex justify-content-between align-items-center">
        <nav class="header_menu">
          <ul class="d-flex align-items-center">
            <li class="menu_depth1">
              <a href="">강좌</a>
              <div class="menu_depth2">
                <ul class="depth2_lec">
                  <li>
                    <a href="">프론트엔드</a>
                    <div class="menu_depth3">
                      <ul>
                        <li><a href="">HTML/CSS</a></li>
                        <li><a href="">JavaScript</a></li>
                        <li><a href="">jQuery</a></li>
                        <li><a href="">React</a></li>
                        <li><a href="">Angular</a></li>
                        <li><a href="">Vue.js</a></li>
                        <li><a href="">TypeScript</a></li>
                      </ul>
                    </div>
                  </li>
                  <li>
                    <a href="">백엔드</a>
                    <div class="menu_depth3">
                      <ul>
                        <li><a href="">Java</a></li>
                        <li><a href="">PHP</a></li>
                        <li><a href="">Next.js</a></li>
                        <li><a href="">Node.js</a></li>
                      </ul>
                    </div>
                  </li>
                  <li>
                    <a href="">클라우드 컴퓨팅</a>
                    <div class="menu_depth3">
                      <ul>
                        <li><a href="">AWS</a></li>
                        <li><a href="">Azure</a></li>
                        <li><a href="">Google Cloud Platform</a></li>
                        <li><a href="">DevOps</a></li>
                        <li><a href="">kubernetes</a></li>
                      </ul>
                    </div>
                  </li>
                  <li>
                    <a href="">데이터베이스</a>
                    <div class="menu_depth3">
                      <ul>
                        <li><a href="">SQL</a></li>
                        <li><a href="">MySQL</a></li>
                        <li><a href="">PostgreSQL</a></li>
                        <li><a href="">Oracle</a></li>
                        <li><a href="">NoSQL</a></li>
                        <li><a href="">MongoDB</a></li>
                        <li><a href="">Cassandra</a></li>
                        <li><a href="">Couchbase</a></li>
                      </ul>
                    </div>
                  </li>
                  <li>
                    <a href="">네트워크 관리</a>
                    <div class="menu_depth3">
                      <ul>
                        <li><a href="">TCP/IP</a></li>
                        <li><a href="">C/C++</a></li>
                      </ul>
                    </div>
                  </li>
                  <li>
                    <a href="">보안</a>
                    <div class="menu_depth3">
                      <ul>
                        <li><a href="">CPPG</a></li>
                        <li><a href="">security</a></li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </li>
            <li class="menu_depth1"><a href="#">'레시피 강좌'란?</a></li>
            <li class="menu_depth1">
              <a href="">커뮤니티</a>
              <div class="menu_depth2">
              <ul>
                  <li><a href="#">고민상담</a></li>
                  <li><a href="#">팀 프로젝트</a></li>
                  <li><a href="#">블로그</a></li>
                </ul> 
              </div>
            </li>
          </ul>
        </nav>

        <div class="header_search">
          <form action="#" class="d-flex align-items-center header_search_inner" method="get">
            <button type="submit" class="search_btn d-flex align-items-center">
              <i class="bi bi-search"></i>
            </button>
            <label for="searchInput" class="visually-hidden">검색창</label>
            <input type="search" id="searchInput" class="form-control" value="" placeholder="무엇을 배우고 싶으신가요?" autocomplete="off"/>
            <button type="button" id="clearSearch" class="btn btn-clear d-flex align-items-center justify-content-center">
              <i class="bi bi-x-circle-fill"></i>
            </button>
          </form>
        </div>
        <div class="header_icon d-flex">
          <div><a href="">장바구니</a></div>
          <div><a href="">알람</a></div>
          <div class="mini-profile">
            미니 프로필
            <!-- <ul>
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
            </ul> -->
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
                <a href="https://kauth.kakao.com/oauth/authorize?response_type=code&client_id=a292c01fc2579fbd7965ca9524a3032f&redirect_uri=http://localhost/code_even/" class="kakao"><img src="images/kakao_login_large_wide.png" width="360" height="34" class="mt-1 " /></a>
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