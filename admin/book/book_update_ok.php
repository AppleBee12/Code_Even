<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php'); // DB 연결
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/img_upload_func.php');

// 현재 로그인된 사용자 세션 값 가져오기
$session_userid = $_SESSION['AUID'] ?? null;

// 로그인 확인
if (!$session_userid) {
  echo "<script>alert('로그인 정보가 없습니다. 다시 로그인해 주세요.'); location.href='/code_even/admin/login.php';</script>";
  exit;
}

// 수정할 교재의 ID 가져오기
$book_id = $_POST['id'] ?? 0;
if (!$book_id) {
  echo "<script>alert('잘못된 요청입니다.'); location.href='/code_even/admin/book/book_list.php';</script>";
  exit;
}

// 데이터 수신
$cate1 = $_POST['cate1'] ?? '';
$cate2 = $_POST['cate2'] ?? '';
$cate3 = $_POST['cate3'] ?? '';
$title = $_POST['title'] ?? '';
$price = $_POST['price'] ?? 0;
$pd = $_POST['pd'] ?? '';
$book = $_POST['book'] ?? '';
$des = $_POST['desc'] ?? ''; // 교재 설명
$writer = $_POST['writer'] ?? '';
$company = $_POST['company'] ?? '';

// 이미지 업로드 처리
$imagePath = ''; // 업로드된 이미지 경로를 저장할 변수
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
  // 호출 디렉토리 설정
  $callingFileDir = 'book_images'; // 업로드 폴더를 지정

  // fileUpload 함수 호출
  $imagePathResult = fileUpload($_FILES['image'], $callingFileDir);
  if ($imagePathResult) {
    $imagePath = $imagePathResult;
  } else {
    die('이미지 업로드 실패. 다시 시도해주세요.');
  }
}

// 이전 이미지 경로를 가져오기
$sql_old_image = "SELECT image FROM book WHERE boid = $book_id";
$result_old_image = $mysqli->query($sql_old_image);
$old_image_path = '';
if ($result_old_image && $result_old_image->num_rows > 0) {
  $row = $result_old_image->fetch_object(); // fetch_object 사용
  $old_image_path = $row->image;
}

// SQL 작성 (이미지 경로 포함 여부에 따라 다르게 처리)
if ($imagePath) {
  // 이전 이미지 삭제
  if ($old_image_path && file_exists($_SERVER['DOCUMENT_ROOT'] . $old_image_path)) {
      unlink($_SERVER['DOCUMENT_ROOT'] . $old_image_path);
  }

  $sql = "UPDATE book SET 
              cate1 = ?, 
              cate2 = ?, 
              cate3 = ?, 
              title = ?, 
              price = ?, 
              pd = ?, 
              book = ?, 
              des = ?, -- 컬럼명 수정
              writer = ?, 
              company = ?, 
              image = ? 
          WHERE boid = ?";
} else {
  $sql = "UPDATE book SET 
              cate1 = ?, 
              cate2 = ?, 
              cate3 = ?, 
              title = ?, 
              price = ?, 
              pd = ?, 
              book = ?, 
              des = ?, -- 컬럼명 수정
              writer = ?, 
              company = ? 
          WHERE boid = ?";
}

$stmt = $mysqli->prepare($sql);

if ($imagePath) {
  $stmt->bind_param(
      "ssssdsdssssi", 
      $cate1, 
      $cate2, 
      $cate3, 
      $title, 
      $price, 
      $pd, 
      $book, 
      $des, 
      $writer, 
      $company, 
      $imagePath, 
      $book_id
  );
} else {
  $stmt->bind_param(
      "ssssdsdsssi", 
      $cate1, 
      $cate2, 
      $cate3, 
      $title, 
      $price, 
      $pd, 
      $book, 
      $des, 
      $writer, 
      $company, 
      $book_id
  );
}

if ($stmt->execute()) {
  echo "<script>alert('교재가 성공적으로 수정되었습니다.'); location.href='/CODE_EVEN/admin/book/book_list.php';</script>";
} else {
  echo "<script>alert('수정에 실패했습니다. 다시 시도해주세요.');</script>";
}

$stmt->close();


?>
