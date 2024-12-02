

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// print_r($_POST);
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