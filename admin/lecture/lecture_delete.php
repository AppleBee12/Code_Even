<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 강좌 ID 가져오기
$lectureId = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($lectureId) {
    $sql = "DELETE FROM lecture WHERE leid = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $lectureId);
    
    if ($stmt->execute()) {
        echo "<script>alert('강좌가 삭제되었습니다.'); window.location.href = 'lecture_list.php';</script>";
    } else {
        echo "<script>alert('삭제에 실패했습니다. 다시 시도해주세요.'); window.location.href = 'lecture_list.php';</script>";
    }
    $stmt->close();
} else {
    die('강좌 ID가 유효하지 않습니다.');
}
?>
