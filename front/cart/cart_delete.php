<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartid = (int)$_POST['cartid']; // 전달받은 cart ID

    if (!$cartid) {
        echo json_encode(['result' => 'fail', 'error' => '유효하지 않은 cartid']);
        exit;
    }

    // cart 테이블에서 강좌와 관련된 데이터 삭제
    $delete_sql = "DELETE FROM cart WHERE cartid = ?";
    $stmt = $mysqli->prepare($delete_sql);
    $stmt->bind_param("i", $cartid);

    if ($stmt->execute()) {
        echo json_encode(['result' => 'ok']);
    } else {
        echo json_encode(['result' => 'fail', 'error' => $stmt->error]);
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo json_encode(['result' => 'fail', 'error' => '잘못된 요청입니다.']);
}
?>
