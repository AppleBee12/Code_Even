<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php'); // DB 연결

header('Content-Type: application/json'); // JSON 응답 헤더 설정

$cate1 = isset($_POST['cate1']) ? $_POST['cate1'] : '';
$cate2 = isset($_POST['cate2']) ? $_POST['cate2'] : '';
$cate3 = isset($_POST['cate3']) ? $_POST['cate3'] : '';

$books = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $cate1 = $_POST['cate1'];
  $cate2 = $_POST['cate2'];
  $cate3 = $_POST['cate3'];
  $title = $_POST['title'];

  $sql = "SELECT * FROM book WHERE cate1 = '$cate1' AND cate2 = '$cate2' AND cate3 = '$cate3' AND title = '$title'";
  $result = $mysqli->query($sql);

  // 디버깅 로그 추가
  error_log("SQL Query: $sql");

  $books = [];
  if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_object()) { // fetch_object 방식
          $books[] = $row;
      }
      error_log("Books Found: " . print_r($books, true));
  } else {
      error_log("No matching books found.");
  }

  echo json_encode($books);
  exit;
}




?>