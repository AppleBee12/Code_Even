<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
session_start();

print_r($_POST);

$sql = "INSERT INTO notice (ntid, title, content, view, regdate, status, file) VALUES ()";
?>