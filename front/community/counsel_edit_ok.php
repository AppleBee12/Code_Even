<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');


//print_r($_POST);
//Array ( [uid] => 3 [contents] =>test [post_id] => 18 [titles] => test [status] => 0 [files] => )
$uid = $_POST['uid'];
$post_id = $_POST['post_id'];
$status = $_POST['status'];
$titles = $_POST['titles'];
$likes = $_POST['likes'];
$comments = $_POST['comments'];
$hits = $_POST['hits'];


$contents = $_POST['contents'];


$sql = "UPDATE counsel SET
        status='$status', titles='$titles', contents='$contents', likes='$likes', comments='$comments', hits='$hits' 
        WHERE uid='$uid' AND post_id='$post_id'";


$result = $mysqli->query($sql);
//echo $sql;



if ($result) {
  echo
  "<script>
        if (confirm('글을 수정하시겠습니까?')){
        alert('수정이 완료되었습니다.');
        location.href='counsel.php';
      }else{
        alert('취소되었습니다.');
        history.back();
      } 
    </script>";
} else {
  echo
  "<script>
      alert('수정이 실패했습니다! 다시 시도해주세요!');
      history.back();
    </script>";
}

$result->close();
