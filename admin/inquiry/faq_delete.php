<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

  $fqid = $_GET['fqid'];
  // print_r($fqid);

  $target_sql = "SELECT faq.target FROM faq WHERE fqid = $fqid";
  $target_result = $mysqli->query($target_sql);

  $image_sql = "SELECT file_name FROM summer_images WHERE table_id = $fqid";
  $image_result  = $mysqli->query($image_sql);

  if ($target_result) {
    $data = $target_result->fetch_object();
    $target = $data->target;

    // print_r($data); 
  
    $sql = "DELETE FROM faq WHERE fqid = $fqid";
    $result = $mysqli->query($sql);

    if ($image_result->num_rows > 0) {

      $row = $image_result->fetch_assoc();
      $imageFileName = $row['file_name'];

      // 실제 파일 시스템에서 이미지 삭제
      $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/upload/summernote/' . $imageFileName;
  
      if (file_exists($imagePath)) {
        unlink($imagePath); // 파일 삭제
        echo "파일 '$imageFileName'이 성공적으로 삭제되었습니다.";

        $delete_sql = "DELETE FROM summer_images WHERE table_id = $fqid";
        $delete_result = $mysqli->query($delete_sql);

        if ($delete_result) {
          echo "데이터베이스에서 레코드가 삭제되었습니다.<br>";
      } else {
          echo "데이터베이스에서 레코드를 삭제하는 데 실패했습니다.<br>";
      }
        
      } else {
        echo "파일 '$imageFileName'이 존재하지 않습니다.";
      }

    } else {
        echo "데이터베이스에서 이미지를 삭제하는 데 실패했습니다.";
    }

    if ($result) {
      $redirect_url = ($target === 'teacher') ? 'teacher_faq.php' : (($target === 'student') ? 'student_faq.php' : 'index.php');
      echo
        "<script>
          confirm('글을 삭제하시겠습니까?');
          alert('삭제가 완료되었습니다.');
          
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