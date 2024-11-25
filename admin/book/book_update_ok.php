<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/db.php');

// POST 데이터 검증
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$title = $_POST['title'] ?? '';
$book = $_POST['book'] ?? '';
$company = $_POST['company'] ?? '';
$price = $_POST['price'] ?? 0;
$pd = $_POST['pd'] ?? '';
$writer = $_POST['writer'] ?? '';
$desc = $_POST['desc'] ?? '';
$cate1 = $_POST['cate1'] ?? '';
$cate2 = $_POST['cate2'] ?? '';
$cate3 = $_POST['cate3'] ?? '';
$category = $cate1 . $cate2 . $cate3;

// 첨부된 이미지 처리
$image_path = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    $file_name = time() . '_' . $_FILES['image']['name'];
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
        $image_path = '/uploads/' . $file_name;
    }
}

// 기존 교재 데이터 가져오기
$sql_get = "SELECT * FROM book WHERE id = $id";
$result = $mysqli->query($sql_get);
$book_data = $result->fetch_object();

if (!$book_data) {
    echo "<script>alert('교재 정보를 찾을 수 없습니다.');</script>";
    echo "<script>location.href='/CODE_EVEN/admin/book_list.php';</script>";
    exit;
}

// 이미지가 없으면 기존 이미지 유지
if (empty($image_path)) {
    $image_path = $book_data->image;
}

// 교재 데이터 업데이트
$sql_update = "UPDATE books 
               SET 
                   title = '$title',
                   book = '$book',
                   company = '$company',
                   price = $price,
                   pd = '$pd',
                   writer = '$writer',
                   description = '$desc',
                   category = '$category',
                   image = '$image_path'
               WHERE id = $id";

if ($mysqli->query($sql_update)) {
    echo "<script>alert('교재 정보가 수정되었습니다.');</script>";
    echo "<script>location.href='/CODE_EVEN/admin/book_list.php';</script>";
} else {
    echo "<script>alert('수정에 실패했습니다. 관리자에게 문의하세요.');</script>";
    echo "<script>history.back();</script>";
}

?>
