<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

$uid = $_SESSION['UID'];
$userid = $_SESSION['AUID'];
$finalAmount = (float)$_POST['finalAmount'];

// orders 테이블 삽입
$order_sql = "INSERT INTO orders (uid, total_price, order_date) VALUES ($uid, $finalAmount, NOW())";
$mysqli->query($order_sql);
$order_id = $mysqli->insert_id; // 마지막으로 삽입된 주문 ID

// order_details 테이블 삽입
foreach ($_POST['cart'] as $item) {
    $leid = $item['leid'];
    $boid = !empty($item['boid']) ? $item['boid'] : 'NULL';
    $price = $item['lecture_price'];
    $detail_sql = "INSERT INTO order_details (order_id, leid, boid, price) VALUES ($order_id, $leid, $boid, $price)";
    $mysqli->query($detail_sql);

    // class_data 테이블 삽입
    $class_data_sql = "INSERT INTO class_data (uid, leid) VALUES ($uid, $leid)";
    $mysqli->query($class_data_sql);
}

echo "<script>alert('결제가 완료되었습니다.');
 location.reroad()';
 </script>";
?>
