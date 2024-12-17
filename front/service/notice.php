<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');
$service_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/service.js\"></script>";

$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE notice.title LIKE '%$keywords%'";
}

$notice_sql = "SELECT * FROM notice $where_clause";
$notice_result = $mysqli->query($notice_sql);

$dataArr = [];
while ($data = $notice_result->fetch_object()) {
  $dataArr[] = $data;
}
?>
<div class="container">
  <ul class="d-flex justify-content-center service_tab">
    <li class="nav_list">
      <a class="nav_item" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/service/faq.php">FAQ</a>
    </li>
    <li class="nav_list_active">
      <a class="nav_item" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/service/notice.php">공지사항</a>
    </li>
  </ul>

  <div class="service_title">
    <h2 class="headt2">공지사항</h2>
    <div class="d-flex justify-content-center">
      <div class="content">
        <div class="title">
          <h3 class="headt3">코드이븐에서 알려드리는 소식입니다.</h3>
          <h4 class="headt6">이곳에서 새로운 소식을 만나보세요!</h4>
        </div>
        <div class="search">
          <form action="#" class="d-flex align-items-center">
            <button type="submit"><i class="bi bi-search"></i></button type="submit">
            <input type="text" class="form-control" placeholder="검색어를 입력해주세요" name="keywords"
            value="<?= htmlspecialchars($keywords); ?>">
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="notice_content">
    <?php if ($keywords): ?>
    <p>“<?= htmlspecialchars($keywords); ?>” 관련 공지사항 검색 결과가 총 <em><?= count($dataArr); ?></em>건 있습니다.</p>
    <?php endif; ?>

    <div class="notice_list">
      <?php
        foreach ($dataArr as $data) {
      ?>
      <div class="notice_item">
        <a href="">
          <div class="title">
            <i class="bi bi-pin-angle-fill headt6"></i><span class="headt6"><?=$data->title;?></span>
          </div>
        </a>
        <div class="">
          <span>글쓴이: <?= ($data->uid == 1) ? '코드이븐' : htmlspecialchars($data->uid); ?></span>
          <span><?=$data->title;?></span>
        </div>
      </div>
      <?php
        }
      ?>
    </div>

  </div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');?>