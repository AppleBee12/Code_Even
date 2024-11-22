<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

  // 게시글 개수 구하기
  $keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
  $where_clause = '';

  if ($keywords) {
    $where_clause = "WHERE lecture.title LIKE '%$keywords%'";
  }

  $page_sql = "SELECT COUNT(*) AS cnt FROM lecture $where_clause";
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

  $sql = "SELECT * FROM book $where_clause 
            ORDER BY book.boid DESC 
            LIMIT $start_num, $list";
  $result = $mysqli->query($sql);

  while ($data = $result->fetch_object()) {
    $dataArr[] = $data;
  }

  // DB에서 카테고리 데이터 가져오기
  $sql_cate = "SELECT * FROM category ORDER BY step, pcode";
  $result_cate = $mysqli->query($sql_cate);

  $categories = [];
  while ($row = $result_cate->fetch_object()) {
    $categories[] = $row;
  }

?>

<div class="container">
  <h2>교재 목록</h2>
  <form action="" class="d-flex justify-content-end align-items-center gap-4 mb-3">
    <p class="mb-0">분류 선택</p>
    <select name="cate1" id="cate1" class="form-select custom-select-width" aria-label="대분류">
      <option selected>대분류</option>
      <?php foreach ($categories as $category) {
        if ($category->step == 1) {
          echo "<option value='{$category->code}'>{$category->name}</option>";
        }
      } ?>
    </select>
    <select name="cate2" id="cate2" class="form-select custom-select-width" aria-label="Default select example">
      <option selected value="">중분류</option>
    </select>
    <select name="cate3" id="cate3" class="form-select custom-select-width" aria-label="Default select example">
      <option selected value="">소분류</option>
    </select>
    <div class="d-flex align-items-center">
      <input type="text" class="form-control" placeholder="검색어를 입력하세요." name="keywords"
        value="<?= htmlspecialchars($keywords); ?>">
      <button type="button" class="btn lesearch"><i class="bi bi-search"></i></button>
    </div>
  </form>
  <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">
          <input class="form-check-input" type="checkbox" value="" id="allCheck">
        </th>
        <th scope="col">번호</th>
        <th scope="col">이미지</th>
        <th scope="col">교재명</th>
        <th scope="col">등록자</th>
        <th scope="col">출판사명</th>
        <th scope="col">출판일</th>
        <th scope="col">저자</th>
        <th scope="col">가격</th>
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
          <input class="form-check-input itemCheckbox" type="checkbox" value="">
        </th>
        <th scope="row">
          <input type="hidden" name="leid[]" value="<?= $item->boid; ?>">
          <?= $item->boid; ?>
        </th>
        <td class="lecture-img"><img src="<?= $item->image; ?>"alt=""></td>
        <td class="title-cell"><?= $item->title; ?></td>
        <td><?= $item->name; ?></td>    
        <td><?= $item->company; ?></td>
        <td><?= date('Y-m-d', strtotime($item->pd)); ?></td>
        <td><?= $item->writer; ?></td>
        <td><?= $item->price; ?></td>
        <td>
          <div class="d-falex justify-content-center gap-4">
            <!-- 수정 버튼 -->
            <a href="book_edit.php?id=<?= $item->boid; ?>">
              <i class="bi bi-pencil-fill"></i>
            </a>
            <!-- 삭제 버튼 -->
            <a href="book_delete.php?id=<?= $item->boid; ?>" onclick="return confirm('이 강좌를 삭제하시겠습니까?');">
              <i class="bi bi-trash"></i>
            </a>
          </div>
        </td>
      </tr>
      <?php
          }
        }
      ?>
    </tbody>
  </table>
  <div class="d-flex justify-content-end gap-2 mt-20 mb-50">
    <button type="button" id="deleteSelectedBtn" class="btn selecmodify">일괄 삭제</button>
  </div>
  <!-- //Pagination -->
  <div class="list_pagination" aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
      <?php
      $previous = $block_start - $block_ct;
      if ($previous < 1)
        $previous = 1;
      if ($block_num > 1) {
        ?>
        <li class="page-item">
          <a class="page-link" href="book_list.php?page=<?= $previous; ?>" aria-label="Previous">
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
        <li class="page-item <?= $active; ?>">
          <a class="page-link" href="book_list.php?page=<?= $i; ?>"><?= $i; ?></a>
        </li>
        <?php
      }
      $next = $block_end + 1;
      if ($total_block > $block_num) {
        ?>
        <li class="page-item">
          <a class="page-link" href="book_list.php?page=<?= $next; ?>" aria-label="Next">
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
  // 카테고리 데이터 변환
  const categories = <?php echo json_encode($categories); ?>;

  // 대분류 선택 -> 중분류 업데이트
  $('#cate1').on('change', function () {
    const cate1 = $(this).val();

    if (cate1) {
      const filterCate2 = categories.filter(category => category.step == 2 && category.pcode == cate1);

      $('#cate2').html('<option value="">중분류</option>');
      filterCate2.forEach(category => {
        $('#cate2').append(`<option value="${category.code}">${category.name}</option>`);
      });
      $('#cate3').html('<option value="">소분류</option>');
    } else {
      $('#cate2').html('<option value="">중분류</option>');
      $('#cate3').html('<option value="">소분류</option>');
    }
  });

  // 중분류 선택 -> 소분류 업데이트
  $('#cate2').on('change', function () {
    const cate2 = $(this).val();

    if (cate2) {
      const filterCate3 = categories.filter(category => category.step == 3 && category.pcode == cate2);

      $('#cate3').html('<option value="">소분류</option>');
      filterCate3.forEach(category => {
        $('#cate3').append(`<option value="${category.code}">${category.name}</option>`);
      });
    } else {
      $('#cate3').html('<option value="">소분류</option>');
    }
  });

  $('.title-cell').each(function () {
    const originalText = $(this).text().trim(); // 셀의 원래 텍스트를 가져옴
    if (originalText.length > 20) {
      $(this).text(originalText.substring(0, 20) + '...'); // 20자 이후 잘라내고 ... 추가
    }
  });
</script>

<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');

?>