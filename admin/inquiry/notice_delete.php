<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

  // JavaScript를 사용해 확인창을 표시
  if (!isset($_GET['delete']) || $_GET['delete'] !== 'true') {
    echo "
    <script>
        if (confirm('글을 삭제하시겠습니까?')) {
            location.href = 'notice.php?ntid=" . $_GET['ntid'] . "&delete=true';
        } else {
            alert('삭제가 취소되었습니다.');
            location.href = 'notice.php';
        }
    </script>";
    exit; // 아래 PHP 코드 실행 방지
  }

  $ntid = $_GET['ntid'];
  $sql = "DELETE FROM notice WHERE ntid = $ntid";
  $result = $mysqli->query($sql);

  if($result){
    echo 
    "<script>
      alert('삭제가 완료되었습니다.');
      location.href='notice.php';
    </script>";
  }else{
    echo
    "<script>
      alert('글 삭제 실패');
      history.back();
    </script>";
  }
?>