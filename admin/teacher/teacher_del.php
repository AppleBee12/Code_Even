<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');


$tcid = $_GET['tcid'];
if (!isset($tcid)) {
  echo "<script>alert('강사 정보가 없습니다.'); location.href = 'teacher_list.php';</script>";
}

//teachers 테이블에서 tcid 컬럼이 $tcid와 같은 데이터 삭제, 썸네일 삭제
$thumbnail_sql = "SELECT tc_thumbnail FROM teachers WHERE tcid = $tcid";
$thumbnail_result = $mysqli->query($thumbnail_sql);
$thumbnail_data = $thumbnail_result->fetch_object();
$thumbnail = $thumbnail_data->tc_thumbnail;


unlink($_SERVER['DOCUMENT_ROOT'].$thumbnail);

$teacher_del_sql = "DELETE FROM teachers WHERE tcid = $tcid";
$teacher_del_result = $mysqli->query($teacher_del_sql);




//삭제 완료후 강사 목록으로 이동
if($teacher_del_result){
  echo "<script>
    alert('강사 정보 삭제 완료');
    location.href = 'teacher_list.php';
  </script>";
}

?>