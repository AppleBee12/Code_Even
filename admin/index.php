<?php

$chart_js = "<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>";
$host = $_SERVER['HTTP_HOST'];
$main_js = "<script src=\"http://$host/code_even/admin/js/main.js\"></script>";

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

//오늘 방문자 수와 6개월 방문자 수 계산

$dataFile =$_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/visit_data.json';
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];
$monthlyData = [];
foreach ($data as $date => $count) {
    $month = substr($date, 5, 2);
    if (!isset($monthlyData[$month])) {
        $monthlyData[$month] = 0;
    }
    $monthlyData[$month] += $count;

    
  }

  // 최신날짜부터 오름차순sort 내림차순krsort
  // krsort($monthlyData);
  $latestMonths = array_slice(array_keys($monthlyData), -6); //최신 6개월 만 array
  $latestCounts = array_slice(array_values($monthlyData), -6);//최신 방문자 수 만 array
  

?>
<style>
  

/* 모달 배경 */
.cookie-modal {
  display: none; 
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.4); /* 배경 어둡게 */
  z-index: 100;
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

.cookie-close-btn:hover,
.cookie-close-btn:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

#cookieAgreeBtn:hover {
  background-color: #45a049;
}

/* 닫기 버튼 */
.close_txt{
  background: none;
  border: none;
}
</style>


<div class="container">
  <div class="top_wrapper d-flex justify-content-between">
    <div>
      <h3><span class="this-month"></span> 수익</h3>
      <p>7,123,000<span class="top_text"> 원</span></p>
    </div>
    <div>
      <h3>직전달 대비 수익률</h3>
      <p>3%</p>
    </div>
    <div>
      <h3>과정 개설 현황</h3>
      <p><span class="top_text">대기 </span>12 <span class="top_text">/ 개설 </span>1,234</p>
    </div>
    <div>
      <h3>판매 강좌수</h3>
      <p>1,234<span class="top_text"> 개</span></p>
    </div>
    <div>
      <h3>오늘 접속자 수</h3>
      <p>53<span class="top_text"> 명</span></p>
    </div>
  </div>
  <div class="bottom_wrapper d-flex justify-content-between">
    <div class="bott_left d-flex flex-column justify-content-between ">
      <h3>최근 6개월 수익률</h3>
      <canvas id="current_six_returns" width="550" height="500"></canvas>
    </div>
    <div class="bott_right d-flex flex-column justify-content-between">
      <div class="sellcost_best_table">
        <div class="d-flex justify-content-between">
          <h3>판매 금액 BEST 강좌</h3>
          <p class="month"><span class="this-month"></span> 현황</p>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">순위</div>
          <div class="p-2 col-5 sst">강좌 명</div>
          <div class="p-2 col-2 sst">강사 명</div>
          <div class="p-2 col-3 sst">판매 금액</div>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">매출 1위</div>
          <div class="p-2 col-5 text-truncate">[HTML]홈페이지 기본 메뉴부터 투명한 메뉴, 방향전환까지 완벽 마스터</div>
          <div class="p-2 col-2">김동주</div>
          <div class="p-2 col-3">812,345 <span>원</span></div>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">매출 2위</div>
          <div class="p-2 col-5 text-truncate">입문자도 실무에서 바로 써먹는 PHP 기초부터 시니어까지</div>
          <div class="p-2 col-2">김동주</div>
          <div class="p-2 col-3">712,345<span>원</span></div>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">매출 3위</div>
          <div class="p-2 col-5 text-truncate">REACT 커리어를 갈아끼워드립니다</div>
          <div class="p-2 col-2">김동주</div>
          <div class="p-2 col-3">612,345<span>원</span></div>
        </div>
      </div>
      <div class="d-flex justify-content-between">
        <div>
          <div class="d-flex justify-content-between">
            <h3>신규 가입자 현황</h3>
            <p class="month"><span class="this-month"></span> 현황</p>
          </div>
          <p>5,412<span class="top_text"> 명</span></p>
          <canvas id="current_six_news" width="400" height="250"></canvas>
        </div>
        <div>
          <div class="d-flex justify-content-between">
            <h3>카테고리별 매출 금액</h3>
            <p class="month"><span class="this-month"></span> 현황</p>
          </div>
          <p>7,123,000<span class="top_text"> 원</span></p>
          <canvas id="cate_one_return" width="250" height="250"></canvas>
        </div>
      </div>
    </div>
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
          <span><b>제작기간</b> : 2024.10.23 - 2024.11.25 </span><br>
          <span><b>개발환경</b> : HTML/CSS, Javascript, J-Query, PHP</span><br>
          <div class="link3">
            <span><b>기획자료 :</b>  <a href="https://www.figma.com/deck/MQfJi66QGjjvn4nzpNfIQz/CODE_EVEN_LMS%EA%B5%AC%ED%98%84%EB%B0%9C%ED%91%9C-%EC%B5%9C%EC%A2%85?node-id=1-466&node-type=slide&viewport=-123%2C-137%2C0.7&t=QMdQYEzDrnraOO0y-1&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1" target="_blank">figma </a>
            <b> 코드 :</b>  <a href="https://github.com/AppleBee12/Code_Even.git" target="_blank">github </a>
            <b> 프론트 페이지 :</b>  <a href="http://localhost/Code_Even/" target="_blank">Front Page</a></p>
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
          <a href="index.php">대시보드,</a> 공통헤더,
          <a href="community/counsel.php">커뮤니티 관리, </a>
          <a href="manual/for_admin.php">관리자 매뉴얼 </a>
        </span><br>
          <span><b>배유나 : </b>
          <a href="student/student_list.php">수강생 관리, </a>
          <a href="inquiry/notice.php">문의 게시판 관리 </a>
          </span><br>
          <span><b>조채림 : </b>
          <a href="../front/signup/signup.php">로그인/회원가입, </a>
          <a href="category/category.php">카테고리관리, </a>
          <a href="coupons/coupons.php">쿠폰관리 </a>
          </span><br>
          <span><b>최은화 : </b>
          <a href="lecture/lecture_list.php">강좌관리, </a>
          <a href="book/book_list.php">교재관리 </a>
          </span><br>
          <span><b>홍은진 : </b>
          <a href="teacher/teacher_list.php">강사관리, </a>
          <a href="orders/orders_list.php">결제/배송관리,  </a>
          <a href="sales/lectuer_sales.php">매출통계관리, </a>
          <a href="user/user_list.php">전체회원관리 </a>
          </span><br>
        </div>
        <hr>
        <div>
          <span><b>관리자 아이디 </b>: code_even</span><br>
          <span><b>관리자 비밀번호 </b>: 12345</span>
        </div><hr>
        <div>
          <span><b>강사용 아이디 </b>: even_teacher</span><br>
          <span><b>강사용 비밀번호 </b>: 12345</span>
        </div>
      </div> <hr>
      <div class="d-flex justify-content-start gap-2 mb-3">
        <label class="align-items-end cookie_btn" for="check">오늘 하루 안보기</label>
        <input type="checkbox" id="check">
      </div>
      <button id="cookieCloseBtn" type="button" class="close_txt alarm">
        <img src="images/sb_logo.png" width="50" height="30" alt="코드이븐로고">
        close
      </button>
    </div>
  </div>


<script>


//모달창 쿠키 양식
const latestCounts = <?php echo json_encode($latestCounts, JSON_NUMERIC_CHECK); ?>; 

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

  // 쿠키 삭제 함수 (테스트용)
  // function deleteCookie(name) {
  //     document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
  // }

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

<?php
$host = $_SERVER['HTTP_HOST'];

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>

