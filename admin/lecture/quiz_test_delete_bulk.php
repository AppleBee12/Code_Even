<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

  // POST 요청 확인
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // exid 배열이 비어 있지 않은지 확인
    if (!empty($_POST['exid'])) {
      // 선택된 exid 배열
      $exid_list = $_POST['exid'];

      // ID를 쉼표로 연결
      $ids_to_delete = implode(',', $exid_list);

      // quiz와 test 테이블에서 삭제
      $delete_quiz = "DELETE FROM quiz WHERE exid IN ($ids_to_delete)";
      $delete_test = "DELETE FROM test WHERE exid IN ($ids_to_delete)";

      // 각각 쿼리 실행
      if ($mysqli->query($delete_quiz) || $mysqli->query($delete_test)) {
        echo "<script>alert('선택된 항목이 삭제되었습니다.'); location.href='quiz_test_list.php';</script>";
      } else {
        echo "<script>alert('삭제 중 오류가 발생했습니다.'); history.back();</script>";
      }
    } else {
      echo "<script>alert('삭제할 항목이 없습니다.'); history.back();</script>";
    }
  } else {
    echo "<script>alert('잘못된 요청입니다.'); history.back();</script>";
  }

?>