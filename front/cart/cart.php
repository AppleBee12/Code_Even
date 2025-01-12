<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

if (isset($_SESSION['UID'])) {
    $uid = $_SESSION['UID'];
    $userid = $_SESSION['AUID'];
} else {
    $uid = '';
    $userid = '';
}

// 카트 조회
$cart_sql = "SELECT 
    c.*, 
    l.leid, 
    l.image, 
    l.title, 
    l.name,
    l.price AS lecture_price, 
    b.book AS book_name, 
    b.price AS book_price,
    b.writer AS book_writer,
    b.company AS book_company
  FROM 
    cart c
  LEFT JOIN 
    lecture l ON c.leid = l.leid
  LEFT JOIN 
    book b ON c.boid = b.boid
  WHERE 
    c.ssid = '$session_id' OR c.uid = '$uid'
";

$cart_result = $mysqli->query($cart_sql);
$cartArr = [];
while ($cart_data = $cart_result->fetch_object()) {
    $cartArr[] = $cart_data;
}
?>

<div class="white container_wrap">
  <div class="container">
    <main>
      <h2 class="headt5">장바구니</h2>
      <div class="row">
        <?php if (!empty($cartArr)) { ?>
          <div class="col-md-8">
            <!-- 장바구니에 강좌가 있는 경우 -->
            <div class="check_del d-flex align-items-center">
              <div class="form-check">
                <div class="check_total d-flex gap-3 align-items-center">
                  <input class="form-check-input checkbox_custom" type="checkbox" id="selectAll" checked>
                  <label class="form-check-label" for="selectAll">
                    <span>전체 선택</span>
                    <span class="check_cnt"><?= count($cartArr); ?></span>
                    <span>/</span>
                    <span class="total_cnt"><?= count($cartArr); ?></span>
                  </label>
                </div>
              </div>
            </div>
            <ul class="cart_list">
              <?php foreach ($cartArr as $cart): ?>
                <li data-cart-id="<?= $cart->cartid; ?>" data-leid="<?= $cart->leid; ?>"> 
                  <div class="d-flex align-items-center">
                    <div class="item_check">
                      <input type="checkbox" class="item-check form-check-input" checked>
                    </div>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_view.php?leid=<?= $cart->leid; ?>" class="item_lnfo d-flex flex-fill">
                      <img src="<?= $cart->image;?>" alt="강좌 이미지" class="item_img">
                      <div class="item_txt d-flex flex-column justify-content-between">
                        <p class="lec_title"><?= $cart->title;?></p>
                        <p class="lec_tc"><?= $cart->name;?></p>
                      </div>     
                    </a>
                    <div class="item_price d-flex align-items-center justify-content-center">
                      <p><span class="number" data-price="<?= $cart->lecture_price;?>"><?= $cart->lecture_price;?></span>원</p>
                    </div>
                    <button type="button" class="btn btn_item_del" aria-label="Delete"><i class="bi bi-x-circle-fill"></i></button>
                  </div>
                </li>
                <?php if (!empty($cart->boid)): ?>
                  <li class="d-flex align-items-center book_list" data-cart-id="<?= $cart->cartid; ?>" data-boid="<?= $cart->boid; ?>">
                    <span class="badge_custom book_badge">교재포함강좌</span>
                    <div class="book_desc d-flex flex-column">
                      <p class="book_title"><?= $cart->book_name;?></p>
                      <span class="book_info"> <?= $cart->book_writer;?> | <?= $cart->book_company;?></span>
                    </div>
                    <p class="book_price"><span class="number" data-price="<?= $cart->book_price;?>"><?= $cart->book_price;?></span>원</p>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
            <button type="button" class="btn btn-outline-secondary mt-3 selected_del">선택삭제</button>
          </div>
          <div class="col-md-4">
            <ul class="list-group mb-3 payment_sum">
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <p class="my-0">강좌 금액</p>
                </div>
                <p class="lec_total_price">
                  <span class="number">0</span>원
                </p>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <p class="my-0">교재 금액</p>
                </div>
                <p class="book_total_price">
                  <span class="number">0</span>원
                </p>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <p class="my-0">선택 강좌 수</p>
                </div>
                <p>총 <span class="lec_total_cnt">0</span>건</p> 
              </li>
              <li class="list-group-item d-flex justify-content-between price_sum">
                <span>주문 금액</span>
                <strong id="grandTotal">0</strong>
              </li>
            </ul>
            <button class="w-100 btn btn-primary btn-lg btn_ok_red">주문하기</button>
          </div>
          <?php } else { ?>
            <!-- 장바구니가 비어 있는 경우 -->
            <div>
              <p class="text-center mt-5">&#128064;</p>
              <p class="text-center my-5">장바구니에 담은 강좌가 없습니다. 원하는 강좌를 찾아보세요!</p>
              <div class="text-center">
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php" class="go_class go_class_wh">강좌 보러가기</a>
              </div>
            </div>
          <?php } ?>



      </div>
    </main>
  </div>
</div>

<script>
  // 결제 정보 업데이트 함수
  function updatePaymentSummary() {
    let lecTotalPrice = 0; // 강좌 총 금액
    let bookTotalPrice = 0; // 교재 총 금액
    let lecTotalCount = 0; // 선택된 강좌 수
    let selectedCount = 0; // 선택된 체크박스 수
    const totalCount = $('.cart_list .item-check').length; // 전체 체크박스 수

    // 각 강좌 및 교재의 상태를 순회하며 금액 및 수량 계산
    $('.cart_list > li').each(function () {
        const isChecked = $(this).find('.item-check').is(':checked'); // 체크박스 선택 여부
        if (isChecked) {
            const lecturePrice = parseInt($(this).find('.item_price .number').data('price')) || 0; // 강좌 금액
            lecTotalPrice += lecturePrice; // 강좌 금액 합산
            lecTotalCount++; // 강좌 수 증가
            selectedCount++; // 선택된 체크박스 수 증가

            // 교재 정보가 포함된 경우 교재 금액 합산
            const bookElement = $(`.book_list[data-cart-id="${$(this).data('cart-id')}"]`);
            if (bookElement.length > 0) {
                const bookPrice = parseInt(bookElement.find('.book_price .number').data('price')) || 0;
                bookTotalPrice += bookPrice; // 교재 금액 합산
            }
        }
    });

    // 총 결제 금액 계산
    const grandTotal = lecTotalPrice + bookTotalPrice;

    // 화면에 결제 정보 업데이트
    $('.lec_total_price .number').text(lecTotalPrice.toLocaleString()); // 강좌 금액 표시
    $('.book_total_price .number').text(bookTotalPrice.toLocaleString()); // 교재 금액 표시
    $('.lec_total_cnt').text(lecTotalCount); // 선택된 강좌 수 표시
    $('#grandTotal').text(grandTotal.toLocaleString() + ' 원'); // 총 결제 금액 표시

    // 체크박스 상태 갱신
    $('.check_cnt').text(selectedCount); // 선택된 체크박스 수
    $('.total_cnt').text(totalCount); // 전체 체크박스 수
  }

  // 개별 체크박스 변경 시 결제 정보 및 전체 선택 상태 업데이트
  $(document).on('change', '.item-check', function () {
      const allChecked = $('.cart_list .item-check').length === $('.cart_list .item-check:checked').length; // 모든 체크박스 선택 여부 확인
      $('#selectAll').prop('checked', allChecked); // 전체 선택 체크박스 상태 동기화
      updatePaymentSummary(); // 결제 정보 업데이트
  });

  // 전체 선택 체크박스 클릭 시 개별 체크박스 상태 동기화
  $('#selectAll').on('change', function () {
      const isChecked = $(this).is(':checked'); // 전체 선택 여부
      $('.cart_list .item-check').prop('checked', isChecked); // 개별 체크박스 상태 변경
      updatePaymentSummary(); // 결제 정보 업데이트
  });

  // 선택 삭제 버튼 클릭 시 선택된 항목 삭제
  $('.selected_del').click(function () {
      const selectedCartIds = []; // 선택된 강좌의 cart ID 목록

      // 선택된 체크박스를 순회하며 cart ID 수집
      $('.cart_list > li').each(function () {
          const isChecked = $(this).find('.item-check').is(':checked');
          if (isChecked) {
              const cartId = $(this).data('cart-id');
              selectedCartIds.push(cartId); // 선택된 cart ID 추가
          }
      });

      // 선택된 항목이 없을 경우 경고 메시지
      if (selectedCartIds.length === 0) {
          alert('삭제할 항목을 선택해주세요.');
          return;
      }

      // 삭제 확인 후 서버로 삭제 요청
      if (confirm('선택한 항목을 삭제하시겠습니까?')) {
          $.ajax({
              url: '/code_even/front/cart/cart_delete.php', // 삭제 처리 PHP 파일 경로
              type: 'POST',
              data: { cartIds: selectedCartIds }, // 선택된 cart ID 배열 전송
              dataType: 'json',
              success: function (response) {
                  if (response.result === 'ok') {
                      alert('선택한 항목이 삭제되었습니다.');
                      selectedCartIds.forEach(cartId => {
                          $(`li[data-cart-id="${cartId}"]`).remove(); // 화면에서 해당 항목 제거
                      });
                      updatePaymentSummary(); // 결제 정보 업데이트
                  } else {
                      alert('삭제 실패: ' + response.error);
                  }
              },
              error: function (xhr, status, error) {
                  console.error(error);
                  alert('삭제 요청 중 오류가 발생했습니다.');
              }
          });
      }
  });

  // 개별 삭제 버튼 클릭 시 해당 강좌 삭제
  $(document).on('click', '.btn_item_del', function () {
      const cartId = $(this).closest('li').data('cart-id'); // 삭제할 cart ID 가져오기

      // cart ID가 없을 경우 경고
      if (!cartId) {
          alert('삭제할 항목이 유효하지 않습니다.');
          return;
      }

      // 삭제 확인 후 서버로 삭제 요청
      if (confirm('해당 강좌를 삭제하시겠습니까?')) {
          $.ajax({
              url: '/code_even/front/cart/cart_delete.php', // 삭제 처리 PHP 파일 경로
              type: 'POST',
              data: { cartid: cartId }, // 개별 삭제를 위한 cart ID 전송
              dataType: 'json',
              success: function (response) {
                  if (response.result === 'ok') {
                      alert('강좌가 삭제되었습니다.');
                      $(`li[data-cart-id="${cartId}"]`).remove(); // 화면에서 해당 항목 제거
                      updatePaymentSummary(); // 결제 정보 업데이트
                  } else {
                      alert('삭제 실패: ' + response.error);
                  }
              },
              error: function (xhr, status, error) {
                  console.error(error);
                  alert('삭제 요청 중 오류가 발생했습니다.');
              }
          });
      }
  });

  // 주문하기 버튼 클릭 시 선택된 항목 주문
  $('.btn_ok_red').click(function () {
      if ('<?= $uid ?>' === '') {
          alert('로그인 후 주문이 가능합니다.');
          return;
      }

      const selectedCartItems = []; // 선택된 강좌 데이터 수집

      // 선택된 체크박스를 순회하며 데이터를 수집
      $('.cart_list > li').each(function () {
          const isChecked = $(this).find('.item-check').is(':checked');
          if (isChecked) {
              const cartId = $(this).data('cart-id');
              const leid = $(this).data('leid');
              const lecturePrice = $(this).find('.item_price .number').data('price') || 0;
              const lectureTitle = $(this).find('.lec_title').text();
              const lectureInstructor = $(this).find('.lec_tc').text();
              const image = $(this).find('.item_img').attr('src');

              // 기본 강좌 데이터 저장
              const cartItem = {
                  cartId: cartId,
                  leid : leid,
                  lecturePrice: lecturePrice,
                  lectureTitle: lectureTitle,
                  lectureInstructor: lectureInstructor,
                  image: image,
                  book: null // 교재 정보는 추가로 처리
              };

              // 강좌에 포함된 교재 정보 추가
              const bookElement = $(`.book_list[data-cart-id="${cartId}"]`);
              if (bookElement.length > 0) {
                  const boid = bookElement.data('boid');
                  const bookName = bookElement.find('.book_title').text();
                  const bookPrice = bookElement.find('.book_price .number').data('price') || 0;
                  const bookWriter = bookElement.find('.book_info').text();

                  cartItem.book = {
                      boid : boid,
                      name: bookName,
                      price: bookPrice,
                      writer: bookWriter
                  };
              }

              selectedCartItems.push(cartItem); // 선택된 강좌 추가
          }
      });

      // 선택된 항목이 없을 경우 경고 메시지
      if (selectedCartItems.length === 0) {
          alert('선택된 강좌가 없습니다.');
          return;
      }

      // 총 결제 금액 계산
      const totalAmount = selectedCartItems.reduce((sum, item) => {
          const lecturePrice = parseInt(item.lecturePrice) || 0;
          const bookPrice = item.book ? parseInt(item.book.price) : 0;
          return sum + lecturePrice + bookPrice;
      }, 0);

      // 서버로 데이터를 전송하기 위한 폼 생성
      const form = $('<form>', {
          action: '/code_even/front/cart/checkout.php', // 전송 대상 PHP 파일 경로
          method: 'POST'
      });

      // 선택된 강좌 데이터를 폼에 추가
      form.append($('<input>', {
          type: 'hidden',
          name: 'data',
          value: JSON.stringify(selectedCartItems)
      }));

      // 총 결제 금액을 폼에 추가
      form.append($('<input>', {
          type: 'hidden',
          name: 'total',
          value: totalAmount
      }));

      $('body').append(form); // 폼을 DOM에 추가
      form.submit(); // 폼 제출
  });

  // 페이지 로드 시 초기화
  $(document).ready(function () {
      updatePaymentSummary(); // 결제 정보 초기화
  });
</script>




<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>
