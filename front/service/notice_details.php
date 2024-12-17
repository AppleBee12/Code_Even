<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');

$ntid = $_GET['ntid'];

$view = "viewed_$ntid";

if (!isset($_SESSION[$view]) || $_SESSION[$view] < strtotime('today')) {

  $viewSql = "UPDATE notice SET view = view + 1 WHERE ntid = $ntid;";
  $mysqli->query($viewSql);

  $_SESSION[$view] = time();
}

$sql = "SELECT * FROM notice WHERE ntid = $ntid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();
?>

<div class="container">
  <div class="service_title">
    <h2 class="headt2">공지사항</h2>
  </div>

  <div class="notice_details">
    <div class="head">
      <h3 class="headt4"><?=$data->title;?></h3>
      <div class="writer">
        <span>글쓴이: <?= ($data->uid == 1) ? '코드이븐' : htmlspecialchars($data->uid); ?></span>
        <span>|</span>
        <span><?=$data->regdate;?></span>
        <span>|</span>
        <span>조회수 <?=$data->view;?></span>
      </div>
    </div>
    <div class="content">
      <p><?=$data->content;?></p>
    </div>
    <div class="bottom">
      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/service/notice.php" class="list"><i class="bi bi-list"></i>목록</a>
    </div>
  </div>
</div>

<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>