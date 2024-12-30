<?php

session_start(); // 세션 시작

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/img_upload_func.php');

// 세션 사용자 ID 확인
$session_userid = $_SESSION['AUID'] ?? null;

if (!$session_userid) {
  die("로그인이 필요합니다.");
}

// 사용자 정보 가져오기
$sql_user = "SELECT uid, username FROM user WHERE userid = ?";
$stmt_user = $mysqli->prepare($sql_user);
$stmt_user->bind_param("s", $session_userid);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user && $result_user->num_rows > 0) {
  $user_data = $result_user->fetch_object();
  $uid = $user_data->uid;
  $username = $user_data->username;
} else {
  die("사용자 정보를 가져오는 데 실패했습니다.");
}

// 강좌 ID 가져오기
$leid = $_POST['leid'] ?? null;
if (!$leid) {
  die("강좌 ID가 필요합니다.");
}

// 강좌 기본 정보 업데이트
$title = $_POST['title'] ?? null;
$cate1 = $_POST['cate1'] ?? null;
$cate2 = $_POST['cate2'] ?? null;
$cate3 = $_POST['cate3'] ?? null;
$price = $_POST['price'] ?? 0;
$book_id = $_POST['book'] ?? null;
$period = $_POST['period'] ?? 30;
$course_type = $_POST['course_type'] ?? 'general';
$description = $_POST['description'] ?? ''; // 강좌 설명 추가

// 썸네일 업데이트
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

// 강좌 정보 업데이트 쿼리
$query_update_lecture = "
    UPDATE lecture
    SET
        cate1 = ?,
        cate2 = ?,
        cate3 = ?,
        title = ?,
        des = ?,
        price = ?,
        period = ?,
        course_type = ?,
        image = IF(? != '', ?, image)
    WHERE leid = ?
";

$stmt = $mysqli->prepare($query_update_lecture);
$stmt->bind_param(
  "sssssdisssi",
  $cate1,
  $cate2,
  $cate3,
  $title,
  $description,
  $price,
  $period,
  $course_type,
  $thumbnailPath,
  $thumbnailPath,
  $leid
);

if (!$stmt->execute()) {
  die("강좌 업데이트 실패: " . $stmt->error);
}

// 기존 강의 세부 정보 업데이트
$detail_name = $_POST['lecture_name'] ?? [];
$detail_quiz_id = $_POST['lecture_quiz_id'] ?? [];
$detail_test_id = $_POST['lecture_test_id'] ?? [];
$detail_video_url = $_POST['lecture_video_url'] ?? [];

foreach ($detail_name as $id => $name) {
  $quiz_id = isset($detail_quiz_id[$id]) && !empty($detail_quiz_id[$id]) ? intval($detail_quiz_id[$id]) : null;
  $test_id = isset($detail_test_id[$id]) && !empty($detail_test_id[$id]) ? intval($detail_test_id[$id]) : null;
  $video_url = $detail_video_url[$id] ?? '';

  $query_update_detail = "
        UPDATE lecture_detail
        SET
            title = ?,
            quiz_id = ?,
            test_id = ?,
            video_url = ?
        WHERE id = ?
    ";

  $stmt = $mysqli->prepare($query_update_detail);
  $stmt->bind_param("siisi", $name, $quiz_id, $test_id, $video_url, $id);

  if (!$stmt->execute()) {
    die("기존 강의 업데이트 실패: " . $stmt->error);
  }
}

// 새로 추가된 강의 처리
$new_names = $_POST['new_lecture_name'] ?? [];
$new_quiz_ids = $_POST['new_lecture_quiz_id'] ?? [];
$new_test_ids = $_POST['new_lecture_test_id'] ?? [];
$new_video_urls = $_POST['new_lecture_video_url'] ?? [];
$new_files = $_FILES['new_lecture_file_id'] ?? [];
$video_order = count($detail_name) + 1;

foreach ($new_names as $i => $name) {
  $quiz_id = isset($new_quiz_ids[$i]) && !empty($new_quiz_ids[$i]) ? intval($new_quiz_ids[$i]) : null;
  $test_id = isset($new_test_ids[$i]) && !empty($new_test_ids[$i]) ? intval($new_test_ids[$i]) : null;
  $video_url = $new_video_urls[$i] ?? '';

  // 1. 새 강의 추가
  $query_new_detail = "
      INSERT INTO lecture_detail (
          lecture_id, title, quiz_id, test_id, video_url, video_order
      ) VALUES (?, ?, ?, ?, ?, ?)
  ";

  $stmt = $mysqli->prepare($query_new_detail);
  $stmt->bind_param("isiisi", $leid, $name, $quiz_id, $test_id, $video_url, $video_order);

  if (!$stmt->execute()) {
    die("새 강의 추가 실패: " . $stmt->error);
  }

  $lecture_detail_id = $mysqli->insert_id; // 새로 삽입된 lecture_detail ID 가져오기

  // 2. 파일 업로드 처리
  if (isset($new_files['name'][$i]) && $new_files['error'][$i] === UPLOAD_ERR_OK) {
    $file_tmp_name = $new_files['tmp_name'][$i];
    $file_name = time() . '_' . uniqid() . '_' . $new_files['name'][$i];
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/';
    $file_path = $upload_dir . $file_name;

    // 업로드 디렉토리가 없으면 생성
    if (!is_dir($upload_dir)) {
      mkdir($upload_dir, 0777, true);
    }

    // 파일 이동
    if (move_uploaded_file($file_tmp_name, $file_path)) {
      $query_file = "
              INSERT INTO lefile (lecdid, lepid, fname, fpath, ftype)
              VALUES (?, ?, ?, ?, ?)
          ";

      $stmt_file = $mysqli->prepare($query_file);
      $file_type = $new_files['type'][$i];
      $stmt_file->bind_param("iisss", $lecture_detail_id, $uid, $file_name, $file_path, $file_type);

      if ($stmt_file->execute()) {
        $file_id = $mysqli->insert_id;

        // 3. `lecture_detail`에 `file_id` 업데이트
        $query_update_file_id = "
                  UPDATE lecture_detail
                  SET file_id = ?
                  WHERE id = ?
              ";

        $stmt_update_file = $mysqli->prepare($query_update_file_id);
        $stmt_update_file->bind_param("ii", $file_id, $lecture_detail_id);

        if (!$stmt_update_file->execute()) {
          die("파일 ID 업데이트 실패: " . $stmt_update_file->error);
        }
      } else {
        die("파일 데이터 저장 실패: " . $stmt_file->error);
      }
    } else {
      die("파일 이동 실패: $file_tmp_name");
    }
  }

  $video_order++;
}


echo "<script>
    alert('강좌가 성공적으로 수정되었습니다.');
    window.location.href = '/code_even/admin/lecture/lecture_list.php';
</script>";

$mysqli->close();

?>