<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE admin_question.qtitle LIKE '%$keywords%' OR user.username LIKE '%$keywords%' OR user.userid LIKE '%$keywords%'";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM admin_question JOIN user ON admin_question.uid = user.uid $where_clause";
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

$sql = "SELECT admin_question.*, user.username, user.userid, user.user_level, admin_answer.aaid 
        FROM admin_question 
        JOIN user ON admin_question.uid = user.uid 
        LEFT JOIN admin_answer ON admin_question.aqid = admin_answer.aqid 
        $where_clause 
        ORDER BY admin_question.aqid DESC 
        LIMIT $start_num, $list";

$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}
?>

<div class="container">
  <div class="description d-flex">
    <i class="bi bi-chat-right-dots"></i>
    <div class="d-flex flex-column gap-3">
      <strong>진행 프로세스 : 답변대기<i class="bi bi-arrow-right-short"></i>답변완료</strong>
      <ul>
        <li>1:1 문의 게시판에 글을 등록 시 처음은 답변대기 상태, 관리자가 답변시 답변완료 상태로 변경됩니다.</li>
        <li>관리자는 해당 내용을 정확히 검토하여 답변을 드리고 있습니다.</li>
      </ul>
    </div>
  </div>
  <h2>1:1 문의</h2>
  <form class="row justify-content-end">
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
        <th scope="col">제목</th>
        <th scope="col">분류</th>
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
            <td><?= $no->aqid; ?></td>
            <td><a
                href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/admin_qna_details.php?aqid=<?= $no->aqid; ?>"
                class="underline"><?= $no->qtitle; ?></a></td>
            <td>
              <?php
              $categories = [
                1 => "결제/환불",
                2 => "강의",
                3 => "쿠폰",
                4 => "가입/탈퇴",
                5 => "기타",
                6 => "수료",
                7 => "정산",
                8 => "강사"
              ];

              echo isset($categories[$no->category]) ? $categories[$no->category] : "알 수 없음";
              ?>
            </td>
            <td><?= $no->regdate; ?></td>
            <td>
              <?php
              $class = !empty($no->aaid) ? 'text-bg-success' : 'text-bg-light';
              $text = !empty($no->aaid) ? '답변완료' : '답변대기';
              echo "<span class='badge $class'>$text</span>";
              ?>
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
  <div class="d-flex justify-content-end">
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/teacher_page/inquiry/admin_qna_write.php"
      class="btn btn-secondary">등록</a>
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

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>