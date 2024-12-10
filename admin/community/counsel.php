<?php
$title = "고민 상담";

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

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
  <h2 class="page_title">고민 상담</h2>
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

  <form action="counsel_edit.php" method="POST">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">닉네임</th>
          <th scope="col">제목</th>
          <th scope="col">내용</th>
          <th scope="col">상태</th>
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
          foreach ($dataArr as $counsel) {
        ?>
            <tr>
              <th scope="row"><?= $counsel->post_id ?></th>
              <td><?= $counsel->usernick ?></td>
              <td><a href="#" class="d-inline-block text-truncate"><?= $counsel->titles ?></a></td>
              <!-- 본문에 html태그가 적용되어있어서 strip_tags적용시킴 -->
              <td><a href="#" class="d-inline-block text-truncate"><?= strip_tags($counsel->contents) ?></a></td>
              <td>
                <?= $counsel->status == 0 ?
                  '<span class="badge text-bg-light">미해결</span>'
                  : '<span class="badge text-bg-success">해결</span>' ?>
              </td>
              <td><?= $counsel->likes ?><b>개</b></td>
              <td><?= $counsel->comments ?><b>개</b></td>
              <td><?= $counsel->hits ?><b>회</b></td>
              <td><?= $counsel->regdate ?></td>
              <td class="edit_col">
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/counsel_edit.php?post_id=<?= $counsel->post_id ?>">
                  <i class="bi bi-pencil-fill"></i>
                </a>
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/counsel_delete.php?post_id=<?= $counsel->post_id ?>">
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
  </form>

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


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>