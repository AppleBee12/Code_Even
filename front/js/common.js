$(document).ready(function () {

  //Header 검색창
  const $searchInput = $("#searchInput");
  const $clearIcon = $("#clearSearch i");

  $clearIcon.hide();

  $searchInput.on("input", function () {
    if ($.trim($(this).val()) !== "") {
      $clearIcon.show();
    } else {
      $clearIcon.hide();
    }
  });

  $("#clearSearch").on("click", function () {
    $searchInput.val("");
    $clearIcon.hide();
    $searchInput.focus();
  });



  //Header 아이콘 퀵메뉴 - 장바구니
  const $cartIcon = $("#cartIcon");
  const $cartList = $(".cart_dropdown");
  const $profileMenu = $(".profile_menu"); // 프로필 메뉴 추가

  $cartIcon.on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $cartList.toggle();
    $profileMenu.hide(); // 장바구니 열 때 프로필 메뉴 닫기
  });

  // 페이지 외부 클릭 시 메뉴 닫기
  $(document).on("click", function (e) {
    if (!$cartIcon.is(e.target) && !$cartList.is(e.target) && $cartList.has(e.target).length === 0) {
      $cartList.hide(); // 메뉴 닫기
    }
  });

  // 메뉴 내부 클릭 시 이벤트 버블링 방지
  $cartList.on("click", function (e) {
    e.stopPropagation();
  });

  //Header 아이콘 퀵메뉴 - 알림벨
  const alertBox = document.querySelector(".alarm .alert");
  const toggleElements = document.querySelectorAll(".alarm .bi-bell, .alarm .badge, .alarm button.close");


  function showAlert(e) {
      e.stopPropagation();
      alertBox.classList.toggle("fade");
      alertBox.classList.toggle("show");
  }

  toggleElements.forEach(element => element.addEventListener("click", showAlert));




  //Header 아이콘 퀵메뉴 - 프로필
  const $profileIcon = $("#profileIcon");

  $profileIcon.on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $profileMenu.toggle();
    $cartList.hide(); // 프로필 열 때 장바구니 메뉴 닫기
  });

  // 페이지 외부 클릭 시 메뉴 닫기
  $(document).on("click", function (e) {
    if (!$profileIcon.is(e.target) && !$profileMenu.is(e.target) && $profileMenu.has(e.target).length === 0) {
      $profileMenu.hide(); // 메뉴 닫기
    }
  });

  // 메뉴 내부 클릭 시 이벤트 버블링 방지
  $profileMenu.on("click", function (e) {
    e.stopPropagation();
  });

  
  //top 버튼
  const $topButton = $('#topButton'); 

  // 스크롤 이벤트
  $(window).on('scroll', function () {
    if ($(window).scrollTop() > 300) {
      $topButton.removeClass('d-none'); 
    } else {
      $topButton.addClass('d-none'); 
    }
  });

  // 버튼 클릭 이벤트
  $topButton.on('click', function () {
    $('html, body').animate({ scrollTop: 0 }, 'smooth'); 
  });


});
