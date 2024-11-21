<?php
  session_start();

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php'); // DB 연결

  // 현재 로그인된 사용자 세션 값 가져오기
  $session_userid = $_SESSION['AUID'] ?? null;

  // 로그인 확인
  if (!$session_userid) {
      echo "<script>alert('로그인 정보가 없습니다. 다시 로그인해 주세요.'); location.href='/code_even/admin/login.php';</script>";
      exit;
  }

  // 현재 사용자 이름 가져오기
  $sql_user = "SELECT username FROM user WHERE userid = '$session_userid'";
  $result_user = $mysqli->query($sql_user);

  if ($result_user->num_rows > 0) {
      $row_user = $result_user->fetch_assoc();
      $username = $row_user['username'];
  } else {
      echo "<script>alert('사용자 정보를 가져오는 데 실패했습니다.');</script>";
      exit;
  }

  // 데이터 수신
  $cate1 = $_POST['cate1'] ?? '';
  $cate2 = $_POST['cate2'] ?? '';
  $cate3 = $_POST['cate3'] ?? '';
  $title = $_POST['title'] ?? '';
  $price = $_POST['price'] ?? 0;
  $pd = $_POST['pd'] ?? '';
  $book = $_POST['book'] ?? '';
  $desc = $_POST['desc'] ?? '';
  $writer = $_POST['writer'] ?? '';
  $company = $_POST['company'] ?? '';

  // 이미지 업로드 처리
  $image_path = '';
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
      $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
      if (!is_dir($upload_dir)) {
          mkdir($upload_dir, 0755, true); // 업로드 디렉토리가 없으면 생성
      }

      $image_name = basename($_FILES['image']['name']);
      $image_path = '/uploads/' . $image_name;

      // 파일 이동
      if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image_name)) {
          echo "<script>alert('이미지 업로드에 실패했습니다.');</script>";
          exit;
      }
  }

  // SQL 작성
  $sql = "INSERT INTO book (cate1, cate2, cate3, title, name, price, pd, book, `desc`, writer, company, image) VALUES (
          '$cate1',
          '$cate2',
          '$cate3',
          '$title',
          '$username', -- 현재 로그인된 사용자의 username
          $price,
          '$pd',
          '$book',
          '$desc',
          '$writer',
          '$company',
          '$image_path'
      )";

  // SQL 실행
  $result = $mysqli->query($sql);

  // 결과 확인
  if ($result) {
      echo "<script>alert('교재가 성공적으로 등록되었습니다.'); location.href='/CODE_EVEN/admin/book/book_list.php';</script>";
  } else {
      echo "<script>alert('등록에 실패했습니다. 다시 시도해주세요.');</script>";
  }

  // 데이터베이스 연결 종료
  $mysqli->close();

?>
