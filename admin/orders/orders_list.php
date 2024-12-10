<?php
  $title = "주문결제목록";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

  // 게시글 키워드 검색
  $keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';

  //날짜검색 추가
  $start_date = isset($_GET['start_date']) ? $mysqli->real_escape_string($_GET['start_date']) : '';
  $end_date = isset($_GET['end_date']) ? $mysqli->real_escape_string($_GET['end_date']) : '';

  // $where_clause 초기화
  $where_clause = ""; 

  if ($keywords) {
    $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "(user.userid LIKE '%$keywords%' OR user.username LIKE '%$keywords%' OR orders.order_title LIKE '%$keywords%')";
  }

  if ($start_date && $end_date) {
      $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "orders.order_date BETWEEN '$start_date' AND '$end_date'";
  } elseif ($start_date) {
      $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "orders.order_date >= '$start_date'";
  } elseif ($end_date) {
      $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "orders.order_date <= '$end_date'";
  }

  $page_sql = "SELECT COUNT(*) AS cnt FROM orders LEFT JOIN user ON orders.uid = user.uid $where_clause";
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

  // $sql = "SELECT * FROM orders $where_clause 
  // ORDER BY orders.odid DESC 
  // LIMIT $start_num, $list"; //teachers 테이블에서 모든 데이터를 조회
  //기본값으로 빈 문자열을 설정하고 나중에 조건을 동적으로 추가하는 방식을 사용합니다. -수정내용참고
  //아래 코드는 $where_clause가 비어 있을 경우 WHERE가 추가되지 않아 정상 작동합니다. -수정내용참고
  $sql = "SELECT 
        orders.odid, 
        user.userid, 
        user.username, 
        orders.order_title, 
        COUNT(order_details.oddtid) AS item_count, 
        orders.final_amount, 
        orders.pay_method, 
        orders.order_date, 
        orders.pay_status 
    FROM 
        orders 
    LEFT JOIN 
        user 
    ON 
        orders.uid = user.uid 
    LEFT JOIN 
        order_details 
    ON 
        orders.odid = order_details.odid 
    " . $where_clause . " 
    GROUP BY 
        orders.odid 
    ORDER BY 
        orders.odid DESC 
    LIMIT 
        $start_num, $list";
  
  $result = $mysqli->query($sql); //쿼리 실행 결과

  while($data = $result->fetch_object()){
  $dataArr[] = $data;
  }

?>



<div class="container">
  <h2 class="page_title">주문결제목록</h2>

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

  <form action="#">
    <table class="table list_table">
      <thead>
        <tr>
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
      <?php
          if(isset($dataArr)){
            foreach($dataArr as $item){
        ?> 
        <tr>
          <td><?= $item->odid; ?></td>
          <td><?= $item->userid; ?></td>
          <td><?= $item->username; ?></td>
          <td><a href="orders_details.php?odid=<?= $item->odid; ?>" class="a_underline">
              <?php
              $order_title = $item->order_title;
              $item_count = $item->item_count;

              // 문자열 자르기 (길이 제한: 50, 생략 부호: "...")
              $short_title = mb_strimwidth($order_title, 0, 54, "...");

              if ($item_count > 1) {
                  echo $short_title . " 외 " . ($item_count - 1) . "건";
              } else {
                  echo $short_title;
              }
              ?>
          </a></td>
          <td><?= number_format($item->final_amount); ?></td>
          <td>
              <?php
              $pay_methods = [
                  1 => "신용카드",
                  2 => "간편결제",
                  3 => "가상계좌",
                  4 => "휴대폰결제",
                  5 => "실시간계좌이체"
              ];
              echo isset($pay_methods[$item->pay_method]) ? $pay_methods[$item->pay_method] : "알 수 없음";
              ?>
          </td>
          <td><?= date('Y-m-d', strtotime($item->order_date)); ?></td>
          <td>
            <?php
            $status_labels = [
                0  => "결제완료",
                -1 => "환불",
                1  => "취소"
            ];
            echo isset($status_labels[$item->pay_status]) ? $status_labels[$item->pay_status] : "알 수 없음";
            ?>
          </td>
        </tr>
        <?php
            }
          }
        ?>      
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

<script>
  $(document).ready(function() {
    const url = window.location.origin + window.location.pathname; // GET 파라미터 제외한 URL 생성
    window.history.replaceState({}, document.title, url); // 브라우저 히스토리 상태 변경
  });
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>