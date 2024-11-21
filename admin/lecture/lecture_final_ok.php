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
    $leid = $_POST['leid'] ?? null; // 강좌 ID

    if ($action === 'final_save') {
        // 공통 데이터 수집
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

        if ($leid) {
            // 수정 로직: 강좌와 강의 업데이트
            $sql_lecture = "
                UPDATE lecture 
                SET cate1 = ?, cate2 = ?, cate3 = ?, title = ?, des = ?, name = ?, image = ?, period = ?, price = ?, isrecipe = ?, isgeneral = ?
                WHERE leid = ?
            ";
            $stmt_lecture = $mysqli->prepare($sql_lecture);
            $stmt_lecture->bind_param(
                "sssssssiiisi", 
                $cate1, $cate2, $cate3, $title, $des, $username, $imagePath, $period, $price, $isrecipe, $isgeneral, $leid
            );

            if ($stmt_lecture->execute()) {
                // 기존 강의 데이터 삭제 후 재등록
                $sql_delete_details = "DELETE FROM lecture_detail WHERE lecture_id = ?";
                $stmt_delete = $mysqli->prepare($sql_delete_details);
                $stmt_delete->bind_param("i", $leid);
                $stmt_delete->execute();

                // 강의 데이터 저장 (lecture_detail 테이블)
                if (isset($_POST['lecture_detail'])) {
                    $lectureDetails = json_decode($_POST['lecture_detail'], true); // JSON 데이터를 PHP 배열로 변환

                    foreach ($lectureDetails as $index => $detail) {
                        $lectureTitle = $detail['title'];          // 강의명
                        $lectureDesc = $detail['description'];    // 강의 설명
                        $quizId = !empty($detail['quiz_id']) ? $detail['quiz_id'] : null; // 퀴즈 ID
                        $testId = !empty($detail['test_id']) ? $detail['test_id'] : null; // 시험 ID
                        $videoUrl = !empty($detail['video_url']) ? $detail['video_url'] : null; // 동영상 주소

                        // lecture_detail 테이블에 저장
                        $sql_detail = "
                            INSERT INTO lecture_detail 
                            (lecture_id, title, description, quiz_id, test_id, video_url, created_at) 
                            VALUES (?, ?, ?, ?, ?, ?, NOW())
                        ";
                        $stmt_detail = $mysqli->prepare($sql_detail);
                        $stmt_detail->bind_param(
                            "isssss", 
                            $leid, $lectureTitle, $lectureDesc, $quizId, $testId, $videoUrl
                        );
                        $stmt_detail->execute();
                    }
                }
                echo "<script>alert('강좌와 강의가 성공적으로 수정되었습니다.'); location.href='lecture_list.php';</script>";
            } else {
                echo "<script>alert('강좌 수정에 실패했습니다: " . $stmt_lecture->error . "');</script>";
            }
        } else {
            // 등록 로직: 기존 코드 그대로 사용
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
                    $lectureDetails = json_decode($_POST['lecture_detail'], true);

                    foreach ($lectureDetails as $index => $detail) {
                        $lectureTitle = $detail['title'];
                        $lectureDesc = $detail['description'];
                        $quizId = !empty($detail['quiz_id']) ? $detail['quiz_id'] : null;
                        $testId = !empty($detail['test_id']) ? $detail['test_id'] : null;
                        $videoUrl = !empty($detail['video_url']) ? $detail['video_url'] : null;

                        $sql_detail = "
                            INSERT INTO lecture_detail 
                            (lecture_id, title, description, quiz_id, test_id, video_url, created_at) 
                            VALUES (?, ?, ?, ?, ?, ?, NOW())
                        ";
                        $stmt_detail = $mysqli->prepare($sql_detail);
                        $stmt_detail->bind_param(
                            "isssss", 
                            $lecture_id, $lectureTitle, $lectureDesc, $quizId, $testId, $videoUrl
                        );
                        $stmt_detail->execute();
                    }
                }
                echo "<script>alert('강좌와 강의가 성공적으로 저장되었습니다.'); location.href='lecture_list.php';</script>";
            } else {
                echo "<script>alert('강좌 저장에 실패했습니다: " . $stmt_lecture->error . "');</script>";
            }
        }
    }
}
?>
