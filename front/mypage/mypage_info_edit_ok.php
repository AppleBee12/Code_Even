<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/mypage_header.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 세션에서 사용자 ID 가져오기
if (isset($_SESSION['AUID'])) {
    $userid = $_SESSION['AUID'];
  } elseif (isset($_SESSION['KAKAO_UID'])) {
    $userid = $_SESSION['KAKAO_UID'];
  } else {
    echo "<script>
        alert('로그인이 필요합니다.');
        history.back();
      </script>";
    exit;
  }

// POST 데이터 가져오기
$usernick = $_POST['usernick'] ?? '';
$username = $_POST['username'] ?? '';
$userpw = $_POST['userpw'] ?? '';
$userphonenum = $_POST['userphonenum'] ?? '';
$useremail = $_POST['useremail'] ?? '';
$post_code = $_POST['post_code'] ?? '';
$addr_line1 = $_POST['addr_line1'] ?? '';
$addr_line2 = $_POST['addr_line2'] ?? '';
$addr_line3 = $_POST['addr_line3'] ?? '';
$email_ok = isset($_POST['email_ok']) ? intval($_POST['email_ok']) : 0;

if (!empty($userpw)) {
    // 비밀번호가 입력된 경우: 비밀번호를 포함한 업데이트
    $hashed_pw = password_hash($userpw, PASSWORD_DEFAULT);

    $sql = "UPDATE user SET 
      usernick = ?, 
      username = ?, 
      userpw = ?, 
      userphonenum = ?, 
      useremail = ?, 
      post_code = ?, 
      addr_line1 = ?, 
      addr_line2 = ?, 
      addr_line3 = ?, 
      email_ok = ? 
  WHERE userid = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param(
        "sssssssssis", 
        $usernick, 
        $username, 
        $hashed_pw, 
        $userphonenum, 
        $useremail, 
        $post_code, 
        $addr_line1, 
        $addr_line2, 
        $addr_line3, 
        $email_ok, 
        $userid
    );
} else {
    // 비밀번호가 입력되지 않은 경우: 비밀번호를 제외한 업데이트
    $sql = "UPDATE user SET 
        usernick = ?, 
        username = ?, 
        userphonenum = ?, 
        useremail = ?, 
        post_code = ?, 
        addr_line1 = ?, 
        addr_line2 = ?, 
        addr_line3 = ?, 
        email_ok = ? 
    WHERE userid = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param(
        "ssssssssis", 
        $usernick, 
        $username, 
        $userphonenum, 
        $useremail, 
        $post_code, 
        $addr_line1, 
        $addr_line2, 
        $addr_line3, 
        $email_ok, 
        $userid
    );
}

// SQL 실행 및 결과 확인
if ($stmt->execute()) {
    echo "
    <script>
        alert('정보 수정이 완료되었습니다.');
        history.back();
    </script>";
    $mysqli->commit(); // 커밋
} else {
    echo "<script>alert('정보 수정에 실패했습니다.'); history.back();</script>";
}

// 리소스 정리
$stmt->close();
$mysqli->close();
?>
