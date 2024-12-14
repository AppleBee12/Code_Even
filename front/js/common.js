$(document).ready(function () {
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


  const $profileToggle = $("#profileToggle");
  const $profileMenu = $(".profile_menu");

  // 프로필 아이콘 클릭 시 메뉴 토글
  $profileToggle.on("click", function (e) {
    e.preventDefault(); // 기본 링크 동작 방지
    $profileMenu.toggle(); // 메뉴의 display 토글
  });

  // 페이지 외부 클릭 시 메뉴 닫기
  $(document).on("click", function (e) {
    if (!$profileToggle.is(e.target) && !$profileMenu.is(e.target) && $profileMenu.has(e.target).length === 0) {
      $profileMenu.hide(); // 메뉴 닫기
    }
  });




});
