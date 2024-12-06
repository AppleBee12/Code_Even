<?php
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/upload/summernote/';
$images = array_diff(scandir($uploadDir), ['.', '..']);

header('Content-Type: application/json');
echo json_encode(array_map(fn($img) => "/code_even/admin/upload/summernote/$img", $images));
?>
