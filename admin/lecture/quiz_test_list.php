<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 검색어와 검색 타입 받기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$searchType = isset($_GET['searchType']) ? $_GET['searchType'] : 'title'; // 기본값: 시험지명

$where_clause = '';

// 검색 조건 설정
if ($keywords) {
  if ($searchType === 'lecture') {
    // 강좌명 검색
    $quiz_where_clause = "WHERE quiz.title LIKE '%$keywords%'";
    $test_where_clause = "WHERE test.title LIKE '%$keywords%'";
  } elseif ($searchType === 'title') {
    // 시험지명 검색
    $quiz_where_clause = "WHERE quiz.tt LIKE '%$keywords%'";
    $test_where_clause = "WHERE test.tt LIKE '%$keywords%'";
  }
} else {
  // 검색어가 없을 경우 조건 제거
  $quiz_where_clause = '';
  $test_where_clause = '';
}

$page_sql = "SELECT COUNT(*) AS cnt FROM (
    SELECT exid FROM quiz
    UNION ALL
    SELECT exid FROM test
  ) AS combined $where_clause";
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

// quiz 테이블 데이터 가져오기
$quiz_sql = "SELECT exid, title, '퀴즈' AS problem_type, 'quiz' AS type, tid, tt, pn, answer, pnlevel, 'admin' AS registered_by 
             FROM quiz $quiz_where_clause";

// test 테이블 데이터 가져오기
$test_sql = "SELECT exid, title, '시험' AS problem_type, 'test' AS type, tid, tt, pn, answer, pnlevel, 'admin' AS registered_by 
             FROM test $test_where_clause";

// 두 쿼리를 UNION으로 합치기
$combined_sql = "($quiz_sql) UNION ALL ($test_sql) ORDER BY exid DESC LIMIT $start_num, $list";
$result = $mysqli->query($combined_sql);

// 데이터 저장
$dataArr = [];
while ($row = $result->fetch_object()) {
  $dataArr[] = $row;
}

// tid를 기준으로 user 테이블에서 username 가져오기
$usernames = [];
if (!empty($dataArr)) {
  // dataArr에서 tid 목록 추출, 중복 제거 후 콤마로 연결
  $tid_list = implode(',', array_unique(array_map(fn($data) => $data->tid, $dataArr)));

  // user 테이블에서 username 가져오기
  $user_sql = "SELECT uid, username FROM user WHERE uid IN ($tid_list)";
  $user_result = $mysqli->query($user_sql);

  while ($user = $user_result->fetch_object()) {
    $usernames[$user->uid] = $user->username; // uid를 키로, username을 값으로 저장
  }
}

?>

<div class="container">
  <h2>퀴즈 / 시험 목록</h2>
  <form action="" method="GET" class="d-flex justify-content-end align-items-center gap-4 mb-3">
    <p class="mb-0">퀴즈 / 시험 검색</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="searchType" value="lecture" id="searchLecture"
        <?= isset($_GET['searchType']) && $_GET['searchType'] == 'lecture' ? 'checked' : '' ?>>
      <label class="form-check-label" for="searchLecture">과정명</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="searchType" value="title" id="searchTitle"
        <?= !isset($_GET['searchType']) || $_GET['searchType'] == 'title' ? 'checked' : '' ?>>
      <label class="form-check-label" for="searchTitle">시험지명</label>
    </div>
    <div class="d-flex align-items-center">
      <input name="keywords" type="text" class="form-control" placeholder="검색어를 입력하세요."
        value="<?= htmlspecialchars($keywords); ?>">
      <button type="submit" class="btn lesearch"><i class="bi bi-search"></i></button>
    </div>
  </form>
  <form id="bulkDeleteForm" action="quiz_test_delete_bulk.php" method="POST">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">
            <input class="form-check-input" type="checkbox" id="selectAll"> <!-- 전체 선택 -->
          </th>
          <th scope="col">번호</th>
          <th scope="col">강좌명</th>
          <th scope="col">문제 유형</th>
          <th scope="col">시험지명</th>
          <th scope="col">등록자</th>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($dataArr as $item): ?>
          <tr>
            <td>
              <input class="form-check-input itemCheckbox" type="checkbox" name="exid[]" value="<?= $item->exid; ?>">
            </td>
            <td><?= $item->exid; ?></td>
            <td class="title-cell"><?= $item->title; ?></td>
            <td><?= $item->problem_type; ?></td>
            <td><?= $item->tt; ?></td>
            <td><?= $usernames[$item->tid] ?? '관리자'; ?></td>
            <td>
              <div class="d-flex justify-content-center gap-4">
                <a href="quiz_test_edit.php?id=<?= $item->exid; ?>&type=<?= $item->type; ?>">
                  <i class="bi bi-pencil-fill"></i>
                </a>
                <a href="quiz_test_delete.php?id=<?= $item->exid; ?>&type=<?= $item->type; ?>"
                   onclick="return confirm('이 항목을 삭제하시겠습니까?');">
                  <i class="bi bi-trash"></i>
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="d-flex justify-content-end">
      <button type="button" id="deleteSelectedBtn" class="btn selecmodify">일괄 삭제</button>
    </div>
  </form>

  <!-- Pagination -->
  <div class="list_pagination" aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
      <?php
      $previous = $block_start - $block_ct;
      if ($previous < 1)
        $previous = 1;
      if ($block_num > 1) {
        ?>
        <li class="page-item">
          <a class="page-link" href="lecture_list.php?page=<?= $previous; ?>" aria-label="Previous">
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
        <li class="page-item <?= $active; ?>">
          <a class="page-link" href="lecture_list.php?page=<?= $i; ?>"><?= $i; ?></a>
        </li>
        <?php
      }
      $next = $block_end + 1;
      if ($total_block > $block_num) {
        ?>
        <li class="page-item">
          <a class="page-link" href="lecture_list.php?page=<?= $next; ?>" aria-label="Next">
            <i class="bi bi-chevron-right"></i>
          </a>
        </li>
        <?php
      }
      ?>
    </ul>
  </div>

  <script>
    $('.title-cell').each(function () {
      const originalText = $(this).text().trim(); // 셀의 원래 텍스트를 가져옴
      if (originalText.length > 20) {
        $(this).text(originalText.substring(0, 20) + '...'); // 20자 이후 잘라내고 ... 추가
      }
    });

    $(document).ready(function () {
      // 전체 선택 / 해제
      $('#selectAll').on('change', function () {
        $('.itemCheckbox').prop('checked', $(this).prop('checked'));
      });

      // 개별 체크박스 해제 시 "전체 선택" 체크박스 해제
      $('.itemCheckbox').on('change', function () {
        if (!$(this).prop('checked')) {
          $('#selectAll').prop('checked', false);
        }
      });

      // "일괄 삭제" 버튼 클릭
      $('#deleteSelectedBtn').on('click', function () {
        const selectedCheckboxes = $('.itemCheckbox:checked');

        if (selectedCheckboxes.length === 0) {
          alert('삭제할 항목을 선택하세요.');
          return;
        }

        if (confirm('선택한 항목을 삭제하시겠습니까?')) {
          $('#bulkDeleteForm').submit(); // 폼 제출
        }
      });
    });
  </script>

  <?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');

  ?>