<?php
$title = "수강생 상세";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$uid = $_GET['uid'];
$sql = "SELECT class_data.*, user.*, lecture.*, stuscores.* 
        FROM class_data 
        JOIN user ON class_data.uid = user.uid 
        JOIN lecture ON class_data.leid = lecture.leid 
        LEFT JOIN stuscores ON user.uid = stuscores.stu_id 
        WHERE user.uid = $uid 
        ORDER BY class_data.cdid DESC";
$result = $mysqli->query($sql);
$data = [];
while ($row = $result->fetch_object()) {
    $data[] = $row; // 각 행을 배열에 추가
}
?>

<div class="container">
  <h2>수강생 관리</h2>
  <div class="content_bar">
    <h3>수강생 상세정보</h3>
  </div>

  <table class="table details_table">
    <colgroup>
      <col class="col-width-160">
      <col class="col-width-516">
      <col class="col-width-160">
      <col class="col-width-516">
    </colgroup>
    <thead class="thead-hidden">
      <tr>
        <th scope="col">구분</th>
        <th scope="col">내용</th>
        <th scope="col">구분</th>
        <th scope="col">내용</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if (!empty($data)) {
          $userData = $data[0];
      ?>
      <tr class="none">
        <th scope="row">이름</th>
        <td><?= $userData->username; ?></td>
        <th scope="row">가입일</th>
        <td><?= $userData->signup_date; ?></td>
      </tr>
      <tr class="none">
        <th scope="row">아이디</th>
        <td><?= $userData->userid; ?></td>
        <th scope="row">마지막접속일</th>
        <td><?= $userData->last_date; ?></td>
      </tr>
      <tr class="none">
        <th scope="row">휴대전화</th>
        <td><?= $userData->userphonenum; ?></td>
        <th scope="row">상태</th>
        <td class="d-flex gap-3">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="statusCheck" id="statusNormal" value="0"
              <?= ($userData->user_status === '0') ? 'checked' : ''; ?> disabled>
            <label class="form-check-label" for="statusNormal">
              정상
            </label>
          </div>
          <div class="form-check">
            <input class=" form-check-input" type="radio" name="statusCheck" id="statusabNormal" value="1"
              <?= ($userData->user_status === '1') ? 'checked' : ''; ?> disabled>
            <label class="form-check-label" for="statusabNormal">
              정지
            </label>
          </div>
          <div class="form-check">
            <input class=" form-check-input" type="radio" name="statusCheck" id="statusCheck" value="-1"
              <?= ($userData->user_status === '-1') ? 'checked' : ''; ?> disabled>
            <label class="form-check-label" for="statusCheck">
              탈퇴
            </label>
          </div>
        </td>
      </tr>
      <tr class="none">
        <th scope="row">이메일</th>
        <td colspan="3"><?= $userData->useremail; ?></td>
      </tr>
      <tr class="none">
        <th scope="row">이메일 수신 여부</th>
        <td colspan="3" class="d-flex gap-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="emailCheck" id="emailCheck" value="1"
              <?= ($userData->email_ok === '1') ? 'checked' : ''; ?> disabled>
            <label class="form-check-label" for="emailCheck">
              동의
            </label>
          </div>
        </td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>

  <div class="content_bar">
    <h3>수강 정보</h3>
  </div>

      <?php
        $groupedData = [];
        foreach ($data as $row) {
            $groupedData[$row->uid][] = $row;
        }
      ?>
  <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">번호</th>
        <th scope="col">강사명</th>
        <th scope="col">강좌명</th>
        <th scope="col">학습시작일</th>
        <th scope="col">학습종료일</th>
        <th scope="col">퀴즈</th>
        <th scope="col">시험</th>
        <th scope="col">진도율</th>
        <th scope="col">수강이수</th>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach ($groupedData as $uid => $group) { 
            $group = array_reverse($group);
            $seq = count($group);
            foreach ($group as $row) {
        ?>
      <tr>
        <th scope="row"><?= $seq--; ?></th>
        <td><?= $row->name; ?></td>
        <td><?= $row->title; ?></td>
        <td>
          <?= date('Y-m-d', strtotime($row->date)) ?>
        </td>
        <td>
          <?php
          $set_date = date('Y-m-d', strtotime($row->date));
          $start_date = new DateTime($row->date); // DateTime 객체 생성
          $start_date->modify("+{$row->period} days"); // 기간을 더함
          $end_date = $start_date->format('Y-m-d'); // 종료 날짜 포맷팅
          ?>
          <?= $end_date ?> 
        </td>
        <td><?=$row->score;?></td>
        <td><?=$row->score;?></td>
        <td><?=$row->progress_rate;?></td>
        <td>
        <?php if ($row->progress_rate >= 80): ?>
          <button class="printButton">
            <span class="badge text-bg-dark">이수증</span>
          </button>
          <?php endif; ?>
        </td>
      </tr>
      <?php
        } // 그룹 내 데이터 반복 종료
    } // 그룹 반복 종료
    ?>
    </tbody>
  </table>
  <div class="d-flex justify-content-end">
    <a href="student_list.php" class="btn btn-outline-danger">취소</a>
  </div>
</div>

<script>
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

</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>