<?php
$title = "블로그";

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE blog.titles LIKE '%$keywords%' OR blog.contents LIKE '%$keywords%' OR user.usernick LIKE '%$keywords%' ";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM blog JOIN user ON blog.uid = user.uid $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

// 페이지네이션
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$list = 5;
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
  <h2 class="page_title">블로그</h2>
  <form action="" id="search_form" class="row justify-content-end">
    <div class="col-lg-3">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="검색어를 입력하세요." name="keywords" value="<?= htmlspecialchars($keywords); ?>">
        <button type="button" class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </form>


  <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/blog_write.php" method="GET">
    <!-- <input type="hidden" name="post" value="blog"> -->
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">글번호</th>
          <th scope="col">썸네일</th>
          <th scope="col">제목</th>
          <th scope="col">내용</th>
          <th scope="col">좋아요</th>
          <th scope="col">댓글수</th>
          <th scope="col">조회수</th>
          <th scope="col">작성일</th>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($dataArr) {
          foreach ($dataArr as $blog) {
        ?>
            <tr>
              <th scope="row"><?= $blog->post_id ?></th>
              <td class="img"> <img src="http://<?= $_SERVER['HTTP_HOST'] . $blog->thumbnails ?>" alt=""></td>
              <td><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/blog_edit.php?post_id=<?= $blog->post_id ?>" class="d-inline-block text-truncate"><?= strip_tags($blog->titles) ?></a></td>
              <td><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/blog_edit.php?post_id=<?= $blog->post_id ?>" class="d-inline-block text-truncate"><?= strip_tags($blog->contents) ?></a></td>
              <td><?= $blog->likes ?><b>개</b></td>
              <td><?= $blog->comments ?><b>개</b></td>
              <td><?= $blog->hits ?><b>회</b></td>
              <td><?= $blog->regdate ?></td>
              <td class="edit_col">
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/blog_edit.php?post_id=<?= $blog->post_id ?>">
                  <i class="bi bi-pencil-fill"></i>
                </a>
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/blog_delete.php?post_id=<?= $blog->post_id ?>">
                  <i class="bi bi-trash-fill"></i>
                </a>
              </td>
            </tr>
        <?php
          }
        } else {
          echo "<tr><td colspan='10'>검색 결과가 없습니다.</td></tr>";
        }
        ?>
      </tbody>
    </table>
    <!-- //table -->
    <button type="submit" class="btn btn-secondary ms-auto d-block">등록</button>
  </form>

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


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>