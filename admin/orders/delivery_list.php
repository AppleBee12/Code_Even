<?php
$title = "배송 목록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');
?>



<div class="container">
  <h2 class="page_title">배송목록</h2>


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
          <th scope="col">주문상세번호</th>
          <th scope="col">아이디</th>
          <th scope="col">교재명</th>
          <th scope="col">수량</th>
          <th scope="col">결제일</th>
          <th scope="col">상태</th>
          <th scope="col">배송상태</th>
          <th scope="col">배송완료일</th>
          <th scope="col">배송추적</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td><a href="teacher_details.php">123</a></td>
          <td><a href="teacher_details.php">231</td>
          <td><a href="teacher_details.php">nany</td>
          <td><a href="orders_details.php">기초부터 확실하게! 페이지의 내용 전달을 위한...</td>
          <td><a href="teacher_details.php">1</td>
          <td><a href="teacher_details.php">2024/10/29</td>
          <td><a href="teacher_details.php">결제완료</td>
          <td><a href="teacher_details.php">배송준비중</td>
          <td><a href="teacher_details.php">-</td>
          <td><a href="teacher_details.php"><button type="button" class="btn btn-light btn-sm btn-bd">배송추적</button></td>
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