<?php
$title = "수강생 목록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$teacher_id = $mysqli->real_escape_string($_SESSION['UID']);

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';

if($level == 100){
  $where_clause = " ";
}
if($level == 10){
  $where_clause = " WHERE lecture.lecid = '$teacher_id'";
}

if ($keywords) {
  $where_clause .= " AND (user.username LIKE '%$keywords%' OR user.userid LIKE '%$keywords%')";
}

$page_sql = "SELECT COUNT(*) AS cnt 
            FROM class_data 
            JOIN user ON class_data.uid = user.uid 
            JOIN lecture ON class_data.leid = lecture.leid 
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

$sql = "SELECT class_data.*, user.*, lecture.*  
        FROM class_data 
        JOIN user ON class_data.uid = user.uid 
        JOIN lecture ON class_data.leid = lecture.leid 
        $where_clause 
        ORDER BY class_data.cdid DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

$dataArr = [];
$firstData = null;
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;

    // 첫 번째 데이터만 따로 저장
    if ($firstData === null) {
      $firstData = $data; // 첫 번째 데이터가 발견되면 저장
  }
}

?>
<div class="container">
  <h2>수강생목록</h2>
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
        <th scope="col">
          <input class="form-check-input" type="checkbox" id="allCheck">
        </th>
        <th scope="col">번호</th>
        <th scope="col">아이디</th>
        <th scope="col">이름</th>
        <th scope="col">강좌명</th>
        <th scope="col">진도율</th>
        <th scope="col">수강이수</th>
        <th scope="col">학습기간</th>
      <?php if ($level == 100): ?>
        <th scope="col">이메일 수신</th>
      <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($dataArr) {
        foreach ($dataArr as $cl) {
          ?>
          <tr>
            <th scope="row">
              <input class="form-check-input itemCheckbox" type="checkbox" value="<?= $cl->cdid; ?>" 
              data-username="<?= $cl->username; ?>" data-userid="<?= $cl->userid; ?>" data-email="<?= $cl->useremail; ?>" data-uid="<?= $cl->uid; ?>">
            </th>
            <td><?= $cl->cdid; ?></td>
            <td><a href="student_details.php?uid=<?= $cl->uid; ?>" class="underline"><?= $cl->userid ?></a></td>
            <td><a href="student_details.php?uid=<?= $cl->uid; ?>" class="underline"><?= $cl->username ?></a></td>
            <td><?= mb_strlen($cl->title) > 25 ? mb_substr($cl->title, 0, 25) . '...' : $cl->title; ?></td>
            <td></td>
            <td>
              <button type="button" class="printButton">
                <span class="badge text-bg-dark">이수증</span>
              </button>
            </td>
            <td>
              <?php
              $set_date = date('Y-m-d', strtotime($cl->date));
              $start_date = new DateTime($cl->date); // DateTime 객체 생성
              $start_date->modify("+{$cl->period} days"); // 기간을 더함
              $end_date = $start_date->format('Y-m-d'); // 종료 날짜 포맷팅
              ?>

              <?= $set_date ?> ~ <?= $end_date ?>
            </td>
          <?php if ($level == 100): ?>
            <td>
              <?= $cl->email_ok == 1 ? '동의' : '비동의'; ?>
            </td>
          <?php endif; ?>
          </tr>
        </tbody>
        <?php
        }
      } else {
        echo "<tr><td colspan='10'>검색 결과가 없습니다.</td></tr>";
      }
      ?>
  </table>

<?php if ($level == 100): ?>
  <button type="button" id="emailBtn" data-bs-toggle="modal" data-bs-target="#send_email"
    class="btn btn-outline-secondary ms-auto d-block">이메일 전송</button>
<?php endif; ?>

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
          <a class="page-link" href="student_list.php?page=<?= $previous; ?>" aria-label="Previous">
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
        <li class="page-item <?= $active; ?>"><a class="page-link" href="student_list.php?page=<?= $i; ?>"><?= $i; ?></a>
        </li>
        <?php
      }
      $next = $block_end + 1;
      if ($total_block > $block_num) {
        ?>
        <li class="page-item">
          <a class="page-link" href="student_list.php?page=<?= $next; ?>" aria-label="Next">
            <i class="bi bi-chevron-right"></i>
          </a>
        </li>
        <?php
      }
      ?>
    </ul>
  </div>

  <!-- //email 모달창 -->
  <div class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">이메일 전송</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="student_send_email_ok.php" method="POST" id="contact-form">
          <div class="modal-body">
            <table class="table">
              <colgroup>
                <col class="col-width-130">
                <col>
              </colgroup>
              <thead class="thead-hidden">
                <tr>
                  <th scope="col">구분</th>
                  <th scope="col">내용</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
            <button type="submit" class="btn btn-secondary">전송</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script>

  /* == 인쇄 버튼 == */
  function printPage() {
    const fileUrl = "../../images/certificate of completion.pdf";

    // PDF를 iframe으로 페이지에 삽입
    const iframe = document.createElement("iframe");
    iframe.style.position = "absolute";
    iframe.style.width = "0px";
    iframe.style.height = "0px";
    iframe.style.border = "none";
    iframe.src = fileUrl;
    // iframe을 body에 추가
    document.body.appendChild(iframe);
    // PDF 파일이 로드된 후 인쇄
    iframe.onload = function () {
      iframe.contentWindow.print();  // iframe 내에서 print() 호출
    };
  }
  
  document.querySelectorAll(".printButton").forEach(function(button) {
    button.addEventListener("click", printPage);
});


  /* == 전체선택 체크박스 == */
  const checkAll = document.getElementById('allCheck');
  const itemCheckboxes = document.querySelectorAll('.itemCheckbox');

  checkAll.addEventListener('change', function () {
    itemCheckboxes.forEach((checkbox) => {
      checkbox.checked = checkAll.checked;
    });
  });

  /* == 이메일 전송 모달 == */
  document.getElementById('emailBtn').addEventListener('click', function () {
    const checkboxes = document.querySelectorAll('.itemCheckbox:checked');
    const modalBody = document.querySelector('.modal-body tbody');

    // 모달에 표시할 데이터 초기화
    modalBody.innerHTML = ''; // 기존 데이터를 지움

    if (checkboxes.length > 0) {
      let htmlContent = '';  // 생성할 HTML 내용 초기화

      checkboxes.forEach(function (checkbox) {
        // data-* 속성에서 값 추출
        const username = checkbox.getAttribute('data-username');
        const userid = checkbox.getAttribute('data-userid');
        const email = checkbox.getAttribute('data-email');
        const uid = checkbox.getAttribute('data-uid');

        htmlContent += `
        <tr class="none">
          <th scope="row">이름(아이디)</th>
          <td>${username} (${userid})</td>
        </tr>
        <tr>
          <th scope="row">이메일</th>
          <td><input class="form-control" value="${email}" name="to_email" readonly></td>
        </tr>
        <tr class="none">
          <th scope="row">제목 <b>*</b></th>
          <td colspan="3"><input type="text" class="form-control" name="title" required></td>
        </tr>
        <tr class="none">
          <th scope="row">내용 <b>*</b></th>
          <td colspan="3"><textarea class="form-control" name="content" required></textarea></td>
        </tr>
        <tr class="none">
          <input type="hidden" name="uid" value="${uid}">
        </tr>
      `;
      });

      // 모달 본문에 HTML 내용 삽입
      modalBody.innerHTML = htmlContent;

      // 모달 띄우기
      const myModal = new bootstrap.Modal(document.querySelector('.modal'));
      myModal.show();
    } else {
      alert('체크박스를 먼저 선택해주세요.');
    }
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

  /* 이메일 발송 기능 */
  (function () {
    // https://dashboard.emailjs.com/admin/account
    emailjs.init({
      publicKey: "yXbH-fCwkFw9v_Bz9",
    });
  })();

  document.getElementById('contact-form').addEventListener('submit', function (event) {
    event.preventDefault();

    emailjs.sendForm('service_yyvqm9i', 'template_xt9x6yz', this)
    .then(() => {
        console.log('SUCCESS!');
    }, (error) => {
        console.log('FAILED...', error);
    });

    // 입력값 가져오기
    const form = event.target;
    const title = form.querySelector('[name="title"]').value;
    const content = form.querySelector('[name="content"]').value;
    const emailInputs = document.querySelectorAll('input[name="to_email"]');
    const uid = document.querySelector('[name="uid"]').value;

    emailInputs.forEach(input => {
      if (input.readOnly) {
        const email = input.value;
        const parentRow = input.closest('tr');
        const username = parentRow.querySelector('td').innerText;
        const userid = parentRow.querySelector('input').dataset.userid;
      }
    });

    // 서버로 POST 요청 보내기
    fetch('student_send_email_ok.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams({
        uid: uid,
        title: title,
        content: content 
      })
    })
      .then(response => response.text())
      .then(data => {
        console.log(data);
        confirm('해당 수강생에게 이메일을 보내시겠습니까?');
        alert('발송이 완료되었습니다.')
        location.href='/CODE_EVEN/admin/student/student_list.php';
      })
      .catch(error => {
        console.error('Error:', error);
        alert('발송이 실패되었습니다.');
      });
  });

</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>