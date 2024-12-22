<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

if (!isset($_SESSION['UID'])) {
  echo "<script>alert('로그인 후 이용 가능합니다.'); window.location.href='/login.php';</script>";
  exit;
}

$uid = $_SESSION['UID'];
$userid = $_SESSION['AUID'];

// cart.php에서 전달된 데이터
$totalPrice = 0;
$cartItems = isset($_POST['data']) ? json_decode($_POST['data'], true) : [];

if (empty($cartItems)) {
  echo "<script>alert('선택된 강좌가 없습니다.'); window.location.href='/cart.php';</script>";
  exit;
}

// 유저 쿠폰 조회
$coupon_sql = "SELECT DISTINCT uc.couponid, c.coupon_name, c.coupon_price, c.coupon_ratio, c.use_min_price, c.max_value
FROM user_coupons uc 
JOIN coupons c ON uc.couponid = c.cpid 
WHERE uc.status = 1 AND uc.userid = ?";

$stmt = $mysqli->prepare($coupon_sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();
$userCoupons = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<div class="white container_wrap">
  <div class="container">
    <main>
      <h2 class="headt5">결제하기</h2>
      <form action="checkout_process.php" method="post" class="row">
        <input type="hidden" name="total_amount" value="<?= $totalPrice; ?>" id="total_price">
        <input type="hidden" name="discount_amount" value="0" id="discount_amount">
        <input type="hidden" name="final_amount" value="<?= $totalPrice; ?>" id="final_amount">
        <input type="hidden" name="selected_payment" value="0" id="selected_payment">
        <input type="hidden" name="receiver_name" value="" id="receiver_name">
        <input type="hidden" name="receiver_contact" value="" id="receiver_contact">
        <input type="hidden" name="post_code" value="" id="post_code">
        <input type="hidden" name="addr_line1" value="" id="addr_line1">
        <input type="hidden" name="addr_line2" value="" id="addr_line2">
        <input type="hidden" name="addr_line3" value="" id="addr_line3">
        <input type="hidden" name="cart_items" value='<?= json_encode($cartItems, JSON_UNESCAPED_UNICODE); ?>' id="cart_items">
  
        <div class="col-md-8">
          <ul class="checkout_list">
          <?php if (!empty($cartItems)) {
            foreach ($cartItems as $item) { 
              $lecturePrice = $item['lecturePrice'];
              $bookPrice = isset($item['book']['price']) ? $item['book']['price'] : 0;
              $totalItemPrice = $lecturePrice + $bookPrice;
              $totalPrice += $totalItemPrice;
          ?>
            <li class="checkout_item" data-leid="<?= $item['leid']; ?>">
              <div class="d-flex align-items-center">
                <div href="" class="item_lnfo d-flex flex-fill">
                  <img src="<?= $item['image']; ?>" alt="강좌 이미지" class="item_img">
                  <div class="item_txt d-flex flex-column justify-content-between">
                    <p class="lec_title"><?= $item['lectureTitle']; ?></p>
                    <p class="lec_tc"><?= $item['lectureInstructor']; ?></p>
                  </div>     
                </div>
                <div class="item_price d-flex align-items-center justify-content-center flex-column">
                  <p><span class="original_price"><?= number_format($lecturePrice); ?>원</span></p>
                  <p class="discounted_price number d-none" data-price="0"></p>
                </div>
              </div>
              <div class="coupon_select d-flex gap-3 align-items-center">
                <label for="coupon_<?= $item['cartId']; ?>">쿠폰 사용</label>
                <select class="form-control" id="coupon_<?= $item['cartId']; ?>" name="coupon[<?= $item['cartId']; ?>]">
                  <option value="">사용 안함</option>
                  <?php foreach ($userCoupons as $coupon) {
                    $couponDiscount = $coupon['coupon_price'] > 0 ? $coupon['coupon_price'] . '원 할인' : $coupon['coupon_ratio'] . '% 할인';
                    $maxValue = $coupon['max_value']; // 최대 할인 금액
                  ?>
                  <option value="<?= $coupon['couponid']; ?>" data-max-value="<?= $maxValue; ?>" data-ratio="<?= $coupon['coupon_ratio']; ?>">
                  <?= $coupon['coupon_name']; ?> (<?= $couponDiscount; ?>)
                  </option>
                  <?php } ?>
                </select>
                <span class="applied_discount">0원 할인</span>
              </div>
            </li>
            <?php if (!empty($item['book'])) { ?>
            <li class="book_list d-flex align-items-center">
                <span class="badge_custom book_badge">교재포함강좌</span>
                <div class="book_desc d-flex flex-column">
                    <p class="book_title"><?= $item['book']['name']; ?></p>
                    <span class="book_info"><?= $item['book']['writer']; ?></span>
                </div>
              <p class="book_price"><span class="number"><?= number_format($bookPrice); ?></span>원</p>
            </li>
            <?php } ?>
            <?php }
            } ?>
          </ul>
        </div>

        <div class="col-md-4 checkout_info_wrap">
          <div class="delivery_info">
            <div class="dvinfo_header d-flex justify-content-between align-items-center mb-3">
                <h3 class="checkout_info_headtt">교재 배송지 정보</h3>
                <button type="button" id="addressLoad" class="btn btn-outline-secondary">기본정보 불러오기</button>
            </div>
            <div class="dinfo_body" id="dinfo_body">
                <div class="d-flex align-items-center">
                    <label for="name">수령자명</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="d-flex align-items-center">
                    <label for="contact">연락처</label>
                    <input type="text" class="form-control" name="contact">
                </div>
                <label for="post_code">수령주소</label>
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control w_sm" id="sample6_postcode" name="post_code" placeholder="우편번호" value="">
                    <input type="button" class="post_search_btn" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                </div>
                <input type="text" id="sample6_address" class="form-control" name="addr_line1" placeholder="주소" value="">
                <input type="text" id="sample6_detailAddress" class="form-control" name="addr_line2" placeholder="상세주소" value="">
                <input type="text" id="sample6_extraAddress" class="form-control" name="addr_line3" placeholder="참고항목(동이름)" value="">
                </div>
          </div>
          <div class="payment_method">
            <h3 class="checkout_info_headtt">결제수단</h3>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="pay_method" id="pay_method1" value="0" checked>
              <label class="form-check-label" for="user_status">카드결제</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="pay_method" id="pay_method2" value="-1"> 
              <label class="form-check-label" for="user_status">무통장입금</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="pay_method" id="pay_method3" value="1"> 
              <label class="form-check-label" for="user_status">실시간계좌이체</label>
            </div>
          </div>
          <div class="payment_cal">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <p class="total_price_tt">선택상품금액</p>
                <p><span class="number total_price"><?= $totalPrice; ?></span>원</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <p class="coupon_price_tt">쿠폰할인금액</p>
                <p class="coupon_price">-<span class="number total_discount">0</span>원</p>
            </div>
          </div>
        <div class="payment_summary d-flex align-items-center justify-content-between">
            <p>최종 결제 금액</p>
            <p><span id="finalAmount" class="number final_amount"><?= number_format($totalPrice); ?></span>원</p>
        </div>
        <button class="w-100 btn btn-primary btn-lg btn_ok_red">결제하기</button>
        </div>
      </form>
    </main>
  </div>
</div>

<script>
    /*
    function updateCartItems() {
    const cartItems = [];
    // 각 아이템의 데이터를 추출
    $('.checkout_item').each(function () {
        const leid = $(this).data('leid'); // 강좌 고유번호
        const price = parseInt($(this).find('.original_price').text().replace(/[^\d]/g, '')) || 0;
        const title = $(this).find('.lec_title').text().trim(); // 강좌 제목

        cartItems.push({
            leid: leid,
            price: price
        });
    });

        // hidden input에 JSON 데이터 저장
        $('#cart_items').val(JSON.stringify(cartItems));
    }
        */

// 페이지 로드 시 cart_items 초기화
$(document).ready(function () {
    //updateCartItems();

    $('.coupon_select select').on('change', function () {
        //updateCartItems();
    let totalDiscount = 0;
    const selectedCoupons = new Set(); // 선택된 쿠폰 ID를 저장할 Set

    // 모든 select 요소를 순회하면서 쿠폰 적용 로직 실행
    $('.coupon_select select').each(function () {
        const selectedOption = $(this).find('option:selected');
        const couponId = selectedOption.val(); // 현재 선택된 쿠폰 ID
        const discountText = selectedOption.text();
        const maxValue = parseInt(selectedOption.data('max-value')) || 0; // 최대 할인 금액
        const ratio = parseInt(selectedOption.data('ratio')) || 0; // 퍼센트 할인 비율
        const itemPrice = parseInt($(this).closest('li').find('.item_price .original_price').text().replace(/[^\d]/g, '')); // 강좌 원래 가격

        // 현재 선택된 쿠폰 ID를 Set에 추가
        if (couponId) {
        selectedCoupons.add(couponId);
        }

        if (discountText.includes('원 할인')) {
        // 고정 금액 할인
        const discount = parseInt(discountText.replace(/[^\d]/g, '')) || 0;
        totalDiscount += discount; // 총 할인 금액에 추가
        const discountedPrice = itemPrice - discount; // 할인 적용된 가격 계산

        // UI 업데이트
        $(this).siblings('.applied_discount').text(`${discount.toLocaleString()}원 할인`);
        $(this).closest('.checkout_item').find('.discounted_price').text(`${discountedPrice.toLocaleString()}원`).removeClass('d-none');
        $(this).closest('.checkout_item').find('.original_price').css({
            'text-decoration': 'line-through',
            'color': 'var(--bk500)',
            'font-size': '15px',
            'font-weight': '600',
        });

        } else if (discountText.includes('% 할인')) {
        // 퍼센트 할인
        let calculatedDiscount = Math.floor((itemPrice * ratio) / 100); // 할인 금액 계산
        if (maxValue > 0) {
            calculatedDiscount = Math.min(calculatedDiscount, maxValue); // 최대 할인 금액 제한
        }
        totalDiscount += calculatedDiscount; // 총 할인 금액에 추가
        const discountedPrice = itemPrice - calculatedDiscount; // 할인 적용된 가격 계산

        // UI 업데이트
        $(this).siblings('.applied_discount').text(`${calculatedDiscount.toLocaleString()}원 할인`);
        $(this).closest('.checkout_item').find('.discounted_price').text(`${discountedPrice.toLocaleString()}원`).removeClass('d-none');
        $(this).closest('.checkout_item').find('.original_price').css({
            'text-decoration': 'line-through',
            'color': 'var(--bk500)',
            'font-size': '15px',
            'font-weight': '600',
        });

        } else {
        // 쿠폰 사용 안 함
        $(this).siblings('.applied_discount').text('0원 할인');
        $(this).closest('.checkout_item').find('.discounted_price').addClass('d-none');
        $(this).closest('.checkout_item').find('.original_price').css('text-decoration', 'none');
        }
    });

    // 선택된 쿠폰을 다른 select 요소에서 비활성화
    $('.coupon_select select').each(function () {
        $(this).find('option').each(function () {
        const couponId = $(this).val();
        if (selectedCoupons.has(couponId)) {
            // 선택된 쿠폰이면 비활성화
            $(this).prop('disabled', true);
        } else {
            // 선택되지 않은 쿠폰은 활성화
            $(this).prop('disabled', false);
        }
        });

        // 현재 선택된 쿠폰은 항상 활성화
        const currentSelectedOption = $(this).find('option:selected');
        currentSelectedOption.prop('disabled', false);
    });

    // 전체 금액 및 최종 결제 금액 계산
    const originalTotal = parseInt($('.total_price').text().replace(/[^\d]/g, '')); // 원래 총 금액
    const finalAmount = originalTotal - totalDiscount; // 최종 결제 금액
    $('.total_discount').text(totalDiscount.toLocaleString()); // 총 할인 금액 업데이트
    $('.final_amount').text(finalAmount.toLocaleString()); // 최종 결제 금액 업데이트


    $('#total_price').val(originalTotal); // 할인 금액 업데이트
    $('#discount_amount').val(totalDiscount); // 할인 금액 업데이트
    $('#final_amount').val(finalAmount); // 최종 결제 금액 업데이트
    });

    //저장된 주소 불러오기
    $('#addressLoad').on('click', function () {
        $.ajax({
            url: 'get_user_address.php', // 데이터 요청 URL
            method: 'GET',
            dataType: 'json',
            success: function (response) {
            if (response.error) {
                alert(response.error);
                return;
            }

            // 데이터를 input 필드에 채우기
            $('#receiver_name').val(response.username);
            $('#receiver_contact').val(response.userphonenum);
            $('#post_code').val(response.post_code);
            $('#addr_line1').val(response.addr_line1);
            $('#addr_line2').val(response.addr_line2);
            $('#addr_line3').val(response.addr_line3);

            // UI 업데이트 (선택 사항)
            $('#dinfo_body input[name="name"]').val(response.username);
            $('#dinfo_body input[name="contact"]').val(response.userphonenum);
            $('#dinfo_body input[name="post_code"]').val(response.post_code);
            $('#dinfo_body input[name="addr_line1"]').val(response.addr_line1);
            $('#dinfo_body input[name="addr_line2"]').val(response.addr_line2);
            $('#dinfo_body input[name="addr_line3"]').val(response.addr_line3);
            },
            error: function () {
            alert('유저 정보를 불러오는데 실패했습니다.');
            },
            });
        });

        // 결제 수단 라디오 버튼 선택 시 값 업데이트
        $('input[name="pay_method"]').on('change', function () {
        const selectedPayment = $(this).val(); // 선택된 라디오 버튼의 value 값
        $('#selected_payment').val(selectedPayment); // hidden 필드에 값 설정
        });
    });

</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>
