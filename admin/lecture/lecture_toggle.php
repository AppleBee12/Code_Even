<?php
header('Content-Type: application/json'); // JSON 응답 설정

// 데이터베이스 연결
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 요청 데이터 읽기
$data = json_decode(file_get_contents('php://input'), true);

// 입력 데이터 검증
$lectureId = isset($data['id']) ? intval($data['id']) : null;
$state = isset($data['state']) ? intval($data['state']) : null;

$response = ['success' => false];

if ($lectureId !== null && $state !== null) {
    // 강좌 state 값만 업데이트
    $sql = "UPDATE lecture SET state = ? WHERE leid = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ii', $state, $lectureId);

        if ($stmt->execute()) {
            $response['success'] = true; // 업데이트 성공
        } else {
            $response['error'] = '쿼리 실행 오류: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        $response['error'] = '쿼리 준비 오류: ' . $mysqli->error;
    }
} else {
    $response['error'] = '유효하지 않은 입력 데이터입니다.';
}

// JSON 응답 반환
echo json_encode($response);
?>
