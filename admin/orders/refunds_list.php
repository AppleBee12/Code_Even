<?php
$title = "환불 목록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');
?>



<div class="container">
  <h2 class="page_title">환불목록</h2>

  <form action="" id="search_form" class="row justify-content-end">
    <div class="col-lg-3">
      <input type="date" class="form-control" />
    </div>
    <div class="col-lg-3">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="분류 선택 또는 검색어를 입력해주세요" aria-label="Recipient's username" aria-describedby="basic-addon2">
      <button type="button" class="btn btn-secondary">
        <i class="bi bi-search"></i>
      </button>
      </div>
    </div>
  </form>

  <form action="">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">주문번호</th>
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
          <th scope="col">주문명</th>
          <th scope="col">결제금액</th>
          <th scope="col">결제방법</th>
          <th scope="col">결제일</th>
          <th scope="col">상태</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td><a href="teacher_details.php">123</a></td>
          <td><a href="teacher_details.php">nany</td>
          <td><a href="teacher_details.php">홍나니</td>
          <td><a href="teacher_details.php">기초부터 확실하게! 페이지의 내용 전달을 위한...외 1건</td>
          <td><a href="teacher_details.php">102,000</td>
          <td><a href="teacher_details.php">신용카드</td>
          <td><a href="teacher_details.php">2024/10/29</td>
          <td><a href="teacher_details.php">환불완료</td>
        </tr>  
    </table>
    <!-- //table -->
    <button type="button" class="btn btn-outline-secondary ms-auto d-block">일괄수정</button>
  </form>



  <div class="list_pagination" aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
      <li class="page-item">
        <a class="page-link" href="" aria-label="Previous">
          <i class="bi bi-chevron-left"></i>
        </a>
      </li>
      <li class="page-item active"><a class="page-link" href="">1</a></li>
      <li class="page-item"><a class="page-link" href="">2</a></li>
      <li class="page-item"><a class="page-link" href="">3</a></li>
      <li class="page-item">
        <a class="page-link" href="" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </a>
      </li>
    </ul>
  </div>
   <!-- //Pagination -->
</div>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>