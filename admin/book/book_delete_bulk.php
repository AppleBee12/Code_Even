<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// POST 요청에서 선택된 ID 값 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ids'])) {
  $id_list = ''; // 삭제할 ID 문자열 초기화
  $first = true; // 첫 번째 ID인지 확인하는 플래그

  // POST 데이터에서 개별 ID를 처리
  foreach ($_POST['ids'] as $id) {
    $is_valid = true;

    // 숫자만 있는지 수동으로 확인 (숫자가 아니면 무시)
    for ($i = 0; $i < strlen($id); $i++) {
      if ($id[$i] < '0' || $id[$i] > '9') {
        $is_valid = false;
        break;
      }
    }

    if ($is_valid) {
      if ($first) {
        $id_list .= $id; // 첫 번째 ID는 쉼표 없이 추가
        $first = false; // 첫 번째 이후는 쉼표 추가 허용
      } else {
        $id_list .= ',' . $id; // 이후 ID는 쉼표로 구분하여 추가
      }
    }
  }

  if ($id_list !== '') { // ID가 하나 이상 있으면 실행
    // 삭제 쿼리 실행
    $sql = "DELETE FROM book WHERE boid IN ($id_list)";
    $result = $mysqli->query($sql);

    // 결과에 따른 메시지 출력
    if ($result) {
      echo "<script>alert('선택한 항목이 삭제되었습니다.'); location.href='book_list.php';</script>";
    } else {
      echo "<script>alert('삭제 중 오류가 발생했습니다.'); history.back();</script>";
    }
  } else {
    echo "<script>alert('삭제할 항목이 없습니다.'); history.back();</script>";
  }
} else {
  echo "<script>alert('잘못된 요청입니다.'); history.back();</script>";
}
?>
