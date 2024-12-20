<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/img_upload_func.php');

// 현재 로그인된 사용자 세션 값 가져오기
$session_userid = $_SESSION['AUID'] ?? null;

// 로그인 확인
if (!$session_userid) {
  echo "<script>alert('로그인 정보가 없습니다. 다시 로그인해 주세요.'); location.href='/code_even/admin/login.php';</script>";
  exit;
}

// 수정할 교재의 ID 가져오기
$book_id = intval($_POST['id'] ?? 0);
if ($book_id <= 0) {
  echo "<script>alert('잘못된 요청입니다.'); location.href='/code_even/admin/book/book_list.php';</script>";
  exit;
}

// 데이터 수신 및 SQL 인젝션 방지
$cate1 = $mysqli->real_escape_string($_POST['cate1'] ?? '');
$cate2 = $mysqli->real_escape_string($_POST['cate2'] ?? '');
$cate3 = $mysqli->real_escape_string($_POST['cate3'] ?? '');
$title = $mysqli->real_escape_string($_POST['title'] ?? '');
$price = floatval($_POST['price'] ?? 0); // 숫자는 floatval로 처리
$pd = $mysqli->real_escape_string($_POST['pd'] ?? '');
$book = $mysqli->real_escape_string($_POST['book'] ?? '');
$des = $mysqli->real_escape_string($_POST['desc'] ?? '');
$writer = $mysqli->real_escape_string($_POST['writer'] ?? '');
$company = $mysqli->real_escape_string($_POST['company'] ?? '');

// 이미지 업로드 처리
$imagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
  $callingFileDir = 'book_images';
  $imagePathResult = fileUpload($_FILES['image'], $callingFileDir);
  if ($imagePathResult) {
    $imagePath = $mysqli->real_escape_string($imagePathResult);
  } else {
    die('이미지 업로드 실패. 다시 시도해주세요.');
  }
}

// 이전 이미지 경로를 가져오기
$sql_old_image = "SELECT image FROM book WHERE boid = $book_id";
$result_old_image = $mysqli->query($sql_old_image);
$old_image_path = '';
if ($result_old_image && $result_old_image->num_rows > 0) {
  $row = $result_old_image->fetch_object();
  $old_image_path = $row->image;
}

// SQL 작성 및 실행
if ($imagePath) {
  // 이전 이미지 삭제
  if ($old_image_path && file_exists($_SERVER['DOCUMENT_ROOT'] . $old_image_path)) {
    unlink($_SERVER['DOCUMENT_ROOT'] . $old_image_path);
  }

  $sql = "
        UPDATE book SET
            cate1 = '$cate1',
            cate2 = '$cate2',
            cate3 = '$cate3',
            title = '$title',
            price = $price,
            pd = '$pd',
            book = '$book',
            des = '$des',
            writer = '$writer',
            company = '$company',
            image = '$imagePath'
        WHERE boid = $book_id
    ";
} else {
  $sql = "
        UPDATE book SET
            cate1 = '$cate1',
            cate2 = '$cate2',
            cate3 = '$cate3',
            title = '$title',
            price = $price,
            pd = '$pd',
            book = '$book',
            des = '$des',
            writer = '$writer',
            company = '$company'
        WHERE boid = $book_id
    ";
}

// 디버깅: 쿼리 확인
// echo $sql; exit;

// 쿼리 실행 및 오류 확인
if (!$mysqli->query($sql)) {
  die("쿼리 오류: " . $mysqli->error);
} else {
  echo "<script>alert('교재가 성공적으로 수정되었습니다.'); location.href='/CODE_EVEN/admin/book/book_list.php';</script>";
}

$mysqli->close();
?>
