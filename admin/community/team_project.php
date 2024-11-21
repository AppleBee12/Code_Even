<?php
$title = "팀 프로젝트";

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE teamproject.titles LIKE '%$keywords%' OR teamproject.contents LIKE '%$keywords%' OR user.usernick LIKE '%$keywords%' ";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM teamproject JOIN user ON teamproject.uid = user.uid $where_clause";
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

$sql = "SELECT teamproject.*, user.uid, user.usernick 
        FROM teamproject 
        JOIN user ON teamproject.uid = user.uid 
        $where_clause 
        ORDER BY teamproject.post_id DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}
?>

<div class="container">
  <h2 class="page_title">팀 프로젝트</h2>
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

  <form action="">
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
          foreach ($dataArr as $tp) {
        ?>
            <tr>
              <th scope="row"><?= $tp->post_id ?></th>
              <td><?= $tp->usernick ?></td>
              <td><a href="#" class="d-inline-block text-truncate"><?= $tp->titles ?></a></td>
              <td><a href="#" class="d-inline-block text-truncate"><?= $tp->contents ?></a></td>
              <td>
                <?= $tp->status == '모집중' ?
                  '<span class="badge text-bg-light">모집중</span>'
                  : '<span class="badge text-bg-danger">모집완료</span>' ?>
              </td>
              <td><?= $tp->likes ?><b>개</b></td>
              <td><?= $tp->comments ?><b>개</b></td>
              <td><?= $tp->hits ?><b>회</b></td>
              <td><?= $tp->regdate ?></td>
              <td class="edit_col">
                <a href="team_project_edit.php?post_id=<?= $tp->post_id ?>">
                  <i class="bi bi-pencil-fill"></i>
                </a>
                <a href="">
                  <i class="bi bi-trash-fill"></i>
                </a>
              </td>
            </tr>
        <?php
          }
        } else {
          echo "<tr><td colspan='8'>검색 결과가 없습니다.</td></tr>";
        }
        ?>
      </tbody>


    </table>
    <!-- //table -->
    <!-- <button type="button" class="btn btn-outline-secondary ms-auto d-block">일괄수정</button> -->
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
          <a class="page-link" href="team_project.php?page=<?= $previous; ?>" aria-label="Previous">
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
        <li class="page-item <?= $active; ?>"><a class="page-link" href="team_project.php?page=<?= $i; ?>"><?= $i; ?></a></li>
      <?php
      }
      $next = $block_end + 1;
      if ($total_block > $block_num) {
      ?>
        <li class="page-item">
          <a class="page-link" href="team_project.php?page=<?= $next; ?>" aria-label="Next">
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