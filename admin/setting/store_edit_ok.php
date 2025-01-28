

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

//print_r($_POST);
 $comid = $_POST['comid'];
 $company = $_POST['company'];
 $ceo_name = $_POST['ceoname'];
 $post_code = $_POST['postcode'];
 $address_one = $_POST['addressOne'];
 $address_two = $_POST['addressTwo'];
 $address_three = $_POST['extraAddress'];
 $bussiness_registration_num = $_POST['bs_reg'];
 $commerce_registration_num = $_POST['com_reg'];
 $cs_number = $_POST['cs_number'];
 $email = $_POST['email'];
 $tax_manager_department = $_POST['tax_dept'];
 $tax_manager_name = $_POST['tax_name'];
 $tax_bill_email = $_POST['tax_email'];
 $tax_manager_phone = $_POST['tax_contact'];
 $privacy_manager_department = $_POST['prv_dept'];
 $privacy_manager_name = $_POST['prv_name'];
 $privacy_manager_email = $_POST['prv_email'];
 $privacy_manager_phone = $_POST['prv_contact'];

//Array ( [comid] => 1 [company] => 주식회사 디제이컴퍼니 [bs_reg] => 192-01-23456 [ceoname] => 김동주 [com_reg] => 2025-서울종로-1234 [postcode] => 12345 [cs_number] => 1544-1234 [addressOne] => 03192 서울 종로구 수표로 96 드림팰리스 [email] => djcompany@djcompany.com [extraAddress] => (관수동, 국일관드림펠리스) [addressTwo] => 드림팰리스2층 종로캠퍼스 [tax_dept] => 회계과 [tax_email] => gildong1234@djcompany.com [tax_name] => 홍길동 주임 [tax_contact] => 010-1234-6589 [prv_dept] => 총무과 [prv_email] => djcompany@djcompany.com [prv_name] => 이도령 대리 [prv_contact] => 010-4567-8900 )

 $profile_sql = "
 UPDATE company_info
 SET 
     company = '$company',
     ceo_name = '$ceo_name',
     post_code = '$post_code',
     address_one = '$address_one',
     address_two = '$address_two',
     address_three = '$address_three',
     bussiness_registration_num = '$bussiness_registration_num',
     commerce_registration_num = '$commerce_registration_num',
     cs_number = '$cs_number',
     email = '$email',
     tax_manager_department = '$tax_manager_department',
     tax_manager_name = '$tax_manager_name',
     tax_bill_email = '$tax_bill_email',
     tax_manager_phone = '$tax_manager_phone',
     privacy_manager_department = '$privacy_manager_department',
     privacy_manager_name = '$privacy_manager_name',
     privacy_manager_email = '$privacy_manager_email',
     privacy_manager_phone = '$privacy_manager_phone'
 WHERE comid = '$comid'
";

$result = $mysqli->query($profile_sql);

if ($result === true) {
  echo
  "<script>
      if (confirm('상점정보를 수정하시겠습니까?')) {
          alert('수정이 완료되었습니다.');
          location.href='/code_even/admin/index.php';
      } else {
          history.back();
      }
   </script>";
} else {
  echo
    "<script>
       alert('수정이 실패했습니다.');
       history.back();
     </script>";
}

?>