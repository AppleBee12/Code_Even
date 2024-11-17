<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$tcid = $_GET['tcid'];
$isnew = $_GET['isnew'] ?? [];
$isrecom = $_GET['isrecom'] ?? [];
$tc_ok = $_GET['tc_ok'] ?? [];

foreach($tcid as $tc){
  $isnew[$tc] =  $isnew[$tc] ?? 0;
  $isrecom[$tc] =  $isrecom[$tc] ?? 0;
  $tc_ok[$tc] =  $tc_ok[$tc] ?? 0;

  $sql = "UPDATE teachers SET 
    isnew = $isnew[$tc], 
    isrecom = $isrecom[$tc], 
    tc_ok = $tc_ok[$tc] 
  WHERE tcid = $tc";

  $result = $mysqli->query($sql);  
}

if($result){
  echo "<script>
    alert('일괄 수정 되었습니다.');
    location.href='teacher_list.php';
  </script>";
} else{
  echo "<script>
    alert('일괄 수정 실패');
    history.back();
  </script>";
}

