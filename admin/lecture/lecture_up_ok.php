<?php

session_start(); // 세션 시작

header('Content-Type: application/json; charset=utf-8');


var_dump($_POST);

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 현재 로그인된 사용자 ID 확인
if (!isset($_SESSION['AUID']) || !isset($_SESSION['AUNAME'])) {
  echo "<script>alert('로그인이 필요합니다.'); location.href='../login/login.php';</script>";
  exit;
}

$session_userid = $_SESSION['AUID']; // 세션에서 AUID 가져오기

// 사용자 정보 가져오기
$sql_user = "SELECT uid, username FROM user WHERE userid = '$session_userid'";
$result_user = $mysqli->query($sql_user);

if ($result_user && $result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
    $uid = $user_data['uid'];
    $username = $user_data['username'];
} else {
    die("사용자 정보를 가져오는 데 실패했습니다.");
}

// 확인용
$sql_user = "SELECT uid, username FROM user WHERE userid = '$session_userid'";
$result_user = $mysqli->query($sql_user);
if (!$result_user || $result_user->num_rows === 0) {
    die(json_encode(['success' => false, 'error' => '사용자 정보를 가져오지 못했습니다.']));
}


// POST 데이터 처리
$title = $_POST['title'] ?? null;
$cate1 = $_POST['cate1'] ?? null;
$cate2 = $_POST['cate2'] ?? null;
$cate3 = $_POST['cate3'] ?? null;
$price = $_POST['price'] ?? 0;
$book_id = $_POST['book'] ?? null;
$period = $_POST['period'] ?? 30;
$is_recipe = isset($_POST['courseType']) && $_POST['courseType'] === 'isrecipe';
$course_type = $_POST['courseType'] ?? 'general'; // 기본값은 'general'
$uid = $_SESSION['userid'] ?? null; // 세션에서 사용자 ID 가져오기

// `true`와 `false`를 데이터베이스에서 처리 가능한 값으로 변환
$isrecipe = ($course_type === 'true') ? 1 : 0; // 1이면 레시피 강좌, 0이면 일반 강좌

// 확인용
$required_fields = ['title', 'cate1', 'cate2', 'cate3'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        die(json_encode(['success' => false, 'error' => "$field 값이 비어 있습니다."]));
    }
}


// 이미지 처리
$image_path = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/images/';
    $image_name = time() . '_' . $_FILES['image']['name'];
    $image_path = $upload_dir . $image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
}

// 필수 값 확인
if (empty($title) || empty($cate1) || empty($cate2) || empty($cate3) ) {
    echo json_encode(['success' => false, 'error' => '필수 항목이 누락되었습니다.']);
    exit;
}

// 교재 ID 확인 (선택 값)
$boid = null;
if (!empty($book_id)) {
    $query_book = "SELECT boid FROM book WHERE boid = '$book_id'";
    $result_book = $mysqli->query($query_book);
    if ($result_book && $result_book->num_rows > 0) {
        $book_data = $result_book->fetch_object();
        $boid = $book_data->boid;
    }
}

// 강좌 데이터 저장
$query_lecture = "
    INSERT INTO lecture (leid, boid, lecid, cate1, cate2, cate3, image, title, price, period, name, isrecipe)
    VALUES (NULL, '$boid', '$uid', '$cate1', '$cate2', '$cate3', '$image_path', '$title', '$price', '$period', '$uid', '$is_recipe')
";

if ($mysqli->query($query_lecture)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => '강좌 정보를 저장하는 데 실패했습니다.']);
}

$mysqli->close();
