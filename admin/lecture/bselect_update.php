<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php'); // DB 연결

header('Content-Type: application/json'); // JSON 응답 헤더 설정

$cate1 = isset($_POST['cate1']) ? $_POST['cate1'] : '';
$cate2 = isset($_POST['cate2']) ? $_POST['cate2'] : '';
$cate3 = isset($_POST['cate3']) ? $_POST['cate3'] : '';

$books = [];

if (!empty($cate1) && !empty($cate2) && !empty($cate3)) {
    $sql_books = "SELECT boid, book FROM book WHERE cate1 = ? AND cate2 = ? AND cate3 = ?";
    $stmt = $mysqli->prepare($sql_books);

    if ($stmt) {
        $stmt->bind_param('sss', $cate1, $cate2, $cate3);
        $stmt->execute();
        $result_books = $stmt->get_result();

        while ($book = $result_books->fetch_object()) {
            $books[] = $book;
        }
        $stmt->close();
    } else {
        error_log("SQL 준비 실패: " . $mysqli->error); // 오류 로그 기록
        echo json_encode(['error' => '서버 오류 발생']);
        exit;
    }
} else {
    echo json_encode(['error' => '모든 분류를 선택하세요.']); // 오류 메시지 반환
    exit;
}

// JSON 데이터 반환
echo json_encode($books);
exit;

?>
