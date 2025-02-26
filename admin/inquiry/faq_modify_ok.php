<?php
// ** 세션 시작 함수 **
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/page_summernote_edit.php');

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

// 이미지 추가 함수 호출
$image_result = addImagesIfNotExists($fqid, $table_name, $imageUrl, $mysqli);

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