<?php
header('Content-Type: application/json'); // JSON 응답 설정

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/db.php');

// 요청 데이터 읽기
$data = json_decode(file_get_contents('php://input'), true);

// 데이터 확인
$lectureId = isset($data['id']) ? intval($data['id']) : null;
$state = isset($data['state']) ? intval($data['state']) : null;

$response = ['success' => false]; // 기본 응답

if ($lectureId !== null && $state !== null) {
    // state 값 업데이트 쿼리
    $sql = "UPDATE lecture SET state = ? WHERE leid = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ii', $state, $lectureId);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Database execution error: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        $response['error'] = 'Database preparation error: ' . $mysqli->error;
    }
} else {
    $response['error'] = 'Invalid input data. ID or State is missing.';
}

// JSON 응답 반환
echo json_encode($response);
?>
