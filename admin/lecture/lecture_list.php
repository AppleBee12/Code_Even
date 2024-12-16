<?php
$title = "강좌 목록";

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $_GET['keywords'] : '';
$where_clause = '';

if ($keywords) {
    $where_clause = "WHERE lecture.title LIKE '%$keywords%'";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM lecture $where_clause";
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

// 강좌 목록 불러오기
$sql = "SELECT leid, image, title, name, period, course_type, isbest, isnew, state FROM lecture 
          $where_clause 
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
            <input type="text" class="form-control" placeholder="검색어를 입력하세요." name="keywords"
                value="<?= $keywords; ?>">
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
                    <th scope="col">승인</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($dataArr)) {
                    foreach ($dataArr as $item) {
                ?> 
                <tr>
                    <th scope="row">
                        <input type="hidden" name="leid[]" value="<?= $item->leid; ?>">
                        <?= $item->leid; ?>
                    </th>
                    <td class="lecture-img"><img src="<?= $item->image; ?>" alt="강좌 이미지"></td>
                    <td class="title-cell"><?= $item->title; ?></td>
                    <td><?= $item->name; ?></td>
                    <td><?= $item->period; ?>일</td>
                    <td>
                      <div>
                        <?php if ($item->course_type === 'general'): ?>
                          <span class="badge text-bg-secondary">일반</span>
                        <?php elseif ($item->course_type === 'recipe'): ?>
                          <span class="badge recipe">레시피</span>
                        <?php endif; ?>
                      </div>
                    </td>
                    <td>
                        <div class="form-check d-inline-block me-2">
                            <input type="hidden" name="isbest[<?= $item->leid; ?>]" value="0">
                            <input class="form-check-input" type="checkbox" id="isbest[<?= $item->leid; ?>]"
                                name="isbest[<?= $item->leid; ?>]" value="1" <?= $item->isbest ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="isbest[<?= $item->leid; ?>]">베스트</label>
                        </div>
                        <div class="form-check d-inline-block">
                            <input type="hidden" name="isnew[<?= $item->leid; ?>]" value="0">
                            <input class="form-check-input" type="checkbox" id="isnew[<?= $item->leid; ?>]"
                                name="isnew[<?= $item->leid; ?>]" value="1" <?= $item->isnew ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="isnew[<?= $item->leid; ?>]">추천</label>
                        </div>
                    </td>
                    <td>
                      <span id="status-badge-<?= $item->leid; ?>"
                        class="badge <?= $item->state == 2 ? 'text-bg-secondary' : 'waitopen'; ?>">
                        <?= $item->state == 2 ? '개설' : '개설 대기'; ?>
                      </span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="form-check form-switch">
                            <input id="toggle-<?= $item->leid; ?>" class="form-check-input tog toggle-switch" type="checkbox" role="switch" data-id="<?= $item->leid; ?>" <?= $item->state == 2 ? 'checked' : ''; ?>>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-4">
                            <a href="lecture_edit.php?id=<?= $item->leid; ?>"><i class="bi bi-pencil-fill"></i></a>
                            <a href="lecture_delete.php?id=<?= $item->leid; ?>" onclick="return confirm('이 강좌를 삭제하시겠습니까?');"><i class="bi bi-trash"></i></a>
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
            <button type="button" class="btn selecmodify">일괄 수정</button>
            <a href="lecture_up.php" type="button" class="btn nlecture">강좌 등록</a>
        </div>
    </form>
    <!-- Pagination -->
    <div class="list_pagination" aria-label="Page navigation example">
        <ul class="pagination d-flex justify-content-center">
            <?php
            $previous = $block_start - $block_ct;
            if ($previous < 1) $previous = 1;
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

  $('.selecmodify').on('click', function() {
    $('form').submit();  // form 제출
  });


</script>

<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');

?>