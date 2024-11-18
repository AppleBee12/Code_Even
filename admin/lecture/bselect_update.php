<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php'); // DB 연결

$cate1 = isset($_POST['cate1']) ? $_POST['cate1'] : '';
$cate2 = isset($_POST['cate2']) ? $_POST['cate2'] : '';
$cate3 = isset($_POST['cate3']) ? $_POST['cate3'] : '';
$title = isset($_POST['title']) ? $_POST['title'] : '';

$books = [];

// 카테고리에 맞는 교재를 검색
if ($cate1 ) {
    $sql_books = " SELECT boid, book FROM book WHERE cate1 = '$cate1' AND cate2 = '$cate2' AND cate3 = '$cate3' ";
    $result_books = $mysqli->query($sql_books);

    // 교재 목록을 배열에 저장
    while ($book = $result_books->fetch_object()) {
        $books[] = $book;
    }
    // echo json_encode($sql_books);
}

// 교재 목록을 JSON 형식으로
echo json_encode($books);




?>
