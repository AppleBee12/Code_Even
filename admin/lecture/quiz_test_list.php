<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

  // 게시글 개수 구하기
  $keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
  $where_clause = '';

  if ($keywords) {
    $where_clause = "WHERE lecture.title LIKE '%$keywords%'";
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
  $quiz_sql = "SELECT exid, title, '퀴즈' AS problem_type, tid, tt, pn, answer, pnlevel, 'admin' AS registered_by FROM quiz $where_clause";

  // test 테이블 데이터 가져오기
  $test_sql = "SELECT exid, title, '시험' AS problem_type, tid, tt, pn, answer, pnlevel, 'admin' AS registered_by FROM test $where_clause";

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
      <input class="form-check-input" type="radio" name="courseType" id="recipeCourse">
      <label class="form-check-label" for="recipeCourse">과정명</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="courseType" id="generalCourse" checked>
      <label class="form-check-label" for="generalCourse">시험지명</label>
    </div>
    <div class="d-flex align-items-center">
    <input name="keywords" type="text" class="form-control" placeholder="검색어를 입력하세요."
    value="<?= $keywords; ?>" ?>
      <button type="button" class="btn lesearch"><i class="bi bi-search"></i></button>
    </div>
  </form>
  <form action="quiz_test_selecdelete.php" method="POST">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">
            <input class="form-check-input" type="checkbox" value="" id="allCheck">
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
        <?php
        if (isset($dataArr)) {
          $total_number = $row_num - $start_num; // 현재 페이지에서 시작 번호 계산
          foreach ($dataArr as $key => $item) {
            ?>
            <tr>
              <th scope="row">
                <input class="form-check-input itemCheckbox" type="checkbox" name="exid[]" value="<?= $item->exid; ?>">
              </th>
              <th scope="row">
                <!-- <input type="hidden" name="exid[]" value="<?= $item->exid; ?>"> -->
                <?= $total_number--; ?>
              </th>
              <td class="title-cell"><?= $item->title; ?></td>
              <td><?= $item->problem_type ?></td>
              <td><?= $item->tt; ?></td>
              <td><?= $usernames[$item->tid] ?></td>
              <td>
                <div class="d-flex justify-content-center gap-4">
                  <!-- 수정 버튼 -->
                  <a href="lecture_edit.php?id=<?= $item->exid; ?>">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                  <!-- 삭제 버튼 -->
                  <a href="lecture_delete.php?id=<?= $item->exid; ?>" onclick="return confirm('이 강좌를 삭제하시겠습니까?');">
                    <i class="bi bi-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            <?php
          }
        }
        ?>
      </tbody>
    </table>
    <div class="d-flex justify-content-end gap-2 mt-20 mb-50">
      <button type="button" id="deleteSelectedBtn" class="btn selecmodify">일괄 삭제</button>
    </div>
  </form>
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
      $('#deleteSelectedBtn').click(function () {
        // 체크된 항목의 exid 값을 배열로 가져오기
        const selectedCheck = $('.itemCheckbox:checked').map(function () {
          return $(this).val();
        }).get();

        if (selectedCheck.length === 0) {
          alert('삭제할 항목을 선택하세요.');
          return;
        }

        // Ajax 요청
        $.ajax({
          url: 'quiz_test_selecdelete.php',
          data: data,
          type: 'POST',
          dataType:'json',
          success: function (response) {
            if (response.success) {
              alert('삭제되었습니다.');
              location.reload();
            } else {
              alert('삭제 실패');
            }
          },
          error: function () {
            alert('서버 요청 중 문제가 발생했습니다.');
          }
        });
      });
    });
  </script>

  <?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');

  ?>