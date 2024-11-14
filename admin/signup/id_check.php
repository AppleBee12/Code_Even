<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$userid = $_POST['userid'];
$id_sql = "SELECT COUNT(*) AS cnt FROM user WHERE userid = '$userid'";
$id_result = $mysqli->query($id_sql);
$id_data = $id_result->fetch_assoc();
$row_num = $id_data['cnt'];

if($row_num >= 1){
  $return_data = array('result' => 'error');
  echo json_encode($return_data);
}else if($row_num == 0){
  $return_data = array('result' => 'ok');
  echo json_encode($return_data);
}



$mysqli->close();
?>