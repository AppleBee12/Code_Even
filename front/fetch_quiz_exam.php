<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

// 요청 확인
if (isset($_POST['type'], $_POST['id'])) {
  $type = $_POST['type']; // quiz 또는 exam
  $exid = (int) $_POST['id']; // exid 정수 변환

  $response = ['success' => false, 'data' => []];

  if ($type === 'quiz') {
    // 퀴즈 데이터 가져오기
    $query = "SELECT pn, question FROM quiz WHERE exid = $exid";
    $result = $mysqli->query($query);
    if ($result && $row = $result->fetch_object()) {
      $options = json_decode($row->question, true); // JSON 배열 변환
      $response['success'] = true;
      $response['data'] = [
        'question' => htmlspecialchars($row->pn),
        'options' => is_array($options) ? array_map('htmlspecialchars', $options) : [] // 안전하게 처리
      ];
    }
  } elseif ($type === 'exam') {
    // 시험 데이터 가져오기
    $query = "
        SELECT t.pn, t.question 
        FROM test t
        WHERE t.exid >= $exid AND t.exid < $exid + 4
        ORDER BY t.exid ASC
    ";

    $result = $mysqli->query($query);
    $exam_data = [];

    while ($result && $row = $result->fetch_object()) {
      $options = json_decode($row->question, true); // JSON 배열 변환
      $exam_data[] = [
        'question' => htmlspecialchars($row->pn),
        'options' => is_array($options) ? array_map('htmlspecialchars', $options) : []
      ];
    }

    if (!empty($exam_data)) {
      $response['success'] = true;
      $response['data'] = $exam_data;
    }
  }


  // JSON 응답 반환
  echo json_encode($response, JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(['success' => false, 'message' => '유효한 요청이 아닙니다.']);
}
exit;
