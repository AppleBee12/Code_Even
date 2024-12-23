<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

if (isset($_GET['aqid']) && isset($_GET['confirm']) && $_GET['confirm'] == "true") {
$aqid = $_GET['aqid'];
$sql = "DELETE FROM admin_question WHERE aqid = $aqid";
$result = $mysqli->query($sql);

  if ($result) {
  echo 
  "<script>
      alert('삭제가 완료되었습니다.');
      location.href = 'admin_qna.php?delete=true';
  </script>";
  } else {
    echo 
    "<script>
        alert('글 삭제 실패');
        history.back();
    </script>";
  }
} else {
  echo 
  "<script>
      if (confirm('글을 삭제하시겠습니까?')) {
          location.href = '?aqid=" . $_GET['aqid'] . "&confirm=true';
      } else {
          alert('삭제가 취소되었습니다.');
          location.href = 'admin_qna.php';
      }
  </script>";
}
?>