<?php
session_start(); // 세션 시작
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// POST 요청 처리
  $cate1 = isset($_POST['cate1']) ? $_POST['cate1'] : '';
  $cate2 = isset($_POST['cate2']) ? $_POST['cate2'] : '';
  $cate3 = isset($_POST['cate3']) ? $_POST['cate3'] : '';
  $title = $_POST['title'] ?? '';

  // 유효성 검사
  if (!$cate1 || !$cate2 || !$cate3 || !$title) {
    echo json_encode(['error' => '모든 필드를 입력해주세요.']);
    exit;
  }

  // 퀴즈 데이터 가져오기
  $quiz_data = [];
  $sql_quiz = "SELECT exid, tt FROM quiz WHERE cate1 = '$cate1' AND cate2 = '$cate2' AND cate3 = '$cate3' AND title LIKE '%$title%'";
  $result_quiz = $mysqli->query($sql_quiz);

  $quiz_data = [];
  while ($row = $result_quiz->fetch_object()) {
    $quiz_data[] = $row;
  }

  // 시험 데이터 가져오기
  $test_data = [];
  $sql_test = "SELECT exid, tt FROM test WHERE cate1 = '$cate1' AND cate2 = '$cate2' AND cate3 = '$cate3' AND title LIKE '%$title%'";
  $result_test = $mysqli->query($sql_test);

  $test_data = [];
  while ($row = $result_test->fetch_object()) {
    $test_data[] = $row;
  }

  // JSON 응답 반환
  echo json_encode(['quiz' => $quiz_data, 'test' => $test_data]);

?>