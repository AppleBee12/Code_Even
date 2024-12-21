<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php'); // DB 연결

// 현재 로그인된 사용자 세션 값 가져오기
$session_userid = $_SESSION['AUID'] ?? null;

if (!$session_userid) {
  echo "<script>alert('로그인 정보가 없습니다. 다시 로그인해 주세요.'); location.href='/code_even/admin/login.php';</script>";
  exit;
}

// 삭제할 교재 ID 가져오기
$book_id = $_GET['id'] ?? null;

if (!$book_id) {
  echo "<script>alert('잘못된 요청입니다.'); history.back();</script>";
  exit;
}

// 데이터베이스에서 이미지 경로 가져오기
$sql_image = "SELECT image FROM book WHERE boid = ?";
$stmt_image = $mysqli->prepare($sql_image);
$stmt_image->bind_param("i", $book_id);
$stmt_image->execute();
$result_image = $stmt_image->get_result();

$image_path = null;
if ($result_image && $result_image->num_rows > 0) {
  $row = $result_image->fetch_object();
  $image_path = $row->image;
}

// 교재 데이터 삭제
$sql_delete = "DELETE FROM book WHERE boid = ?";
$stmt_delete = $mysqli->prepare($sql_delete);
$stmt_delete->bind_param("i", $book_id);

if ($stmt_delete->execute()) {
  // 이미지 파일 삭제
  if ($image_path && file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
    unlink($_SERVER['DOCUMENT_ROOT'] . $image_path);
  }
  echo "<script>alert('교재가 삭제되었습니다.'); location.href='/code_even/admin/book/book_list.php';</script>";
} else {
  echo "<script>alert('삭제에 실패했습니다. 다시 시도해주세요.'); history.back();</script>";
}

// 데이터베이스 연결 종료
$stmt_image->close();
$stmt_delete->close();
$mysqli->close();
?>
