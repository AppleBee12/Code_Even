<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');


//print_r($_POST);
//Array ( [uid] => 1 [board_type] => C [post_id] => 12 [contents] => 댓글 )

$uid = $_POST['uid'];
$board_type = $_POST['board_type'];
$post_id = $_POST['post_id'];
$contents = nl2br($_POST['contents']);


$sql = "INSERT INTO post_comment (uid, board_type, post_id, contents) 
        VALUES ('$uid', '$board_type', '$post_id', '$contents')";

$result = $mysqli->query($sql);
//echo $sql;



if ($result) {
  echo
  "<script>
        if (confirm('댓글을 등록하시겠습니까?')){
        alert('등록이 완료되었습니다.');
        location.href='counsel.php';
      }else{
        alert('취소되었습니다.');
        history.back();
      } 
    </script>";
} else {
  echo
  "<script>
      alert('댓글 등록이 실패했습니다! 다시 시도해주세요!');
      history.back();
    </script>";
}

$result->close();


?>