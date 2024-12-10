<?php
$title = "배송 목록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

$page_sql = "SELECT COUNT(*) AS cnt FROM order_delivery";
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

?>



<div class="container">
  <h2 class="page_title">교재배송목록</h2>


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
  </form>

  <div class="list_pagination">
    <ul class="pagination d-flex justify-content-center">
      <?php
        $previous = $block_start - $block_ct;
        if ($previous < 1) $previous = 1;
        if ($block_num > 1) { 
      ?>
      <li class="page-item">
        <a class="page-link" href="delivery_list.php?page=<?= $previous; ?>" aria-label="Previous">
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
      <li class="page-item <?= $active; ?>"><a class="page-link" href="delivery_list.php?page=<?= $i; ?>"><?= $i; ?></a></li>
      <?php
        }
        $next = $block_end + 1;
        if($total_block > $block_num){
      ?>
      <li class="page-item">
        <a class="page-link" href="delivery_list.php?page=<?= $next; ?>" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </a>
      </li>
      <?php
        }
      ?>
    </ul>
  </div>
  <!-- //Pagination -->
</div>



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>