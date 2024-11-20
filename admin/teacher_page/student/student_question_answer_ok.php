<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

print_r($_POST);
// $aqid = $_POST['aqid'];
// $acontent = $_POST['acontent'];

// $admin_qna_sql = "
//     INSERT INTO teacher_qna (aqid , acontent)
//     SELECT aqid, '$acontent' 
//     FROM admin_question 
//     WHERE aqid = $aqid
//     ";

// // print_r($admin_qna_sql);

// $admin_qna_result = $mysqli->query($admin_qna_sql);

// if ($admin_qna_result === true) {
//   echo
//     "<script>
//     confirm('글을 등록하시겠습니까?');
//     alert('등록이 완료되었습니다.');
//     location.href = 'admin_qna.php';
//   </script>";
// } else {
//   echo
//     "<script>
//     alert('글쓰기 실패');
//     history.back();
//   </script>";
// }

?>