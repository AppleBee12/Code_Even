<?php

$host = $_SERVER['HTTP_HOST'];
$manual_js = "<script src=\"http://$host/code_even/admin/js/manual.js\"></script>";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

//$uid, $level은 header에서 잡아줌
$title =  ($level == 100) ? "관리자 매뉴얼" : (($level == 10) ? "강사 매뉴얼" : null);;
// $mnid = ($level == 100) ? 1 : (($level == 10) ? 20 : null);
// $type = ($level == 100) ? '관리자' : (($level == 10) ? '강사' : null); // 원하는 type

$mnnid = isset($_GET['mnnid']) ? intval($_GET['mnnid']) : null;
$conid = isset($_GET['conid']) ? intval($_GET['conid']) : null;
// 값 확인 및 기본 처리
if (!$mnnid || !$conid) {
  echo "잘못된 접근입니다.";
  exit;
}

// 데이터베이스 쿼리
$sql = "
    SELECT *
    FROM 
        manual_contents
    WHERE 
        mnnid = $mnnid AND conid = $conid
    ORDER BY 
        mcid ASC
";

$result = $mysqli->query($sql);
if (!$result) {
  echo "데이터베이스 오류: " . $mysqli->error;
}

// 결과 데이터 처리
$rows = [];
while ($row = $result->fetch_assoc()) {
  $rows[] = $row;
}

?>
<h2><?= $title ?></h2>
<div class="container manual-wrap">
  <div class="manual-body">
  <?php if (!empty($rows)): ?>
    <?php foreach ($rows as $content): ?>
      <div class="manual-item">
        <?php if ($content['type'] === 'img'): ?>
          <img class="manual-img mt-5" src="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/upload/manual/' . $content['image']; ?>" alt="이미지">
        <?php elseif ($content['type'] === 'txt'): ?>
          <div><?=($content['text']); ?></div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>데이터가 없습니다.</p>
  <?php endif; ?>
  </div>
  </div>




<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>