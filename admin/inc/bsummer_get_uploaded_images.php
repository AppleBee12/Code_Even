<?php
$uploadDir = '/path/to/your/uploads/';
$images = array_diff(scandir($uploadDir), ['.', '..']);

header('Content-Type: application/json');
echo json_encode(array_map(fn($img) => "/uploads/$img", $images));
?>
