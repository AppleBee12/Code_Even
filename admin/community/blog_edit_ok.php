<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

print_r($_POST);
$post_id = $_GET['post_id'] ?? null;

?>