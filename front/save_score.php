<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

// 학생 ID 확인
if (!isset($_SESSION['UID'])) {
  echo json_encode(['success' => false, 'message' => '로그인이 필요합니다.'], JSON_UNESCAPED_UNICODE);
  exit;
}

$stu_id = (int) $_SESSION['UID'];

// POST 데이터 확인
if (!isset($_POST['type'], $_POST['id'], $_POST['answer'])) {
  echo json_encode(['success' => false, 'message' => '필수 데이터가 누락되었습니다.'], JSON_UNESCAPED_UNICODE);
  exit;
}

$type = $_POST['type']; // quiz 또는 exam
$exid = (int) $_POST['id'];
$answer = $_POST['answer']; // 사용자가 제출한 답변
$score = 0;

// 강의 및 상세 강의 ID 가져오기
$lecture_detail_query = "
    SELECT lecture_id AS leid, id AS detail_id 
    FROM lecture_detail 
    WHERE (quiz_id = $exid AND '$type' = 'quiz') OR (test_id = $exid AND '$type' = 'exam')
";
$lecture_detail_result = $mysqli->query($lecture_detail_query);

if ($lecture_detail_result && $row = $lecture_detail_result->fetch_object()) {
  $leid = $row->leid;
  $detail_id = $row->detail_id;
} else {
  echo json_encode([
    'success' => false,
    'message' => '강의 정보를 찾을 수 없습니다.'
  ], JSON_UNESCAPED_UNICODE);
  exit;
}

// 정답 확인 및 점수 계산
if ($type === 'quiz') {
  $quiz_query = "SELECT answer FROM quiz WHERE exid = $exid";
  $quiz_result = $mysqli->query($quiz_query);
  if ($quiz_result && $quiz_row = $quiz_result->fetch_object()) {
    $correct_answer = $quiz_row->answer;
    $score = ($answer == $correct_answer) ? 100 : 0;
  }
} elseif ($type === 'exam') {
  $test_query = "SELECT answer FROM test WHERE exid = $exid";
  $test_result = $mysqli->query($test_query);
  if ($test_result && $test_row = $test_result->fetch_object()) {
    $correct_answer = $test_row->answer;
    $score = ($answer == $correct_answer) ? 100 : 0;
  }
}

// 기존 기록 확인
$existing_score_query = "
    SELECT exid FROM stuscores 
    WHERE stu_id = $stu_id AND leid = $leid AND detail_id = $detail_id
";
$existing_score_result = $mysqli->query($existing_score_query);

if ($existing_score_result && $existing_score_result->num_rows > 0) {
  // 이미 존재하는 경우 업데이트
  $update_query = "
        UPDATE stuscores 
        SET quiz = IF('$type' = 'quiz', $exid, quiz),
            quiz_score = IF('$type' = 'quiz', $score, quiz_score),
            test = IF('$type' = 'exam', $exid, test),
            test_score = IF('$type' = 'exam', $score, test_score),
            answer = '$answer'
        WHERE stu_id = $stu_id AND leid = $leid AND detail_id = $detail_id
    ";
  $mysqli->query($update_query);
} else {
  // 새로운 기록 삽입
  $insert_query = "
        INSERT INTO stuscores (leid, detail_id, stu_id, quiz, quiz_score, test, test_score, answer)
        VALUES (
            $leid, 
            $detail_id, 
            $stu_id, 
            IF('$type' = 'quiz', $exid, NULL), 
            IF('$type' = 'quiz', $score, NULL), 
            IF('$type' = 'exam', $exid, NULL), 
            IF('$type' = 'exam', $score, NULL), 
            '$answer'
        )
    ";
  $mysqli->query($insert_query);
}

// SQL 오류 확인
if ($mysqli->error) {
  echo json_encode([
    'success' => false,
    'message' => 'SQL 오류: ' . $mysqli->error
  ], JSON_UNESCAPED_UNICODE);
  exit;
}

// 응답 반환
if ($mysqli->affected_rows > 0) {
  echo json_encode([
    'success' => true,
    'message' => '점수가 성공적으로 저장되었습니다.',
    'score' => $score,
    'leid' => $leid,
    'detail_id' => $detail_id
  ], JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode([
    'success' => false,
    'message' => '점수 저장에 실패했습니다. (쿼리 실행됨, 영향받은 행 없음)',
    'leid' => $leid,
    'detail_id' => $detail_id,
    'score' => $score
  ], JSON_UNESCAPED_UNICODE);
}
?>