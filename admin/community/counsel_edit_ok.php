<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');


// print_r($_POST);
$post_id = $_POST['post_id'];
$titles =$_POST['titles'];
$status = $_POST['status'];
$contents =$_POST['content'];

$sql = "UPDATE counsel SET 
                      titles = '$titles',
                      status = $status,
                      contents = '$contents'
        WHERE post_id = $post_id";


$result = $mysqli->query($sql);
// echo $sql;

if ($result === TRUE) {
  echo "<script>
            alert('수정이 완료되었습니다.');
            location.href = '/code_even/admin/community/counsel.php';
         </script>";
  exit;
  } else {
  echo "Error: " . $sql . "<br>" . $result->error;
}


$result->close();


?>
