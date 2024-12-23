<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

if (isset($_GET['ntid']) && isset($_GET['confirm']) && $_GET['confirm'] == "true") {
  $ntid = $_GET['ntid'];
  $sql = "DELETE FROM notice WHERE ntid = $ntid";
  $result = $mysqli->query($sql);

  if ($result) {
  echo 
  "<script>
      alert('삭제가 완료되었습니다.');
      location.href = 'notice.php?delete=true';
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
          location.href = '?ntid=" . $_GET['ntid'] . "&confirm=true';
      } else {
          alert('삭제가 취소되었습니다.');
          location.href = 'notice.php';
      }
  </script>";
}
?>