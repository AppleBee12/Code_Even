<?php

$title = "강좌 목록";

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$uid = (int) ($_SESSION['UID'] ?? 0);

// user_level 확인
$user_level = null;
if ($uid) {
  $result = $mysqli->query("SELECT user_level FROM user WHERE uid = $uid");
  $user_level = $result ? $result->fetch_object()->user_level : null;
}

// 사용자 필터링
$user_filter = ($user_level == 100) ? "" : "lecid = $uid";

// 검색어 필터링
$keywords = isset($_GET['keywords']) ? $_GET['keywords'] : '';
$search_filter = $keywords ? "title LIKE '%$keywords%'" : "";

// 최종 WHERE 절 조합
$conditions = [];
if ($user_filter)
  $conditions[] = $user_filter;
if ($search_filter)
  $conditions[] = $search_filter;

$where_clause = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";

// 게시글 개수 구하기
$page_sql = "SELECT COUNT(*) AS cnt FROM lecture $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

// 페이지네이션
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
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

// 강좌 목록 불러오기
$sql = "SELECT leid, image, title, name, period, course_type, isbest, isnew, state 
        FROM lecture $where_clause 
        ORDER BY leid DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}

?>


<div class="container">
  <h2>강좌 목록</h2>
  <form action="" class="d-flex justify-content-end">
    <div class="d-flex w-25 mb-3">
      <input type="text" class="form-control" placeholder="검색어를 입력하세요." name="keywords" value="<?= $keywords; ?>">
      <button type="button" class="btn lesearch"><i class="bi bi-search"></i></button>
    </div>
  </form>
  <form action="best_new_modify.php" method="POST">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">이미지</th>
          <th scope="col">강좌명</th>
          <th scope="col">등록자</th>
          <th scope="col">학습 기간</th>
          <th scope="col">강좌 유형</th>
          <th scope="col">강좌 전시 옵션</th>
          <th scope="col">상태</th>
          <?php if ($user_level == 100): ?>
            <th scope="col">승인</th>
          <?php endif; ?>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($dataArr) && count($dataArr) > 0): ?>
          <?php foreach ($dataArr as $index => $item): ?>
            <tr>
              <!-- 게시물 번호 (페이지별 순차 번호) -->
              <th scope="row">
                <input type="hidden" name="leid[]" value="<?= htmlspecialchars($item->leid); ?>">
                <?= $row_num - $start_num - $index; ?>
              </th>

              <!-- 강좌 이미지 -->
              <td class="lecture-img">
                <img src="<?= htmlspecialchars($item->image); ?>" alt="강좌 이미지">
              </td>

              <!-- 강좌명 -->
              <td class="title-cell"><?= htmlspecialchars($item->title); ?></td>

              <!-- 등록자 -->
              <td><?= htmlspecialchars($item->name); ?></td>

              <!-- 학습 기간 -->
              <td><?= htmlspecialchars($item->period); ?>일</td>

              <!-- 강좌 유형 -->
              <td>
                <div>
                  <?php if ($item->course_type === 'general'): ?>
                    <span class="badge text-bg-secondary">일반</span>
                  <?php elseif ($item->course_type === 'recipe'): ?>
                    <span class="badge recipe">레시피</span>
                  <?php endif; ?>
                </div>
              </td>

              <!-- 베스트 및 추천 체크박스 -->
              <td>
                <div class="form-check d-inline-block me-2">
                  <input type="hidden" name="isbest[<?= htmlspecialchars($item->leid); ?>]" value="0">
                  <input class="form-check-input" type="checkbox" id="isbest[<?= htmlspecialchars($item->leid); ?>]"
                    name="isbest[<?= htmlspecialchars($item->leid); ?>]" value="1" <?= $item->isbest ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="isbest[<?= htmlspecialchars($item->leid); ?>]">베스트</label>
                </div>
                <div class="form-check d-inline-block">
                  <input type="hidden" name="isnew[<?= htmlspecialchars($item->leid); ?>]" value="0">
                  <input class="form-check-input" type="checkbox" id="isnew[<?= htmlspecialchars($item->leid); ?>]"
                    name="isnew[<?= htmlspecialchars($item->leid); ?>]" value="1" <?= $item->isnew ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="isnew[<?= htmlspecialchars($item->leid); ?>]">추천</label>
                </div>
              </td>

              <!-- 상태 표시 -->
              <td>
                <span id="status-badge-<?= htmlspecialchars($item->leid); ?>"
                  class="badge <?= $item->state == 2 ? 'text-bg-secondary' : 'waitopen'; ?>">
                  <?= $item->state == 2 ? '개설' : '개설 대기'; ?>
                </span>
              </td>

              <!-- 관리자 전용 토글 스위치 -->
              <?php if ($user_level == 100): ?>
                <td>
                  <div class="d-flex justify-content-center align-items-center">
                    <div class="form-check form-switch">
                      <input id="toggle-<?= htmlspecialchars($item->leid); ?>" class="form-check-input tog toggle-switch"
                        type="checkbox" role="switch" data-id="<?= htmlspecialchars($item->leid); ?>" <?= $item->state == 2 ? 'checked' : ''; ?>>
                    </div>
                  </div>
                </td>
              <?php endif; ?>

              <!-- 수정 및 삭제 버튼 -->
              <td>
                <div class="d-flex justify-content-center gap-4">
                  <a href="lecture_edit.php?id=<?= htmlspecialchars($item->leid); ?>">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                  <a href="lecture_delete.php?id=<?= htmlspecialchars($item->leid); ?>"
                    onclick="return confirm('이 강좌를 삭제하시겠습니까?');">
                    <i class="bi bi-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="10" class="text-center text-muted">등록된 강좌가 없습니다.</td>
          </tr>
        <?php endif; ?>

      </tbody>
    </table>
    <div class="d-flex justify-content-end gap-2 mt-20 mb-50">
      <button type="button" class="btn selecmodify">일괄 수정</button>
      <a href="lecture_up.php" type="button" class="btn nlecture">강좌 등록</a>
    </div>
  </form>
  <!-- Pagination -->
  <div class="list_pagination" aria-label="Page_navigation">
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
      <?php } ?>
      <?php
      for ($i = $block_start; $i <= $block_end; $i++) {
        $active = ($page == $i) ? 'active' : '';
        ?>
        <li class="page-item <?= $active; ?>">
          <a class="page-link" href="lecture_list.php?page=<?= $i; ?>"><?= $i; ?></a>
        </li>
      <?php } ?>
      <?php
      $next = $block_end + 1;
      if ($total_block > $block_num) {
        ?>
        <li class="page-item">
          <a class="page-link" href="lecture_list.php?page=<?= $next; ?>" aria-label="Next">
            <i class="bi bi-chevron-right"></i>
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>
</div>
<script>
  $('.toggle-switch').on('change', function () {
    const lectureId = $(this).data('id'); // 강좌 ID
    const isChecked = $(this).prop('checked'); // 토글 상태
    const newState = isChecked ? 2 : 1; // 상태 값 설정 (2: 개설, 1: 개설 대기)
    const $statusBadge = $(`#status-badge-${lectureId}`); // 상태 배지 선택

    $.ajax({
      url: '/code_even/admin/lecture/lecture_toggle.php',
      type: 'POST',
      data: JSON.stringify({ id: lectureId, state: newState }),
      contentType: 'application/json',
      dataType: 'json',
      success: function (response) {
        if (response.success) {
          // 상태 배지 업데이트
          if (newState === 2) {
            $statusBadge
              .text('개설')
              .removeClass('waitopen')
              .addClass('text-bg-secondary');
          } else {
            $statusBadge
              .text('개설 대기')
              .removeClass('text-bg-secondary')
              .addClass('waitopen');
          }
        } else {
          alert('상태 변경에 실패했습니다: ' + response.error);
        }
      },
      error: function (xhr, status, error) {
        console.error('Ajax 요청 실패:', status, error, xhr.responseText);
        alert('서버와 통신 중 오류가 발생했습니다.');
      }
    });
  });


  $('.title-cell').each(function () {
    const originalText = $(this).text().trim(); // 셀의 원래 텍스트를 가져옴
    if (originalText.length > 20) {
      $(this).text(originalText.substring(0, 20) + '...'); // 20자 이후 잘라내고 ... 추가
    }
  });

  // 일괄 수정
  $('table .form-check-input[type="checkbox"]').change(function () {
    if ($(this).prop("checked")) {
      $(this).val('1');
    } else {
      $(this).val('0');
    }
  });

  $('.selecmodify').on('click', function () {
    $('form').submit();  // form 제출
  });


</script>

<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');

?>