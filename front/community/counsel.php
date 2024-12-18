<?php
$title = '고민상담';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');


// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';
//키워드 검색
if ($keywords) {
  $where_clause = "WHERE counsel.titles LIKE '%$keywords%' OR counsel.contents LIKE '%$keywords%' OR user.usernick LIKE '%$keywords%' ";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM counsel JOIN user ON counsel.uid = user.uid $where_clause";
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

$sql = "SELECT counsel.*, user.uid, user.usernick 
        FROM counsel 
        JOIN user ON counsel.uid = user.uid 
        $where_clause 
        ORDER BY counsel.post_id DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}

?>
<div class="container">
  <div class="community_title">
    <h2 class="headt2">고민상담</h2>
    <div class="d-flex justify-content-center">
      <div class="content">
        <div class="title">
          <h3 class="headt3">이야기를 나누고 토론해보세요?</h3>
          <h4 class="headt6">최신IT정보부터 커리어 고민까지 궁금한 점을 자유롭게 이야기하세요.</h4>
        </div>
        <!-- //키워드 검색 -->
        <div class="search">
          <form method="GET" class="d-flex align-items-center">
            <button type="button"><i class="bi bi-search"></i></button>
            <input type="text" class="form-control" placeholder="검색어를 입력해주세요" name="keywords" value="<?= htmlspecialchars($keywords); ?>">
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="counsel_contents_wrapper">
    <?php if ($keywords): ?>
      <p>“<?= htmlspecialchars($keywords); ?>” 관련 <?=$title?> 검색 결과가 총 <em><?= count($dataArr); ?></em>건 있습니다.</p>
      
        <!-- <p>“<?= htmlspecialchars($keywords); ?>” 관련 <?=$title?> 검색 결과가 없습니다.</p> -->
      <?php endif; ?>
    <ul class="d-flex flex-column justify-content-center">
    <?php
        if ($dataArr) {
          foreach ($dataArr as $counsel) {
        ?>
      <li class="counsel_content">
        <div>
          <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/community/counsel_detail.php?post_id=<?= $counsel->post_id ?>" class="row">
            <div class="counsel_txt col-10">
              <p class="headt5 d-inline-block text-truncate"><?= $counsel->post_id ?>. <?= $counsel->titles ?></p>
              <p class="d-inline-block text-truncate"><?= strip_tags($counsel->contents) ?></p><!-- 본문 html태그 적용되어있어 strip_tag사용 -->
              <div class="d-flex">
                <p>닉네임: <?= $counsel->usernick ?> |</p>
                <p> 작성일: <?= $counsel->regdate ?></p>
              </div>
            </div>
            <div class="counsel_btn col-2">
              <div class="d-flex justify-content-between">
                <p><i class="bi bi-eye"></i> <?= $counsel->hits ?></p>  
                <p><i class="bi bi-chat-dots"></i> <?= $counsel->comments ?></p>
                <p><i class="bi bi-hand-thumbs-up"></i> <?= $counsel->likes ?></p>
              </div>
              <?= $counsel->status == 0 ?
                  '<span class="badge text-bg-light">미해결</span>'
                  : '<span class="badge text-bg-success">해결</span>' ?>
            </div>
          </a>
        </div>
      </li>
      <?php
          }
        } else {
          echo "<li>검색 결과가 없습니다.</li>";
        }
        ?>
    </ul>





      <!-- //Pagination -->
  <div class="list_pagination" aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
      <?php
      $previous = $block_start - $block_ct;
      if ($previous < 1) $previous = 1;
      if ($block_num > 1) {
      ?>
        <li class="page-item">
          <a class="page-link" href="counsel.php?page=<?= $previous; ?>" aria-label="Previous">
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
        <li class="page-item <?= $active; ?>"><a class="page-link" href="counsel.php?page=<?= $i; ?>"><?= $i; ?></a></li>
      <?php
      }
      $next = $block_end + 1;
      if ($total_block > $block_num) {
      ?>
        <li class="page-item">
          <a class="page-link" href="counsel.php?page=<?= $next; ?>" aria-label="Next">
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

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>

