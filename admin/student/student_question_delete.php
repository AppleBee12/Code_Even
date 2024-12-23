<?php
$title = "수강생 질문";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

  // JavaScript를 사용해 확인창을 표시
  if (!isset($_GET['delete']) || $_GET['delete'] !== 'true') {
    echo "
    <script>
        if (confirm('글을 삭제하시겠습니까?')) {
            location.href = 'student_question.php?sqid=" . $_GET['sqid'] . "&delete=true';
        } else {
            alert('삭제가 취소되었습니다.');
            location.href = 'student_question.php';
        }
    </script>";
    exit; // 아래 PHP 코드 실행 방지
  }

  $sqid = $_GET['sqid'];
  $sql = "DELETE FROM student_qna WHERE sqid = $sqid";
  $result = $mysqli->query($sql);

  if ($result) {
    echo "
    <script>
        alert('삭제가 완료되었습니다.');
        location.href = 'student_question.php';
    </script>";
  } else {
      echo "
      <script>
          alert('글 삭제 실패');
          history.back();
      </script>";
  }
?>