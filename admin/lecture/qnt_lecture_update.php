<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php'); // DB 연결

    // POST 요청인지 확인
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cate1 = isset($_POST['cate1']) ? $_POST['cate1'] : '';
    $cate2 = isset($_POST['cate2']) ? $_POST['cate2'] : '';
    $cate3 = isset($_POST['cate3']) ? $_POST['cate3'] : '';

    // 요청 값 확인
    if (empty($cate1) || empty($cate2) || empty($cate3)) {
      echo json_encode([]); // 빈 결과 반환
      exit;
    }

    $lecture = [];
    $sql = "SELECT * FROM lecture WHERE cate1 = '$cate1' AND cate2 = '$cate2' AND cate3 = '$cate3'";
    $result = $mysqli->query($sql);

    // 디버깅 로그 추가
    error_log("SQL Query: $sql");

    $lecture = [];
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_object()) { // fetch_object 방식
        $lecture[] = $row;
      }
      error_log("lecture Found: " . print_r($lecture, true));
    } else {
      error_log("No matching lecture found.");
    }

    echo json_encode($lecture);
    exit;
  }

?>