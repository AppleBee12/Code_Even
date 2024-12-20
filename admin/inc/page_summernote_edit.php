<?php

function addImagesIfNotExists($fqid, $table_name, $imageUrl, $mysqli) {
  // 세션에서 이미지 URL 가져오기
  if (!$imageUrl) {
      return false;
  }

  // 기존 이미지 가져오기
  $existing_img_sql = "SELECT file_name FROM summer_images WHERE table_id = $fqid AND table_name = '$table_name'";
  $existing_img_result = $mysqli->query($existing_img_sql);

  $existing_images = [];
  while ($row = $existing_img_result->fetch_assoc()) {
      $existing_images[] = $row['file_name'];
  }

  $image_result = true;

  // 새로운 이미지만 추가하기
  foreach ($imageUrl as $image) {
      // 기존에 동일한 이미지가 없으면 삽입
      if (!in_array($image, $existing_images)) {
          $image_sql = "INSERT INTO summer_images (table_name, table_id, file_name) VALUES ('$table_name', $fqid, '$image')";
          $image_result = $mysqli->query($image_sql);

          if (!$image_result) {
              // 실패한 경우 오류 메시지
              echo "<script>console.log('이미지 \"$image\" 추가 실패: " . $mysqli->error . "');</script>";
          } else {
              echo "<script>console.log('이미지 \"$image\"가 추가되었습니다.');</script>";
          }
      }
  }

  return $image_result;
}

?>