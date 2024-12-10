<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

// print_r($_POST);
$category = $_POST['category'];
$username = $_POST['username'];
$userid = $_POST['userid'];
$title = $_POST['title'];
$content = $_POST['content'];
$status = $_POST['status'];
$target = $_POST['target'];
$table_name = $_POST['table_name'];

// 세션에서 이미지 URL 가져오기
$imageUrl = isset($_SESSION['imageUrl']) ? $_SESSION['imageUrl'] : null;

// 이미지 URL 값 확인하기
// echo "<pre>";
// var_dump($imageUrl); // imageUrl 값을 출력
// echo "</pre>";

$faq_sql = "
    INSERT INTO faq (uid, title, content, status, category, target)
    SELECT uid, '$title', '$content', '$status', '$category', '$target'
    FROM user
    WHERE username = '$username' AND userid = '$userid'
";
$faq_result = $mysqli->query($faq_sql);
$faq_id = $mysqli->insert_id;

$image_sql = "INSERT INTO summer_images (table_name, table_id, file_name) VALUES ('$table_name', '$faq_id', '$imageUrl')";
$image_result = $mysqli->query($image_sql);

if ($faq_result === true && $image_result === true) {
  $redirect_url = ($target === 'teacher') ? 'teacher_faq.php' : (($target === 'student') ? 'student_faq.php' : 'faq.php');
  echo
    "<script>
    confirm('글을 등록하시겠습니까?');
    alert('등록이 완료되었습니다.');
    location.href = '$redirect_url';
  </script>";
} else {
  echo
    "<script>
    alert('글쓰기 실패');
    history.back();
  </script>";
}

?>