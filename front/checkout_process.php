<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

$uid = $_SESSION['UID'];
$userid = $_SESSION['AUID'];
$finalAmount = (float)$_POST['finalAmount'];

// cart 데이터 디코딩
$cartData = json_decode($_POST['cart'], true);
if (!$cartData) {
    echo "<script>alert('장바구니 데이터가 유효하지 않습니다.'); history.back();</script>";
    exit;
}

// orders 테이블 삽입
$order_sql = "INSERT INTO orders (uid, final_amount, order_date) VALUES ($uid, $finalAmount, NOW())";
if ($mysqli->query($order_sql)) {
    $order_id = $mysqli->insert_id; // 마지막으로 삽입된 주문 ID

    // order_details 테이블 삽입
    foreach ($cartData as $item) {
        $leid = $item['leid'];
        $boid = !empty($item['boid']) ? $item['boid'] : 'NULL';
        $price = $item['lecture_price'];

        $detail_sql = "INSERT INTO order_details (odid, product_id, tc_uid, price) VALUES ($order_id, $leid, $boid, $price)";
        $mysqli->query($detail_sql);

        // class_data 테이블 삽입
        $class_data_sql = "INSERT INTO class_data (uid, leid) VALUES ($uid, $leid)";
        $mysqli->query($class_data_sql);
    }

    echo "<script>alert('결제가 완료되었습니다. 나의 수업 페이지로 이동합니다.');
    location.href='/CODE_EVEN/front/mypage/mypage_lecture.php';
    </script>";
} else {
    echo "<script>alert('결제 처리 중 오류가 발생했습니다. 관리자에게 문의하세요.'); history.back();</script>";
}
?>
