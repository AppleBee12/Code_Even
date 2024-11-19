<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php'); // DB 연결

    // POST 요청인지 확인
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cate1 = $_POST['cate1'] ?? '';
    $cate2 = $_POST['cate2'] ?? '';
    $cate3 = $_POST['cate3'] ?? '';

    // 필수 데이터 검증
    if (!$cate1 || !$cate2 || !$cate3) {
      echo json_encode(['error' => '카테고리 값이 누락되었습니다.']);
      exit;
    }

    // DB에서 강좌 데이터 가져오기
    $stmt = $mysqli->prepare("SELECT leid, title FROM lecture WHERE cate1 = ? AND cate2 = ? AND cate3 = ? AND state = 0");
    $stmt->bind_param("sss", $cate1, $cate2, $cate3);
    $stmt->execute();
    $result = $stmt->get_result();

    $lectures = $result->fetch_all(MYSQLI_ASSOC);

    // JSON 데이터 반환
    echo json_encode($lectures);
    exit;
  }

  echo json_encode(['error' => '잘못된 요청입니다.']);
  exit;

?>