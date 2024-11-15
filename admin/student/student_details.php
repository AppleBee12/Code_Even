<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
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
          <th scope="row">이름(아이디)</th>
          <td>홍길동</td>
          <th scope="row">가입일</th>
          <td>2024/10/10 13:14:15</td>
        </tr>
        <tr class="none">
          <th scope="row">아이디</th>
          <td>hong1234</td>
          <th scope="row">마지막접속일</th>
          <td>2024/10/10 13:14:15</td>
        </tr>
        <tr class="none">
          <th scope="row">휴대전화</th>
          <td>010-1234-6589</td>
          <th scope="row">상태</th>
          <td class="d-flex gap-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="statusCheck" id="flexRadioDisabled" checked disabled>
              <label class="form-check-label" for="flexRadioDisabled">
                정상
              </label>
            </div>
            <div class="form-check">
              <input class=" form-check-input" type="radio" name="statusCheck" id="flexRadioDisabled" disabled>
              <label class="form-check-label" for="flexRadioCheckedDisabled">
                정지
              </label>
            </div>
            <div class="form-check">
              <input class=" form-check-input" type="radio" name="statusCheck" id="flexRadioDisabled" disabled>
              <label class="form-check-label" for="flexRadioCheckedDisabled">
                탈퇴
              </label>
            </div>
          </td>
        </tr>
        <tr class="none">
          <th scope="row">이메일</th>
          <td>exampla1111@example.com</td>
          <th scope="row">마지막접속일</th>
          <td>2024/10/10 13:14:15</td>
        </tr>
        <tr class="none">
          <th scope="row">이메일 수신 여부</th>
          <td class="d-flex gap-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="emailCheck" id="emailCheck" checked disabled>
              <label class="form-check-label" for="flexRadioDisabled">
                동의
              </label>
            </div>
            <div class="form-check">
              <input class=" form-check-input" type="radio" name="emailCheck" id="flexRadioDisabled" disabled>
              <label class="form-check-label" for="flexRadioCheckedDisabled">
                비동의
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
          <th scope="row">2</th>
          <td>김동주</td>
          <td>웹 프로그래밍의 꽃! 웹페이지의 동 적요소를 담당하는...</td>
          <td>2024/11/02</td>
          <td>2024/12/01</td>
          <td>100</td>
          <td>80</td>
          <td>100%</td>
          <td>
            <button id="printButton">
              <span class="badge text-bg-dark">이수증</span>
            </button>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>김동주</td>
          <td>기초부터 확실하게! 페이지의 내용 전달을 위한 HTML...</td>
          <td>2024/11/02</td>
          <td>2024/12/31</td>
          <td></td>
          <td>20</td>
          <td>40%</td>
          <td>
            <span class="badge text-bg-light">미이수</span>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-end">
      <a href="student_list.php" type="button" class="btn btn-outline-danger">취소</a>
    </div>
  </form>
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

  document.getElementById("printButton").addEventListener("click", printPage);
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>