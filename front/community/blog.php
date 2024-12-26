<?php
$title = '블로그';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';
// 키워드 검색
if ($keywords) {
  $where_clause = "WHERE blog.titles LIKE '%$keywords%' OR blog.contents LIKE '%$keywords%' OR user.usernick LIKE '%$keywords%' ";
}
$page_sql = "SELECT COUNT(*) AS cnt FROM blog JOIN user ON blog.uid = user.uid $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

// 페이지네이션
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$list = 12;
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

$sql = "SELECT blog.*, user.uid, user.usernick 
        FROM blog 
        JOIN user ON blog.uid = user.uid 
        $where_clause 
        ORDER BY blog.post_id DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}

?>

<div class="container">
  <div class="community_title d-flex flex-column gap-5">
    <h3 class="headt3"><?= $title ?></h3>
    <div class="d-flex justify-content-center align-items-center">
      <div class="content d-flex flex-column gap-3 mx-auto">
        <div class="title">
          <div class="headt3">IT분야의 이슈와 코드이븐의 소식을 만나보세요</div>
          <div class="headt6">새로운 IT컨텐츠를 소개하고, 코드이븐만의 컨텐츠와 소식을 공유하는 공간입니다.</div>
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


  <div class="community_contents_wrapper">
    <div class="row d-flex justify-content-between align-items-center">
      <p class="keywords col-11">
        <?php if ($keywords): ?>
          “<?= htmlspecialchars($keywords); ?>” 관련 <?= $title ?> 검색 결과가 총 <em><?= count($dataArr); ?></em>건 있습니다.
        <?php endif; ?>
      </p>
    </div>
    <div class="d-flex flex-column justify-content-center">

      <div class="blog_content">
        <div class="row d-flex">
          <?php
          if ($dataArr) {
            foreach ($dataArr as $blog) {
          ?>
              <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/community/blog_detail.php?post_id=<?= $blog->post_id ?>" class="col-3 card_wrapper mb-5">
                <div class="card">
                  <img src="http://<?= $_SERVER['HTTP_HOST']; ?><?= $blog->thumbnails ?>" class="card-img-top" alt="">
                  <div class="blog_txt card-body card_wrapper">
                    <p class="card-title headt6 multi-2line-ellipsis"><?= $blog->post_id ?>. <?= strip_tags($blog->titles) ?></p>
                    <p class="card-text subtitle1 multi-3line-ellipsis"><?= strip_tags($blog->contents) ?></p><!-- 본문 html태그 적용되어있어 strip_tag사용 -->
                    <div class="d-flex justify-content-between mt-3">
                      <div class="d-flex gap-2 justify-content-between">
                        <p class="d-flex gap-1"><i class="bi bi-eye"></i> <?= $blog->hits ?></p>
                        <p class="d-flex gap-1"><i class="bi bi-chat-dots"></i> <?= $blog->comments ?></p>
                        <p class="d-flex gap-1"><i class="bi bi-hand-thumbs-up"></i> <?= $blog->likes ?></p>
                      </div>
                      <p><?= date('Y-m-d', strtotime($blog->regdate)) ?></p>
                    </div>
                  </div>
                </div>
              </a>
          <?php
            }
          } else {
            echo "<li>검색 결과가 없습니다.</li>";
          }
          ?>
        </div>
      </div>

    </div>





    <!-- //Pagination -->
    <div class="list_pagination" aria-label="Page_navigation">
      <ul class="pagination d-flex justify-content-center">
        <?php
        $previous = $block_start - $block_ct;
        if ($previous < 1) $previous = 1;
        if ($block_num > 1) {
        ?>
          <li class="page-item">
            <a class="page-link" href="blog.php?page=<?= $previous; ?>" aria-label="Previous">
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
          <li class="page-item <?= $active; ?>"><a class="page-link" href="blog.php?page=<?= $i; ?>"><?= $i; ?></a></li>
        <?php
        }
        $next = $block_end + 1;
        if ($total_block > $block_num) {
        ?>
          <li class="page-item">
            <a class="page-link" href="blog.php?page=<?= $next; ?>" aria-label="Next">
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

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>