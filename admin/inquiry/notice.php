<?php
$title = "문의게시판 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = "";

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
        ORDER BY notice.fix DESC, notice.ntid DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}

?>

<div class="container">
  <h2>전체 공지사항</h2>
  <form method="get" class="row justify-content-end">
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

  <form action="notice_write.php" method="POST">
    <table class="table list_table">
      <thead>
        <tr>
        <?php if ($level == 100): ?>
          <th scope="col">
            <input class="form-check-input" type="checkbox" id="allCheck">
          </th>
        <?php endif; ?>
          <th scope="col">번호</th>
        <?php if ($level == 100): ?>
          <th scope="col">아이디</th>
        <?php endif; ?>
        <?php if ($level == 100): ?>
          <th scope="col">이름</th>
        <?php elseif ($level == 10): ?>
            <th scope="col">작성자</th>
        <?php endif; ?>
          <th scope="col">제목</th>
          <th scope="col">조회수</th>
          <th scope="col">등록일</th>
        <?php if ($level == 100): ?>
          <th scope="col">상태</th>
          <th scope="col">관리</th>
        <?php endif; ?>
        </tr>
      </thead>
      <tbody>
      <?php
        if (count($dataArr) > 0) {
          $sequence_number = $row_num - $start_num;  // 순번 계산 시작
          foreach ($dataArr as $no) {
          ?>
            <tr>
          <?php if ($level == 100): ?>
            <th scope="row">
              <input 
                class="form-check-input itemCheckbox" type="checkbox" value="<?=$no->ntid?>"
                data-id="<?= $no->ntid; ?>" 
                data-title="<?= htmlspecialchars($no->title); ?>" 
                data-fix=<?= $no->fix; ?>>
            </th>
          <?php endif; ?>

              <td>
                <?php if ($no->fix == 1): ?>
                  <i class="bi bi-pin-angle-fill"></i>
                <?php else: ?>
                  <?= $no->ntid ?>
                <?php endif; ?>
              </td>

            <?php if ($level == 100): ?>
              <td><?= $no->userid; ?></td>
            <?php endif; ?>
              <td><?= $no->username; ?></td>
              <td>
              <?php if ($level == 100): ?>
                <a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_modify.php?ntid=<?= $no->ntid; ?>"
                  class="underline"><?= $no->title; ?>
                </a>
              <?php endif; ?>
              <?php if ($level == 10): ?>
                <a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_details.php?ntid=<?= $no->ntid; ?>"
                  class="underline"><?= $no->title; ?>
                </a>
              <?php endif; ?>
              </td>
              <td><?= $no->view; ?></td>
              <td><?= $no->regdate; ?></td>
              <?php if ($level == 100): ?>
              <td>
                <?php
                $class = $no->fix == 0 ? 'text-bg-light' : 'text-bg-success';
                $text = $no->fix == 1 ? '고정' : '일반';
                echo "<span class='badge $class'>$text</span>";
                ?>
              </td>
              <td class="edit_col">
                <a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_modify.php?ntid=<?= $no->ntid; ?>">
                  <i class="bi bi-pencil-fill"></i>
                </a>
                <a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_delete.php?ntid=<?= $no->ntid; ?>">
                  <i class="bi bi-trash-fill"></i>
                </a>
              </td>
              <?php endif; ?>
            </tr>
            <?php
            }
          } else {
            echo "<tr><td colspan='10'>검색 결과가 없습니다.</td></tr>";
          }
        ?>
      </tbody>
    </table>
<?php if ($level == 100): ?>
  <div class="d-flex justify-content-end gap-2">
    <button type="button" id="fixBtn" data-bs-toggle="modal" class="btn btn-outline-secondary">상태 변경</button>
    <button type="submit" class="btn btn-secondary">등록</button>
  </div>
<?php endif; ?>
  </form>
</div>

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
      <li class="page-item <?= $active; ?>"><a class="page-link" href="notice.php?page=<?= $i; ?>&keywords=<?= urlencode($keywords); ?>"><?= $i; ?></a></li>
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
<div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">글 상태 변경</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="notice_status_ok.php" method="POST" id="fixForm">
        <input type="hidden" name="ntid" id="modal_ntid">
        <div class="modal-body">
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
                  <td>
                    <input type="text" class="form-control w-75" id="modal_title" value="<?= isset($no->title) ? htmlspecialchars($no->title) : ''; ?>" readonly>
                  </td>
                </tr>
                <tr class="none">
                  <th scope="row">상태 <b>*</b></th>
                  <td class="d-flex gap-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="fix" id="fix_on" value=1>
                      <label class="form-check-label" for="fix_on">
                        고정
                      </label>
                    </div>
                    <div class="form-check">
                      <input class=" form-check-input" type="radio" name="fix" id="fix_off" value=0>
                      <label class="form-check-label" for="fix_off">
                        일반
                      </label>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
          <button type="submit" class="btn btn-outline-secondary">수정</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

/* == 전체선택 체크박스 == */
const checkAll = document.getElementById('allCheck');
const itemCheckboxes = document.querySelectorAll('.itemCheckbox');

checkAll.addEventListener('change', function () {
  itemCheckboxes.forEach((checkbox) => {
    checkbox.checked = checkAll.checked;
  });
});

/* == 체크박스 하나만 선택하도록 하기 == */
const checkboxes = document.querySelectorAll('.itemCheckbox');
checkboxes.forEach(function (checkbox) {
  checkbox.addEventListener('change', function () {
    checkboxes.forEach(function (item) {
      if (item !== checkbox) {
        item.checked = false; // 다른 체크박스는 해제
      }
    });
  });
});

/* == 상태 변경 모달 띄우기 == */
const fixBtn = document.getElementById('fixBtn');

fixBtn.addEventListener('click', function () {
  const selectedCheckbox = document.querySelector('.itemCheckbox:checked');
  if (selectedCheckbox) {
    const ntid = selectedCheckbox.dataset.id; // 체크박스의 data-id 속성값
    const title = selectedCheckbox.dataset.title; // 체크박스의 data-title 속성값
    const fix = selectedCheckbox.dataset.fix; // 체크박스의 data-fix 속성값

    // 모달 필드에 값 설정
    document.getElementById('modal_ntid').value = ntid;
    document.getElementById('modal_title').value = title;
    
    if (fix == 1) {
      document.getElementById('fix_on').checked = true;
      document.getElementById('fix_off').checked = false;
    } else {
      document.getElementById('fix_on').checked = false;
      document.getElementById('fix_off').checked = true;
    }

    // 모달 띄우기
    const modal = new bootstrap.Modal(document.querySelector('.modal'));
    modal.show();
  } else {
    alert('상태를 변경할 게시글을 선택해주세요.');
  }
});

  // 입력값 가져오기
  
  document.getElementById('fixForm').addEventListener('submit', function (event) {
    event.preventDefault();
    
    const ntid = document.querySelector('[name="ntid"]').value;
    const fix = document.querySelector('[name="fix"]:checked').value;

  // 서버로 POST 요청 보내기
  fetch('notice_status_ok.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
      ntid: ntid,
      fix: fix 
    })
  })
    .then(response => response.text())
    .then(data => {
      console.log(data);
      confirm('상태를 변경하시겠습니까?');
      alert('상태 변경이 완료되었습니다.');
      location.href='notice.php';
    })
    .catch(error => {
      console.error('Error:', error);
      alert('변경이 실패되었습니다.');
    });
  });

</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>