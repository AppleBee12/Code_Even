<?php
$title = "전체회원목록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/code_even/admin/inc/date_format_func.php');

//상태 검색 추가
$user_status = isset($_GET['user_status']) ? $_GET['user_status'] : 'all';
// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';
$conditions = [];

// 검색어 조건
if ($keywords) {
  $conditions[] = "(user.userid LIKE '%$keywords%' OR user.username LIKE '%$keywords%' OR user.useremail LIKE '%$keywords%')";
}

if ($user_status !== 'all') {
  $conditions[] = "user.user_status = $user_status";
}

// WHERE 절 생성
if (!empty($conditions)) {
  $where_clause = "WHERE " . implode(" AND ", $conditions);
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


$sql = "SELECT * 
        /*
        DATE_FORMAT(signup_date, '%Y/%m/%d') AS formatted_signup_date, 
        DATE_FORMAT(last_date, '%Y/%m/%d %H:%i:%s') AS formatted_last_date 
        */
        FROM user $where_clause 
        ORDER BY user.uid DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

while($data = $result->fetch_object()){
  $dataArr[] = $data;
}

?>

<div class="container">
  <h2 class="page_title">전체회원목록</h2>
  <form action="#" id="search_form" class="row justify-content-end">
    <div class="col-lg-3 ulist_status pt_04">
      <span class="status_tt me-4">회원상태</span>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="user_status" id="status_all" value="all" <?= $user_status === 'all' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="status_all">전체</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="user_status" id="status_normal" value="0" <?= $user_status === '0' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="status_normal">정상</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="user_status" id="status_withdrawn" value="-1" <?= $user_status === '-1' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="status_withdrawn">탈퇴</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="user_status" id="status_suspended" value="1" <?= $user_status === '1' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="status_suspended">정지</label>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="상태 선택 또는 검색어를 입력하세요." name="keywords" value="<?= htmlspecialchars($keywords); ?>">
        <button class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </form>
  <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">번호</th>
        <th scope="col">아이디</th>
        <th scope="col">이름</th>
        <th scope="col">이메일</th>
        <th scope="col">가입일</th>
        <th scope="col">마지막접속일</th>
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
        <td>
          <?php
            if ($item->user_level == 100) {
                echo "관리자";
            } elseif ($item->user_level == 10) {
                echo "강사";
            } elseif ($item->user_level == 1) {
                echo "일반회원";
            }
          ?>
        </td>
        <td>
          <?php
            if ($item->user_status == 0) {
              echo "<span class=\"badge text-bg-light\">정상</span>";
            } elseif ($item->user_status == 1) {
              echo "<span class=\"badge text-bg-secondary\">정지</span>";
            } elseif ($item->user_status == -1) {
              echo "<span class=\"badge text-outline-secondary\">탈퇴</span>";
            }
          ?>
        </td>
        <!-- <td class="edit_col"> -->
        <td>
          <a href="user_edit.php?uid=<?= $item->uid; ?>">
            <i class="bi bi-pencil-fill"></i> 
            <span class="visually-hidden">수정</span>  
          </a>
          <!-- <a href="user_del.php?uid=<?= $item->uid; ?>">
            <i class="bi bi-trash-fill del_link"></i>
            <span class="visually-hidden">삭제</span>
          </a> -->
        </td>
      </tr>
      <?php
          }
        }
      ?>
    </tbody> 
  </table>
  <!--//table -->
  
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
  $('.del_link').click(function(e) {
        if (!confirm('정말 삭제하시겠습니까? 삭제 후에는 복구가 불가능합니다.')) {
          e.preventDefault();
        }
      });

  //새로고침 시 주소창 리셋
  if (window.location.search) {
    // URL에 파라미터가 있을 때만 실행
    const url = window.location.href.split('?')[0];
    window.history.replaceState(null, null, url);
  }
</script>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>