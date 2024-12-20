<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

if (!isset($_SESSION['UID'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='/code_even/front/login.php';</script>";
    exit;
}

// POST 데이터 받기
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartData = json_decode($_POST['data'], true); // POST로 전달된 cartData
    $totalAmount = (float)$_POST['total']; // POST로 전달된 totalAmount
} else {
    echo "<script>alert('잘못된 접근입니다.'); location.href='/code_even/front/cart.php';</script>";
    exit;
}

$userid = $_SESSION['AUID'];

// 사용자 쿠폰 가져오기
$coupons = [];
$coupon_sql = "SELECT 
    uc.ucid, c.coupon_name, c.coupon_price 
    FROM user_coupons uc
    JOIN coupons c 
    ON uc.couponid = c.cpid 
    WHERE uc.userid = '$userid' 
    AND uc.status = 1";
$coupon_result = $mysqli->query($coupon_sql);
while ($coupon = $coupon_result->fetch_assoc()) {
    $coupons[] = $coupon;
}
?>

<!-- 결제 페이지 -->
<div class="white">
    <form id="checkoutForm" action="checkout_process.php" method="POST">
        <div class="container py-5">
            <h2 class="mb-4 headt5">결제하기</h2>
            <div class="row">
                <!-- 강좌 및 교재 정보 -->
                <div class="col-lg-8">
                    <div class="list-group mb-3">
                        <?php foreach ($cartData as $item): ?>
                            <div class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <img src="<?= htmlspecialchars($item['image']); ?>" alt="강좌 이미지" style="width: 80px; height: 80px; object-fit: cover;" class="me-3">
                                    <div class="flex-fill">
                                        <h5><?= htmlspecialchars($item['title']); ?></h5>
                                        <p class="text-muted"><?= number_format($item['lecture_price']); ?> 원</p>
                                        <?php if (!empty($item['book_name'])): ?>
                                            <p>
                                                <span class="badge bg-secondary">교재 포함</span>
                                                <?= htmlspecialchars($item['book_name']); ?> - <?= number_format($item['book_price']); ?> 원
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="coupon-<?= $item['cartid']; ?>">쿠폰 선택:</label>
                                    <select name="coupon[<?= $item['cartid']; ?>]" class="form-select coupon-select" data-cartid="<?= $item['cartid']; ?>">
                                        <option value="0" data-discount="0">쿠폰 사용 안함</option>
                                        <?php foreach ($coupons as $coupon): ?>
                                            <option value="<?= $coupon['ucid']; ?>" data-discount="<?= $coupon['coupon_price']; ?>">
                                                <?= htmlspecialchars($coupon['coupon_name']); ?> - <?= number_format($coupon['coupon_price']); ?> 원 할인
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- 결제 정보 -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">결제 정보</h5>
                            <p>총 결제 금액: <strong id="totalAmount"><?= number_format($totalAmount); ?></strong> 원</p>
                            <p>할인 적용 금액: <strong id="finalAmount"><?= number_format($totalAmount); ?></strong> 원</p>
                            <input type="hidden" name="finalAmount" id="finalAmountInput" value="<?= $totalAmount; ?>">
                            <hr>
                            <button type="submit" class="btn btn-primary w-100 btn_ok_red">최종 결제하기</button>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                        <?php foreach ($cartData as $item): ?>
                        <?php if (!empty($item['book_name'])): ?>
                            <div class="mt-2">
                                <label for="address-<?= $item['cartid']; ?>">배송지 입력:</label>
                                <input type="text" name="address[<?= $item['cartid']; ?>]" class="form-control">
                            </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function () {
    // 쿠폰 선택 시 할인 금액 계산
    $('.coupon-select').on('change', function () {
        let totalDiscount = 0;
        $('.coupon-select option:selected').each(function () {
            totalDiscount += parseInt($(this).data('discount')) || 0;
        });

        // 총 결제 금액 계산
        const totalAmount = <?= $totalAmount; ?>;
        const finalAmount = totalAmount - totalDiscount;

        $('#finalAmount').text(finalAmount.toLocaleString() + ' 원');
        $('#finalAmountInput').val(finalAmount);
    });
});
</script>

<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>
