<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/code_even/admin/inc/dbcon.php');

if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='../login/login.php';
  </script>";
}
$cgid = $_GET['cgid'];
if (!isset($cgid)) {
  echo "<script>alert('카테고리 정보가 없습니다.'); 
  // location.href = 'category.php';</script>";
}


$category_sql = "SELECT cgid FROM category WHERE cgid = $cgid";
$category_result = $mysqli->query($category_sql);
$category_data = $category_result->fetch_object();
// $coupon_image_url = $coupon_data->coupon_image;

// unlink($_SERVER['DOCUMENT_ROOT'].$coupon_image_url);

$category_del_sql = "DELETE FROM category WHERE cgid = $cgid";
$category_del_result = $mysqli->query($category_del_sql);

//삭제 완료후 쿠폰 목록으로 이동
if($category_del_result){
  echo "<script>
    alert('카테고리 삭제 완료');
    location.href = 'category.php';
  </script>";
}

?>