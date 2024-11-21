<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php'); // DB 연결

  header('Content-Type: application/json'); // JSON 응답 헤더 설정

  // POST 데이터 가져오기
  $cate1 = isset($_POST['cate1']) ? $_POST['cate1'] : '';
  $cate2 = isset($_POST['cate2']) ? $_POST['cate2'] : '';
  $cate3 = isset($_POST['cate3']) ? $_POST['cate3'] : '';

  $books = []; // 결과를 저장할 배열

  // 교재 데이터 초기화
  if (!empty($lecture->cate1) && !empty($lecture->cate2) && !empty($lecture->cate3)) {
    $sql_books = "
        SELECT boid, book 
        FROM book 
        WHERE cate1 = '{$lecture->cate1}' 
          AND cate2 = '{$lecture->cate2}' 
          AND cate3 = '{$lecture->cate3}'
    ";
    $result_books = $mysqli->query($sql_books);

    if ($result_books) {
        while ($book = $result_books->fetch_object()) {
            $books[] = $book;
        }
    }
  }

  // JSON 형식으로 결과 반환
  echo json_encode($books);
  exit;

?>
