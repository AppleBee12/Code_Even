<?php
$title = "문의게시판 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$auid = $_SESSION['AUID'];

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';

if($level == 100){
  $where_clause = "";
}
if($level == 10){
  $where_clause = "WHERE user.userid = '$auid'";
}

if ($keywords) {
  $where_clause .= " AND (admin_question.qtitle LIKE '%$keywords%' OR user.username LIKE '%$keywords%' OR user.userid LIKE '%$keywords%')";
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
<?php if ($level == 10): ?>
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
<?php endif; ?>
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

<?php if ($level == 10): ?>
  <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/teacher_page/inquiry/admin_qna_question.php" method="POST">
<?php endif; ?>
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
        <?php if ($level == 100): ?>
          <th scope="col">회원유형</th>
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
        <?php endif; ?>
          <th scope="col">제목</th>
          <th scope="col">분류</th>
          <th scope="col">등록일</th>
          <th scope="col">상태</th>
        </tr>
      </thead>
      <tbody>
      <?php
        if (count($dataArr) > 0) {
          $sequence_number = $row_num - $start_num;  // 순번 계산 시작
          foreach ($dataArr as $ad) {
          ?>
            <tr>
          <?php if ($level == 10): ?>
            <td><?= $sequence_number--; ?></td> <!-- level이 10일 때만 순번 출력 -->
          <?php else: ?>
            <td><?= $ad->aqid; ?></td>
          <?php endif; ?>
            <?php if ($level == 100): ?>
              <td>
                <?php
                $user_levels = [
                  1 => "수강생",
                  10 => "강사"
                ];

                echo isset($user_levels[$ad->user_level]) ? $user_levels[$ad->user_level] : "알 수 없음";
                ?>
              </td>
              <td><?= $ad->userid; ?></td>
              <td><?= $ad->username; ?></td>
            <?php endif; ?>
              <td><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/admin_qna_details.php?aqid=<?= $ad->aqid; ?>"
                  class="underline"><?= $ad->qtitle; ?></a></td>
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

                echo isset($categories[$ad->category]) ? $categories[$ad->category] : "알 수 없음";
                ?>
              </td>
              <td><?= $ad->regdate; ?></td>
              <td>
                <?php
                $class = !empty($ad->aaid) ? 'text-bg-success' : 'text-bg-light';
                $text = !empty($ad->aaid) ? '답변완료' : '답변대기';
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
  <?php if ($level == 10): ?>
    <button type="submit" class="btn btn-secondary ms-auto d-block">등록</button>
  <?php endif; ?>

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
            <a class="page-link" href="admin_qna.php?page=<?= $previous; ?>&keywords=<?= urlencode($keywords); ?>" aria-label="Previous">
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
          <li class="page-item <?= $active; ?>"><a class="page-link" href="admin_qna.php?page=<?= $i; ?>&keywords=<?= urlencode($keywords); ?>"><?= $i; ?></a></li>
          <?php
        }
        $next = $block_end + 1;
        if ($total_block > $block_num) {
          ?>
          <li class="page-item">
            <a class="page-link" href="admin_qna.php?page=<?= $next; ?>&keywords=<?= urlencode($keywords); ?>" aria-label="Next">
              <i class="bi bi-chevron-right"></i>
            </a>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>
<?php if ($level == 10): ?>
  </form>
<?php endif; ?>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>