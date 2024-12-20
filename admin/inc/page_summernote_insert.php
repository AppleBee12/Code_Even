<?php

function insertSummerImages($mysqli, $table_name, $table_id, $imageUrl) {
  if (empty($imageUrl)) {
      return true; // 이미지가 없는 경우 삽입하지 않음
  }

  foreach ($imageUrl as $image) {
      $image_sql = "INSERT INTO summer_images (table_name, table_id, file_name) VALUES ('$table_name', '$table_id', '$image')";
      if (!$mysqli->query($image_sql)) {
          return false; // 하나라도 실패하면 false 반환
      }
  }
  return true; // 모든 삽입 성공 시 true 반환
}

?>