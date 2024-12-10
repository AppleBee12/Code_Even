<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');?>


<!-- 여기부터 정리해주세용! -->
  <p><a href="http://localhost/code_even/admin/login/login.php">어드민(관리자&강사)페이지 바로가기</a></p>
  <p><a href="tc_applyform.php" class="link-underline-danger link-offset-2 link-body-emphasis a_underline">강의자신청(임시)</a></p>
  <p><a href="" class="link-underline-danger link-offset-2 link-body-emphasis a_underline">결제페이지(임시)</a></p>
    
  
  <?php if(!isset($_SESSION['AUID'])){ ?>
  <div class="loginform d-flex gap-3">
    <span class="pointer" data-bs-toggle="modal" data-bs-target="#exampleModaltest" data-bs-whatever="@mdo">로그인</span>
    <a href="members/signup/signup.php" class="link-body-emphasis">회원가입</a>
  </div>

  <div class="modal fade" id="exampleModaltest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-center">
          <div class="wrappers d-flex row justify-content-center">
            <img src="admin/images/txt_logo.png" class="mt-5" width="309" height="46" alt="코드이븐로고">
            <h1 class="modal-title fs-5 mt-5 d-flex justify-content-center" id="exampleModalLabel login">로그인</h1>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">  
          <form action="members/login/login_ok.php" method="POST" >
            <div class="mb-3 d-flex justify-content-center gap-4 mid">
              <label for="inputId" class="col-form-label align-self-center">아이디</label>
              <input type="text" class="form-control id" id="inputId" placeholder="아이디를 입력하세요" name="userid" required>
            </div>
            <div class="mb-3 d-flex justify-content-center gap-3 mpw">
              <label for="inputPassword" class="col-form-label align-self-center">비밀번호</label>
              <input type="password" class="form-control pw" id="inputPassword" placeholder="비밀번호를 입력하세요"   name="userpw" required>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button class="btn loginbtn">로그인</button>
              <a href="https://kauth.kakao.com/oauth/authorize?client_id=<?=$REST_API_KEY?>&response_type=code&redirect_uri=<?=$REDIRECT_URI?>"><img src="images/kakaobtn.png" width="345" height="34" class="mt-1 "/></a>

              <div class="mt-3 d-flex flex-columns justify-content-center gap-3 mb-5">
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
  <?php
    }else{
  ?>
  <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/members/login/logout.php">로그아웃</a>
  <?php
    } 
  ?>
<!-- 쿠키 모달 창 -->
  <div id="cookieModal" class="cookie-modal ">
    <div class="cookie-modal-content ">
      <h2 class="d-flex justify-content-center mb-3">CODE EVEN</h2>
      <p>본 웹사이트는 구직용 포트폴리오 웹사이트이며, <br>
      실제로 운영되는 사이트가 아닙니다.</p>
      <hr>
      <div class="text-start">
        <div>
          <span><b>팀원 : </b>홍수진(팀장), 배유나, 조채림, 최은화, 홍은진</span><br>
          <span><b>제작기간</b> : 2024.11.26 - 2024.11.23 </span><br>
          <span><b>개발환경</b> : HTML/CSS, Javascript, J-Query, PHP</span><br>
          <div class="link3">
            <span><b>기획자료 :</b>  <a href="https://www.figma.com/deck/MQfJi66QGjjvn4nzpNfIQz/CODE_EVEN_LMS%EA%B5%AC%ED%98%84%EB%B0%9C%ED%91%9C-%EC%B5%9C%EC%A2%85?node-id=1-466&node-type=slide&viewport=-123%2C-137%2C0.7&t=QMdQYEzDrnraOO0y-1&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1" target="_blank">figma</a>
            <b> 코드 :</b>  <a href="https://github.com/AppleBee12/Code_Even.git" target="_blank">github</a>
            <b> 관리자 페이지 :</b>  <a href="http://localhost/code_even/admin/index.php" target="_blank">Admin Page</a></p>
          </div>
        </div>
        <hr>
        <div>
          <span><b>업무분장</b></span>
          <p><b>기획 : </b>팀원 전체 <b>디자인 : </b>구현 담당자</p>
        </div>
        <hr>
        <div>
          <span><b>* 구현 완료 페이지 *</b></span><br>
          <span><b>홍수진 : </b>
          <a href="admin/index.php">대시보드,</a> 공통헤더,
          <a href="admin/community/counsel.php">커뮤니티 관리, </a>
          <a href="admin/manual/for_admin.php">관리자 매뉴얼 </a>
        </span><br>
          <span><b>배유나 : </b>
          <a href="admin/student/student_list.php">수강생 관리, </a>
          <a href="admin/inquiry/notice.php">문의 게시판 관리 </a>
          </span><br>
          <span><b>조채림 : </b>
          <a href="members/signup/signup.php">로그인/회원가입, </a>
          <a href="admin/category/category.php">카테고리관리, </a>
          <a href="admin/coupons/coupons.php">쿠폰관리 </a>
           </span><br>
          <span><b>최은화 : </b>
          <a href="admin/lecture/lecture_list.php">강좌관리, </a>
          <a href="admin/book/book_list.php">교재관리 </a>
          </span><br>
          <span><b>홍은진 : </b>
          <a href="admin/teacher/teacher_list.php">강사관리, </a>
          <a href="admin/orders/orders_list.php">결제/배송관리,  </a>
          <a href="admin/sales/lectuer_sales.php">매출통계관리, </a>
          <a href="admin/user/user_list.php">전체회원관리 </a>
          </span><br>
        </div>
        <hr>
        <div>
          <span><b>강사용 아이디 </b>: even_teacher</span><br>
          <span><b>강사용 비밀번호 </b>: 12345</span>
        </div><hr>
        <div>
          <span><b>학생용 아이디 </b>: even_student</span><br>
          <span><b>학생용 비밀번호 </b>: 12345</span>
        </div>
      </div> <hr>
      <div class="d-flex justify-content-start gap-2 mb-3">
        <label class="align-items-end cookie_btn" for="check">오늘 하루 안보기</label>
        <input type="checkbox" id="check">
      </div>
      <button id="cookieCloseBtn" type="button" class="close_txt alarm">
        <img src="admin/images/sb_logo.png" width="50" height="30" alt="코드이븐로고">
        close
      </button>
    </div>
  </div>




<script>
 $(document).ready(function () {
    const cookieName = 'hideCookieModal'; // 쿠키 이름
    const cookieValue = 'true'; // 쿠키 값
    const cookieExpireDays = 1; // 쿠키 유지 기간 (1일)
    
    // 쿠키 확인 함수
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    // 쿠키 설정 함수
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        document.cookie = `${name}=${value}; expires=${date.toUTCString()}; path=/`;
    }

    // "오늘 하루 안 보기" 클릭 이벤트
    $('#cookieCloseBtn').on('click', function () {
        if ($('#check').is(':checked')) {
            // 체크박스가 체크된 경우 쿠키 설정
            setCookie(cookieName, cookieValue, cookieExpireDays);
        }
        // 모달 닫기
        $('#cookieModal').fadeOut();
    });

    // 페이지 로드 시 쿠키 확인
    if (!getCookie(cookieName)) {
        $('#cookieModal').fadeIn(); // 쿠키가 없으면 모달 표시
    }
});

</script>

<!-- 여기까지 정리해주세용!!!!! -->


<section class="sec01">
  <h3>sec01배너가 나올 부분입니다</h3>
  <div></div>
</section>
<section class="sec02">
  <h3>sec02카테고리가 나올 부분입니다</h3>
  <ul>
    <li>카테1</li>
    <li>카테2</li>
    <li>카테3</li>
    <li>카테4</li>
    <li>카테5</li>
    <li>카테6</li>
  </ul>
</section>
<section class="sec03">
  <h3>sec03 베스트 추천 강좌</h3>
  <div></div>
</section>
<section class="sec04">
  <h3>sec04 지금 가장 인기있는 레시피</h3>
  <div></div>
</section>
<section class="sec05">
  <h3>sec05 수강생 후기 배너</h3>
  <div></div>
</section>
<section class="sec06">
  <h3>sec06 이달의 BEST 선생님</h3>
  <div></div>
</section>
<section class="sec07">
  <h3>sec07 강사 신청하기 배너</h3>
  <div></div>
</section>
<section class="sec08">
  <h3>sec08 최신 강좌</h3>
  <div></div>
</section>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');?>