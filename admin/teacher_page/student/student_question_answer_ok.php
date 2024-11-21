<?php
$title = "수강생 질문";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

// print_r($_POST);
$sqid = $_POST['sqid'];
$content = $_POST['content'];

$teacher_qna_sql = "
    INSERT INTO teacher_qna (sqid , content)
    SELECT sqid, '$content' 
    FROM student_qna 
    WHERE sqid = $sqid
    ";

// print_r($teacher_qna_sql);

$teacher_qna_result = $mysqli->query($teacher_qna_sql);

if ($teacher_qna_result === true) {
  echo
    "<script>
    confirm('답변을 등록하시겠습니까?');
    alert('등록이 완료되었습니다.');
    location.href = '../../student/student_question.php';
  </script>";
} else {
  echo
    "<script>
    alert('글쓰기 실패');
    history.back();
  </script>";
}

?>