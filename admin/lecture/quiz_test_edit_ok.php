<?php
session_start(); // 세션 시작

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 현재 로그인된 사용자 세션 값 가져오기
$session_userid = $_SESSION['AUID'] ?? null;

// 로그인 확인
if (!$session_userid) {
    echo "<script>alert('로그인 정보가 없습니다. 다시 로그인해 주세요.'); location.href='/code_even/admin/login.php';</script>";
    exit;
}

// 현재 사용자 uid 가져오기
$sql_user = "SELECT uid FROM user WHERE userid = '$session_userid'";
$result_user = $mysqli->query($sql_user);

if ($result_user->num_rows > 0) {
    $row_user = $result_user->fetch_object(); // fetch_object 사용
    $uid = $row_user->uid; // uid 값 저장
} else {
    echo "<script>alert('사용자 정보를 가져오는 데 실패했습니다.');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 필수 데이터 가져오기
    $exid = $_POST['exid'] ?? null; // 수정할 데이터 ID
    $cate1 = $_POST['cate1'] ?? null;
    $cate2 = $_POST['cate2'] ?? null;
    $cate3 = $_POST['cate3'] ?? null;
    $lecture_id = $_POST['lecture_id'] ?? null;
    $tt = $_POST['tt'] ?? null; // 시험지명
    $pn = $_POST['pn'] ?? null; // 단일 문자열로 전달
    $explan = $_POST['explan'] ?? ''; // 해설 (선택)
    $pnlevel = $_POST['pnlevel'] ?? 0; // 문제 수준
    $answer = $_POST['answer'] ?? null; // 정답
    $question_text = $_POST['question'] ?? []; // 문제명 (배열)
    $courseType = $_POST['type'] ?? 'quiz'; // 문제 유형 (quiz 또는 exam)

    // 필수 값 확인
    if (!$exid || !$cate1 || !$cate2 || !$cate3 || !$tt || !$answer || empty($pn) || empty($question_text)) {
        echo "<script>alert('필수 데이터를 모두 입력해주세요.'); history.back();</script>";
        exit;
    }

    if (!is_array($question_text)) {
        echo "<script>alert('문항 데이터가 올바르지 않습니다.'); history.back();</script>";
        exit;
    }

    // 강좌 제목 가져오기
    $sql = "SELECT title FROM lecture WHERE leid = '$lecture_id'";
    $result = $mysqli->query($sql);
    $lecture = $result->fetch_object();

    if (!$lecture) {
        echo "<script>alert('유효하지 않은 강좌입니다.'); history.back();</script>";
        exit;
    }

    $title = $lecture->title; // 강좌명 가져오기
    $question_json = json_encode($question_text, JSON_UNESCAPED_UNICODE); // 문항 데이터를 JSON으로 변환

    // 테이블 결정
    $validTypes = ['quiz', 'test'];
    if (!in_array($courseType, $validTypes)) {
        echo "<script>alert('유효하지 않은 문제 유형입니다.'); history.back();</script>";
        exit;
    }
    $table = ($courseType === 'quiz') ? "quiz" : "test";

    // 데이터 업데이트
    $sql = "
        UPDATE $table 
        SET cate1 = '$cate1',
            cate2 = '$cate2',
            cate3 = '$cate3',
            tid = '$uid',
            title = '$title',
            tt = '$tt',
            explan = '$explan',
            pnlevel = '$pnlevel',
            answer = '$answer',
            pn = '$pn',
            question = '$question_json'
        WHERE exid = '$exid'
    ";

    if ($mysqli->query($sql)) {
        echo "<script>alert('수정이 완료되었습니다.'); location.href='quiz_test_list.php';</script>";
    } else {
        error_log("Database Error: {$mysqli->error}");
        echo "<script>alert('수정 중 오류가 발생했습니다. 관리자에게 문의하세요.'); history.back();</script>";
    }
}
?>
