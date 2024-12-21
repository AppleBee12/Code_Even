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

    // 오늘 출석 체크 기록
    $attendance_sql = "INSERT INTO attendance_data (uid, check_date) 
                       VALUES (?, ?) 
                       ON DUPLICATE KEY UPDATE created_at = NOW()";
    $todayAttendanceData = $mysqli->prepare($attendance_sql);
    $todayAttendanceData->bind_param("is", $uid, $today);
    $todayAttendanceData->execute();
    $todayAttendanceData->close();
}




?>

