<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/page_summernote_delete.php');

if (isset($_GET['fqid']) && isset($_GET['confirm']) && $_GET['confirm'] == "true") {
$table_id = $_GET['fqid'];

// FAQ 삭제를 위한 타겟 정보 가져오기
$target_sql = "SELECT target FROM faq WHERE fqid = $table_id";
$target_result = $mysqli->query($target_sql);

if ($target_result) {
    $data = $target_result->fetch_object();
    $target = $data->target;

    // Summernote 이미지 삭제
    deleteSummernoteImages($mysqli, $table_id, 'faq');

    // FAQ 데이터 삭제
    $sql = "DELETE FROM faq WHERE fqid = $table_id";
    $result = $mysqli->query($sql);

    if ($result) {
        $redirect_url = ($target === 'teacher') ? 'teacher_faq.php' : (($target === 'student') ? 'student_faq.php' : 'index.php');
        echo
          "<script>
            alert('삭제가 완료되었습니다.');
            location.href = '$redirect_url';
          </script>";
    } else {
        echo
          "<script>
            alert('글 삭제 실패');
            history.back();
          </script>";
    }
  } else {
      echo
        "<script>
          alert('타겟 정보를 가져오지 못했습니다.');
          history.back();
        </script>";
  }
} else {
  echo 
  "<script>
      if (confirm('글을 삭제하시겠습니까?')) {
          location.href = '?fqid=" . $_GET['fqid'] . "&confirm=true';
      } else {
          alert('삭제가 취소되었습니다.');
          location.href = 'notice.php';
      }
  </script>";
}
?>
