<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

// print_r($_POST);
$username = $_POST['username'];
$userid = $_POST['userid'];
$title = $_POST['title'];
$content = $_POST['content'];
$status = $_POST['status'];

$notice_sql = "
    INSERT INTO notice (uid, title, content, status)
    SELECT uid, '$title', '$content', '$status'  
    FROM user
    WHERE username = '$username' AND userid = '$userid'
";

$user_result = $mysqli->query($notice_sql);

// if ($user_result === true) {
//   echo
//     "<script>
//     confirm('글을 등록하시겠습니까?');
//     alert('등록이 완료되었습니다.');
//     location.href='notice.php';
//   </script>";
// } else {
//   echo
//     "<script>
//     alert('글쓰기 실패');
//     history.back();
//   </script>";
// }

?>