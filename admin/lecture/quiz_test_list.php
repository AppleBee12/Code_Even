<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 사용자 정보 가져오기
$uid = (int) ($_SESSION['UID'] ?? 0);
$user_level = null;

// user_level 확인
if ($uid) {
  $result = $mysqli->query("SELECT user_level FROM user WHERE uid = $uid");
  $user_level = $result ? $result->fetch_object()->user_level : null;
}

// 검색어와 검색 타입 받기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$searchType = isset($_GET['searchType']) ? $_GET['searchType'] : 'title'; // 기본값: 시험지명

// 검색 조건 설정
$where_clause = []; // 배열로 WHERE 절 생성

// 사용자 권한에 따라 필터링
if ($user_level != 100) {
  $where_clause[] = "tid = $uid"; // 일반 사용자는 자신의 글만
}

// 검색어 조건 추가
if ($keywords) {
  if ($searchType === 'lecture') {
    $where_clause[] = "title LIKE '%$keywords%'";
  } elseif ($searchType === 'title') {
    $where_clause[] = "tt LIKE '%$keywords%'";
  }
}

// WHERE 절 최종 조합
$where_sql = count($where_clause) > 0 ? 'WHERE ' . implode(' AND ', $where_clause) : '';

// 페이지 카운트를 검색 조건에 맞게 수정
$page_sql = "SELECT COUNT(*) AS cnt FROM (
    SELECT exid FROM quiz $where_sql
    UNION ALL
    SELECT exid FROM test $where_sql
) AS combined";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

// 페이지네이션 설정
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // 현재 페이지
$list = 10; // 페이지당 항목 수
$start_num = ($page - 1) * $list; // 시작 번호
$block_ct = 5; // 한 블록에 표시할 페이지 수
$block_num = ceil($page / $block_ct);
$block_start = (($block_num - 1) * $block_ct) + 1;
$block_end = $block_start + $block_ct - 1;

$total_page = ceil($row_num / $list); // 전체 페이지 수
$total_block = ceil($total_page / $block_ct);
if ($block_end > $total_page) {
  $block_end = $total_page;
}

// 데이터 가져오기
$quiz_sql = "SELECT exid, title, '퀴즈' AS problem_type, 'quiz' AS type, tid, tt, pn, answer, pnlevel, 'admin' AS registered_by 
             FROM quiz $where_sql";
$test_sql = "SELECT exid, title, '시험' AS problem_type, 'test' AS type, tid, tt, pn, answer, pnlevel, 'admin' AS registered_by 
             FROM test $where_sql";

// 두 쿼리 결합 및 데이터 페이징 처리
$combined_sql = "($quiz_sql) UNION ALL ($test_sql) ORDER BY exid DESC LIMIT $start_num, $list";
$result = $mysqli->query($combined_sql);

// 데이터 저장
$dataArr = [];
while ($row = $result->fetch_object()) {
  $dataArr[] = $row;
}

// 사용자 이름 가져오기
$usernames = [];
if (!empty($dataArr)) {
  $tid_list = implode(',', array_unique(array_map(fn($data) => $data->tid, $dataArr)));

  // user 테이블에서 tid에 해당하는 사용자 이름 가져오기
  $user_sql = "SELECT uid, username FROM user WHERE uid IN ($tid_list)";
  $user_result = $mysqli->query($user_sql);

  while ($user = $user_result->fetch_object()) {
    $usernames[$user->uid] = $user->username; // uid를 키로, username 저장
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
      // 이전 블록 링크
      $previous = $block_start - 1;
      if ($previous > 0) {
        ?>
        <li class="page-item">
          <a class="page-link"
            href="quiz_test_list.php?page=<?= $previous; ?>&keywords=<?= urlencode($keywords); ?>&searchType=<?= $searchType; ?>"
            aria-label="Previous">
            <i class="bi bi-chevron-left"></i>
          </a>
        </li>
        <?php
      }
      ?>
      <?php
      // 페이지 번호 링크
      for ($i = $block_start; $i <= $block_end; $i++) {
        $active = ($page == $i) ? 'active' : '';
        ?>
        <li class="page-item <?= $active; ?>">
          <a class="page-link"
            href="quiz_test_list.php?page=<?= $i; ?>&keywords=<?= urlencode($keywords); ?>&searchType=<?= $searchType; ?>">
            <?= $i; ?>
          </a>
        </li>
        <?php
      }
      // 다음 블록 링크
      $next = $block_end + 1;
      if ($next <= $total_page) {
        ?>
        <li class="page-item">
          <a class="page-link"
            href="quiz_test_list.php?page=<?= $next; ?>&keywords=<?= urlencode($keywords); ?>&searchType=<?= $searchType; ?>"
            aria-label="Next">
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