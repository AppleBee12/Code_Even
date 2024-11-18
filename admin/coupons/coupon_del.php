<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/code_even/admin/inc/dbcon.php');

if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='../login/login.php';
  </script>";
}
$cpid = $_GET['cpid'];
if (!isset($cpid)) {
  echo "<script>alert('쿠폰정보가 없습니다.'); 
  location.href = 'coupons.php';</script>";
}


$coupon_image_sql = "SELECT coupon_image FROM coupons WHERE cpid = $cpid";
$coupon_result = $mysqli->query($coupon_image_sql);
$coupon_data = $coupon_result->fetch_object();
$coupon_image_url = $coupon_data->coupon_image;

unlink($_SERVER['DOCUMENT_ROOT'].$coupon_image_url);

$coupon_del_sql = "DELETE FROM coupons WHERE cpid = $cpid";
$coupon_del_result = $mysqli->query($coupon_del_sql);

//삭제 완료후 쿠폰 목록으로 이동
if($coupon_del_result){
  echo "<script>
    alert('쿠폰삭제 완료');
    location.href = 'coupons.php';
  </script>";
}

?>