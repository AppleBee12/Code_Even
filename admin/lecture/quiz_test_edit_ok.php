<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $type = $_POST['type'] ?? 'quiz';
  $exid = intval($_POST['exid']);
  $cate1 = $_POST['cate1'] ?? '';
  $cate2 = $_POST['cate2'] ?? '';
  $cate3 = $_POST['cate3'] ?? '';
  $answer = $_POST['questions'][0]['answer'] ?? '';
  $pn = $_POST['questions'][0]['pn'] ?? '';
  $explan = $_POST['questions'][0]['explan'] ?? '';

  // 문항 데이터 검증
  if (empty($_POST['questions'][0]['options']) || count($_POST['questions'][0]['options']) < 2) {
    echo "<script>alert('문항은 최소 2개 이상 입력해야 합니다.'); history.back();</script>";
    exit;
  }

  // JSON 인코딩
  $question = json_encode($_POST['questions'][0]['options'] ?? [], JSON_UNESCAPED_UNICODE);

  // 테이블 선택
  $tableName = ($type === 'quiz') ? 'quiz' : 'test';

  // 데이터베이스 업데이트 (강좌명 관련 필드 제거)
  $sql_update = "UPDATE $tableName SET cate1 = ?, cate2 = ?, cate3 = ?, answer = ?, pn = ?, question = ?, explan = ? WHERE exid = ?";
  if ($stmt = $mysqli->prepare($sql_update)) {
    $stmt->bind_param("sssssssi", $cate1, $cate2, $cate3, $answer, $pn, $question, $explan, $exid);

    if ($stmt->execute()) {
      echo "<script>alert('수정이 완료되었습니다.'); window.location.href='quiz_test_list.php';</script>";
    } else {
      error_log("Database Error: " . $stmt->error);
      echo "<script>alert('수정에 실패했습니다. 관리자에게 문의하세요.'); history.back();</script>";
    }

    $stmt->close();
  } else {
    error_log("Query Preparation Error: " . $mysqli->error);
    echo "<script>alert('쿼리를 준비하는 동안 오류가 발생했습니다. 관리자에게 문의하세요.'); history.back();</script>";
  }
} else {
  echo "<script>alert('잘못된 요청입니다.'); history.back();</script>";
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>