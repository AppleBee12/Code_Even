<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$tcid = $_GET['tcid'];
if (!isset($tcid)) {
  echo "<script>alert('강사 정보가 없습니다.'); location.href = 'teacher_list.php';</script>";
  exit;
}

// teachers 테이블에서 tcid에 해당하는 uid와 썸네일 가져오기
$teacher_sql = "SELECT uid, tc_thumbnail FROM teachers WHERE tcid = $tcid";
$teacher_result = $mysqli->query($teacher_sql);
if ($teacher_result->num_rows > 0) {
  $teacher_data = $teacher_result->fetch_object();
  $uid = $teacher_data->uid;
  $thumbnail = $teacher_data->tc_thumbnail;

  // 썸네일 파일 삭제
  if ($thumbnail && file_exists($_SERVER['DOCUMENT_ROOT'] . $thumbnail)) {
    unlink($_SERVER['DOCUMENT_ROOT'] . $thumbnail);
  }

  // teachers 테이블에서 데이터 삭제
  $teacher_del_sql = "DELETE FROM teachers WHERE tcid = $tcid";
  $teacher_del_result = $mysqli->query($teacher_del_sql);

  // user 테이블에서 uid와 일치하는 데이터 삭제
  if ($teacher_del_result) {
    $user_del_sql = "DELETE FROM user WHERE uid = $uid";
    $user_del_result = $mysqli->query($user_del_sql);

    // 삭제 완료 후 강사 목록으로 이동
    echo "<script>
      alert('강사 정보 및 관련 회원 정보 삭제 완료');
      location.href = 'teacher_list.php';
    </script>";
  } else {
    echo "<script>alert('강사 정보 삭제 중 오류 발생'); history.back();</script>";
  }
} else {
  echo "<script>alert('해당 강사 정보를 찾을 수 없습니다.'); location.href = 'teacher_list.php';</script>";
}
?>
