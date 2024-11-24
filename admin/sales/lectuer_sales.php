<?php
  $title = "강좌매출통계";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

  //대분류 가져오기
  $category_sql = "SELECT * FROM category WHERE code LIKE 'A%' ORDER BY cgid ASC";
  $category_result = $mysqli->query($category_sql);

  while($cate_data = $category_result->fetch_object()){
      $categories[] = $cate_data;
  }

  //분야 카테고리랑 매칭하기
  $category_map = [];
  foreach ($categories as $category) {
      $category_map[$category->cgid] = $category->name;
  }


  //게시글 분류 검색 추가
  $category_filter = isset($_GET['category']) ? $mysqli->real_escape_string($_GET['category']) : '';
  $where_clause = '';
  // 게시글 키워드 검색
  $keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
  //강좌유형검색
  $lec_type_filter = isset($_GET['search_lectype']) ? $mysqli->real_escape_string($_GET['search_lectype']) : '';

  // 오름차순 내림차순 추가
  // 정렬 관련 파라미터 처리
  $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'leid'; // 기본 정렬: 강좌번호
  $order = isset($_GET['order']) ? $_GET['order'] : 'asc'; // 기본 오름차순
  $order_next = $order === 'asc' ? 'desc' : 'asc'; // 다음 정렬 상태

  // 현재 GET 파라미터에서 불필요한 파라미터 제거
  $query_params = $_GET;
  unset($query_params['order_by'], $query_params['order']); // 정렬 관련 파라미터 제거


  if ($keywords) {
    $where_clause = "WHERE lecture_sales.lec_title LIKE '%$keywords%' OR lecture_sales.th_name LIKE '%$keywords%'";
  }

  if ($category_filter) {
    $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "lecture_sales.lec_cate = '$category_filter'";
  }

  if ($lec_type_filter !== '') {
    $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "lecture_sales.lec_type = '$lec_type_filter'";
  }

  $page_sql = "SELECT COUNT(DISTINCT leid) AS cnt FROM lecture_sales $where_clause";
  $page_result = $mysqli->query($page_sql);
  $page_data = $page_result->fetch_assoc();
  $row_num = $page_data['cnt']; // 그룹화된 데이터 개수

  // 페이지네이션
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $list = 10;
  $start_num = ($page - 1) * $list;
  $block_ct = 5;
  $block_num = ceil($page / $block_ct);
  $block_start = (($block_num - 1) * $block_ct) + 1;
  $block_end = $block_start + $block_ct - 1; 

  $total_page = ceil($row_num / $list); // 전체 페이지 수
  $total_block = ceil($total_page / $block_ct); // 전체 블록 수
  $block_num = ceil($page / $block_ct); // 현재 블록
  $block_start = (($block_num - 1) * $block_ct) + 1; // 블록 시작 번호
  $block_end = $block_start + $block_ct - 1; // 블록 끝 번호

  if ($block_end > $total_page) {
      $block_end = $total_page; // 블록 끝 번호가 총 페이지 수를 넘지 않도록 설정
  }


  $sql = "SELECT 
      leid,
      lec_cate,
      th_name,
      lec_title,
      lec_type,
      lec_price,
      SUM(total_order_amount) AS total_order_amount, -- 주문금액 합계
      SUM(order_count) AS total_order_count,         -- 주문건수 합계
      SUM(total_refund_amount) AS total_refund_amount, -- 환불금액 합계
      SUM(refund_count) AS total_refund_count,       -- 환불건수 합계
      SUM(final_sales_amount) AS total_final_sales -- 총 매출금액 합계
    FROM lecture_sales
    $where_clause
    GROUP BY leid, lec_cate, th_name, lec_title, lec_type
    ORDER BY $order_by $order
    LIMIT $start_num, $list
  ";

  $result = $mysqli->query($sql);
  $dataArr = [];
  if ($result) {
    while ($data = $result->fetch_object()) {
      $dataArr[] = $data;
    }
  }

  //전체합계 추가
  $sum_sql = "SELECT 
          SUM(total_order_amount) AS total_order_amount_sum,
          SUM(order_count) AS total_order_count_sum,
          SUM(total_refund_amount) AS total_refund_amount_sum,
          SUM(refund_count) AS total_refund_count_sum,
          SUM(final_sales_amount) AS total_final_sales_sum
      FROM lecture_sales
      $where_clause
  ";
  $sum_result = $mysqli->query($sum_sql);
  $totalSumData = $sum_result->fetch_assoc();
?>


</style>
<div class="container"> 
  <h2 class="page_title">강좌매출통계</h2>

  <form action="#" id="search_form" class="row justify-content-end align-items-center" method="GET">
    <div class="col-lg-3 pt_04">
    <span class="status_tt me-4">강좌유형</span>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="search_lectype" id="inlineRadio3" value="" checked>
        <label class="form-check-label" for="inlineRadio3">전체</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="search_lectype" id="inlineRadio1" value="1" <?= $lec_type_filter === '1' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="inlineRadio1">일반</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="search_lectype" id="inlineRadio2" value="2" <?= $lec_type_filter === '2' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="inlineRadio2">레시피</label>
    </div>
</div>
    <div class="col-lg-2">
      <select class="form-select" name="category" aria-label="대표분류">
        <option value="">-전체분류선택-</option>
        <?php foreach($categories as $category): ?>
          <option value="<?= $category->cgid; ?>">
            <?= $category->name;?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-lg-4">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="유형이나 분류 선택 또는 검색어를 입력하세요." name="keywords" value="<?= htmlspecialchars($keywords); ?>">
        <button type="submit" class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
    
  </form>
  <!-- //Search-form -->

  <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">번호</th>
        <th scope="col">분류</th>
        <th scope="col">강사명</th>
        <th scope="col">강좌명</th>
        <th scope="col">강좌유형</th>
        <th scope="col">가격</th>
        <th scope="col">
          주문금액
          <a href="?<?= http_build_query(array_merge($query_params, ['order_by' => 'total_order_amount', 'order' => $order_next])); ?>" class="sort-icon">
              <i class="bi bi-arrow-<?= $order_by === 'total_order_amount' && $order === 'asc' ? 'up' : 'down'; ?>-short"></i>
          </a>
        </th>
        <th scope="col">
            건수
            <a href="?<?= http_build_query(array_merge($query_params, ['order_by' => 'order_count', 'order' => $order_next])); ?>" class="sort-icon">
                <i class="bi bi-arrow-<?= $order_by === 'order_count' && $order === 'asc' ? 'up' : 'down'; ?>-short"></i>
            </a>
        </th>
        <th scope="col">
            환불금액
            <a href="?<?= http_build_query(array_merge($query_params, ['order_by' => 'total_refund_amount', 'order' => $order_next])); ?>" class="sort-icon">
                <i class="bi bi-arrow-<?= $order_by === 'total_refund_amount' && $order === 'asc' ? 'up' : 'down'; ?>-short"></i>
            </a>
        </th>
        <th scope="col">
            건수
            <a href="?<?= http_build_query(array_merge($query_params, ['order_by' => 'refund_count', 'order' => $order_next])); ?>" class="sort-icon">
                <i class="bi bi-arrow-<?= $order_by === 'refund_count' && $order === 'asc' ? 'up' : 'down'; ?>-short"></i>
            </a>
        </th>
        <th scope="col">
            총매출금액
            <a href="?<?= http_build_query(array_merge($query_params, ['order_by' => 'final_sales_amount', 'order' => $order_next])); ?>" class="sort-icon">
                <i class="bi bi-arrow-<?= $order_by === 'final_sales_amount' && $order === 'asc' ? 'up' : 'down'; ?>-short"></i>
            </a>
        </th>
       
      </tr>
    </thead>
    <tbody>
    <?php
      if (isset($dataArr) && count($dataArr) > 0) {
          foreach ($dataArr as $index => $data) {

      ?>
          <tr>
              <th scope="row"><?= $start_num + $index + 1; ?></th>
              <td>
        <?= $data->lec_cate == 1 ? '웹개발' : ($data->lec_cate == 2 ? '클라우드·DB' : ($data->lec_cate == 3 ? '보안·네트워크' : '기타')); ?>
    </td>

    <td><?= htmlspecialchars($data->th_name); ?></td>
    <td class="lec_title  ">
      <?= htmlspecialchars($data->lec_title); ?>
    </td>
          <td>
              <span class="badge <?= $data->lec_type == 1 ? 'text-bg-secondary' : 'text_bg_recipe'; ?>">
                  <?= $data->lec_type == 1 ? '일반' : '레시피'; ?>
              </span>
          </td>
          <td class="group_lefttline"><?= number_format($data->lec_price); ?>원</td>
          <td class="group_lefttline"><?= number_format($data->total_order_amount); ?>원</td>
          <td class="group_rightline"><?= $data->total_order_count; ?>건</td>
          <td><?= number_format($data->total_refund_amount); ?>원</td>
          <td class="group_rightline"><?= $data->total_refund_count; ?>건</td>
          <td><?= number_format($data-> total_final_sales); ?>원</td>
      </tr>
      
      <?php
      }
  } 
  ?>
  <tr class="amount_sum">
    <td colspan="5" class="fw-bold"><span>총 강좌수 :  <?= $row_num; ?></span></td>
    <td class="fw-bold group_lefttline group_rightline">합계</td>
    <td class="fw-bold"><?= number_format($totalSumData['total_order_amount_sum']); ?>원</td>
    <td class="fw-bold group_rightline"><?= $totalSumData['total_order_count_sum']; ?>건</td>
    <td class="fw-bold"><?= number_format($totalSumData['total_refund_amount_sum']); ?>원</td>
    <td class="fw-bold group_rightline"><?= $totalSumData['total_refund_count_sum']; ?>건</td>
    <td class="fw-bold"><?= number_format($totalSumData['total_final_sales_sum']); ?>원</td>
</tr>
    </tbody>
  </table>
  <!-- //table -->

  <div class="list_pagination">
    <ul class="pagination d-flex justify-content-center">
      <?php
        $previous = $block_start - $block_ct;
        if ($previous < 1) $previous = 1;
        if ($block_num > 1) { 
      ?>
      <li class="page-item">
        <a class="page-link" href="lectuer_sales.php?page=<?= $previous; ?>" aria-label="Previous">
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
      <li class="page-item <?= $active; ?>"><a class="page-link" href="lectuer_sales.php?page=<?= $i; ?>"><?= $i; ?></a></li>
      <?php
        }
        $next = $block_end + 1;
        if($total_block > $block_num){
      ?>
      <li class="page-item">
        <a class="page-link" href="lectuer_sales.php?page=<?= $next; ?>" aria-label="Next">
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
    // 새로고침 시 URL에서 GET 파라미터 제거
    if (window.location.search) {
        const url = window.location.origin + window.location.pathname;
        window.history.replaceState({}, document.title, url);
    }

    
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>