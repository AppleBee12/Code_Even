<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE faq.title LIKE '%$keywords%' OR user.username LIKE '%$keywords%' OR user.userid LIKE '%$keywords%'";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM faq JOIN user ON faq.uid = user.uid $where_clause";
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

$sql = "SELECT faq.*, user.username, user.userid 
        FROM faq 
        JOIN user ON faq.uid = user.uid 
        $where_clause 
        AND faq.target = 'student' 
        ORDER BY faq.fqid DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}

?>

<div class="container">
  <h2>수강생 FAQ</h2>
  <form action="" method="GET" class="row justify-content-end">
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
        <th scope="col">분류</th>
        <th scope="col">제목</th>
        <th scope="col">조회수</th>
        <th scope="col">등록일</th>
        <th scope="col">상태</th>
        <th scope="col">관리</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($dataArr)) {
        foreach ($dataArr as $faq) {
          ?>
          <tr>
            <td><?= $faq->fqid; ?></td>
            <td><?= $faq->userid; ?></td>
            <td><?= $faq->username; ?></td>
            <td>
              <?php
              echo $faq->category == 1 ? "결제/환불" :
                ($faq->category == 2 ? "강의" :
                ($faq->category == 3 ? "쿠폰" :
                ($faq->category == 4 ? "가입/탈퇴" :
                ($faq->category == 5 ? "기타" :
                ($faq->category == 6 ? "수료" :
                ($faq->category == 7 ? "정산" :
                ($faq->category == 8 ? "강사" : "알 수 없음")))))));
              ?>
            </td>
            <td>
              <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/faq_modify.php?fqid=<?= $faq->fqid; ?>"
                class="underline"><?= $faq->title; ?></a>
            </td>
            <td><?= $faq->view; ?></td>
            <td><?= $faq->regdate; ?></td>
            <td>
              <?php
              $class = $faq->status == 'on' ? 'text-bg-success' : 'text-bg-light';
              $text = $faq->status == 'on' ? '노출' : '숨김';
              echo "<span class='badge $class'>$text</span>";
              ?>
            </td>
            <td class="edit_col">
              <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/faq_modify.php?fqid=<?= $faq->fqid; ?>">
                <i class="bi bi-pencil-fill"></i>
              </a>
              <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/faq_delete.php?fqid=<?= $faq->fqid; ?>">
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

  <div class="d-flex justify-content-end gap-2">
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/faq_write.php?target=student"
      class="btn btn-secondary">등록</a>
  </div>

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
        <a class="page-link" href="student_faq.php?page=<?= $previous; ?>" aria-label="Previous">
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
      <li class="page-item <?= $active; ?>"><a class="page-link" href="student_faq.php?page=<?= $i; ?>"><?= $i; ?></a>
      </li>
      <?php
    }
    $next = $block_end + 1;
    if ($total_block > $block_num) {
      ?>
      <li class="page-item">
        <a class="page-link" href="teacher_faq.php?page=<?= $next; ?>" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </a>
      </li>
      <?php
    }
    ?>
  </ul>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>