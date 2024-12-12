<?php
$data = json_decode(file_get_contents("php://input"), true);
$imagesToDelete = $data['images'];

foreach ($imagesToDelete as $image) {
    $filePath = $_SERVER['DOCUMENT_ROOT'] . parse_url($image, PHP_URL_PATH);
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

echo json_encode(['status' => 'success', 'deleted' => $imagesToDelete]);
?>
