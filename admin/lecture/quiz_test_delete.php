<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// id와 type 값 확인
if (isset($_GET['id']) && isset($_GET['type'])) {
  $id = intval($_GET['id']); // id를 정수로 변환하여 안전성 확보
  $type = $_GET['type']; // type 값 확인 ('quiz' 또는 'test')

  // type 값에 따라 테이블 선택
  $table = '';
  if ($type === 'quiz') {
    $table = 'quiz';
  } elseif ($type === 'test') {
    $table = 'test';
  } else {
    echo "<script>alert('잘못된 요청입니다.'); history.back();</script>";
    exit;
  }

  // 삭제 쿼리
  $delete_sql = "DELETE FROM $table WHERE exid = $id";

  // 쿼리 실행 및 결과 확인
  if ($mysqli->query($delete_sql)) {
    echo "<script>alert('삭제되었습니다.'); location.href='quiz_test_list.php';</script>";
  } else {
    echo "<script>alert('삭제 중 오류가 발생했습니다: {$mysqli->error}'); history.back();</script>";
  }
} else {
  echo "<script>alert('잘못된 요청입니다.'); history.back();</script>";
}
?>
