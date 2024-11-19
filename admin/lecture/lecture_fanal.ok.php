<?php
session_start(); // 세션 시작
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 현재 로그인된 사용자 ID 확인
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='/login.php';</script>";
    exit;
}
$session_userid = $_SESSION['user_id']; // 세션에서 사용자 ID 가져오기

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

    if ($action === 'draft_save') {
        // 임시 저장 로직
        echo "<script>alert('임시 저장 로직을 처리합니다.');</script>";
        // 필요한 로직 작성 (예: lecture_up_ok.php로 처리)
        exit; // draft_save 처리가 완료된 후 더 이상 실행되지 않도록 종료
    } elseif ($action === 'final_save') {
        // 최종 등록 로직은 아래에 작성
    } else {
        echo "<script>alert('잘못된 요청입니다.');</script>";
        exit;
    }
}

// 최종 등록 로직
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 강좌 관련 데이터 수집
    $cate1 = $_POST['cate1'];           // 대분류
    $cate2 = $_POST['cate2'];           // 중분류
    $cate3 = $_POST['cate3'];           // 소분류
    $title = $_POST['title'];           // 강좌명
    $des = $_POST['description'];       // 강좌 설명
    $period = $_POST['period'];         // 학습 기간
    $price = $_POST['price'];           // 수강료
    $isrecipe = $_POST['isrecipe'];     // 레시피 여부
    $isgeneral = $_POST['isgeneral'];   // 일반 강좌 여부

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
                $stmt_detail->bind_param("issii", $lecture_id, $lectureTitle, $lectureDesc, $quizId, $testId);

                if ($stmt_detail->execute()) {
                    $lecture_detail_id = $stmt_detail->insert_id;

                    // 실습 파일 업로드 (lefile 테이블)
                    if (isset($_FILES['practice_file']['name'][$detail['index']]) && $_FILES['practice_file']['error'][$detail['index']] === UPLOAD_ERR_OK) {
                        $file = $_FILES['practice_file'];
                        $fileName = basename($file['name'][$detail['index']]);
                        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/' . $fileName;
                        $fileType = $file['type'][$detail['index']];

                        if (move_uploaded_file($file['tmp_name'][$detail['index']], $filePath)) {
                            $sql_file = "
                                INSERT INTO lefile (lecdid, fname, fpath, ftype, uploaded)
                                VALUES (?, ?, ?, ?, NOW())
                            ";
                            $stmt_file = $mysqli->prepare($sql_file);
                            $stmt_file->bind_param("isss", $lecture_detail_id, $fileName, $filePath, $fileType);

                            if (!$stmt_file->execute()) {
                                echo "<script>alert('실습 파일 저장에 실패했습니다: " . $stmt_file->error . "');</script>";
                            }
                        }
                    }

                    // 동영상 데이터 저장 (levideo 테이블)
                    if (isset($detail['videos'])) {
                        foreach ($detail['videos'] as $video) {
                            $videoName = $video['name'];  // 동영상 이름
                            $videoUrl = $video['url'];    // 동영상 URL
                            $videoOrder = $video['order']; // 순서

                            $sql_video = "
                                INSERT INTO levideo (lecpid, lepid, videoname, video_url, orders, uploaded) 
                                VALUES (?, ?, ?, ?, ?, NOW())
                            ";
                            $stmt_video = $mysqli->prepare($sql_video);
                            $stmt_video->bind_param("iissi", $uid, $lecture_detail_id, $videoName, $videoUrl, $videoOrder);

                            if (!$stmt_video->execute()) {
                                echo "<script>alert('동영상 저장에 실패했습니다: " . $stmt_video->error . "');</script>";
                            }
                        }
                    }
                } else {
                    echo "<script>alert('강의 저장에 실패했습니다: " . $stmt_detail->error . "');</script>";
                }
            }
        }

        echo "<script>alert('강좌와 강의가 성공적으로 등록되었습니다.');</script>";
        echo "<script>location.href='lecture_list.php';</script>";
    } else {
        echo "<script>alert('강좌 저장에 실패했습니다: " . $stmt_lecture->error . "');</script>";
    }
}
?>
