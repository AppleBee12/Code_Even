<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

$leid = $_POST['leid'];
$boid = $_POST['boid'] ?? '';
$total_price = $_POST['price'];

if(isset($_SESSION['UID'])){
  $uid = $_SESSION['UID'];
  $ssid = '';
} else{
  $uid = '';
  $ssid = session_id();
}


    $sql = "INSERT INTO cart 
    (leid, boid, uid, ssid, total_price) VALUES 
    ($leid, $boid, $uid, '$ssid', $total_price)";

    $result = $mysqli->query($sql);

    if($result){
      $data = array('result'=>'ok');
    } else{
      $data = array('result'=>'fail');
    }



echo json_encode($data); 

?>