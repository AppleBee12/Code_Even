<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 강좌 ID 가져오기
$lectureId = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($lectureId) {
    // lecture_detail의 ID 추출 및 lefile 데이터 삭제
    $sqlDetailIds = "SELECT id FROM lecture_detail WHERE lecture_id = $lectureId";
    $resultDetailIds = $mysqli->query($sqlDetailIds);

    if ($resultDetailIds) {
        while ($row = $resultDetailIds->fetch_assoc()) {
            $lecdid = intval($row['id']);
            $sqlFile = "DELETE FROM lefile WHERE lecdid = $lecdid";
            $resultFile = $mysqli->query($sqlFile);

            if (!$resultFile) {
                echo "<script>alert('파일 정보 삭제에 실패했습니다.'); window.location.href = 'lecture_list.php';</script>";
                exit;
            }
        }
    }

    // lecture_detail 테이블에서 관련 데이터 삭제
    $sqlDetail = "DELETE FROM lecture_detail WHERE lecture_id = $lectureId";
    $resultDetail = $mysqli->query($sqlDetail);
    if (!$resultDetail) {
        echo "<script>alert('강의 세부 정보 삭제에 실패했습니다.'); window.location.href = 'lecture_list.php';</script>";
        exit;
    }

    // lecture 테이블에서 데이터 삭제
    $sqlLecture = "DELETE FROM lecture WHERE leid = $lectureId";
    $resultLecture = $mysqli->query($sqlLecture);
    if (!$resultLecture) {
        echo "<script>alert('강좌 삭제에 실패했습니다.'); window.location.href = 'lecture_list.php';</script>";
        exit;
    }

    // 삭제 성공 메시지
    echo "<script>alert('강좌가 삭제되었습니다.'); window.location.href = 'lecture_list.php';</script>";
} else {
    // 잘못된 ID 처리
    echo "<script>alert('유효하지 않은 강좌 ID입니다.'); window.location.href = 'lecture_list.php';</script>";
    exit;
}
?>
