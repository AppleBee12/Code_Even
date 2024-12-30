<?php
$title = "환불 목록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 게시글 키워드 검색
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';

//날짜검색 추가
$start_date = isset($_GET['start_date']) ? $mysqli->real_escape_string($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? $mysqli->real_escape_string($_GET['end_date']) : '';

// $where_clause 초기화
$where_clause = ""; 

if ($keywords) {
  $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "(user.userid LIKE '%$keywords%' OR orders.order_title LIKE '%$keywords%')";
}

if ($start_date && $end_date) {
    $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "refunds.processed_date BETWEEN '$start_date' AND '$end_date'";
} elseif ($start_date) {
    $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "refunds.processed_date >= '$start_date'";
} elseif ($end_date) {
    $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "refunds.processed_date <= '$end_date'";
}


$page_sql = "SELECT COUNT(*) AS cnt FROM refunds";
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

$sql = "SELECT *
    FROM 
        refunds 
    LEFT JOIN 
        user
    ON 
        refunds.uid = user.uid 
    LEFT JOIN 
        orders 
    ON 
        refunds.odid = orders.odid 
    " . $where_clause . " 
    GROUP BY 
        refunds.reid 
    ORDER BY 
        refunds.reid DESC 
    LIMIT 
        $start_num, $list";
  
  $result = $mysqli->query($sql); //쿼리 실행 결과

  while($data = $result->fetch_object()){
  $dataArr[] = $data;
  }


?>



<div class="container">
  <h2 class="page_title">환불목록</h2>

  <form action="#" id="search_form" class="row justify-content-end" method="GET">
    <div class="col-lg-2 d-flex align-items-center date_form">
      <label class="date_lable me-2" for="start_date" >시작일</label>
      <input type="date" id="start_date" class="form-control" name="start_date" value="<?= htmlspecialchars($_GET['start_date'] ?? ''); ?>">
    </div>
    
    <div class="col-lg-2 d-flex align-items-center date_form">
      <label class="date_lable me-2" for="end_date">종료일</label>
      <input type="date" id="end_date" class="form-control" name="end_date" value="<?= htmlspecialchars($_GET['end_date'] ?? ''); ?>">
    </div>
    <div class="col-lg-3">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="기간 선택 또는 검색어를 입력해주세요" name="keywords" value="<?= htmlspecialchars($keywords); ?>" aria-label="검색창" >
      <button class="btn btn-secondary">
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
          <th scope="col">환불금액</th>
          <th scope="col">결제방법</th>
          <th scope="col">환불처리일</th>
          <th scope="col">상태</th>
          <th scope="col">담당자</th>
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
          <td><a href="teacher_details.php">code_even</td>
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
        <a class="page-link" href="orders_list.php?page=<?= $previous; ?>" aria-label="Previous">
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
      <li class="page-item <?= $active; ?>"><a class="page-link" href="orders_list.php?page=<?= $i; ?>"><?= $i; ?></a></li>
      <?php
        }
        $next = $block_end + 1;
        if($total_block > $block_num){
      ?>
      <li class="page-item">
        <a class="page-link" href="orders_list.php?page=<?= $next; ?>" aria-label="Next">
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
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>