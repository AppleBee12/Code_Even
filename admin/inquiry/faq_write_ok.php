<?php
// ** 세션 시작 함수 **
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/page_summernote_insert.php');

$category = $_POST['category'];
$username = $_POST['username'];
$userid = $_POST['userid'];
$title = $_POST['title'];
$content = $_POST['content'];
$status = $_POST['status'];
$target = $_POST['target'];
$table_name = $_POST['table_name'];

// ** 세션에서 이미지 URL 가져오기 **
$imageUrl = isset($_SESSION['imageUrl']) ? $_SESSION['imageUrl'] : [];

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

// ** 최근 실행된 INSERT 쿼리의 자동증가 ID값 가져오기 (summer_images에 넣기위함) **
$create_id = $mysqli->insert_id;

// ** 이미지 삽입 처리 함수 호출 **
$image_result = insertSummerImages($mysqli, $table_name, $create_id, $imageUrl);

// if ($imageUrl) {
//   // ** 여러 개의 이미지가 있는 경우 처리 **
//   foreach ($imageUrl as $image) {
//       // ** summer_images 테이블에 삽입 **
//       $image_sql = "INSERT INTO summer_images (table_name, table_id, file_name) VALUES ('$table_name', '$faq_id', '$image')";
//       $image_result = $mysqli->query($image_sql);
//   }
// } else {
//   // ** 이미지가 없으면 삽입하지 않음 **
//   $image_result = true;
// }

if ($faq_result === true && $image_result === true) {

  unset($_SESSION['imageUrl']);

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