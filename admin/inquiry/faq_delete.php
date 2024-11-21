<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

  $fqid = $_GET['fqid'];
  // print_r($fqid);

  $target_sql = "SELECT faq.target FROM faq WHERE fqid = '$fqid'";
  $target_result = $mysqli->query($target_sql);


  if ($target_result) {
    $data = $target_result->fetch_object();
    $target = $data->target;

    // print_r($data); 
  
    $sql = "DELETE FROM faq WHERE fqid = $fqid";
    $result = $mysqli->query($sql);

    if ($result === true) {
      $redirect_url = ($target === 'teacher') ? 'teacher_faq.php' : (($target === 'student') ? 'student_faq.php' : 'index.php');
      echo
        "<script>
          confirm('글을 삭제하시겠습니까?');
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
?>