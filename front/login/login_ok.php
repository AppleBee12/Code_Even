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
  $_SESSION['AUID'] = $data->userid;
  $_SESSION['AUNAME'] = $data->username;
  $_SESSION['AULEVEL'] = $data->user_level;
  $_SESSION['UID'] = $data->uid;

  // 마지막 로그인 시간 업데이트
  $update_sql = "UPDATE user SET last_date = now() WHERE uid = $data->uid";
  $update_result = $mysqli->query($update_sql);

  // 세션 아이디를 기반으로 cart 테이블 데이터 업데이트
  $session_id = session_id();
  $cart_update_sql = 
  "UPDATE cart 
      SET uid = {$data->uid}, userid = '{$data->userid}' 
      WHERE ssid = '$session_id'
  ";
  $mysqli->query($cart_update_sql);

  

  if ($_SESSION['AULEVEL'] == 100) {
    echo "<script>
      alert('관리자님, 반갑습니다.');
      location.href=\"http://". $_SERVER['HTTP_HOST'] ."/code_even/\";
    </script>";
} elseif ($_SESSION['AULEVEL'] == 10) {
    echo "<script>
      alert('선생님, 반갑습니다.');
      location.href=\"http://". $_SERVER['HTTP_HOST'] ."/code_even/\";
    </script>";
} else {
    echo "<script>
      alert('회원님, 반갑습니다!');
      location.href=\"http://". $_SERVER['HTTP_HOST'] ."/code_even/\";
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



