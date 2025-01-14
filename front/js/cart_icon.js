$(document).ready(function () {
  let leid, boid, price; // 전역 변수로 설정

  // 장바구니 아이콘 클릭 이벤트
  $(document).on('click', '.cart-add-icon', function () {
    leid = $(this).data('leid'); // 강좌 ID
    boid = $(this).data('boid') || null; // 교재 ID
    price = $(this).data('price'); // 강좌 가격
    const hasBook = $(this).data('has-book') === 1; // 교재 여부

    if (hasBook) {
      // 교재가 있는 경우 모달 표시
      $('#cartModal').modal('show');
      $('#cartModal .book-title').text($(this).data('book-title'));
      $('#cartModal .book-price').text($(this).data('book-price') + '원');
    } else {
      // 교재가 없는 경우 바로 추가
      addToCart(leid, null, price);
    }
  });

  // "확인" 버튼 클릭 시 교재 포함하여 장바구니 추가
  $('#yesbookAddToCart').off('click').on('click', function () {
    addToCart(leid, boid, price);
    $('#cartModal').modal('hide');
  });

  // "취소" 버튼 클릭 시 교재 제외하고 장바구니 추가
  $('#nobookAddToCart').off('click').on('click', function () {
    addToCart(leid, null, price);
    $('#cartModal').modal('hide');
  });

  // 장바구니 추가 AJAX 요청
  function addToCart(leid, boid, price) {
    $.ajax({
      type: 'POST',
      url: '/code_even/front/cart/cart_insert.php',
      data: { leid: leid, boid: boid, price: price },
      dataType: 'json',
      success: function (response) {
        if (response.result === 'ok') {
          alert('장바구니에 추가되었습니다!');
        } else if (response.result === '중복입니다.') {
          alert('이미 장바구니에 추가된 강좌입니다.');
        } else {
          alert('장바구니 추가에 실패했습니다. 다시 시도해주세요.');
        }
      },
      error: function () {
        alert('서버 요청 중 오류가 발생했습니다.');
      },
    });
  }
});
