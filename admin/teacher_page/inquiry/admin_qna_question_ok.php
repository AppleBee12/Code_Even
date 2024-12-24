<?php
$title = "수강생 질문";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// print_r($_POST);
$username = $_POST['username'];
$userid = $_POST['userid'];
$user_level = $_POST['user_level'];
$category = $_POST['category'];
$qtitle = $_POST['qtitle'];
$qcontent = $_POST['qcontent'];

$question_sql = "
    INSERT INTO admin_question (uid, qtitle, qcontent, category)
    SELECT uid, '$qtitle', '$qcontent', '$category' 
    FROM user
    WHERE username = '$username' AND userid = '$userid' AND user_level = '$user_level'
";

$question_result = $mysqli->query($question_sql);

if ($question_result === true) {
    echo
        "<script>
    confirm('글을 등록하시겠습니까?');
    alert('등록이 완료되었습니다.');
    location.href='../../inquiry/admin_qna.php';
  </script>";
} else {
    echo
        "<script>
    alert('글쓰기 실패');
    history.back();
  </script>";
}

?>