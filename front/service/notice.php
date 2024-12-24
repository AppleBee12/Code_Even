<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');
$service_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/service.js\"></script>";

$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE notice.title LIKE '%$keywords%'";
}

$page_sql = "SELECT COUNT(*) AS cnt 
            FROM notice $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

// 페이지네이션
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$list = 10;
$start_num = ($page - 1) * $list;
$block_ct = 5;
$block_num = ceil($page / $block_ct);
$block_start = (($block_num - 1) * $block_ct) + 1;
$block_end = $block_start + $block_ct - 1;

$total_page = ceil($row_num / $list);
$total_block = ceil($total_page / $block_ct);
if ($block_end > $total_page) {
  $block_end = $total_page;
}

$notice_sql = "
    SELECT * FROM notice 
    $where_clause 
    ORDER BY fix DESC, ntid DESC 
    LIMIT $start_num, $list
    ";
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
      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/service/notice_details.php?ntid=<?= $data->ntid; ?>">
        <div class="notice_item">
          <div class="title">
            <?php if ($data->fix == 1): ?>
              <i class="bi bi-pin-angle-fill headt6"></i>
            <?php endif; ?>
            <span class="headt6"><?=$data->title;?></span>
          </div>
          <div class="writer">
            <span>글쓴이: <?= ($data->uid == 1) ? '코드이븐' : htmlspecialchars($data->uid); ?></span>
            <span>|</span>
            <span><?=$data->regdate;?></span>
            <span>|</span>
            <span>조회수 <?=$data->view;?></span>
          </div>
        </div>
      </a>
      <?php
        }
      ?>
    </div>

    <!-- //Pagination -->
    <div class="list_pagination">
      <ul class="pagination d-flex justify-content-center">
        <?php
        $previous = $block_start - $block_ct;
        if ($previous < 1)
          $previous = 1;
        if ($block_num > 1) {
          ?>
          <li class="page-item">
            <a class="page-link" href="notice.php?page=<?= $previous; ?>" aria-label="Previous">
              <i class="bi bi-chevron-left"></i>
            </a>
          </li>
          <?php
        }
        ?>
        <?php
        for ($i = $block_start; $i <= $block_end; $i++) {
          $active = ($page == $i) ? 'active' : '';
          ?>
          <li class="page-item <?= $active; ?>"><a class="page-link" href="notice.php?page=<?= $i; ?>"><?= $i; ?></a>
          </li>
          <?php
        }
        $next = $block_end + 1;
        if ($total_block > $block_num) {
          ?>
          <li class="page-item">
            <a class="page-link" href="notice.php?page=<?= $next; ?>" aria-label="Next">
              <i class="bi bi-chevron-right"></i>
            </a>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>

  </div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');?>