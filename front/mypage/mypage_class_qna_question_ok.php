<?php
$title = '마이페이지-1:1문의하기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// print_r($_POST);

$cdid = $_POST['cdid'];
$qtitle = $_POST['qtitle'];
$qcontent = $_POST['qcontent'];

$sql = "INSERT INTO student_qna (cdid, qtitle, qcontent) VALUES ($cdid, '$qtitle', '$qcontent')";
$result = $mysqli->query($sql);

if ($result === true) {
  echo
  "<script>
    alert('등록이 완료되었습니다.');
    location.href='mypage_qna.php';
  </script>";
} else {
  echo
  "<script>
    alert('글쓰기 실패');
    history.back();
  </script>";
}
?>