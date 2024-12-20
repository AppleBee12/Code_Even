<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

if (!isset($_SESSION['UID'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='/code_even/front/login.php';</script>";
    exit;
}

$userid = $_SESSION['AUID'];
$cartData = json_decode($_GET['data'], true);
$totalAmount = (float)$_GET['total'];

// 사용자 쿠폰 가져오기
$userid = $_SESSION['AUID'];
$coupons = [];
$coupon_sql = "SELECT 
    uc.userid, c.coupon_name, c.coupon_price, c.coupon_ratio 
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
<form id="checkoutForm" action="checkout_process.php" method="POST">
    <div class="container">
        <h2>결제하기</h2>
        <div>
            <?php foreach ($cartData as $item): ?>
                <div>
                    <img src="<?= $item['image']; ?>" alt="강좌 이미지">
                    <h3><?= $item['title']; ?> - <?= number_format($item['lecture_price']); ?>원</h3>
                    <?php if (!empty($item['book_name'])): ?>
                        <p>[교재] <?= $item['book_name']; ?> - <?= number_format($item['book_price']); ?>원</p>
                        <div>
                            <label for="address">배송지 입력:</label>
                            <input type="text" name="address[]" required>
                        </div>
                    <?php endif; ?>
                    <select name="coupon[]">
                        <option value="0">쿠폰 사용 안함</option>
                        <?php foreach ($coupons as $coupon): ?>
                            <option value="<?= $coupon['ucid']; ?>" data-discount="<?= $coupon['coupon_price']; ?>">
                                <?= $coupon['coupon_name']; ?> - <?= number_format($coupon['coupon_price']); ?>원 할인
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endforeach; ?>
        </div>
        <div>
            <h3>최종 결제 금액: <span id="finalAmount"><?= number_format($totalAmount); ?></span>원</h3>
            <input type="hidden" name="finalAmount" id="finalAmountInput" value="<?= $totalAmount; ?>">
        </div>
        <button type="submit">결제하기</button>
    </div>
</form>

<script>
    // 쿠폰 선택 시 할인 금액 계산
    const coupons = document.querySelectorAll('select[name="coupon[]"]');
    coupons.forEach(coupon => {
        coupon.addEventListener('change', () => {
            let discount = 0;
            coupons.forEach(c => {
                const selected = c.options[c.selectedIndex];
                discount += parseInt(selected.dataset.discount || 0);
            });
            const finalAmount = <?= $totalAmount; ?> - discount;
            document.getElementById('finalAmount').innerText = finalAmount.toLocaleString();
            document.getElementById('finalAmountInput').value = finalAmount;
        });
    });
</script>
