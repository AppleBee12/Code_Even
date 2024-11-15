<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

// print_r($_POST);
$username = $_POST['username'];
$title = $_POST['title'];
$content = $_POST['content'];
$status = $_POST['status'];

$sql = "INSERT INTO notice (title, content, status) VALUES ('$title', '$content', '$status')";

if ($mysqli->query($sql) === true) {
  echo
    "<script>
    confirm('글을 등록하시겠습니까?');
    alert('등록이 완료되었습니다.');
    location.href='notice_write.php';
  </script>";
} else {
  echo
    "<script>
    alert('글쓰기 실패');
    history.back();
  </script>";
}

?>