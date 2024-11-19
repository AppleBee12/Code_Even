<?php
session_start(); // 세션 시작
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 현재 로그인된 사용자 ID 확인
if (!isset($_SESSION['AUID'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='/login.php';</script>";
    exit;
}
$session_userid = $_SESSION['AUID']; // 세션에서 사용자 ID 가져오기

// 사용자 정보 가져오기
$sql_user = "SELECT uid, username FROM user WHERE userid = ?";
$stmt_user = $mysqli->prepare($sql_user);
$stmt_user->bind_param("s", $session_userid);
$stmt_user->execute();
$stmt_user->bind_result($uid, $username);
$stmt_user->fetch();
$stmt_user->close();

// 버튼 동작 구분 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null; // 버튼의 action 값 확인

    if ($action === 'final_save') {
        // 최종 등록 로직만 처리
        // 강좌 관련 데이터 수집
        $cate1 = $_POST['cate1'];
        $cate2 = $_POST['cate2'];
        $cate3 = $_POST['cate3'];
        $title = $_POST['title'];
        $des = $_POST['description'];
        $period = $_POST['period'];
        $price = $_POST['price'];
        $isrecipe = $_POST['isrecipe'];
        $isgeneral = $_POST['isgeneral'];

        // 썸네일 이미지 업로드 처리
        $imagePath = 'uploads/images/default.png'; // 기본값
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/images/';
            $imagePath = $uploadDir . basename($image['name']);

            if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                $imagePath = '/uploads/images/' . basename($image['name']); // 상대 경로 저장
            } else {
                echo "<script>alert('이미지 업로드에 실패했습니다. 기본 이미지가 사용됩니다.');</script>";
            }
        }

        // 강좌 데이터 lecture 테이블에 저장
        $sql_lecture = "
            INSERT INTO lecture 
            (cate1, cate2, cate3, title, des, name, image, period, price, isrecipe, isgeneral, lecid, date, state, approval)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 1, '대기')
        ";
        $stmt_lecture = $mysqli->prepare($sql_lecture);
        $stmt_lecture->bind_param(
            "sssssssiiisi", 
            $cate1, $cate2, $cate3, $title, $des, $username, $imagePath, $period, $price, $isrecipe, $isgeneral, $uid
        );

        if ($stmt_lecture->execute()) {
            $lecture_id = $stmt_lecture->insert_id; // 새로 생성된 강좌 ID

            // 강의 데이터 저장 (lecture_detail 테이블)
            if (isset($_POST['lecture_detail'])) {
                foreach ($_POST['lecture_detail'] as $detail) {
                    $lectureTitle = $detail['title'];          // 강의명
                    $lectureDesc = $detail['description'];    // 강의 설명
                    $quizId = !empty($detail['quiz_id']) ? $detail['quiz_id'] : null; // 퀴즈 ID
                    $testId = !empty($detail['test_id']) ? $detail['test_id'] : null; // 시험 ID

                    $sql_detail = "
                        INSERT INTO lecture_detail 
                        (lecture_id, title, description, quiz_id, test_id, created_at) 
                        VALUES (?, ?, ?, ?, ?, NOW())
                    ";
                    $stmt_detail = $mysqli->prepare($sql_detail);
                    $stmt_detail->bind_param("issssi", $lecture_id, $lectureTitle, $lectureDesc, $quizId, $testId);
                    $stmt_detail->execute();
                }
            }

            echo "<script>alert('강좌가 최종 저장되었습니다.');</script>";
            echo "<script>location.href='lecture_list.php';</script>";
        } else {
            echo "<script>alert('강좌 저장에 실패했습니다.');</script>";
            echo "<script>history.back();</script>";
        }
    } else {
        echo "<script>alert('잘못된 요청입니다.');</script>";
        echo "<script>history.back();</script>";
    }
}
?>
