<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

  // id 값 확인
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 삭제 쿼리 실행 (quiz와 test 테이블에서 삭제)
    $delete_quiz = "DELETE FROM quiz WHERE exid = $id";
    $delete_test = "DELETE FROM test WHERE exid = $id";

    // 쿼리 실행 및 결과 확인
    if ($mysqli->query($delete_quiz) || $mysqli->query($delete_test)) {
      echo "<script>alert('삭제되었습니다.'); location.href='quiz_test_list.php';</script>";
    } else {
      echo "<script>alert('삭제 중 오류가 발생했습니다.'); history.back();</script>";
    }
  } else {
    echo "<script>alert('잘못된 요청입니다.'); history.back();</script>";
  }

?>