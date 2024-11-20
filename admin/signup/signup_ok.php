<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$username = $_POST['username'];
$usernick = $_POST['usernick'];
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$userphonenum = $_POST['userphonenum'];
$useremail = $_POST['useremail'];
$userpw = hash('sha512', $userpw);

$sql = "INSERT INTO user (username, usernick, userid, userphonenum, useremail, userpw) VALUES ('$username', '$usernick', '$userid', '$userphonenum', '$useremail', '$userpw')";
$result = $mysqli->query($sql);

if($result){
  $coupon_sql = "SELECT cpid FROM coupons WHERE coupon_name='신규 회원 15% 할인 쿠폰'";
  $coupon_result = $mysqli->query($coupon_sql);
  $coupon_data = $coupon_result->fetch_object();
  $due_date = date('d.m.Y 23:59:59', strtotime("+30days"));

  $uc_sql  = "INSERT INTO user_coupons
  (ucid, userid, status, use_max_date, reason) VALUES 
  ($coupon_data->cpid, '$userid', 1, '$$due_date', '회원가입')";

  $uc_result = $mysqli->query($uc_sql);

  echo "<script>
  alert('회원가입이 완료되었습니다. 가입축하쿠폰이 발행되었습니다!');
  location.href='../login/login.php';
  </script>";
}else{
  echo "<script>
  alert('회원가입이 실패되었습니다.');
  history.back();
  </script>";
}

?>