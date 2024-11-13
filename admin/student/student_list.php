<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
?>

<style>
  #printButton {
    position: relative; width: 50px; height: 21px;
    background: none; border: none;
    span {position: absolute; left: 0; top: 0;}
  }

  .modal_table {
    display: flex;
    flex-direction: row;
    width: 100%;
    border-collapse: collapse;
  }
</style>

<div class="container">
  <h2>수강생목록</h2>
  <form class="row justify-content-end">
    <div class="col-lg-4">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="검색어를 입력하세요." aria-label="Recipient's username" aria-describedby="basic-addon2">
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
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
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
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        </th>
        <td>2</td>
        <td><a href="">ping09</a></td>
        <td><a href="">피곤핑</a></td>
        <td>기초부터 확실하게! 페이지의..</td>
        <td>0%</td>
        <td>
          <span class="badge text-bg-light">미이수</span>
        </td>
        <td>2024.10.19 ~ 2024.10.31</td>
      </tr>
      <tr>
        <th scope="row">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        </th>
        <td>1</td>
        <td><a href="">hong1234</a></td>
        <td><a href="">홍길동</a></td>
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

<div class="modal" id="send_email" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">이메일 전송</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="modal_table table">
          <thead>
            <tr>
              <th>이름(아이디)</th>
              <th>이메일</th>
            </tr>
            <tr>
              <th>제목 *</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>홍길동</td>
              <td>hong1234@hong.com</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
        <button type="button" class="btn btn-secondary">등록</button>
      </div>
    </div>
  </div>
</div>

<div class="d-flex justify-content-end">
  <button type="button" data-bs-toggle="modal" data-bs-target="#send_email" class="btn btn-outline-secondary">이메일 전송</button>
</div>

</div>
<script>
  function printPage(){
    const fileUrl = "../../images/certificate of completion.pdf";

    const width = 800;
    const height = 600;
    const left = (window.innerWidth / 2) - (width / 2);
    const top = (window.innerHeight / 2) - (height / 2);

    const printWindow = window.open(fileUrl, "_blank", `width=${width},height=${height},left=${left},top=${top}`);

    printWindow.onload = function() {
      printWindow.print();
    }; 
  }
  document.getElementById("printButton").addEventListener("click", printPage);
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>