<?php
date_default_timezone_set('Asia/Seoul');
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
    $attendance_count = 0;

    // 오늘 출석 여부 확인
    $attendance_sql = "SELECT COUNT(*) FROM attendance_data WHERE uid = ? AND check_date = ?";
    $stmt = $mysqli->prepare($attendance_sql);
    $stmt->bind_param("is", $uid, $today);
    $stmt->execute();
    $stmt->bind_result($attendance_count);
    $stmt->fetch();
    $stmt->close();

    // 출석 기록 처리
    if ($attendance_count == 0) {
        // 오늘 출석 기록이 없으면 새로 INSERT
        $insert_sql = "INSERT INTO attendance_data (uid, check_date, created_at) 
                       VALUES (?, ?, NOW())";
        $stmt = $mysqli->prepare($insert_sql);
        $stmt->bind_param("is", $uid, $today);
        $stmt->execute();
        $stmt->close();
    } else {
        // 오늘 출석 기록이 이미 있으면 아무 작업도 하지 않음
    }
}

?>

