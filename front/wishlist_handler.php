<?php

// 오류 로그 활성화
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');


// 로그인 여부 확인
if (!isset($_SESSION['AUID'])) {
    echo json_encode(['status' => 'error', 'message' => '로그인이 필요합니다.']);
    exit;
}

$user_id = $_SESSION['AUID']; // 로그인한 유저 ID
$lecture_id = isset($_POST['lecture_id']) ? (int)$_POST['lecture_id'] : 0;

if ($lecture_id <= 0) {
    echo json_encode(['status' => 'error', 'message' => '유효하지 않은 강좌 ID입니다.']);
    exit;
}

// 찜 여부 확인
$check_sql = "SELECT * FROM wishlist WHERE uid = ? AND leid = ?";
$stmt = $mysqli->prepare($check_sql);
$stmt->bind_param("ii", $user_id, $lecture_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 이미 찜한 경우 삭제
    $delete_sql = "DELETE FROM wishlist WHERE uid = ? AND leid = ?";
    $delete_stmt = $mysqli->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $user_id, $lecture_id);
    if ($delete_stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => '찜한 강좌 목록에서 삭제되었습니다.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => '삭제에 실패했습니다.']);
    }
    $delete_stmt->close();
} else {
    // 찜하지 않은 경우 추가
    $insert_sql = "INSERT INTO wishlist (uid, leid) VALUES (?, ?)";
    $insert_stmt = $mysqli->prepare($insert_sql);
    $insert_stmt->bind_param("ii", $user_id, $lecture_id);
    if ($insert_stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => '찜한 강좌 목록에 추가되었습니다.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => '찜하기 실패했습니다.']);
    }
    $insert_stmt->close();
}

$stmt->close();
$mysqli->close();
