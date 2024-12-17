<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

$leid = $_POST['leid'];
$boid = $_POST['boid'];
$price = $_POST['price'];
$cnt = $_POST['cnt'];

if(isset($_SESSION['UID'])){
  $uid = $_SESSION['UID'];
  $ssid = '';
} else{
  $uid = '';
  $ssid = session_id();
}


    $sql = "INSERT INTO cart 
    (leid, uid, ssid, lec_price) VALUES 
    ($leid, '$uid', '$ssid', $lec_price)";

    $result = $mysqli->query($sql);

    if($result){
      $data = array('result'=>'ok');
    } else{
      $data = array('result'=>'fail');
    }








echo json_encode($data); 

?>