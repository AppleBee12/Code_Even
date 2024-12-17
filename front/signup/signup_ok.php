<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$username = $_POST['username'];
$usernick = $_POST['usernick'];
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$userphonenum = $_POST['userphonenum'];
$useremail = $_POST['useremail'];
$email_ok = $_POST['email_ok'];
$userpw = hash('sha512', $userpw);

$sql = "INSERT INTO user (username, usernick, userid, userphonenum, useremail, email_ok, userpw) VALUES ('$username', '$usernick', '$userid', '$userphonenum', '$useremail', '$email_ok', '$userpw')";
$result = $mysqli->query($sql);

if($result){
  $coupon_sql = "SELECT cpid FROM coupons WHERE coupon_name='신규 회원 15% 할인 쿠폰'";
  $coupon_result = $mysqli->query($coupon_sql);
  $coupon_data = $coupon_result->fetch_object();
  $due_date = date('Y-m-d 23:59:59', strtotime("+30days"));

  $uc_sql  = "INSERT INTO user_coupons
  (couponid, userid, status, use_max_date, reason) VALUES 
  ($coupon_data->cpid, '$userid', 1, '$due_date', '신규 회원 15% 할인 쿠폰')";

  $uc_result = $mysqli->query($uc_sql);

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

// email_ok 값을 처리
$email_ok = isset($_POST['email_ok']) ? $_POST['email_ok'] : 0;

// 데이터 확인
if ($email_ok == 1) {
    echo "이메일 수신 동의: 1";
} else {
    echo "이메일 수신 동의: 0";
}

?>