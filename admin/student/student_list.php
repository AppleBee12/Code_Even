<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<style>
  em {
    color: var(--primary);
  }
</style>

<div class="container">
  <h2>수강생목록</h2>
  <form class="row justify-content-end">
    <div class="col-lg-4">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="검색어를 입력하세요." aria-label="Recipient's username"
          aria-describedby="basic-addon2">
        <button type="button" class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">
          <input class="form-check-input" type="checkbox" value="" id="allCheck">
        </th>
        <th scope="col">번호</th>
        <th scope="col">아이디</th>
        <th scope="col">이름</th>
        <th scope="col">강좌명</th>
        <th scope="col">진도율</th>
        <th scope="col">수강이수</th>
        <th scope="col">학습기간</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <input class="form-check-input itemCheckbox" type="checkbox" value="">
        </th>
        <td>2</td>
        <td><a href="student_details.php" class="underline">ping09</a></td>
        <td><a href="student_details.php" class="underline">피곤핑</a></td>
        <td>기초부터 확실하게! 페이지의..</td>
        <td>0%</td>
        <td>
          <span class="badge text-bg-light">미이수</span>
        </td>
        <td>2024.10.19 ~ 2024.10.31</td>
      </tr>
      <tr>
        <th scope="row">
          <input class="form-check-input itemCheckbox" type="checkbox" value="" id="flexCheckDefault">
        </th>
        <td>1</td>
        <td><a href="student_details.php" class="underline">hong1234</a></td>
        <td><a href="student_details.php" class="underline">홍길동</a></td>
        <td>기초부터 확실하게! 페이지의..</td>
        <td>100%</td>
        <td>
          <button id="printButton">
            <span class="badge text-bg-dark">이수증</span>
          </button>
        </td>
        <td>2024.10.19 ~ 2024.10.31</td>
      </tr>
    </tbody>
  </table>

  <div class="modal modal-lg" id="send_email" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">이메일 전송</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <table class="table d-flex">
                <thead>
                  <tr>
                    <th scope="col">이름(아이디)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>홍길동</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table d-flex">
                <thead>
                  <tr>
                    <th scope="col">이메일</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>hong1234@hong.com</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <table class="table d-flex">
                <thead>
                  <tr>
                    <th scope="col">제목<em> *</em></th>
                  </tr>
                  <tr>
                    <th scope="col">내용<em> *</em></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <input type="text" class="form-control" placeholder="제목을 입력해주세요.">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <textarea class="form-control" placeholder="메시지를 입력해주세요."></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
          <button type="button" class="btn btn-secondary">등록</button>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-end">
    <button type="button" data-bs-toggle="modal" data-bs-target="#send_email" class="btn btn-outline-secondary">이메일
      전송</button>
  </div>

</div>

<script>
  // 인쇄 버튼
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


  // "전체 선택" 체크박스를 가져옴
  const checkAll = document.getElementById('allCheck');
  // 각 항목 체크박스를 모두 가져옴
  const itemCheckboxes = document.querySelectorAll('.itemCheckbox');

  // "전체 선택" 체크박스 클릭 이벤트 리스너 추가
  checkAll.addEventListener('change', function() {
      itemCheckboxes.forEach((checkbox) => {
          checkbox.checked = checkAll.checked;
      });
  });
</script>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>