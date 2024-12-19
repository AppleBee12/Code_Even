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

// 어느 분야든 첫 술에 배부를 수는 없다고 생각해요.
// 취업이 목표이시라면 목표로 하는 기업을 정하시거나
// 조금 더 나아가서는 본인에게 맞는 언어를 정해서 공부를 하시고 그 언어에 맞는 회사를 찾아보시는게 좋다고 생각해요
// 하나의 언어라도 깊이 있게 공부해보시고 부가적인 CS 지식을 많이 익히시는 걸 추천드립니다.

// 



?>