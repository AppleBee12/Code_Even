<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/code_even/admin/inc/dbcon.php');

$uid = $_GET['uid'];
if (!isset($uid)) {
  echo "<script>alert('상품정보가 없습니다.'); location.href = 'front/mypage_info_edit.php';</script>";
}

// $sql = "DELETE FROM user WHERE uid=$uid";
$mypage_del_sql = "DELETE FROM user WHERE uid = $uid";
$mypage_del_result = $mysqli->query($mypage_del_sql);
// $mypage_del_row = $mypage_del_result->fetch_assoc();

if($mypage_del_result){
  echo "<script>
    alert('계정탈퇴가 되었습니다.');
    location.href = \"http://". $_SERVER['HTTP_HOST'] ."/code_even/\";
  </script>";
}
session_start();
session_unset();
session_destroy();

// echo $sql;
?>