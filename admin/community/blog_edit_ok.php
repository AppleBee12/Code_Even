<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

print_r($_POST);
$post_id = $_GET['post_id'] ?? null;
$titles = $_POST['titles'];
$thumbnails = $_FILES['thumbnails'];
$content = rawurldecode($_POST['content']);

$sql = "UPDATE blog SET 
                titles = '$titles',
                content = '$content'";


// 섬네일이 업로드되었으면
if (!empty($thumbnails['name'])) {
    // 섬네일 이미지 파일 처리 (예: 파일 업로드)
    $thumbnail_path = 'path/to/upload/' . basename($thumbnails['name']); // 예시 경로
    move_uploaded_file($thumbnails['tmp_name'], $thumbnail_path); // 실제 파일 업로드

    // 쿼리에 섬네일 경로 추가
    $sql .= ", thumbnails = '$thumbnail_path'";
}

$sql .= "WHERE post_id = $post_id";

$result = $mysqli->query($sql);
// echo $sql;

?>  