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
$sql_user = "SELECT uid, username FROM user WHERE userid = '$session_userid'";
$result_user = $mysqli->query($sql_user);

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
    cate1 = '$cate1',
    cate2 = '$cate2',
    cate3 = '$cate3',
    title = '$title',
    price = '$price',
    period = '$period',
    course_type = '$course_type',
    image = IF('$thumbnailPath' != '', '$thumbnailPath', image)
  WHERE leid = $leid
";

if (!$mysqli->query($query_update_lecture)) {
  die("강좌 업데이트 실패: " . $mysqli->error);
}

// 기존 강의 세부 정보 업데이트
$detail_name = $_POST['lecture_name'] ?? [];
$detail_description = $_POST['lecture_description'] ?? [];
$detail_quiz_id = $_POST['lecture_quiz_id'] ?? [];
$detail_test_id = $_POST['lecture_test_id'] ?? [];
$detail_video_url = $_POST['lecture_video_url'] ?? [];
$uploaded_files = $_FILES['lecture_file_id'] ?? [];

foreach ($detail_name as $id => $name) {
  $description = $detail_description[$id] ?? '';
  $quiz_id = isset($detail_quiz_id[$id]) && $detail_quiz_id[$id] !== '' ? $detail_quiz_id[$id] : 'NULL';
  $test_id = isset($detail_test_id[$id]) && $detail_test_id[$id] !== '' ? $detail_test_id[$id] : 'NULL';
  $video_url = $detail_video_url[$id] ?? '';
  $file_id = 'NULL'; // 초기화

  // 새 파일 업로드 처리 (기존 파일 유지)
  if (isset($uploaded_files['name'][$id]) && $uploaded_files['error'][$id] === UPLOAD_ERR_OK) {
    $file_tmp_name = $uploaded_files['tmp_name'][$id];
    $file_name = time() . '_' . uniqid() . '_' . $uploaded_files['name'][$id];
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/';
    $file_path = $upload_dir . $file_name;

    if (!is_dir($upload_dir)) {
      mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($file_tmp_name, $file_path)) {
      $query_file = "
        INSERT INTO lefile (lecdid, lepid, fname, fpath, ftype)
        VALUES ($id, '$uid', '$file_name', '$file_path', '{$uploaded_files['type'][$id]}')
      ";
      if ($mysqli->query($query_file)) {
        $file_id = $mysqli->insert_id;

        // 업데이트 `file_id` in `lecture_detail`
        $query_update_file_id = "
          UPDATE lecture_detail
          SET file_id = $file_id
          WHERE id = $id
        ";
        if (!$mysqli->query($query_update_file_id)) {
          die("파일 ID 업데이트 실패: " . $mysqli->error);
        }
      } else {
        die("파일 저장 실패: " . $mysqli->error);
      }
    } else {
      die("파일 업로드 실패: $file_name");
    }
  }

  // 강의 세부 정보 업데이트
  $query_update_detail = "
    UPDATE lecture_detail
    SET
      title = '$name',
      description = '$description',
      quiz_id = $quiz_id,
      test_id = $test_id,
      video_url = '$video_url'
    WHERE id = $id
  ";

  if (!$mysqli->query($query_update_detail)) {
    die("강의 업데이트 실패: " . $mysqli->error);
  }
}

// 새로 추가된 강의 처리
$new_names = $_POST['new_lecture_name'] ?? [];
$new_descriptions = $_POST['new_lecture_description'] ?? [];
$new_quiz_ids = $_POST['new_lecture_quiz_id'] ?? [];
$new_test_ids = $_POST['new_lecture_test_id'] ?? [];
$new_video_urls = $_POST['new_lecture_video_url'] ?? [];
$new_files = $_FILES['new_lecture_file_id'] ?? [];
$video_order = count($detail_name) + 1;

foreach ($new_names as $i => $name) {
  $description = $new_descriptions[$i] ?? '';
  $quiz_id = isset($new_quiz_ids[$i]) && $new_quiz_ids[$i] !== '' ? $new_quiz_ids[$i] : 'NULL';
  $test_id = isset($new_test_ids[$i]) && $new_test_ids[$i] !== '' ? $new_test_ids[$i] : 'NULL';
  $video_url = $new_video_urls[$i] ?? '';
  $file_id = 'NULL';

  $query_new_detail = "
    INSERT INTO lecture_detail (
      lecture_id, title, description, quiz_id, test_id, video_url, video_order
    ) VALUES (
      $leid, '$name', '$description', $quiz_id, $test_id, '$video_url', $video_order
    )
  ";

  if (!$mysqli->query($query_new_detail)) {
    die("새 강의 추가 실패: " . $mysqli->error);
  }

  $lecture_detail_id = $mysqli->insert_id; // 새로 삽입된 lecture_detail ID 가져오기

  // 새 파일 업로드 처리
  if (isset($new_files['name'][$i]) && $new_files['error'][$i] === UPLOAD_ERR_OK) {
    $file_tmp_name = $new_files['tmp_name'][$i];
    $file_name = time() . '_' . uniqid() . '_' . $new_files['name'][$i];
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/';
    $file_path = $upload_dir . $file_name;

    if (!is_dir($upload_dir)) {
      mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($file_tmp_name, $file_path)) {
      $query_file = "
        INSERT INTO lefile (lecdid, lepid, fname, fpath, ftype)
        VALUES ($lecture_detail_id, '$uid', '$file_name', '$file_path', '{$new_files['type'][$i]}')
      ";
      if (!$mysqli->query($query_file)) {
        die("파일 저장 실패: " . $mysqli->error);
      }
    } else {
      die("파일 업로드 실패: $file_name");
    }
  }

  $video_order++;
}

echo "<script>
  alert('강좌가 성공적으로 수정되었습니다.');
  window.location.href = '/CODE_EVEN/admin/lecture/lecture_list.php';
</script>";

$mysqli->close();

?>
