<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

$result_data = array('result' => 'error'); // 기본값 설정

if (isset($_POST['userid'])) {
    // 아이디 중복 체크
    $userid = $_POST['userid'];
    $sql = "SELECT COUNT(*) AS cnt FROM user WHERE userid = '$userid'";
    $result = $mysqli->query($sql);
    $data = $result->fetch_assoc();
    if ($data['cnt'] > 0) {
        $result_data = array('result' => 'error'); // 중복된 아이디
    } else {
        $result_data = array('result' => 'ok'); // 사용할 수 있는 아이디
    }
} else if (isset($_POST['usernick'])) {
    // 닉네임 중복 체크
    $usernick = $_POST['usernick'];
    $sql = "SELECT COUNT(*) AS cnt FROM user WHERE usernick = '$usernick'";
    $result = $mysqli->query($sql);
    $data = $result->fetch_assoc();
    if ($data['cnt'] > 0) {
        $result_data = array('result' => 'error'); // 중복된 닉네임
        return false;
    } else {
        $result_data = array('result' => 'ok'); // 사용할 수 있는 닉네임
    }
}

echo json_encode($result_data); // 결과 반환
$mysqli->close();
?>
