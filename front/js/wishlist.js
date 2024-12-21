$(document).ready(function () {
  // 공통 찜하기 처리 함수
  function handleWishlist(action, lectureId, callback) {
      $.ajax({
          type: 'POST',
          url: '/code_even/front/wishlist_handler.php', // 공통 처리 PHP
          data: { action: action, lecture_id: lectureId },
          dataType: 'json',
          success: function (response) {
              if (response.status === 'success') {
                  if (callback) callback(true, response.message);
              } else if (response.status === 'not_logged_in') {
                  alert('로그인이 필요합니다.');
                  $('#exampleModaltest').modal('show'); // 로그인 모달 열기
              } else {
                  if (callback) callback(false, response.message);
              }
          },
          error: function () {
              alert('처리 중 오류가 발생했습니다.');
          }
      });
  }

  // 빈 하트 클릭 시
  $(document).on('click', '.heart-icon', function () {
      const lectureId = $(this).data('leid'); // 강좌 ID
      const $icon = $(this); // 현재 클릭한 아이콘

      handleWishlist('add', lectureId, function (success, message) {
          alert(message);
          if (success) {
              $icon.addClass('d-none');
              $icon.siblings('.heart-icon-filled').removeClass('d-none');
          }
      });
  });

  // 채워진 하트 클릭 시
  $(document).on('click', '.heart-icon-filled', function () {
      const lectureId = $(this).data('leid'); // 강좌 ID
      const $icon = $(this); // 현재 클릭한 아이콘

      handleWishlist('remove', lectureId, function (success, message) {
          alert(message);
          if (success) {
              $icon.addClass('d-none');
              $icon.siblings('.heart-icon').removeClass('d-none');
          }
      });
  });
});
