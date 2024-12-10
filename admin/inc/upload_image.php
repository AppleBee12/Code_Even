<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/upload/summernote/'; // 이미지 저장 경로
  
  $fileName = uniqid() . '_' . basename($_FILES['file']['name']);
  $uploadFilePath = $uploadDir . $fileName;

  // 브라우저에서 접근 가능한 경로
  $accessibleUrlBase = 'http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/upload/summernote/';

  if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
    echo json_encode([
        'status' => 'success',
        'imageUrl' => $accessibleUrlBase . $fileName, // 브라우저에서 접근 가능한 경로
    ]);
    if (!isset($_SESSION['imageUrl']) || !is_array($_SESSION['imageUrl'])) {
      $_SESSION['imageUrl'] = []; // 배열로 초기화
  }
    $_SESSION['imageUrl'][] = $accessibleUrlBase . $fileName;
    
  } else {
    echo json_encode([
        'status' => 'error',
        'message' => '이미지 업로드 실패',
    ]);
  }
}
?>
