<?php
$title = "강사 목록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

// 'code'가 'A'로 시작하는 category 데이터를 가져오기
$category_sql = "SELECT * FROM category WHERE code LIKE 'A%' ORDER BY cgid ASC";
$category_result = $mysqli->query($category_sql);

while($cate_data = $category_result->fetch_object()){
    $categories[] = $cate_data;
}


// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE teachers.tc_userid LIKE '%$keywords%' OR teachers.tc_name LIKE '%$keywords%' OR teachers.tc_email LIKE '%$keywords%'";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM teachers $where_clause";
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


$sql = "SELECT * FROM teachers $where_clause 
        ORDER BY teachers.tcid DESC 
        LIMIT $start_num, $list"; //teachers 테이블에서 모든 데이터를 조회
$result = $mysqli->query($sql); //쿼리 실행 결과

while($data = $result->fetch_object()){
  $dataArr[] = $data;
}

?>



<div class="container">
  <h2 class="page_title">강사목록</h2>


  <form action="" id="search_form" class="row justify-content-end">
    <div class="col-lg-3">
      <select class="form-select" name="" aria-label="대표분야">
        <option value="">-전체분야선택-</option>
        <?php foreach($categories as $category): ?>
          <option value="<?= $category->cgid; ?>">
            <?= $category->name;?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-lg-3">
    <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="검색어를 입력하세요." name="keywords" value="<?= htmlspecialchars($keywords); ?>">
      <!-- <input type="text" class="form-control" placeholder="분류 선택 또는 검색어를 입력해주세요" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
      <button type="button" class="btn btn-secondary">
        <i class="bi bi-search"></i>
      </button>
      </div>
    </div>
  </form>

  <form action="tclist_update.php" method="GET">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">프로필이미지</th>
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
          <th scope="col">이메일</th>
          <th scope="col">분야</th>
          <th scope="col">상태</th>
          <th scope="col">강사전시옵션</th>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
      <?php
          if(isset($dataArr)){
            foreach($dataArr as $item){
        ?> 
        <tr>
          <th scope="row">
            <input type="hidden" name="tcid[]" value="<?= $item->tcid; ?>">
            <?= $item->tcid; ?>
          </th>
          <td>
            <img src="<?= $item->tc_thumbnail; ?>" class="rounded_circle" width = 35 height = 35 alt="">
          </td> 
          <td><?= $item->tc_userid; ?></td> 
          <td><?= $item->tc_name; ?></td> 
          <td><?= $item->tc_email; ?></td>
          <td><?= $item->tc_cate; ?></td>
          <td>
          <select class="form-select form-select-sm tc_status" aria-label="승인여부" name="tc_ok[<?= $item->tcid; ?>]" id="tc_ok[<?= $item->tcid; ?>]">
              <option value="-1" <?php if($item->tc_ok == -1){echo 'selected';}?>>승인거절</option>
              <option value="0" <?php if($item->tc_ok == 0){echo 'selected';}?>>심사중</option>
              <option value="1" <?php if($item->tc_ok == 1){echo 'selected';}?>>승인완료</option>
            </select>
          </td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" <?php echo $item->isnew ? 'checked' : ''; ?> name="isnew[<?= $item->tcid; ?>]" value="<?= $item->isnew ?>" id="flexCheckDefault">
              <label class="form-check-label" for="isnew">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" <?php echo $item->isrecom ? 'checked' : ''; ?> name="isrecom[<?= $item->tcid; ?>]" value="<?= $item->isrecom ?>" id="flexCheckDefault">
              <label class="form-check-label" for="isrecom">
                추천
              </label>
            </div>
          </td>
          <td class="edit_col">
            <a href="teacher_edit.php?tcid=<?= $item->tcid; ?>">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="teacher_del.php?tcid=<?= $item->tcid; ?>">
            <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <?php
            }
          }
        ?>
      </tbody> 
    </table>
     <!--//table -->
    <button class="btn btn-outline-secondary ms-auto d-block">일괄수정</button>
  </form>



  <!-- //Pagination -->
<div class="list_pagination" aria-label="Page navigation example">
  <ul class="pagination d-flex justify-content-center">
    <?php
      $previous = $block_start - $block_ct;
      if ($previous < 1) $previous = 1;
      if ($block_num > 1) { 
    ?>
    <li class="page-item">
      <a class="page-link" href="notice.php?page=<?= $previous; ?>" aria-label="Previous">
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
    <li class="page-item <?= $active; ?>"><a class="page-link" href="notice.php?page=<?= $i; ?>"><?= $i; ?></a></li>
    <?php
      }
      $next = $block_end + 1;
      if($total_block > $block_num){
    ?>
    <li class="page-item">
      <a class="page-link" href="notice.php?page=<?= $next; ?>" aria-label="Next">
        <i class="bi bi-chevron-right"></i>
      </a>
    </li>
    <?php
      }
    ?>
  </ul>
</div>
</div>

<script>
    $('table .form-check-input').change(function(){
    if($(this).prop( "checked" )){
      $(this).val('1');
    } else{
      $(this).val('0');
    }
  });
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>