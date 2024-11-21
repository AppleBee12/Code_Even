<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/inc/check_cookie.php');
?>
<style>
/* 모달 배경 */
.cookie-modal {
  /* display: none; 기본적으로 숨겨두기 */
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.4); /* 배경 어둡게 */
}

/* 모달 콘텐츠 */
.cookie-modal-content {
  background-color: #fff;
  /* margin: 5% auto; */
  padding: 20px;
  margin: 30px;
  border: 5px solid var(--bk900);
  width: 80%;
  max-width: 500px;
  text-align: center;
  border-radius: 5px;
  position: relative;
}

/* 닫기 버튼 */
.cookie-close-btn {
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
  position: absolute;
  bottom: 10px;  /* 콘텐츠 하단에 위치 */
  right: 10px;   /* 콘텐츠 오른쪽에 위치 */
  cursor: pointer;
}

.cookie-close-btn:hover,
.cookie-close-btn:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

/* 동의 버튼 스타일 */
#cookieAgreeBtn {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

#cookieAgreeBtn:hover {
  background-color: #45a049;
}

</style>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/common.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/main.css">
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
  <div class="gap-5 align-items-center bgsz ">
    <div class="w-50 container d-flex justify-content-center align-items-center">
      <?php if(!isset($_SESSION['AUID'])){
      ?>
      <div class="w-50 d-flex flex-column align-items-center">
        <h1 class="mt-5">로그인</h1>
        <form action="members/login/login_ok.php" method="POST" class="w-100">
          <label for="inputId" class="form-label mt-3">아이디</label>
          <input type="text" id="inputId" class="form-control" placeholder="아이디를 입력하세요" name="userid" required>
          
          <label for="inputPassword" class="form-label mt-3">비밀번호</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="비밀번호를 입력하세요" name="userpw" required>
          
          <button class="btn btn-primary mt-3 w-100">로그인</button>
          
          <div class="mt-3 d-flex flex-columns justify-content-center gap-3">
            <a href="#" class="link-body-emphasis ">아이디 찾기</a>
            <a href="#" class="link-body-emphasis">비밀번호 찾기</a>
            <a href="members/signup/signup.php" class="link-body-emphasis text-decoration-underline">회원가입</a>
          </div>
        </form>
      </div>
      <?php
        }else{
      ?>
      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/members/login/logout.php">로그아웃</a>
      <?php
        } 
      ?>
    </div>
  </div>
  <div id="cookieModal" class="cookie-modal ">
    <div class="cookie-modal-content ">
      <h2 class="d-flex justify-content-center mb-3">CODE EVEN</h2>
      <p>본 웹사이트는 구직용 포트폴리오 웹사이트이며, <br>
      실제로 운영되는 사이트가 아닙니다.</p>
      <hr>
      <div class="text-start">
        <div>
          <span><b>팀원 : </b>홍수진(팀장), 배유나, 조채림, 최은화, 홍은진</span><br>
          <span><b>제작기간</b> : 2024.10.23 - 2024.11.22 </span><br>
          <span><b>개발환경</b> : html, css, J-Qery, php</span><br>
          <span><b>기획자료 :</b>  <a href="https://www.figma.com/slides/9MsKBvc3jwAm3v1j24QznJ/CODE_EVEN_LMS%EB%94%94%EC%9E%90%EC%9D%B8%EB%B0%9C%ED%91%9C?t=cgmURknfV4lmJRsM-6" target="_blank">figma</a>
          <b> 코드 :</b>  <a href="https://github.com/AppleBee12/Code_Even.git" target="_blank">github</a></p>
        </div>
        <hr>
        <div>
          <span><b>업무분장</b></span>
          <p><b>기획 : </b>팀원 전체 <b>디자인 : </b>구현 담당자</p>
        </div>
        <hr>
        <div>
          <span><b>구현 완료 페이지</b></span><br>
          <span><b>홍수진 : </b>대시보드, 커뮤니티 관리, 관리자 매뉴얼</span><br>
          <span><b>배유나 : </b></span><br>
          <span><b>조채림 : </b></span><br>
          <span><b>최은화 : </b></span><br>
          <span><b>홍은진 : </b></span><br>
        </div>
        <hr>
        <div>
          <span><b>관리자 아이디 </b>: code_even</span>
          <p><b>관리자 비밀번호 </b>: 12345</p>
        </div>
      </div> <hr>
      <div class="d-flex justify-content-start gap-2">
        <label class="align-items-end cookie_btn" for="check">오늘 하루 안보기</label>
        <input type="checkbox" id="check">
      </div>
      <span class="cookie-close-btn" id="cookieCloseBtn">&times;</span>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 
  $(document).ready(function () {
    // 페이지 로드 시 쿠키 확인
    // let cookieValue = getCookie("hideCookieModal");
    // console.log("Cookie value on load: " + cookieValue);
    if (getCookie("hideCookieModal") !== "true") {
      $("#cookieModal").show();
    }


    // "오늘 하루 안보기" 버튼 클릭 시
    $('.cookie_btn').on('click', function() {
      setCookie('hideCookieModal', 'true', 1); // 1일 동안 쿠키 설정
      $('#cookieModal').fadeout();
    });

      // 닫기 버튼 클릭 이벤트
      $("#cookieCloseBtn").on("click", function () {
        if ($("#check").is(":checked")) {
          setCookie("hideCookieModal", "true", 1); // 1일 동안 쿠키 저장
        }
        $("#cookieModal").fadeOut();
      });

      // 쿠키 설정 함수
    function setCookie(name, value, days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // 쿠키 유효기간 설정
        let expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/"; // 쿠키 저장
    }


    // 쿠키 가져오기 함수
    function getCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i].trim();
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
      }
  });

</script>

</html>
