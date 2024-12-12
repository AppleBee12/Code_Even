<?php
// ** 세션 시작 함수 **
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$fqid = $_POST['fqid'];
$username = $_POST['username'];
$userid = $_POST['userid'];
$title = $_POST['title'];
$content = $_POST['content'];
$status = $_POST['status'];
$target = $_POST['target'];
$category = $_POST['category'];
$table_name = $_POST['table_name'];

// 세션에서 이미지 URL 가져오기
$imageUrl = isset($_SESSION['imageUrl']) ? $_SESSION['imageUrl'] : null;

$faq_sql = "
    UPDATE faq 
    SET 
        title = '$title',
        content = '$content',
        status = '$status',
        target = '$target',
        category = '$category'
    WHERE uid = (
        SELECT uid 
        FROM user 
        WHERE username = '$username' AND userid = '$userid'
    )
    AND fqid = '$fqid'
";
$faq_result = $mysqli->query($faq_sql);

if ($imageUrl) {
  // 기존 이미지 가져오기
  $existing_img_sql = "SELECT file_name FROM summer_images WHERE table_id = $fqid AND table_name = '$table_name'";
  $existing_img_result  = $mysqli->query($existing_img_sql);

  $existing_images = [];
  while ($row = $existing_img_result->fetch_assoc()) {
    $existing_images[] = $row['file_name'];
  }

  $image_result = true;

  // 새로운 이미지만 추가하기
  foreach ($imageUrl as $image) {
    // 기존에 동일한 이미지가 없으면 삽입
    if (!in_array($image, $existing_images)) {
      $image_sql = "INSERT INTO summer_images (table_name, table_id, file_name) VALUES ('$table_name', $fqid, '$image')";
      $image_result = $mysqli->query($image_sql);

      if ($image_result) {
        echo "<script>console.log(이미지 '$image'가 추가되었습니다.);</script>";
      } else {
        echo "<script>console.log(이미지 '$image' 추가 실패: );</script>" . $mysqli->error;
      }
    }
  }

}

if ($faq_result && $image_result) {

  unset($_SESSION['imageUrl']);

  $redirect_url = ($target === 'teacher') ? 'teacher_faq.php' : (($target === 'student') ? 'student_faq.php' : 'faq.php');
  echo
    "<script>
    confirm('글을 수정하시겠습니까?');
    alert('수정이 완료되었습니다.');
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