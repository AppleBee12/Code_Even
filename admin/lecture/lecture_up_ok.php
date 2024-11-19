<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 데이터 수집: AJAX 요청인지 확인
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'get_quiz_test') {
    $cate1 = $_POST['cate1'];
    $cate2 = $_POST['cate2'];
    $cate3 = $_POST['cate3'];
    $title = $_POST['title'];

    // 데이터 검증
    if (empty($cate1) || empty($cate2) || empty($cate3) || empty($title)) {
        echo json_encode(['error' => '카테고리와 강좌명을 모두 입력해주세요.']);
        exit;
    }

    // quiz 데이터 가져오기
    $sql_quiz = "SELECT exid, tt FROM quiz WHERE cate1 = ? AND cate2 = ? AND cate3 = ? AND title = ?";
    $stmt_quiz = $mysqli->prepare($sql_quiz);
    $stmt_quiz->bind_param("ssss", $cate1, $cate2, $cate3, $title);
    $stmt_quiz->execute();
    $result_quiz = $stmt_quiz->get_result();
    $quiz_data = [];
    while ($row = $result_quiz->fetch_object()) {
        $quiz_data[] = $row;
    }

    // test 데이터 가져오기
    $sql_test = "SELECT exid, tt FROM test WHERE cate1 = ? AND cate2 = ? AND cate3 = ? AND title = ?";
    $stmt_test = $mysqli->prepare($sql_test);
    $stmt_test->bind_param("ssss", $cate1, $cate2, $cate3, $title);
    $stmt_test->execute();
    $result_test = $stmt_test->get_result();
    $test_data = [];
    while ($row = $result_test->fetch_object()) {
        $test_data[] = $row;
    }

    // JSON으로 반환
    echo json_encode(['quiz' => $quiz_data, 'test' => $test_data]);
    exit;
}

// 임시 저장 로직
if (isset($_POST['draft_save'])) {
    $cate1 = $_POST['cate1']; // 대분류 코드
    $cate2 = $_POST['cate2']; // 중분류 코드
    $cate3 = $_POST['cate3']; // 소분류 코드
    $title = $_POST['title']; // 강좌명

    // 기본값 설정
    $state = 0; // 임시 저장 상태
    $date = date('Y-m-d H:i:s'); // 현재 시간 저장

    // 쿼리 실행
    $sql = "INSERT INTO lecture (cate1, cate2, cate3, title, date, state) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssi", $cate1, $cate2, $cate3, $title, $date, $state);

    if ($stmt->execute()) {
        echo "<script>alert('강좌가 임시 저장되었습니다.');</script>";
        echo "<script>location.href='lecture_list.php';</script>";
    } else {
        echo "<script>alert('저장 실패: " . $stmt->error . "');</script>";
    }
}
?>
