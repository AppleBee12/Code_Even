<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');

if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='../login/login.php';
  </script>";
}
$mysqli->autocommit(FALSE);//커밋이 안되도록 지정, 일단 바로 저장하지 못하도록

try{

  $coupon_name = $_POST['coupon_name'] ?? '';
  $coupon_image = $_FILES['coupon_image'] ??'';
  $coupon_type = $_POST['coupon_type'] ?? '';
  $coupon_price = $_POST['coupon_price'] ?? '0';
  $coupon_ratio = $_POST['coupon_ratio'] ?? '0';
  $status = $_POST['status'] ?? '';
  $use_min_price = $_POST['use_min_price'] ?? '0';
  $max_value = $_POST['max_value'] ?? '0';


  $filePath = $_SERVER['DOCUMENT_ROOT'] . "/code_even/admin/coupons/coupon4.png";
if (file_exists($filePath)) {
    echo "<img src='/code_even/admin/coupons/coupon4.png' alt='쿠폰 이미지'>";
} else {
    echo "이미지를 찾을 수 없습니다.";
}



  $sql = "INSERT INTO coupons 
  (coupon_name, coupon_image, coupon_type, coupon_price, coupon_ratio, status, userid, max_value, use_min_price) 
  VALUES
  ('$coupon_name', '$couponImage', '$coupon_type', $coupon_price, $coupon_ratio, $status, '{$_SESSION['AUID']}', $max_value, $use_min_price)";
 
 $result = $mysqli->query($sql); 

 //입력성공하면 쿠폰등록 완료 경고창 띄우고 쿠폰목록 페이지로 이동
 if($result){
   echo "
     <script>
       alert('쿠폰 등록 완료');
       location.href = 'coupons.php';
     </script>
   ";
   $mysqli->commit();//디비에 커밋한다.
 }
 
}catch (Exception $e) {
    $mysqli->rollback();//저장한 테이블이 있다면 롤백한다.
    //에러문구
    exit;
}

$mysqli->close();

?>