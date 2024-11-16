<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

  $ntid = $_GET['ntid'];
  $sql = "DELETE FROM notice WHERE ntid = $ntid";
  $result = $mysqli->query($sql);

  if($result){
    echo 
    "<script>
      alert('글 삭제 성공');
      location.href='notice.php';
    </script>";
  }else{
    echo
    "<script>
      alert('글 삭제 실패');
      history.back();
    </script>";
  }
?>