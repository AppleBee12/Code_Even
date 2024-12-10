<?php

session_start(); // 세션 시작

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/img_upload_func.php');

$lecture_id = $_GET['id'] ?? null;

if ($lecture_id) {
    $sql = "DELETE FROM lecture_detail WHERE id = $lecture_id";
    if ($mysqli->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $mysqli->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid ID']);
}

?>
