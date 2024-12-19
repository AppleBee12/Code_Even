<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

$leid = (int)$_POST['leid'];
$boid = isset($_POST['boid']) && $_POST['boid'] !== '' ? (int)$_POST['boid'] : 'NULL';
$total_price = (float)$_POST['price'];

if (isset($_SESSION['UID'])) {
    $uid = (int)$_SESSION['UID']; // 문자열로 저장된 UID를 정수로 변환
    $userid = $_SESSION['AUID'];
    $ssid = 'NULL';
} else {
    $uid = 'NULL';
    $ssid = "'" . session_id() . "'";
}

// 중복 확인 쿼리
$check_sql = "
    SELECT 1 
    FROM cart 
    WHERE leid = $leid 
    AND (uid = $uid OR ssid = $ssid)
    LIMIT 1
";
$check_result = $mysqli->query($check_sql);

if ($check_result && $check_result->num_rows > 0) {
    // 중복된 경우 처리
    $data = array('result' => '중복입니다.');
} else {
    // 중복이 아닌 경우 INSERT 실행
    $insert_sql = "
        INSERT INTO cart (leid, boid, uid, userid, ssid, total_price)
        VALUES ($leid, $boid, $uid, '$userid', '$ssid', $total_price)
    ";
    $insert_result = $mysqli->query($insert_sql);

    if ($insert_result) {
        $data = array('result' => 'ok');
    } else {
        $data = array('result' => 'fail', 'error' => $mysqli->error);
    }
}

echo json_encode($data);
?>
