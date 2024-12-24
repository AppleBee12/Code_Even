<?php

error_reporting( E_ALL );
ini_set( "display_errors", 1 );
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

$name = $_POST['name'];
// $pcode = $_POST['pcode']??'';
$code = $_POST['code'];
$step = $_POST['step'];

// pcode가 있을 때 작동
if(isset($_POST['pcode'])){
  $pcode = $_POST['pcode'] ;
}


/*
중복 여부파악하기
*/
$sql = "SELECT cgid FROM category WHERE step='$step' and (name='$name' or code='$code')";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

if ($data && isset($data->cgid)) {
    $return_data = array('result' => -1);
    echo json_encode($return_data);
    exit;
}
$pcode = $pcode ?: 'NULL';
//데이타 안에  cgid가 있으면(중복), 리턴데이타에다가 연관배열형식->키값의 result에 -1을 할당 
//연관배열을 json형식으로 변환
//나가기
// if($data->cgid){
//   $return_data = array('result' => -1);
//   echo json_encode($return_data);
//   exit;
// }
//중복되지 않는다면 테이블에 저장한다. 
$sql = "INSERT INTO category (pcode, code, name, step) VALUES ('$pcode', '$code', '$name', $step)";
$result = $mysqli->query($sql);

if($result){
  $return_data = array('result' => 1);
  echo json_encode($return_data);
}else{
  $return_data = array('result'=>0);//실패
  echo json_encode($return_data); 
}

$mysqli->close();
?>