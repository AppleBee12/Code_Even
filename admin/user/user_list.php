<?php
$title = "전체회원목록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');


// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE user.userid LIKE '%$keywords%' OR user.username LIKE '%$keywords%' OR user.useremail LIKE '%$keywords%'";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM user $where_clause";
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


$sql = "SELECT * FROM user $where_clause 
        ORDER BY user.uid DESC 
        LIMIT $start_num, $list"; //teachers 테이블에서 모든 데이터를 조회
$result = $mysqli->query($sql); //쿼리 실행 결과

while($data = $result->fetch_object()){
  $dataArr[] = $data;
}

?>



<div class="container">
  <h2 class="page_title">전체회원목록</h2>


  <form action="" id="search_form" class="row justify-content-end">
    
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
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
          <th scope="col">이메일</th>
          <th scope="col">마지막접속일</th>
          <th scope="col">가입일</th>
          <th scope="col">회원구분</th>
          <th scope="col">상태</th>
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
            <input type="hidden" name="uid[]" value="<?= $item->uid; ?>">
            <?= $item->uid; ?>
          </th>
          <td><?= $item->userid; ?></td> 
          <td><?= $item->username; ?></td> 
          <td><?= $item->useremail; ?></td>
          <td><?= $item->signup_date; ?></td>
          <td><?= $item->last_date; ?></td>
          <td><?= $item->user_level; ?></td>
          <td><?= $item->user_status; ?></td>
          <td class="edit_col">
            <a href="user_edit.php?uid=<?= $item->uid; ?>">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <?php
            }
          }
        ?>
        <!--
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">승인완료</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td class="edit_col">
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bd-secondary">승인거절</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td class="edit_col">
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        -->
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



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>