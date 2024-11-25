<?php
$title = "수강생 질문";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$teacher_id = $mysqli->real_escape_string($_SESSION['UID']);

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';

if($level == 100){
  $where_clause = '';
}
if($level == 10){
  $where_clause = " WHERE lecture.lecid = '$teacher_id'";
}

if ($keywords) {
  $where_clause .= " AND (student_qna.qtitle LIKE '%$keywords%' 
                          OR lecture.title LIKE '%$keywords%'
                          OR user.username LIKE '%$keywords%'
                          OR user.userid LIKE '%$keywords%')";
}

$page_sql = "SELECT COUNT(*) AS cnt 
            FROM student_qna 
            JOIN class_data ON student_qna.cdid = class_data.cdid 
            JOIN lecture ON class_data.leid = lecture.leid 
            JOIN user ON class_data.uid = user.uid 
            $where_clause";
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

$sql = "SELECT student_qna.*, class_data.*, lecture.*, user.*, teacher_qna.asid 
        FROM student_qna 
        LEFT JOIN teacher_qna ON student_qna.sqid = teacher_qna.sqid 
        JOIN class_data ON student_qna.cdid = class_data.cdid
        JOIN lecture ON class_data.leid = lecture.leid
        JOIN user ON class_data.uid = user.uid 
        $where_clause 
        ORDER BY student_qna.sqid DESC 
        LIMIT $start_num, $list";

$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}

?>

<div class="container">
  <h2>수강생 질문</h2>
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
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
          <th scope="col">제목</th>
        <?php if ($level == 100): ?>
          <th scope="col">강사명</th>
        <?php endif; ?>
          <th scope="col">강의명</th>
          <th scope="col">등록일</th>
          <th scope="col">상태</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (count($dataArr) > 0) {
          $sequence_number = $row_num - $start_num;  // 순번 계산 시작
          foreach ($dataArr as $qna) {
          ?>
            <tr>
          <?php if ($level == 10): ?>
            <td><?= $sequence_number--; ?></td> <!-- level이 10일 때만 순번 출력 -->
          <?php else: ?>
            <td><?= $qna->sqid; ?></td>
          <?php endif; ?>
              <td><?= $qna->userid; ?></td>
              <td><?= $qna->username; ?></td>
              <td><a href="student_question_details.php?sqid=<?= $qna->sqid; ?>" class="underline"><?= mb_strlen($qna->qtitle) > 30 ? mb_substr($qna->qtitle, 0, 30) . '...' : $qna->qtitle; ?></a>
              </td>
            <?php if ($level == 100): ?>
              <td><?= $qna->name; ?></td>
            <?php endif; ?>
              <td><?= mb_strlen($qna->title) > 15 ? mb_substr($qna->title, 0, 15) . '...' : $qna->title; ?></td>
              <td><?= $qna->regdate; ?></td>
              <td>
                <?php
                $class = !empty($qna->asid) ? 'text-bg-success' : 'text-bg-light';
                $text = !empty($qna->asid) ? '답변완료' : '답변대기';
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
            <a class="page-link" href="student_question.php?page=<?= $previous; ?>" aria-label="Previous">
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
          <li class="page-item <?= $active; ?>"><a class="page-link"
              href="student_question.php?page=<?= $i; ?>"><?= $i; ?></a></li>
          <?php
        }
        $next = $block_end + 1;
        if ($total_block > $block_num) {
          ?>
          <li class="page-item">
            <a class="page-link" href="student_question.php?page=<?= $next; ?>" aria-label="Next">
              <i class="bi bi-chevron-right"></i>
            </a>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>

</div>

<script>
  let target = $('#summernote');
  target.summernote({
    height: 400,
  });
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>