<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$aqid = $_GET['aqid'];
$sql = "DELETE FROM admin_question WHERE aqid = $aqid";
$result = $mysqli->query($sql);

if ($result) {
  echo
    "<script>
    confirm('글을 삭제하시겠습니까?');
    alert('삭제가 완료되었습니다.');
    location.href='admin_qna_teacher.php';
  </script>";
} else {
  echo
    "<script>
      alert('글 삭제 실패');
      history.back();
    </script>";
}
?>