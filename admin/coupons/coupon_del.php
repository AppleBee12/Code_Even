<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/code_even/admin/inc/dbcon.php');

if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='../login/login.php';
  </script>";
}
$cid = $_GET['cid'];
if (!isset($cid)) {
  echo "<script>alert('쿠폰정보가 없습니다.'); 
  location.href = 'coupons.php';</script>";
}


?>