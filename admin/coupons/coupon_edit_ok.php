<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/img_upload_func.php');

if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='../login/login.php';
  </script>";
}

$cpid = $_POST['cpid'];
if (!isset($cpid)) {
  echo "<script>alert('쿠폰정보가 없습니다.'); 
  location.href = 'coupons.php';</script>";
}

  $cpid = $_POST['cpid'];
  $coupon_name = $_POST['coupon_name'] ?? '';
  $coupon_image = $_FILES['coupon_image'] ??'';
  $coupon_type = $_POST['coupon_type'] ?? '';
  $coupon_price = $_POST['coupon_price'] ?? '0';
  $coupon_ratio = $_POST['coupon_ratio'] ?? '0';
  $status = $_POST['status'] ?? '';
  $max_value = $_POST['max_value'] ?? '0';
  $use_min_price = $_POST['use_min_price'] ?? '0';
  $use_max_date = $_POST['use_max_date'] ?? 'NULL';
  $cp_desc = $_POST['cp_desc'] ?? '';

  $callingFileDir = basename(dirname(__FILE__));
  
  $sql = "SELECT coupon_image FROM coupons WHERE cpid = $cpid";
  $result = $mysqli->query($sql);
  $existingThumbnail = '';
  if ($result && $row = $result->fetch_assoc()) {
      $existingThumbnail = $row['coupon_image'];
  }

  $CpImagePath = ''; // 초기화 추가 (썸네일 변경 안 하는 경우)

  if (isset($_FILES['coupon_image']) && $_FILES['coupon_image']['error'] == UPLOAD_ERR_OK) {
    // 기존 파일이 있으면 삭제
    if (!empty($existingThumbnail)) {
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . $existingThumbnail;
        deleteFile($fullPath); // 파일 삭제 함수 호출
    }

    // 새로운 파일 업로드
    $uploadResult = fileUpload($_FILES['coupon_image'], $callingFileDir);
    if ($uploadResult) {
        $CpImagePath = $uploadResult; // 성공적으로 업로드된 경로
    } else {
        echo "<script>
            alert('파일 첨부할 수 없습니다.');
            history.back();
        </script>";
        exit;
    }
  }

$sql = "UPDATE coupons SET 
  coupon_name = '$coupon_name',
  -- coupon_image = '$coupon_image',
  coupon_type = '$coupon_type',
  coupon_price = $coupon_price,
  coupon_ratio = $coupon_ratio,
  status = $status,
  max_value = $max_value,
  use_min_price = $use_min_price,
  use_max_date = '$use_max_date',
  cp_desc = '$cp_desc'
  ";

if ($CpImagePath) {
  $sql .= ", coupon_image = '$CpImagePath'";
}
$sql .= " WHERE cpid = $cpid";
// print_r($sql);
$result = $mysqli->query($sql); 

 //입력성공하면 쿠폰등록 완료 경고창 띄우고 쿠폰목록 페이지로 이동
 if($result){
   echo "
     <script>
       alert('쿠폰수정 완료');
       location.href = 'coupons.php';
     </script>
   ";
   $mysqli->commit();//디비에 커밋한다.
  }

if(isset($_FILES['coupon_image'])){
  if($coupon_image['size'] > 10240000 ){
    echo "
     <script>
       alert('10MB이하만 첨부할 수 있습니다.');
       history.back();
     </script>
    ";
   }
   
   //파일 포멧 검사
   if(strpos($coupon_image['type'], 'image') === false){
     echo "
     <script>
       alert('이미지만 첨부할 수 있습니다.');
       history.back();
     </script>
    ";
   }
  }

$mysqli->close();

?>