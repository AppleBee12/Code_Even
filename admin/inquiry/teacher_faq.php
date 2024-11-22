<?php
$title = "문의게시판 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';

if($level == 100){
  $where_clause = "WHERE faq.target = 'teacher'";
}
if($level == 10){
  $where_clause = "WHERE faq.target = 'teacher' AND faq.status = 'on'";
}

if ($keywords) {
  $where_clause .= " AND (faq.title LIKE '%$keywords%' OR user.username LIKE '%$keywords%' OR user.userid LIKE '%$keywords%')";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM faq JOIN user ON faq.uid = user.uid $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

// print_r($page_data);

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
        ORDER BY faq.fqid DESC 
        LIMIT $start_num, $list";
        
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}

?>

<div class="container">
  <h2>강사 FAQ</h2>
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

  <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/faq_write.php" method="GET">
  <input type="hidden" name="target" value="teacher">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">
            <input class="form-check-input" type="checkbox" id="allCheck">
          </th>
          <th scope="col">번호</th>
        <?php if ($level == 100): ?>
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
        <?php endif; ?>
          <th scope="col">분류</th>
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
        if (isset($dataArr)) {
          foreach ($dataArr as $faq) {
            ?>
            <tr>
              <th scope="row">
                <input 
                  class="form-check-input itemCheckbox" type="checkbox" value="<?=$faq->fqid?>"
                  data-id="<?= $faq->fqid; ?>" 
                  data-title="<?= htmlspecialchars($faq->title); ?>" 
                  data-status="<?= $faq->status; ?>">
              </th>
              <td><?= $faq->fqid; ?></td>
            <?php if ($level == 100): ?>
              <td><?= $faq->userid; ?></td>
              <td><?= $faq->username; ?></td>
            <?php endif; ?>
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
              <?php if ($level == 100): ?>
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/faq_modify.php?fqid=<?= $faq->fqid; ?>"
                  class="underline"><?= $faq->title; ?>
                </a>
              <?php endif; ?>
              <?php if ($level == 10): ?>
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/faq_details.php?fqid=<?= $faq->fqid; ?>"
                  class="underline"><?= $faq->title; ?>
                </a>
              <?php endif; ?>
              </td>
              <td><?= $faq->view; ?></td>
              <td><?= $faq->regdate; ?></td>
            <?php if ($level == 100): ?>
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
        <button type="button" id="statusBtn" data-bs-toggle="modal" class="btn btn-outline-secondary">상태 변경</button>
        <button type="submit" class="btn btn-secondary">등록</button>
      </div>
    <?php endif; ?>
  </form>

</div>

<!-- //상태 변경 모달창 -->
<div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">글 상태 변경</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="faq_status_ok.php" method="POST" id="statusForm">
        <input type="hidden" name="fqid" id="modal_fqid">
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
                    <input type="text" class="form-control w-75" id="modal_title" value="<?= isset($faq->title) ? htmlspecialchars($faq->title) : ''; ?>" readonly>
                  </td>
                </tr>
                <tr class="none">
                  <th scope="row">상태 <b>*</b></th>
                  <td class="d-flex gap-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="status_on" value="on">
                      <label class="form-check-label" for="status_on">
                        노출
                      </label>
                    </div>
                    <div class="form-check">
                      <input class=" form-check-input" type="radio" name="status" id="status_off" value="off">
                      <label class="form-check-label" for="status_off">
                        숨김
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
const statusBtn = document.getElementById('statusBtn');

statusBtn.addEventListener('click', function () {
  const selectedCheckbox = document.querySelector('.itemCheckbox:checked');
  if (selectedCheckbox) {
    const fqid = selectedCheckbox.dataset.id; // 체크박스의 data-id 속성값
    const title = selectedCheckbox.dataset.title; // 체크박스의 data-title 속성값
    const status = selectedCheckbox.dataset.status; // 체크박스의 data-status 속성값

    // 모달 필드에 값 설정
    document.getElementById('modal_fqid').value = fqid;
    document.getElementById('modal_title').value = title;
    document.getElementById('status_on').checked = status === 'on';
    document.getElementById('status_off').checked = status === 'off';

    // 모달 띄우기
    const modal = new bootstrap.Modal(document.querySelector('.modal'));
    modal.show();
  } else {
    alert('상태를 변경할 게시글을 선택해주세요.');
  }
});

  // 입력값 가져오기
  
  document.getElementById('statusForm').addEventListener('submit', function (event) {
    event.preventDefault();
    
    const fqid = document.querySelector('[name="fqid"]').value;
    const status = document.querySelector('[name="status"]:checked').value;

  // 서버로 POST 요청 보내기
  fetch('faq_status_ok.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
      fqid: fqid,
      status: status 
    })
  })
    .then(response => response.text())
    .then(data => {
      console.log(data);
      confirm('상태를 변경하시겠습니까?');
      alert('상태 변경이 완료되었습니다.');
      location.href='student_faq.php';
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