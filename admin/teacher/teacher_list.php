<?php
  $title = "강사 목록";
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
  $tc_ok = isset($_GET['tc_ok']) ? $mysqli->real_escape_string($_GET['tc_ok']) : 'all';

  $where_clause = '';
  // 게시글 키워드 검색
  $keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';

  if ($keywords) {
    $where_clause = "WHERE teachers.tc_userid LIKE '%$keywords%' OR teachers.tc_name LIKE '%$keywords%' OR teachers.tc_email LIKE '%$keywords%'";
  }

    // 승인 상태 조건 추가
  if ($tc_ok !== 'all') {
    $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "teachers.tc_ok = '$tc_ok'";
  }
  if ($category_filter) {
    $where_clause .= ($where_clause ? ' AND ' : 'WHERE ') . "teachers.tc_cate = '$category_filter'";
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
  <form action="#" id="search_form" class="row justify-content-end" method="GET">
    <div class="col-lg-4 tlist_status pt_04">
      <span class="status_tt me-4">승인상태</span>
      <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="tc_ok" id="status_all" value="all" <?= $tc_ok === 'all' ? 'checked' : ''; ?>>
      <label class="form-check-label" for="status_all">전체</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="tc_ok" id="status_normal" value="0" <?= $tc_ok === '0' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="status_normal">심사중</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="tc_ok" id="status_suspended" value="1" <?= $tc_ok === '1' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="status_suspended">승인완료</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="tc_ok" id="status_withdrawn" value="-1" <?= $tc_ok === '-1' ? 'checked' : ''; ?>>
        <label class="form-check-label" for="status_withdrawn">승인거절</label>
    </div>


    </div>
    <div class="col-lg-2">
      <select class="form-select" name="category" aria-label="대표분야">
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
        <input type="text" class="form-control" placeholder="상태/분야 선택 또는 검색어를 입력하세요." name="keywords" value="<?= htmlspecialchars($keywords); ?>">
        <button type="submit" class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </form>
  <!-- //Search-form -->

  <form action="tclist_update.php" method="GET">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">
            <input class="form-check-input" type="checkbox" id="allCheck">
          </th>
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
          <td>
            <input class="form-check-input itemCheckbox" type="checkbox" name="delarr[]" value="<?= $item->tcid; ?>">
          </td>
          <th scope="row">
            <input type="hidden" name="tcid[]" value="<?= $item->tcid; ?>">
            <?= $item->tcid; ?>
          </th>
          <td>
            <?php 
              $thumbnail_path = !empty($item->tc_thumbnail) ? $_SERVER['DOCUMENT_ROOT'] . $item->tc_thumbnail : '';
              $image_src = (!empty($item->tc_thumbnail) && file_exists($thumbnail_path)) ? $item->tc_thumbnail : '/CODE_EVEN/admin/upload/teacher/tc_dummy.png';
            ?>
            <img src="<?= $image_src; ?>" class="rounded_circle" width="35" height="35" alt="프로필 이미지">
          </td>
          <td><?= $item->tc_userid; ?></td> 
          <td><?= $item->tc_name; ?></td> 
          <td><?= $item->tc_email; ?></td>
          <td><?= isset($category_map[$item->tc_cate]) ? $category_map[$item->tc_cate] : '기타'; ?></td>
          <td>
          <select class="form-select form-select-sm tc_status" aria-label="승인여부" name="tc_ok[<?= $item->tcid; ?>]" id="tc_ok[<?= $item->tcid; ?>]">
              <option value="-1" <?php if($item->tc_ok == -1){echo 'selected';}?>>승인거절</option>
              <option value="0" <?php if($item->tc_ok == 0){echo 'selected';}?>>심사중</option>
              <option value="1" <?php if($item->tc_ok == 1){echo 'selected';}?>>승인완료</option>
            </select>
          </td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" id="isnew[<?= $item->tcid; ?>]" <?php echo $item->isnew ? 'checked' : ''; ?> name="isnew[<?= $item->tcid; ?>]" value="<?= $item->isnew ?>">
              <label class="form-check-label" for="isnew[<?= $item->tcid; ?>]">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" id="isrecom[<?= $item->tcid; ?>]" <?php echo $item->isrecom ? 'checked' : ''; ?> name="isrecom[<?= $item->tcid; ?>]" value="<?= $item->isrecom ?>">
              <label class="form-check-label" for="isrecom[<?= $item->tcid; ?>]">
                추천
              </label>
            </div>
          </td>
          <td class="edit_col">
            <a href="teacher_edit.php?tcid=<?= $item->tcid; ?>">
            <i class="bi bi-pencil-fill"></i>
            <span class="visually-hidden">수정</span>   
            </a>
            <a href="teacher_del.php?tcid=<?= $item->tcid; ?>" >
            <i class="bi bi-trash-fill del_link"></i>
            <span class="visually-hidden">삭제</span>
            </a>
          </td>
        </tr>
        <?php
            }
          }
        ?>
      </tbody>
    </table>
    <div class="d-grid d-md-flex justify-content-md-end">
      <button type="submit" class="btn btn-outline-secondary">일괄수정</button> 
    </div>
    <!--//table -->
  </form>

    <!-- 삭제용 폼 -->
    <form id="deleteForm" action="tclist_del.php" method="POST">
      <input type="hidden" name="delarr" id="delarr">
      <button type="button" class="btn btn-outline-danger" id="all_del_btn">일괄삭제</button>
    </form>
  <!-- //List -->

  
  <div class="list_pagination">
    <ul class="pagination d-flex justify-content-center">
      <?php
        $previous = $block_start - $block_ct;
        if ($previous < 1) $previous = 1;
        if ($block_num > 1) {
          $query_string = http_build_query(array_merge($_GET, ['page' => $previous]));
      ?>
      <li class="page-item">
        <a class="page-link" href="teacher_list.php?<?= $query_string; ?>" aria-label="Previous">
          <i class="bi bi-chevron-left"></i>
        </a>
      </li>
      <?php
        }
        for ($i = $block_start; $i <= $block_end; $i++) {
          $active = ($page == $i) ? 'active' : '';
          $query_string = http_build_query(array_merge($_GET, ['page' => $i]));
      ?>
      <li class="page-item <?= $active; ?>"><a class="page-link" href="teacher_list.php?<?= $query_string; ?>"><?= $i; ?></a></li>
      <?php
        }
        $next = $block_end + 1;
        if($total_block > $block_num) {
          $query_string = http_build_query(array_merge($_GET, ['page' => $next]));
      ?>
      <li class="page-item">
        <a class="page-link" href="teacher_list.php?<?= $query_string; ?>" aria-label="Next">
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
    $('table .form-check-input[type="checkbox"]').change(function(){
    if($(this).prop( "checked" )){
      $(this).val('1');
    } else{
      $(this).val('0');
    }
  });

  //개별삭제
  $('.del_link').click(function(e) {
      if (!confirm('정말 삭제하시겠습니까? 삭제 후에는 복구가 불가능합니다.')) {
        e.preventDefault();
      }
    });

  // 체크박스 전체선택
  $('#allCheck').on('change', function () {
    const isChecked = $(this).prop('checked'); // 전체 선택 여부 확인
    $('.itemCheckbox').prop('checked', isChecked); // 전체 체크박스 선택/해제
  });

  // 일괄삭제
  $('#all_del_btn').on('click', function () {
    const checkedBoxes = $('.itemCheckbox:checked'); // 체크된 항목
    const ids = checkedBoxes.map(function () {
      return $(this).val(); // 선택된 ID 수집
    }).get(); // jQuery 객체를 배열로 변환

    if (ids.length === 0) {
      alert('삭제할 항목을 선택하세요.');
      return;
    }

    // 선택된 ID를 hidden input에 JSON 형식으로 추가
    $('#delarr').val(JSON.stringify(ids));

    // 삭제 폼 제출
    $('#del_form').submit();
  });

  //새로고침 시 주소창 리셋
  if (window.location.search) {
    // URL에 파라미터가 있을 때만 실행
    const url = window.location.href.split('?')[0];
    window.history.replaceState(null, null, url);
  }
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>