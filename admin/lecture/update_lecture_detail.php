<?php

session_start(); // 세션 시작

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/img_upload_func.php');

$lecture_id = $_POST['lecture_id'];

// 기존 강의 업데이트
if (!empty($_POST['lecture_name'])) {
    foreach ($_POST['lecture_name'] as $id => $name) {
        $description = $_POST['lecture_description'][$id];
        $video_url = $_POST['lecture_video_url'][$id];

        $sql = "UPDATE lecture_detail SET title = '$name', description = '$description', video_url = '$video_url' WHERE id = $id";
        $mysqli->query($sql);
    }
}

// 새로운 강의 추가
if (!empty($_POST['new_lecture_name'])) {
    foreach ($_POST['new_lecture_name'] as $index => $name) {
        $description = $_POST['new_lecture_description'][$index];
        $video_url = $_POST['new_lecture_video_url'][$index];

        $sql = "INSERT INTO lecture_detail (lecture_id, title, description, video_url) VALUES ($lecture_id, '$name', '$description', '$video_url')";
        $mysqli->query($sql);
    }
}

echo "<script>alert('강의가 수정되었습니다.'); location.href = 'lecture_list.php';</script>";
?>