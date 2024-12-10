<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$tcid = $_POST['tcid'];
$isnew = $_POST['isnew'] ?? [];
$isrecom = $_POST['isrecom'] ?? [];
$tc_ok = $_POST['tc_ok'] ?? [];

// print_r($isnew);
// print_r($isrecom);
// print_r($tc_ok);

// exit;

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

  // tc_ok 값에 따라 user 테이블의 user_level 업데이트
  if ($tc_ok[$tc] == 1 || $tc_ok[$tc] == -1) {
    // 해당 tcid와 연결된 uid를 가져오는 쿼리
    $uid_sql = "SELECT uid FROM teachers WHERE tcid = $tc";
    $uid_result = $mysqli->query($uid_sql);
    if ($uid_result && $uid_result->num_rows > 0) {
        $uid_data = $uid_result->fetch_assoc();
        $uid = $uid_data['uid'];

        // tc_ok 값에 따라 user_level 업데이트
        $new_user_level = ($tc_ok[$tc] == 1) ? 10 : 1; // tc_ok == 1일 때 10, tc_ok == -1일 때 1
        $user_update_sql = "UPDATE user SET user_level = $new_user_level WHERE uid = $uid";
        $mysqli->query($user_update_sql);
    }
  }
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

