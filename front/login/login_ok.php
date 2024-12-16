<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
session_start();

$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$password = hash('sha512', $userpw);

$sql = "SELECT * FROM user WHERE userid = '$userid' and userpw = '$password'";
$result = $mysqli->query($sql);
$data = $result->fetch_object();
if($data){
  $update_sql = "UPDATE user SET last_date = now() WHERE uid = $data->uid";
  $update_result = $mysqli->query($update_sql);
  $_SESSION['AUID'] = $data->userid;
  $_SESSION['AUNAME'] = $data->username;
  $_SESSION['AULEVEL'] = $data->user_level;
  $_SESSION['UID'] = $data->uid;

  if ($_SESSION['AULEVEL'] == 100) {
    echo "<script>
      alert('관리자님, 반갑습니다.');
      location.href='../../index.php';
    </script>";
} elseif ($_SESSION['AULEVEL'] == 10) {
    echo "<script>
      alert('선생님, 반갑습니다.');
      location.href='../../index.php';
    </script>";
} else {
    echo "<script>
      alert('회원님, 반갑습니다!');
      location.href='../../index.php';
    </script>";
}
} else {
// 로그인 실패 처리
echo "<script>
  alert('로그인에 실패하셨습니다.');
  history.back();
</script>";
}
?>



