<?php
$title = "수강생 질문";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

  $sqid = $_GET['sqid'];
  $sql = "DELETE FROM student_qna WHERE sqid = $sqid";
  $result = $mysqli->query($sql);

  if($result){
    echo 
    "<script>
      confirm('글을 삭제하시겠습니까?');
      alert('삭제가 완료되었습니다.');
      location.href='student_question.php';
    </script>";
  }else{
    echo
    "<script>
      alert('글 삭제 실패');
      history.back();
    </script>";
  }
?>