<?php

session_start(); // 세션 시작

header('Content-Type: application/json; charset=utf-8');

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/img_upload_func.php');

// 세션 사용자 ID 확인
$session_userid = $_SESSION['AUID'] ?? null;

if (!$session_userid) {
    die("로그인이 필요합니다.");
}

// 사용자 정보 가져오기
$sql_user = "SELECT uid, username FROM user WHERE userid = '$session_userid'";
$result_user = $mysqli->query($sql_user);

if ($result_user && $result_user->num_rows > 0) {
    $user_data = $result_user->fetch_object(); // fetch_assoc -> fetch_object
    $uid = $user_data->uid;
    $username = $user_data->username;
} else {
    die("사용자 정보를 가져오는 데 실패했습니다.");
}

// 어떤 액션인지 확인
$action = $_POST['action'] ?? 'save_basic_info';

if ($action === 'save_basic_info') {
    // 강좌 기본 정보 저장
    $title = $_POST['title'] ?? null;
    $cate1 = $_POST['cate1'] ?? null;
    $cate2 = $_POST['cate2'] ?? null;
    $cate3 = $_POST['cate3'] ?? null;
    $price = $_POST['price'] ?? 0;
    $book_id = $_POST['book'] ?? null;
    $period = $_POST['period'] ?? 30;
    $course_type = $_POST['courseType'] ?? 'general';

    // 썸네일 업로드
    $thumbnailPath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $callingFileDir = 'lecture';
        $uploadResult = fileUpload($_FILES['image'], $callingFileDir);
        if ($uploadResult) {
            $thumbnailPath = $uploadResult;
        } else {
            die("썸네일 업로드 실패. 다시 시도해주세요.");
        }
    }

    // 교재 ID 설정
    $boid = null;
    if (!empty($book_id)) {
        $query_book = "SELECT boid FROM book WHERE boid = '$book_id'";
        $result_book = $mysqli->query($query_book);
        if ($result_book && $result_book->num_rows > 0) {
            $book_data = $result_book->fetch_object();
            $boid = $book_data->boid;
        }
    }
    $boid = isset($boid) ? "'$boid'" : "NULL";

    // 강좌 저장 쿼리
    $query_lecture = "
        INSERT INTO lecture (
            boid, lecid, cate1, cate2, cate3, image, title, price, period, name, course_type
        ) VALUES (
            $boid, '$uid', '$cate1', '$cate2', '$cate3', '$thumbnailPath', '$title', '$price', '$period', '$username', '$course_type'
        )
    ";
    $result = $mysqli->query($query_lecture);

    if ($result) {
        $leid = $mysqli->insert_id; // 저장된 강좌 ID
        echo "<script>
            alert('강좌 기본 정보가 저장되었습니다. 세부 정보를 입력하세요.');
            window.location.href = '/CODE_EVEN/admin/lecture_up_ok.php?leid=$leid';
        </script>";
        exit;
    } else {
        die("강좌 등록 실패: " . $mysqli->error);
    }
    } elseif ($action === 'save_detail_info') {
    // 강의 세부 정보 저장
    $leid = $_POST['leid'] ?? null;

    if (!$leid) {
        die("강좌 ID가 필요합니다.");
    }

    $detail_name = $_POST['lecture_name'] ?? [];
    $detail_description = $_POST['lecture_description'] ?? [];
    $detail_quiz_id = $_POST['lecture_quiz_id'] ?? [];
    $detail_test_id = $_POST['lecture_test_id'] ?? [];
    $detail_video_url = $_POST['lecture_video_url'] ?? [];
    $uploaded_files = $_FILES['lecture_file_id'] ?? [];

    $video_order = 1;

    foreach ($detail_name as $i => $name) {
        $description = $detail_description[$i] ?? '';
        $quiz_id = $detail_quiz_id[$i] ?? 'NULL';
        $test_id = $detail_test_id[$i] ?? 'NULL';
        $video_url = $detail_video_url[$i] ?? '';

        // SQL 쿼리 생성
        $query_lecture_detail = "
            INSERT INTO lecture_detail (
                lecture_id, title, description, quiz_id, test_id, video_url, video_order
            ) VALUES (
                $leid, '$name', '$description', $quiz_id, $test_id, '$video_url', $video_order
            )
        ";

        if (!$mysqli->query($query_lecture_detail)) {
            die("강의 데이터 저장 실패: " . $mysqli->error);
        }

        $video_order++;
    }

    echo "<script>
        alert('강좌 세부 정보가 저장되었습니다.');
        window.location.href = '/CODE_EVEN/admin/lecture_list.php';
    </script>";
    exit;
}

$mysqli->close();
