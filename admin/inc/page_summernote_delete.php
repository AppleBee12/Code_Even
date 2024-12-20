<?php


// ** 테이블의 id값을 적을 때 변수명을 $table_id로 정의해주세요! (ex. $fqid -> $table_id);
// ** $table_name은 필요한 테이블의 명을 적어주세요!
function deleteSummernoteImages($mysqli, $table_id, $table_name) {
    // 이미지 정보 가져오기
    $image_sql = "SELECT file_name FROM summer_images WHERE table_id = $table_id AND table_name = '$table_name'";
    $image_result  = $mysqli->query($image_sql);

    if ($image_result->num_rows > 0) {
      while ($row = $image_result->fetch_assoc()) {
        $imageFileName = $row['file_name'];
        $baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/upload/summernote/';
        $imageFileNameWithoutUrl = str_replace($baseUrl, '', $imageFileName);
        
        // 실제 파일 시스템에서 이미지 삭제
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/upload/summernote/' . $imageFileNameWithoutUrl;

        if (file_exists($imagePath)) {
          unlink($imagePath); // 파일 삭제
  
          // 데이터베이스 이미지 삭제
          $delete_sql = "DELETE FROM summer_images WHERE table_id = $table_id";
          $delete_result = $mysqli->query($delete_sql);
  
          if ($delete_result) {
            echo "<script>console.log('데이터베이스에서 삭제되었습니다.');</script>";
          } else {
            echo "<script>console.log('데이터베이스에서 삭제를 실패하였습니다.');</script>";
          }
          
        } else {
          echo "<script>console.log('파일 \"$imageFileNameWithoutUrl\"이 존재하지 않습니다.');</script>";
        }
      }
    }
    // return false; // 삭제 대상 없음
}
?>
