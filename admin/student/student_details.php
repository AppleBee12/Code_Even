<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$cdid = $_GET['cdid'];
$sql = "SELECT class_data.*, user.*, lecture.* 
        FROM class_data 
        JOIN user ON class_data.uid = user.uid 
        JOIN lecture ON class_data.leid = lecture.leid 
        WHERE cdid = $cdid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();
?>

<div class="container">
  <h2>수강생 관리</h2>
  <div class="content_bar">
    <h3>수강생 상세정보</h3>
  </div>

  <form action="" method="">
    <table class="table details_table">
      <colgroup>
        <col style="width:160px">
        <col style="width:516px">
      </colgroup>
      <thead class="thead-hidden">
        <tr>
          <th scope="col">구분</th>
          <th scope="col">내용</th>
        </tr>
      </thead>
      <tbody>
        <tr class="none">
          <th scope="row">이름</th>
          <td><?= $data->username; ?></td>
          <th scope="row">가입일</th>
          <td><?= $data->signup_date; ?></td>
        </tr>
        <tr class="none">
          <th scope="row">아이디</th>
          <td><?= $data->userid; ?></td>
          <th scope="row">마지막접속일</th>
          <td><?= $data->last_date; ?></td>
        </tr>
        <tr class="none">
          <th scope="row">휴대전화</th>
          <td><?= $data->userphonenum; ?></td>
          <th scope="row">상태</th>
          <td class="d-flex gap-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="statusCheck" id="statusCheck" value="0"
                <?= ($data->user_status === '0') ? 'checked' : ''; ?> disabled>
              <label class="form-check-label" for="statusCheck">
                정상
              </label>
            </div>
            <div class="form-check">
              <input class=" form-check-input" type="radio" name="statusCheck" id="statusCheck" value="1"
                <?= ($data->user_status === '1') ? 'checked' : ''; ?> disabled>
              <label class="form-check-label" for="statusCheck">
                정지
              </label>
            </div>
            <div class="form-check">
              <input class=" form-check-input" type="radio" name="statusCheck" id="statusCheck" value="-1"
                <?= ($data->user_status === '-1') ? 'checked' : ''; ?> disabled>
              <label class="form-check-label" for="statusCheck">
                탈퇴
              </label>
            </div>
          </td>
        </tr>
        <tr class="none">
          <th scope="row">이메일</th>
          <td><?= $data->useremail; ?></td>
        </tr>
        <tr class="none">
          <th scope="row">이메일 수신 여부</th>
          <td class="d-flex gap-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="emailCheck" id="emailCheck" value="1"
                <?= ($data->email_ok === '1') ? 'checked' : ''; ?> disabled>
              <label class="form-check-label" for="emailCheck">
                동의
              </label>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </form>

  <div class="content_bar">
    <h3>수강 정보</h3>
  </div>

  <form action="" method="">
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
        <tr>
          <th scope="row"><?= $data->cdid; ?></th>
          <td>김동주</td>
          <td><?= $data->title; ?></td>
          <td>
            <?= date('Y-m-d', strtotime($data->date)) ?>
          </td>
          <td>
            <?php
            $set_date = date('Y-m-d', strtotime($data->date));
            $start_date = new DateTime($data->date); // DateTime 객체 생성
            $start_date->modify("+{$data->period} days"); // 기간을 더함
            $end_date = $start_date->format('Y-m-d'); // 종료 날짜 포맷팅
            ?>
            <?= $end_date ?>
          </td>
          <td>100</td>
          <td>80</td>
          <td>100%</td>
          <td>
            <button id="printButton">
              <span class="badge text-bg-dark">이수증</span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-end">
      <a href="student_list.php" type="button" class="btn btn-outline-danger">취소</a>
    </div>
  </form>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>

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

  document.getElementById("printButton").addEventListener("click", printPage);
</script>