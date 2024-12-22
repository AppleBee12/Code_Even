<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

if (!isset($_SESSION['UID'])) {
  echo json_encode(['error' => '로그인 상태가 아닙니다.']);
  exit;
}

$uid = $_SESSION['UID'];

$query = "SELECT username, userphonenum, post_code, addr_line1, addr_line2, addr_line3 FROM user WHERE uid = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if ($userData) {
  echo json_encode($userData);
} else {
  echo json_encode(['error' => '유저 데이터를 찾을 수 없습니다.']);
}

$stmt->close();
?>
