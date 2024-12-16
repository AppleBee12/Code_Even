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


  //Header 아이콘 퀵메뉴
  const $profileIcon = $("#profileIcon");
  const $profileMenu = $(".profile_menu");

  $profileIcon.on("click", function (e) {
    e.preventDefault(); 
    e.stopPropagation(); 
    $profileMenu.toggle();
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



});
