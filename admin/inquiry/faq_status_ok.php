<?php
$title = "FAQ 상태 변경";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

$fqid = $_POST['fqid'];
$status = $_POST['status'];

$sql = "UPDATE faq 
        SET status = '$status' 
        WHERE fqid = '$fqid'";

if ($mysqli->query($sql) === TRUE) {
  echo "성공";

} else {
  echo "Error: " . $mysqli->error;
}

?>