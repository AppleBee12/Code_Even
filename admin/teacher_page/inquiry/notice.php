<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE notice.title LIKE '%$keywords%' OR user.username LIKE '%$keywords%' OR user.userid LIKE '%$keywords%'";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM notice JOIN user ON notice.uid = user.uid $where_clause";
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

$sql = "SELECT notice.*, user.username, user.userid 
        FROM notice 
        JOIN user ON notice.uid = user.uid 
        $where_clause 
        ORDER BY notice.ntid DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}
?>

<div class="container">
  <h2>전체 공지사항</h2>
  <form action="" method="get" class="row justify-content-end">
    <div class="col-lg-4">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="검색어를 입력하세요." name="keywords"
          value="<?= htmlspecialchars($keywords); ?>">
        <button type="submit" class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </form>

  <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">번호</th>
        <th scope="col">아이디</th>
        <th scope="col">이름</th>
        <th scope="col">제목</th>
        <th scope="col">조회수</th>
        <th scope="col">등록일</th>
        <th scope="col">상태</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($dataArr) {
        foreach ($dataArr as $no) {
          ?>
          <tr>
            <td><?= $no->ntid; ?></td>
            <td><?= $no->userid; ?></td>
            <td><?= $no->username; ?></td>
            <td><a
                href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_modify.php?ntid=<?= $no->ntid; ?>"
                class="underline"><?= $no->title; ?></a></td>
            <td><?= $no->view; ?></td>
            <td><?= $no->regdate; ?></td>
            <td>
              <?php
              $class = $no->status == 'on' ? 'text-bg-success' : 'text-bg-light';
              $text = $no->status == 'on' ? '노출' : '숨김';
              echo "<span class='badge $class'>$text</span>";
              ?>
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

</div>

<!-- //Pagination -->
<div class="list_pagination" aria-label="Page navigation example">
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
      <li class="page-item <?= $active; ?>"><a class="page-link" href="notice.php?page=<?= $i; ?>"><?= $i; ?></a></li>
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

<!-- //상태 변경 모달창 -->
<!-- <div class="modal" id="status_modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">글 상태 변경</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="status_form">
          <table class="table">
            <colgroup>
              <col style="width:110px">
              <col style="width:auto">
            </colgroup>
            <thead class="thead-hidden">
              <tr>
                <th scope="col">구분</th>
                <th scope="col">내용</th>
              </tr>
            </thead>
            <tbody>
              <tr class="none">
                <th scope="row">제목</th>
                <td><input type="text" class="form-control w-75" id="modal_title" readonly></td>
              </tr>
              <tr class="none">
                <th scope="row">상태 <b>*</b></th>
                <td class="d-flex gap-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status_on" value="on">
                    <label class="form-check-label" for="status">
                      노출
                    </label>
                  </div>
                  <div class="form-check">
                    <input class=" form-check-input" type="radio" name="status" id="status_off" value="off">
                    <label class="form-check-label" for="status">
                      숨김
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
        <button type="button" class="btn btn-outline-secondary" id="updateStatusBtn">수정</button>
      </div>
    </div>
  </div>
</div> -->

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>