<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$username = $_POST['username'];
$usernick = $_POST['usernick'];
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$userphonenum = $_POST['userphonenum'];
$useremail = $_POST['useremail'];
$userpw = hash('sha512', $userpw);

$sql = "INSERT INTO members (username, usernick, userid, userphonenum, useremail, userpw) VALUES ('$username', '$usernick', '$userid', '$userphonenum', '$useremail', '$userpw')";
$result = $mysqli->query($sql);

if($result){

  echo "<script>
  alert('회원가입이 완료되었습니다. 가입축하쿠폰이 발행되었습니다!');
  location.href='../../index.php';
  </script>";
}else{
  echo "<script>
  alert('회원가입이 실패되었습니다.');
  history.back();
  </script>";
}

?>