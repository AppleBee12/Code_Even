<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');


//print_r($_POST);
//Array ( [uid] => 3 [content] =>testest[titles] => testtest [status] => 0 [files] => )

$uid = $_POST['uid'];
$status = $_POST['status'];
$titles = $_POST['titles'];


$contents = $_POST['contents'];


$sql = "INSERT INTO counsel (uid, status, titles, contents, likes, comments, hits) 
        VALUES ('$uid', '$status', '$titles', '$contents', '0', '0', '0')";

$result = $mysqli->query($sql);
//echo $sql;



if ($result) {
  echo
  "<script>
        if (confirm('글을 등록하시겠습니까?')){
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
      alert('글 등록이 실패했습니다! 다시 시도해주세요!');
      history.back();
    </script>";
}

$result->close();


?>