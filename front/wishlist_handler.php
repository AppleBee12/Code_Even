<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// JSON 응답 함수 (공통 처리)
function jsonResponse($status, $message = '', $extra = []) {
    echo json_encode(array_merge(['status' => $status, 'message' => $message], $extra));
    exit;
}

// 로그인 여부 확인
if (!isset($_SESSION['AUID'])) {
    jsonResponse('not_logged_in', '로그인이 필요합니다.');
}

$uid = $_SESSION['UID']; // 로그인한 유저 ID
$lecture_id = isset($_POST['lecture_id']) ? (int) $_POST['lecture_id'] : 0;

if ($lecture_id <= 0) {
    jsonResponse('error', '유효하지 않은 강좌 ID입니다.');
}

// DB 연결 및 찜 여부 확인
$mysqli->begin_transaction();
try {
    $check_sql = "SELECT * FROM wishlist WHERE uid = ? AND leid = ?";
    $stmt = $mysqli->prepare($check_sql);
    $stmt->bind_param("ii", $uid, $lecture_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 이미 찜한 경우 삭제
        $delete_sql = "DELETE FROM wishlist WHERE uid = ? AND leid = ?";
        $delete_stmt = $mysqli->prepare($delete_sql);
        $delete_stmt->bind_param("ii", $uid, $lecture_id);
        $delete_stmt->execute();
        
        if ($delete_stmt->affected_rows > 0) {
            $mysqli->commit();
            jsonResponse('success', '찜한 강좌 목록에서 삭제되었습니다.');
        } else {
            throw new Exception('삭제에 실패했습니다.');
        }
    } else {
        // 찜하지 않은 경우 추가
        $insert_sql = "INSERT INTO wishlist (uid, leid) VALUES (?, ?)";
        $insert_stmt = $mysqli->prepare($insert_sql);
        $insert_stmt->bind_param("ii", $uid, $lecture_id);
        $insert_stmt->execute();
        
        if ($insert_stmt->affected_rows > 0) {
            $mysqli->commit();
            jsonResponse('success', '찜한 강좌 목록에 추가되었습니다.');
        } else {
            throw new Exception('찜하기 실패했습니다.');
        }
    }
} catch (Exception $e) {
    $mysqli->rollback(); // 트랜잭션 롤백
    jsonResponse('error', $e->getMessage());
} finally {
    $stmt->close();
    $mysqli->close();
}
