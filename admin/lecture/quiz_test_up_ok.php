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
$sql_user = "SELECT uid FROM user WHERE userid = ?";
$stmt_user = $mysqli->prepare($sql_user);
$stmt_user->bind_param("s", $session_userid);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows > 0) {
	$row_user = $result_user->fetch_assoc();
	$uid = $row_user['uid']; // uid 값 저장
} else {
	echo "<script>alert('사용자 정보를 가져오는 데 실패했습니다.');</script>";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// POST 데이터 가져오기
	$cate1 = $_POST['cate1'] ?? null;
	$cate2 = $_POST['cate2'] ?? null;
	$cate3 = $_POST['cate3'] ?? null;
	$lecture_id = $_POST['lecture_id'] ?? null; // 강좌 ID
	$tt = $_POST['tt'] ?? null; // 시험지명
	$courseType = $_POST['courseType'] ?? null; // 문제 유형 (quiz 또는 exam)
	$titles = $_POST['pn'] ?? []; // 문제명 배열
	$answers = $_POST['answer'] ?? []; // 정답 배열
	$questions = $_POST['question'] ?? []; // 문항 배열
	$explans = $_POST['explan'] ?? []; // 해설 배열

	// 필수 데이터 검증
	if (!$cate1 || !$cate2 || !$cate3 || !$lecture_id || !$tt || !$courseType || empty($titles) || empty($answers) || empty($questions)) {
		echo "<script>alert('필수 데이터를 모두 입력해주세요.'); history.back();</script>";
		exit;
	}

	// 강좌 제목 가져오기
	$sql = "SELECT title FROM lecture WHERE leid = ?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s", $lecture_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$lecture = $result->fetch_object();

	if (!$lecture) {
		echo "<script>alert('유효하지 않은 강좌입니다.'); history.back();</script>";
		exit;
	}

	$title = $lecture->title; // 강좌명 가져오기

	// 저장 테이블 선택
	$tableName = ($courseType === 'quiz') ? 'quiz' : 'test';

	// 데이터 저장
	foreach ($titles as $key => $title_item) {
		$explan = $explans[$key] ?? ''; // 해설
		$answer = $answers[$key] ?? ''; // 정답
		$question_set = $questions[$key] ?? []; // 문항 배열
		$question_json = json_encode($question_set, JSON_UNESCAPED_UNICODE); // JSON 변환

		// SQL 실행
		$sql = "INSERT INTO $tableName (cate1, cate2, cate3, tid, title, tt, explan, answer, pn, question) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param(
			"ssssssssss",
			$cate1,        // 대분류
			$cate2,        // 중분류
			$cate3,        // 소분류
			$uid,          // 사용자 ID
			$title,        // 강좌명
			$tt,           // 시험지명
			$explan,       // 해설
			$answer,       // 정답
			$title_item,   // 문제명
			$question_json // 문항 데이터(JSON)
		);

		if (!$stmt->execute()) {
			echo "<script>alert('등록에 실패했습니다: {$stmt->error}'); history.back();</script>";
			exit;
		}
	}

	echo "<script>alert('등록이 완료되었습니다.'); location.href='quiz_test_up.php';</script>";
}
?>