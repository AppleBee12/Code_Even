<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');


//print_r($_POST);
//Array ( [uid] => 3 [board_type] => C [post_id] => 11 [commid] => 6 [edit-contents] => 댓글에 적힌 내용 )


$uid = $_POST['uid'];
$board_type = $_POST['board_type'];
$post_id = $_POST['post_id'];
$commid = $_POST['commid'];
$contents = ($_POST['edit-contents']);

$sql = "UPDATE post_comment
        SET contents = ?
        WHERE commid = ? AND uid = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sii", $contents, $commid, $uid);
$result = $stmt->execute();
//echo $sql;

if ($result) {
  echo
  "<script>
        if (confirm('댓글을 수정하시겠습니까?')){
        
          alert('수정이 완료되었습니다.');
          location.href='" . ($board_type === 'C' ? 'counsel.php' : ($board_type === 'B' ? 'blog.php' : 'teamproject.php')) . "';
        
      }else{
        alert('댓글 수정이 취소되었습니다.');
        history.back();
      } 
    </script>";
} else {
  echo
  "<script>
      alert('댓글 수정이 실패했습니다! 다시 시도해주세요!');
      history.back();
    </script>";
}

$stmt->close();


?>
