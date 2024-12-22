<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');


if (!isset($_SESSION['UID'])) {
    echo "<script>alert('로그인 후 이용 가능합니다.'); window.location.href='/login.php';</script>";
    exit;
}

$uid = $_SESSION['UID'];
$userid = $_SESSION['AUID'];

// cart.php에서 전달된 데이터
$cartItems = isset($_POST['data']) ? json_decode($_POST['data'], true) : [];
if (empty($cartItems)) {
    echo "<script>alert('선택된 강좌가 없습니다.'); window.location.href='/cart.php';</script>";
    exit;
}
var_dump($cartItems);

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

    var_dump($userCoupons);

?>

<div class="white container_wrap">
  <div class="container">
    <main>
      <h2 class="headt5">결제하기</h2>
      <div class="row">
        <div class="col-md-8">
          <ul class="checkout_list">
          <?php if (!empty($cartItems)) {
            $totalPrice = 0;
                foreach ($cartItems as $item){ 
                    $lecturePrice = $item['lecturePrice'];
                    $bookPrice = isset($item['book']['price']) ? $item['book']['price'] : 0;
                    $totalItemPrice = $lecturePrice + $bookPrice;
                    $totalPrice += $totalItemPrice;
                    ?>
            <li class="checkout_item"> 
              <div class="d-flex align-items-center">
                <div href="" class="item_lnfo d-flex flex-fill">
                  <img src="<?= $item['image']; ?>" alt="강좌 이미지" class="item_img">
                  <div class="item_txt d-flex flex-column justify-content-between">
                    <p class="lec_title"><?= $item['lectureTitle']; ?></p>
                    <p class="lec_tc"><?= $item['lectureInstructor']; ?></p>
                  </div>     
                </div>
                <div class="item_price d-flex align-items-center justify-content-center">
                  <p><span class="number" data-price="<?= number_format($lecturePrice); ?>"><?= number_format($lecturePrice); ?></span>원</p>
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
                <option value="<?= $coupon['couponid']; ?>" data-max-value="<?= $maxValue; ?>">
                <?= $coupon['coupon_name']; ?> (<?= $couponDiscount; ?>)
                </option>
                <?php } ?>
                </select>
              </div>
            </li>
            <?php if (!empty($item['book'])) { ?>
            <li class="book_list d-flex align-items-center">
                <span class="badge_custom book_badge">교재포함강좌</span>
                <div class="book_desc d-flex flex-column">
                    <p class="book_title"><?= $item['book']['name']; ?></p>
                    <span span class="book_info"><?= $item['book']['writer']; ?></span>
                </div>
              <p class="book_price"><span class="number" data-price="<?= number_format($bookPrice); ?>"><?= number_format($bookPrice); ?></span>원</p>
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
                <button type="button" class="btn btn-outline-secondary">기본정보 불러오기</button>
            </div>
            <div class="dinfo_body">
                <div class="d-flex align-items-center" >
                <label for="">수령자명</label>
                <input type="text" class="form-control">
                </div>
                <div class="d-flex align-items-center">
                <label for="">연락처</label>
                <input type="text" class="form-control">
                </div>
                <label for="">수령주소</label>
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
              <input class="form-check-input" type="radio" name="user_status" id="user_status0" value="0" checked>
              <label class="form-check-label" for="user_status">카드결제</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_status" id="user_status-1" value="-1"> 
              <label class="form-check-label" for="user_status">무통장입금</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_status" id="user_status1" value="1"> 
              <label class="form-check-label" for="user_status">실시간계좌이체</label>
            </div>
          </div>
          <div class="payment_cal">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <p class="total_price_tt">선택상품금액</p>
                <p><span class="number"><?= $totalPrice; ?></span>원</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <p class="coupon_price_tt">쿠폰할인금액</p>
                <p class="coupon_price">-<span class="number">123124</span>원</p>
            </div>
          </div>
        <div class="payment_summary d-flex align-items-center justify-content-between">
            <p>최종 결제 금액</p>
            <p><span id="finalAmount"><?= number_format($totalPrice); ?></span>원</p>
        </div>
        <button class="w-100 btn btn-primary btn-lg btn_ok_red">결제하기</button>
        </div>
      </div>
    </main>
  </div>
</div>

<script>
    $('.coupon_select select').on('change', function () {
        let totalDiscount = 0;

        $('.coupon_select select').each(function () {
            const selectedOption = $(this).find('option:selected');
            const discountText = selectedOption.text();
            const maxValue = parseInt(selectedOption.data('max-value')) || 0; // 최대 할인 금액

            if (discountText.includes('원 할인')) {
                totalDiscount += parseInt(discountText.replace(/[^\d]/g, '')) || 0;
            } else if (discountText.includes('% 할인')) {
                const percentage = parseInt(discountText.replace(/[^\d]/g, '')) || 0;
                const itemPrice = parseInt($(this).closest('li').find('.item_price').text().replace(/[^\d]/g, ''));
                let calculatedDiscount = Math.floor((itemPrice * percentage) / 100);
                if (maxValue > 0) {
                    calculatedDiscount = Math.min(calculatedDiscount, maxValue); // 최대 할인 금액 제한
                }
                totalDiscount += calculatedDiscount;
            }
        });

        const originalTotal = <?= $totalPrice; ?>;
        const finalAmount = originalTotal - totalDiscount;
        $('#finalAmount').text(finalAmount.toLocaleString());
    });

</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>