<?php
$title = "강좌매출통계";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

 // 'code'가 'A'로 시작하는 category 데이터를 가져오기
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

 if ($keywords) {
   $where_clause = "WHERE lecture_sales.lec_title LIKE '%$keywords%' OR lecture_sales.th_name LIKE '%$keywords%'";
 }

 if ($category_filter) {
   $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "lecture_sales.lec_cate = '$category_filter'";
 }

 $page_sql = "SELECT COUNT(*) AS cnt FROM lecture_sales $where_clause";
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


 $sql = "SELECT * FROM lecture_sales $where_clause 
         ORDER BY lecture_sales.leid DESC 
         LIMIT $start_num, $list"; //teachers 테이블에서 모든 데이터를 조회
 $result = $mysqli->query($sql); //쿼리 실행 결과

 while($data = $result->fetch_object()){
   $dataArr[] = $data;
 }

?>

<div class="container"> 
  <h2 class="page_title">강좌매출통계</h2>

  <form action="#" id="search_form" class="row justify-content-end" method="GET">
    <div class="col-lg-3 pt_04">
      <span class="status_tt me-4">강좌유형</span>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="1" checked> 
        <label class="form-check-label" for="inlineRadio3">전체</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0">
        <label class="form-check-label" for="inlineRadio1">일반</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="-1" > 
        <label class="form-check-label" for="inlineRadio2">레시피</label>
      </div>

    </div>  
    <div class="col-lg-3">
      <select class="form-select" name="category" aria-label="대표분류">
        <option value="">-전체분류선택-</option>
        <?php foreach($categories as $category): ?>
          <option value="<?= $category->cgid; ?>">
            <?= $category->name;?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-lg-3">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="분류 선택 또는 검색어를 입력하세요." name="keywords" value="<?= htmlspecialchars($keywords); ?>">
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
        <th scope="col">주문금액 / 건수</th>
        <th scope="col">환불금액 / 건수</th>
        <th scope="col">총매출금액</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>웹개발</td>
        <td>김동주</td>
        <td>html, css 쉽게배우자</td>
        <td><span class="badge text-bg-secondary">일반</span></td>
        <td>129,000원</td>
        <td>9,999원 / 10건</td>
        <td>9,999원 / 10건</td>
        <td>119,999원</td>
      </tr>  
      <tr>
        <th scope="row">1</th>
        <td>웹개발</td>
        <td>김동주</td>
        <td>Flex box 파헤치기!</td>
        <td><span class="badge text-bg-red">레시피</span></td>
        <td>129,000원</td>
        <td>9,999원 / 10건</td>
        <td>9,999원 / 10건</td>
        <td>119,999원</td>
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
        <a class="page-link" href="user_list.php?page=<?= $previous; ?>" aria-label="Previous">
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
      <li class="page-item <?= $active; ?>"><a class="page-link" href="user_list.php?page=<?= $i; ?>"><?= $i; ?></a></li>
      <?php
        }
        $next = $block_end + 1;
        if($total_block > $block_num){
      ?>
      <li class="page-item">
        <a class="page-link" href="user_list.php?page=<?= $next; ?>" aria-label="Next">
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


</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>