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
        boid, lecid, cate1, cate2, cate3, image, title, price, period, name, course_type, state
    ) VALUES (
        $boid, '$uid', '$cate1', '$cate2', '$cate3', '$thumbnailPath', '$title', '$price', '$period', '$username', '$course_type', 1
    )
";
$result = $mysqli->query($query_lecture);

if ($result) {
  $leid = $mysqli->insert_id; // 저장된 강좌 ID

  $detail_name = $_POST['lecture_name'] ?? [];
  $detail_description = $_POST['lecture_description'] ?? [];
  $detail_quiz_id = $_POST['lecture_quiz_id'] ?? [];
  $detail_test_id = $_POST['lecture_test_id'] ?? [];
  $detail_video_url = $_POST['lecture_video_url'] ?? [];
  $uploaded_files = $_FILES['lecture_file_id'] ?? [];

  $video_order = 1;

  foreach ($detail_name as $i => $name) {
    $description = $detail_description[$i] ?? '';
    $quiz_id = isset($detail_quiz_id[$i]) && $detail_quiz_id[$i] !== '' ? $detail_quiz_id[$i] : 'NULL';
    $test_id = isset($detail_test_id[$i]) && $detail_test_id[$i] !== '' ? $detail_test_id[$i] : 'NULL';
    $video_url = $detail_video_url[$i] ?? '';

    // 강의 세부 정보 저장
    $query_lecture_detail = "
            INSERT INTO lecture_detail (
                lecture_id, title, description, quiz_id, test_id, video_url, video_order
            ) VALUES (
                $leid, '$name', '$description', $quiz_id, $test_id, '$video_url', $video_order
            )
        ";
    if (!$mysqli->query($query_lecture_detail)) {
      echo "<script>alert('강의 데이터 저장 실패: " . $mysqli->error . "');</script>";
      exit;
    }

    // 강의 ID 가져오기
    $lecture_detail_id = $mysqli->insert_id;

    // 동영상 정보 저장 (levideo 테이블)
    if (!empty($video_url)) {
      $query_video = "
                INSERT INTO levideo (lecpid, videoname, video_url, orders)
                VALUES ($lecture_detail_id, '$name', '$video_url', $video_order)
            ";
      if (!$mysqli->query($query_video)) {
        echo "<script>alert('동영상 데이터 저장 실패: " . $mysqli->error . "');</script>";
        exit;
      }
    }

    // 첨부 파일 정보 저장 (lefile 테이블)
    if (isset($uploaded_files['name'][$i]) && $uploaded_files['error'][$i] === UPLOAD_ERR_OK) {
      $file_tmp_name = $uploaded_files['tmp_name'][$i];
      $file_name = $uploaded_files['name'][$i];
      $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/';
      $file_path = $upload_dir . time() . '_' . $file_name;

      // 디렉토리 생성
      if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
      }

      // 파일 업로드 처리
      if (move_uploaded_file($file_tmp_name, $file_path)) {
        $query_file = "
                    INSERT INTO lefile (lecdid, fname, fpath, ftype)
                    VALUES ($lecture_detail_id, '$file_name', '$file_path', '{$uploaded_files['type'][$i]}')
                ";
        if (!$mysqli->query($query_file)) {
          echo "<script>alert('파일 데이터 저장 실패: " . $mysqli->error . "');</script>";
          exit;
        }
      } else {
        echo "<script>alert('파일 업로드 실패: $file_name');</script>";
        exit;
      }
    }

    $video_order++;
  }

  echo "<script>
        alert('강좌 세부 정보가 저장되었습니다.');
        window.location.href = '/CODE_EVEN/admin/lecture_list.php';
    </script>";
  exit;
} else {
  echo "<script>alert('강좌 등록 실패: " . $mysqli->error . "');</script>";
}

$mysqli->close();

?>