<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
session_start();

$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$password = hash('sha512', $userpw);

$sql = "SELECT * FROM user WHERE userid = '$userid' and userpw = '$password'";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

if ($data) {
    $_SESSION['AUID'] = $data->userid;
    $_SESSION['AUNAME'] = $data->username;
    $_SESSION['AULEVEL'] = $data->user_level;
    $_SESSION['UID'] = $data->uid;

    // 마지막 로그인 시간 업데이트
    $update_sql = "UPDATE user SET last_date = now() WHERE uid = $data->uid";
    $mysqli->query($update_sql);

    // 세션 아이디를 기반으로 cart 테이블 데이터 업데이트
    $session_id = session_id();
    $cart_update_sql = 
        "UPDATE cart 
        SET uid = {$data->uid}, userid = '{$data->userid}' 
        WHERE ssid = '$session_id'";
    $mysqli->query($cart_update_sql);

    // 로그인 후 리다이렉트 URL 설정
    $redirect_url = $_SESSION['return_url'] ?? '/code_even/';
    unset($_SESSION['return_url']); // 세션 값 제거

    // 사용자 레벨에 따른 메시지 설정
    $welcome_message = '';
    if ($_SESSION['AULEVEL'] == 100) {
        $welcome_message = '관리자님, 반갑습니다.';
    } elseif ($_SESSION['AULEVEL'] == 10) {
        $welcome_message = '선생님, 반갑습니다.';
    } else {
        $welcome_message = '회원님, 반갑습니다!';
    }

    // 리다이렉트 처리
    echo "<script>
        alert('$welcome_message');
        location.href='$redirect_url';
    </script>";
} else {
    // 로그인 실패 처리
    echo "<script>
        alert('로그인에 실패하셨습니다. 아이디와 비밀번호를 확인해주세요.');
        history.back();
    </script>";
}
?>
