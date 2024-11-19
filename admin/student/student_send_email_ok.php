<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$uid = $_POST['uid'];
$title = $_POST['title'];
$content = $_POST['content'];
$regdate = date('Y-m-d H:i:s');

$sql = "INSERT INTO send_email (uid, title, content, regdate) 
        VALUES ('$uid', '$title', '$content', '$regdate')";

if ($mysqli->query($sql) === TRUE) {
  echo "Email data saved successfully.";
} else {
  echo "Error: " . $mysqli->error;
}

?>