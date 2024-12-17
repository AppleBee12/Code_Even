<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

?>
<div class="container">
  <div class="row img_info">
    <div class="col-9">
      <img src="" alt="">
    </div>
    <div class="con_border col-3 p-4">
      <h4 class="mb-2">제대로 파는 HTML CSS</h4>
      <p>44,000 원</p>
      <hr>
      <ul>
        <li>
          <div class=" d-flex gap-2 mb-2">
            <i class="bi bi-play-circle"></i>
            <p>VOD / 총 5강 / 2시간 15분</p>
          </div>
        </li>
        <li>
          <div class=" d-flex gap-2 mb-2">
            <i class="bi bi-calendar"></i>
            <p>30일 수강 가능</p>
          </div>
        </li>
        <li>
          <div class=" d-flex gap-2">
            <i class="bi bi-archive"></i>
            <p>강의 자료 있음</p>
          </div>
        </li>
      </ul>
      <hr>
      <p class="mt-4 fw-semibold mb-2">[교재] 목요일 TOO MUCH 친절한 HTML+CSS+자바...</p>
      <div class="d-flex justify-content-between">
        <p class="text-danger fs-5 fw-bold mb-3">28,800 원</p>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            <p>교재 함께 구매</p>
          </label>
        </div>
      </div>
      <hr>
      <div class="row gx-2 align-items-center mt-3">
        <!-- 장바구니 버튼 -->
        <div class="col-2">
          <button class="btn btn-light w-100">
            <i class="bi bi-cart"></i>
          </button>
        </div>
        <!-- 바로 결제하기 버튼 -->
        <div class="col-10">
          <button class="btn btn-outline-light w-100">
            바로 결제하기
          </button>
        </div>
      </div>
      <div class="row gx-2 mt-2">
        <!-- 찜하기 버튼 -->
        <div class="col-6">
          <button class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-heart"></i>
            <span>찜하기</span>
          </button>
        </div>
        <!-- 공유하기 버튼 -->
        <div class="col-6">
          <button class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-share"></i>
            <span>공유하기</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="row tab-menu text-center">
    <div class="col">
      <a href="#section-intro" class="tab-link active">강좌 소개</a>
    </div>
    <div class="col">
      <a href="#section-book" class="tab-link">교재 소개</a>
    </div>
    <div class="col">
      <a href="#section-teacher" class="tab-link">강사 소개</a>
    </div>
    <div class="col">
      <a href="#section-lecture" class="tab-link">강의</a>
    </div>
    <div class="col">
      <a href="#section-review" class="tab-link">리뷰</a>
    </div>
    <!-- 언더라인 추가 -->
    <div class="tab-underline"></div>
  </div>

  <!-- 섹션 콘텐츠 -->
  <div class="container mt-5">
    <section id="section-intro">
      <h2 class="mb-5">강좌 소개</h2>
      <p>강좌에 대한 소개 내용을 여기에 넣습니다.</p>
    </section>
    <section id="section-book">
      <h2 class="mb-5">교재 소개</h2>
      <p>교재에 대한 설명이 여기에 들어갑니다.</p>
    </section>
    <section id="section-teacher">
      <h2 class="mb-5">강사 소개</h2>
      <p>강사에 대한 소개 내용을 여기에 넣습니다.</p>
    </section>
    <section id="section-lecture">
      <h2 class="mb-5">강의</h2>
      <div class="lecture-container">
        <!-- 헤더 -->
        <div class="lecture-header">제대로 파는 HTML</div>
        <!-- 강의 리스트 -->
        <div class="lecture-item">
          <div>
            <i class="bi bi-play-circle"></i>
            <span>1강. HTML, CSS, JavaScript가 뭔가요?</span>
          </div>
          <div>
            <i class="bi bi-alarm"></i>
            <span class="time">20:00</span>
          </div>
        </div>
        <div class="lecture-item">
          <div>
            <i class="bi bi-play-circle"></i>
            <span>2강. 갖다 놓는 HTML</span>
          </div>
          <div>
            <i class="bi bi-alarm"></i>
            <span class="time">20:00</span>
          </div>
        </div>
        <div class="lecture-item">
          <div>
            <i class="bi bi-play-circle"></i>
            <span>3강. HTML 더 깊이 알아보기</span>
          </div>
          <div>
            <i class="bi bi-alarm"></i>
            <span class="time">20:00</span>
          </div>
        </div>
        <div class="lecture-item">
          <div>
            <i class="bi bi-play-circle"></i>
            <span>4강. 꾸미는 CSS</span>
          </div>
          <div>
            <i class="bi bi-alarm"></i>
            <span class="time">20:00</span>
          </div>
        </div>
        <div class="lecture-item">
          <div>
            <i class="bi bi-play-circle"></i>
            <span>5강. CSS 더 깊이 알아보기</span>
          </div>
          <div>
            <i class="bi bi-alarm"></i>
            <span class="time">20:00</span>
          </div>
        </div>
      </div>
    </section>
    <section id="section-review">
      <h2 class="mb-5">수강평</h2>
      <p>수강평이 여기에 표시됩니다.</p>
    </section>
  </div>
</div>
<script>

  /* 탭메뉴 언더라인 이동 */
  $(document).ready(function () {
    // 탭 클릭 이벤트
    $(".tab-link").on("click", function (e) {
      e.preventDefault();

      // 모든 탭에서 active 클래스 제거
      $(".tab-link").removeClass("active");

      // 클릭된 탭에 active 클래스 추가
      $(this).addClass("active");

      // 언더라인 이동
      const index = $(this).parent().index();
      const tabWidth = $(".tab-menu .col").outerWidth();
      $(".tab-underline").css("left", index * tabWidth + "px");

      // 해당 섹션으로 부드럽게 스크롤 이동
      const target = $(this).attr("href");
      $("html, body").animate(
        {
          scrollTop: $(target).offset().top - $(".tab-menu").outerHeight(), // 탭 메뉴 높이만큼 상단 여백 추가
        },
        500 // 부드러운 스크롤 애니메이션
      );
    });

    // 스크롤 이벤트: 탭이 상단에 고정된 상태 유지
    $(window).on("scroll", function () {
      const sections = $("section");
      let scrollTop = $(this).scrollTop();

      sections.each(function (index) {
        const sectionTop = $(this).offset().top - $(".tab-menu").outerHeight() - 50; // 상단 여백 추가
        const sectionBottom = sectionTop + $(this).outerHeight();

        if (scrollTop >= sectionTop && scrollTop < sectionBottom) {
          $(".tab-link").removeClass("active");
          $(".tab-link").eq(index).addClass("active");

          // 언더라인 이동
          const tabWidth = $(".tab-menu .col").outerWidth();
          $(".tab-underline").css("left", index * tabWidth + "px");
        }
      });
    });
  });




  $(document).ready(function () {
    $(".tab-link").on("click", function (e) {
      e.preventDefault(); // 기본 앵커 링크 동작 방지

      // 모든 탭에서 active 클래스 제거
      $(".tab-link").removeClass("active");

      // 클릭된 탭에 active 클래스 추가
      $(this).addClass("active");

      // 해당 섹션으로 부드럽게 스크롤 이동
      const target = $(this).attr("href");
      $("html, body").animate(
        {
          scrollTop: $(target).offset().top - 50, // 상단 여백 추가
        },
        500 // 애니메이션 시간 (밀리초 단위)
      );
    });
  });


</script>
<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');

?>