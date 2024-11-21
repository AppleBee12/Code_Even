<?php
$title = "공지사항 상태 변경";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$ntid = $_POST['ntid'];
$status = $_POST['status'];

$sql = "UPDATE notice 
        SET status = '$status' 
        WHERE ntid = '$ntid'";

if ($mysqli->query($sql) === TRUE) {
  echo 
  "<script>
    location.href = 'notice.php';
  </script>";

} else {
  echo "Error: " . $mysqli->error;
}

?>