<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

$post_id = $_GET['post_id'];
$sql = "DELETE FROM blog WHERE post_id = $post_id";
$result = $mysqli->query($sql);

if ($result) {
  echo
    "<script>
        if (confirm('글을 삭제하시겠습니까?')){
        alert('삭제가 완료되었습니다.');
        location.href='counsel.php';
      }else{
        alert('취소되었습니다.');
        history.back();
      } 
    </script>";
} else {
  echo
    "<script>
      alert('글 삭제가 실패했습니다! 다시 시도해주세요!');
      history.back();
    </script>";
}
?>