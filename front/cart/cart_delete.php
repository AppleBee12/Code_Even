<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 개별 삭제와 선택 삭제를 구분
    $cartId = $_POST['cartid'] ?? null; // 개별 삭제 시 사용
    $cartIds = $_POST['cartIds'] ?? []; // 선택 삭제 시 사용

    // 1. 개별 삭제 처리
    if (!empty($cartId)) {
        $delete_sql = "DELETE FROM cart WHERE cartid = ?";
        $stmt = $mysqli->prepare($delete_sql);
        $stmt->bind_param("i", $cartId);

        if ($stmt->execute()) {
            echo json_encode(['result' => 'ok']);
        } else {
            echo json_encode(['result' => 'fail', 'error' => $stmt->error]);
        }

        $stmt->close();
        $mysqli->close();
        exit; // 개별 삭제 완료 후 종료
    }

    // 2. 선택 삭제 처리
    if (!empty($cartIds)) {
        $placeholders = implode(',', array_fill(0, count($cartIds), '?'));
        $delete_sql = "DELETE FROM cart WHERE cartid IN ($placeholders)";
        $stmt = $mysqli->prepare($delete_sql);

        // Bind multiple parameters dynamically
        $stmt->bind_param(str_repeat('i', count($cartIds)), ...$cartIds);

        if ($stmt->execute()) {
            echo json_encode(['result' => 'ok']);
        } else {
            echo json_encode(['result' => 'fail', 'error' => $stmt->error]);
        }

        $stmt->close();
        $mysqli->close();
        exit; // 선택 삭제 완료 후 종료
    }

    // 선택된 항목이나 개별 ID가 없을 경우 에러
    echo json_encode(['result' => 'fail', 'error' => '선택된 항목이 없습니다.']);
    exit;

} else {
    echo json_encode(['result' => 'fail', 'error' => '잘못된 요청입니다.']);
    exit;
}
