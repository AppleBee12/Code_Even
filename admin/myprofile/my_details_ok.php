

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// print_r($_POST);
 $uid = $_POST['uid'];
 $username = $_POST['username'];
 $userphonenum = $_POST['userphonenum'];
 $useremail = $_POST['useremail'];


 $profile_sql = "
 UPDATE user
 SET 
     username = '$username',
     userphonenum = '$userphonenum',
     useremail = '$useremail'
 WHERE uid = '$uid'
";

$result = $mysqli->query($profile_sql);

if ($result === true) {
  echo
  "<script>
      if (confirm('프로필을 수정하시겠습니까?')) {
          alert('수정이 완료되었습니다.');
          location.href='/code_even/admin/index.php';
      } else {
          history.back();
      }
   </script>";
} else {
  echo
    "<script>
       alert('수정 실패');
       history.back();
     </script>";
}

?>