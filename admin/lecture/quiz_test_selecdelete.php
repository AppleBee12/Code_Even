<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// JSON 데이터 읽기
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['exid']) && is_array($data['exid'])) {
    // exid 배열을 쉼표로 연결
    $exid_list = implode(',', $data['exid']);

    // quiz 테이블에서 삭제
    $quiz_sql = "DELETE FROM quiz WHERE exid IN ($exid_list)";
    $mysqli->query($quiz_sql);

    // test 테이블에서 삭제
    $test_sql = "DELETE FROM test WHERE exid IN ($exid_list)";
    $mysqli->query($test_sql);

    echo json_encode(['success' => true]); // 성공 응답
    exit;
}

echo json_encode(['success' => false]); // 실패 응답
exit;
?>
