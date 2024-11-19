<?php

session_start(); // 세션 시작
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 현재 로그인된 사용자 ID 확인
if (!isset($_SESSION['AUID']) || !isset($_SESSION['AUNAME'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='../login/login.php';</script>";
    exit;
}

$session_userid = $_SESSION['AUID']; // 세션에서 AUID 가져오기

// 사용자 정보 가져오기
$sql_user = "SELECT uid, username FROM user WHERE userid = '$session_userid'";
$result_user = $mysqli->query($sql_user);
if ($result_user->num_rows === 1) {
    $user = $result_user->fetch_assoc();
    $uid = $user['uid'];
    $username = $user['username'];
} else {
    echo "<script>alert('사용자 정보를 불러오는데 실패했습니다.');</script>";
    exit;
}

// 강좌 데이터 저장 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cate1 = $_POST['cate1'] ?? null;
    $cate2 = $_POST['cate2'] ?? null;
    $cate3 = $_POST['cate3'] ?? null;
    $title = $_POST['title'] ?? null;
    $price = (int)str_replace(',', '', $_POST['price'] ?? 0);
    $period = $_POST['period'] ?? 30;
    $isrecipe = $_POST['isrecipe'] ?? 0;
    $isgeneral = $_POST['isgeneral'] ?? 1;
    $imagePath = '/uploads/images/default.png';
    $video_url = $_POST['video_url'] ?? null;
    $state = ($_POST['action'] === 'draft_save') ? 0 : 1;
    $approval = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'get_quiz_test') {
      $cate1 = $_POST['cate1'] ?? null;
      $cate2 = $_POST['cate2'] ?? null;
      $cate3 = $_POST['cate3'] ?? null;
      $title = $_POST['title'] ?? null;
  
      // 데이터 검증
      if (empty($cate1) || empty($cate2) || empty($cate3) || empty($title)) {
          echo json_encode(['error' => '카테고리와 강좌명은 필수 입력 항목입니다.']);
          exit;
      }
  
      // quiz 데이터 가져오기
      $sql_quiz = "SELECT exid, tt FROM quiz WHERE cate1 = '$cate1' AND cate2 = '$cate2' AND cate3 = '$cate3' AND title = '$title'";
      $result_quiz = $mysqli->query($sql_quiz);
  
      $quiz_data = [];
      if ($result_quiz && $result_quiz->num_rows > 0) {
          while ($row = $result_quiz->fetch_object()) {
              $quiz_data[] = $row;
          }
      }
  
      // test 데이터 가져오기
      $sql_test = "SELECT exid, tt FROM test WHERE cate1 = '$cate1' AND cate2 = '$cate2' AND cate3 = '$cate3' AND title = '$title'";
      $result_test = $mysqli->query($sql_test);
  
      $test_data = [];
      if ($result_test && $result_test->num_rows > 0) {
          while ($row = $result_test->fetch_object()) {
              $test_data[] = $row;
          }
      }
  
      // 데이터 반환
      echo json_encode(['quiz' => $quiz_data, 'test' => $test_data]);
      exit;
  }
  

    // video_url 검증
    if (empty($video_url)) {
        echo "<script>alert('동영상 URL은 필수 입력 항목입니다.'); history.back();</script>";
        exit;
    }

    // 이미지 업로드 처리
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $uploadedFile = $uploadDir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
            $imagePath = '/uploads/images/' . basename($_FILES['image']['name']);
        }
    }

    // 필수 입력 항목 검증
    if (empty($cate1) || empty($cate2) || empty($cate3) || empty($title)) {
        echo "<script>alert('필수 항목을 모두 입력해주세요.');</script>";
        exit;
    }

    // 강좌 데이터 저장
    $sql = "
    INSERT INTO lecture 
    (lecid, cate1, cate2, cate3, title, name, price, period, isrecipe, `isgeneral`, image, video_url, date, state, approval) 
    VALUES ('$uid', '$cate1', '$cate2', '$cate3', '$title', '$username', $price, $period, $isrecipe, '$isgeneral', '$imagePath', '$video_url', NOW(), $state, $approval)
    ";

    // 디버깅용 SQL 확인
    echo "<pre>$sql</pre>"; // 쿼리를 출력하여 확인
    if ($mysqli->query($sql)) {
    $lecture_id = $mysqli->insert_id;

    // 강의 세부 정보 저장
    if (!empty($_POST['lecture_detail'])) {
        foreach ($_POST['lecture_detail'] as $detail) {
            $lectureTitle = $detail['title'] ?? null;
            $lectureDesc = $detail['description'] ?? null;
            $quizId = $detail['quiz_id'] ?? null;
            $testId = $detail['test_id'] ?? null;
            $videoUrl = $detail['video_url'] ?? null;
            $videoOrder = $detail['video_order'] ?? null;

            $sql_detail = "
                INSERT INTO lecture_detail 
                (lecture_id, title, description, quiz_id, test_id, video_url, video_order, created_at) 
                VALUES ('$lecture_id', '$lectureTitle', '$lectureDesc', '$quizId', '$testId', '$videoUrl', '$videoOrder', NOW())
            ";
            $mysqli->query($sql_detail);
        }
    }

    echo "<script>alert('강좌가 성공적으로 저장되었습니다.');</script>";
    echo "<script>location.href='lecture_list.php';</script>";
    } else {
    echo "<script>alert('저장 실패: {$mysqli->error}');</script>";
    exit;
    }
}
?>
