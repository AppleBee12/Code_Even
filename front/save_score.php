<?php
header('Content-Type: application/json; charset=UTF-8');
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

// ✅ 학생 ID 확인
if (!isset($_SESSION['UID'])) {
  echo json_encode(['success' => false, 'message' => '로그인이 필요합니다.'], JSON_UNESCAPED_UNICODE);
  exit;
}

$stu_id = (int) $_SESSION['UID'];

// ✅ JSON 데이터 읽기
$rawData = file_get_contents('php://input');
$decodedData = json_decode($rawData, true);

// ✅ JSON 데이터 검증
if (!$decodedData || !isset($decodedData['type'], $decodedData['id'], $decodedData['answers'])) {
  echo json_encode([
    'success' => false,
    'message' => '필수 데이터가 누락되었습니다.',
    'received' => $decodedData
  ], JSON_UNESCAPED_UNICODE);
  exit;
}

// ✅ 변수 할당
$type = $decodedData['type']; // 시험인지 퀴즈인지
$exid = (int) $decodedData['id']; // 시작 문제 번호
$answers = $decodedData['answers']; // 배열 형태
$score = 0;

// ✅ 강의 및 상세 강의 ID 가져오기
$lecture_detail_query = "
    SELECT lecture_id AS leid, id AS detail_id 
    FROM lecture_detail 
    WHERE test_id = $exid OR quiz_id = $exid
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

// ✅ 연속된 문제 세트 가져오기
$test_query = "
    SELECT exid, answer 
    FROM test 
    WHERE exid BETWEEN $exid AND ($exid + 3)
    ORDER BY exid ASC;
";
$test_result = $mysqli->query($test_query);

if (!$test_result || $test_result->num_rows === 0) {
  echo json_encode([
    'success' => false,
    'message' => '시험 문제를 찾을 수 없습니다.'
  ], JSON_UNESCAPED_UNICODE);
  exit;
}

// ✅ 문제별 정답 확인 및 점수 계산
$totalQuestions = $test_result->num_rows;
$correctCount = 0;

// 정답 매핑
$correctAnswers = [];
while ($test_row = $test_result->fetch_object()) {
  $correctAnswers[$test_row->exid] = (int) $test_row->answer;
}

// 사용자 답변과 정답 비교
foreach ($answers as $question_exid => $user_answer) {
  if (isset($correctAnswers[$question_exid]) && (int) $user_answer === $correctAnswers[$question_exid]) {
    $correctCount++;
  }
}

// ✅ 점수 계산 (100점 만점 기준)
if ($totalQuestions > 0) {
  $score = intval(($correctCount / $totalQuestions) * 100);
}

// ✅ 점수 저장
$existing_score_query = "
    SELECT exid FROM stuscores 
    WHERE stu_id = $stu_id AND leid = $leid AND detail_id = $detail_id
";
$existing_score_result = $mysqli->query($existing_score_query);

if ($existing_score_result && $existing_score_result->num_rows > 0) {
  // 이미 존재하는 경우 업데이트
  $update_query = "
        UPDATE stuscores 
        SET test = $exid,
            test_score = $score,
            answer = '" . json_encode($answers, JSON_UNESCAPED_UNICODE) . "'
        WHERE stu_id = $stu_id AND leid = $leid AND detail_id = $detail_id
    ";
  $mysqli->query($update_query);
} else {
  // 새로운 기록 삽입
  $insert_query = "
        INSERT INTO stuscores (leid, detail_id, stu_id, test, test_score, answer)
        VALUES (
            $leid, 
            $detail_id, 
            $stu_id, 
            $exid,
            $score,
            '" . json_encode($answers, JSON_UNESCAPED_UNICODE) . "'
        )
    ";
  $mysqli->query($insert_query);
}

// ✅ SQL 오류 확인
if ($mysqli->error) {
  echo json_encode([
    'success' => false,
    'message' => 'SQL 오류: ' . $mysqli->error
  ], JSON_UNESCAPED_UNICODE);
  exit;
}

// ✅ 최종 응답 반환
echo json_encode([
  'success' => true,
  'message' => '점수가 성공적으로 저장되었습니다.',
  'score' => $score,
  'correctCount' => $correctCount,
  'totalQuestions' => $totalQuestions,
  'leid' => $leid,
  'detail_id' => $detail_id
], JSON_UNESCAPED_UNICODE);
?>