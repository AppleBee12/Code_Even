<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

// print_r($_POST);
$ntid = $_POST['ntid'];
$username = $_POST['username'];
$userid = $_POST['userid'];
$title = $_POST['title'];
$content = $_POST['content'];
$fix = $_POST['fix'];

$notice_sql = "
    UPDATE notice 
    SET 
        title = '$title',
        content = '$content',
        fix = '$fix'
    WHERE uid = (
        SELECT uid 
        FROM user 
        WHERE username = '$username' AND userid = '$userid'
    )
    AND ntid = '$ntid'
";

$user_result = $mysqli->query($notice_sql);

if ($user_result === true) {
  echo
    "<script>
    confirm('글을 수정하시겠습니까?');
    alert('수정이 완료되었습니다.');
    location.href='notice.php';
  </script>";
} else {
  echo
    "<script>
    alert('글쓰기 실패');
    history.back();
  </script>";
}

?>