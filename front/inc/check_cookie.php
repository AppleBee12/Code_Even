<?php
// session_start();
// require ($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// $dataFile = $_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/visit_data.json';
$today = date("Y-m-d");


// 방문자 수 
if (!isset($_COOKIE["visited"])) {
    // 오늘 방문 데이터 추가
    $visitor_sql = "INSERT INTO visitor_data (visit_date, visitors) 
                    VALUES (?, 1) 
                    ON DUPLICATE KEY UPDATE visitors = visitors + 1";
    $todayVisitorData = $mysqli->prepare($visitor_sql);
    $todayVisitorData->bind_param("s", $today);
    $todayVisitorData->execute();
    $todayVisitorData->close();

    // 쿠키 설정 (1일 유지)
    setcookie("visited", "yes", time() + 86400, '/');
}

// 출석 체크 처리 (로그인한 사용자만)
if (isset($_SESSION['UID'])) {
    $uid = $_SESSION['UID'];

    // 이미 출석한 날짜인지 확인 (오늘 출석 기록이 있는지 확인)
    $attendance_sql = "SELECT COUNT(*) FROM attendance_data WHERE uid = ? AND check_date = ?";
    $todayAttDate = $mysqli->prepare($attendance_sql);
    $todayAttDate->bind_param("is", $uid, $today);
    $todayAttDate->execute();
    $todayAttDate->bind_result($attendance_count);
    $todayAttDate->fetch();
    $todayAttDate->close();

    if ($attendance_count == 0) {
        // 출석 기록이 없으면 새로운 출석 기록 INSERT
        $attendance_sql = "INSERT INTO attendance_data (uid, check_date, created_at) 
                           VALUES (?, ?, NOW())";
        $todayAttDate = $mysqli->prepare($attendance_sql);
        $todayAttDate->bind_param("is", $uid, $today);
        $todayAttDate->execute();
        $todayAttDate->close();
    } else {
        // 출석 기록이 있으면 오늘 출석 기록 업데이트
        $attendance_sql = "UPDATE attendance_data SET created_at = NOW() 
                           WHERE uid = ? AND check_date = ?";
        $todayAttDate = $mysqli->prepare($attendance_sql);
        $todayAttDate->bind_param("is", $uid, $today);
        $todayAttDate->execute();
        $todayAttDate->close();
    }

}




?>

