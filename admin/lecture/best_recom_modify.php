<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

  // 전달받은 데이터 배열 초기화
  $isbest = $_POST['isbest'] ?? [];   // '베스트' 값
  $isrecom = $_POST['isrecom'] ?? []; // '추천' 값
  $leid_list = $_POST['leid'] ?? [];  // 강좌 ID 목록

  // 각 강좌의 값이 없을 경우 0으로 설정하고 업데이트 쿼리 실행
  foreach ($leid_list as $leid) {
    // 각 강좌의 값이 없을 경우 0으로 설정
    $isbest[$leid] = $isbest[$leid] ?? 0;
    $isrecom[$leid] = $isrecom[$leid] ?? 0;

    // SQL 업데이트 쿼리
    $sql = "UPDATE lecture SET 
      isbest = {$isbest[$leid]}, 
      isrecom = {$isrecom[$leid]} 
    WHERE leid = $leid";

    // 쿼리 실행
    $result = $mysqli->query($sql);

    // 쿼리 실행이 실패할 경우 에러 처리
    if (!$result) {
      echo "<script>
        alert('일괄 수정 실패');
        history.back();
      </script>";
      exit; // 오류 발생 시 스크립트 종료
    }
  }

  // 성공적으로 처리된 경우
  echo "<script>
    alert('일괄 수정 되었습니다.');
    location.href = 'lecture_list.php';  // 수정 후 강좌 목록으로 리다이렉트
  </script>";

?>
