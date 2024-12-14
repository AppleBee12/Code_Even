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
$leid = $_POST['leid'] ?? $_GET['leid'] ?? null;
if (!$leid) {
  die("강좌 ID가 필요합니다.");
}

// 기존 강좌 데이터 가져오기
$query_lecture = "SELECT * FROM lecture WHERE leid = '$leid'";
$result_lecture = $mysqli->query($query_lecture);
if ($result_lecture && $result_lecture->num_rows > 0) {
  $lecture_data = $result_lecture->fetch_object();
} else {
  die("강좌 데이터를 가져오는 데 실패했습니다.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 업데이트 처리
  $title = $_POST['title'] ?? null;
  $cate1 = $_POST['cate1'] ?? null;
  $cate2 = $_POST['cate2'] ?? null;
  $cate3 = $_POST['cate3'] ?? null;
  $price = $_POST['price'] ?? 0;
  $book_id = $_POST['book'] ?? null;
  $period = $_POST['period'] ?? 30;
  $course_type = $_POST['courseType'] ?? 'general';

  // 썸네일 업데이트
  $thumbnailPath = $lecture_data->image;
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

  // 강좌 정보 업데이트
  $query_update_lecture = "
        UPDATE lecture
        SET boid = $boid,
            cate1 = '$cate1',
            cate2 = '$cate2',
            cate3 = '$cate3',
            image = '$thumbnailPath',
            title = '$title',
            price = '$price',
            period = '$period',
            course_type = '$course_type'
        WHERE leid = '$leid'
    ";


  if (!$mysqli->query($query_update_lecture)) {
    die("강좌 업데이트 실패: " . $mysqli->error);
  }

  // 강좌 세부 정보 업데이트
  $detail_name = $_POST['new_lecture_name'] ?? []; // 수정된 변수 이름
  $detail_quiz_id = $_POST['new_lecture_quiz_id'] ?? []; // 수정된 변수 이름
  $detail_test_id = $_POST['new_lecture_test_id'] ?? []; // 수정된 변수 이름
  $detail_video_url = $_POST['new_lecture_video_url'] ?? []; // 수정된 변수 이름
  $uploaded_files = $_FILES['lecture_file_id'] ?? [];// 파일 업로드와 연결 처리

  $video_order = 1;

  foreach ($detail_name as $i => $name) {
    $description = ''; // 필요시 $_POST에서 받아올 수 있음
    $quiz_id = isset($detail_quiz_id[$i]) && $detail_quiz_id[$i] !== '' ? $detail_quiz_id[$i] : 'NULL';
    $test_id = isset($detail_test_id[$i]) && $detail_test_id[$i] !== '' ? $detail_test_id[$i] : 'NULL';
    $video_url = $detail_video_url[$i] ?? '';
    $file_id = 'NULL'; // 초기화

    // 파일 업로드 처리
    if (isset($uploaded_files['name'][$i]) && $uploaded_files['error'][$i] == UPLOAD_ERR_OK) {
      $file_tmp_name = $uploaded_files['tmp_name'][$i];
      $file_name = time() . '_' . uniqid() . '_' . $uploaded_files['name'][$i];
      $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/';
      $file_path = $upload_dir . $file_name;

      // 디렉토리 확인 및 생성
      if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
          die("업로드 디렉토리 생성 실패: $upload_dir");
        }
      }

      // 기존 파일 삭제
      $query_existing_file = "SELECT fpath FROM lefile WHERE lecdid = '$lecture_detail_id'";
      $result_existing_file = $mysqli->query($query_existing_file);
      if ($result_existing_file && $result_existing_file->num_rows > 0) {
        $existing_file = $result_existing_file->fetch_object();
        if (file_exists($existing_file->fpath)) {
          unlink($existing_file->fpath); // 기존 파일 삭제
        }

        // 기존 파일 데이터베이스에서 삭제
        $query_delete_file = "DELETE FROM lefile WHERE lecdid = '$lecture_detail_id'";
        if (!$mysqli->query($query_delete_file)) {
          die("기존 파일 삭제 실패: " . $mysqli->error);
        }
      }

      // 새 파일 저장
      if (move_uploaded_file($file_tmp_name, $file_path)) {
        echo "파일 업로드 성공: $file_path<br>";

        // SQL 쿼리 실행
        $query_file = "
              INSERT INTO lefile (lecdid, lepid, fname, fpath, ftype)
              VALUES ('$lecture_detail_id', '$uid', '$file_name', '$file_path', '{$uploaded_files['type'][$i]}')
          ";
        echo "쿼리 실행: $query_file<br>";
        if ($mysqli->query($query_file)) {
          $file_id = $mysqli->insert_id; // 새로 저장된 파일 ID
          echo "파일 데이터 삽입 성공, file_id: $file_id<br>";
        } else {
          die("SQL 실행 오류: " . $mysqli->error);
        }
      } else {
        die("파일 이동 실패: $file_tmp_name");
      }
    } else {
      echo "파일 업로드 실패 (에러 코드): " . $uploaded_files['error'][$i] . "<br>";
      $file_id = 'NULL'; // 새 파일이 없을 경우 file_id를 NULL로 설정
    }

    // 기존 데이터 업데이트 또는 삽입
    $query_check_detail = "SELECT id FROM lecture_detail WHERE lecture_id = '$leid' AND video_order = $video_order";
    $result_check_detail = $mysqli->query($query_check_detail);

    if ($result_check_detail && $result_check_detail->num_rows > 0) {
      $lecture_detail_id = $result_check_detail->fetch_object()->id;
      $query_update_detail = "
          UPDATE lecture_detail
          SET title = '$name',
              quiz_id = $quiz_id,
              test_id = $test_id,
              video_url = '$video_url',
              video_order = $video_order,
              file_id = $file_id
          WHERE id = $lecture_detail_id
      ";
      if (!$mysqli->query($query_update_detail)) {
        die("강의 세부 데이터 업데이트 실패: " . $mysqli->error);
      }
    } else {
      $query_insert_detail = "
          INSERT INTO lecture_detail (
              lecture_id, title, quiz_id, test_id, video_url, video_order, file_id
          ) VALUES (
              $leid, '$name', $quiz_id, $test_id, '$video_url', $video_order, $file_id
          )
      ";
      if (!$mysqli->query($query_insert_detail)) {
        die("강의 세부 데이터 삽입 실패: " . $mysqli->error);
      }
    }

    $video_order++;

  }



  echo "<script>
          alert('강좌가 수정되었습니다.');
          window.location.href = '/CODE_EVEN/admin/lecture/lecture_list.php';
      </script>";
  exit;
}
?>