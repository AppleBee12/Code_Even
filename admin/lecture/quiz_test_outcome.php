<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 검색 키워드 처리
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';

$where_clause = '';
if (!empty($keywords)) {
  $where_clause = "WHERE lecture.title LIKE '%$keywords%' OR lecture.name LIKE '%$keywords%'";
}

// 게시글 개수 구하기
$page_sql = "SELECT COUNT(*) AS cnt FROM lecture $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_object();
$row_num = $page_data->cnt;

// 페이지네이션
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
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
  <h2>퀴즈 / 시험 결과 관리</h2>
  <form action="" method="GET" class="d-flex justify-content-end align-items-center gap-4 mb-3">
    <div class="d-flex w-25 mb-3">
    <input type="text" name="keywords" class="form-control" placeholder="검색어를 입력하세요." value="<?= htmlspecialchars($keywords); ?>">
      <button type="submit" class="btn lesearch"><i class="bi bi-search"></i></button>
    </div>
  </form>
  <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">번호</th>
        <th scope="col">이름</th>
        <th scope="col">강좌명</th>
        <th scope="col">퀴즈 점수</th>
        <th scope="col">시험 점수</th>
        <th scope="col">미리보기</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>정민재</td>
        <td class="title-cell">기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)</td>
        <td>90점</td>
        <td>80점</td>
        <td>
          <button type="button" class="btn btn-sm nlecture">미리보기</button>
        </td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>김재현</td>
        <td class="title-cell">HTML 정도는 껌이지</td>
        <td>70점</td>
        <td>85점</td>
        <td>
          <button type="button" class="btn btn-sm nlecture">미리보기</button>
        </td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>박미라</td>
        <td class="title-cell">기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)</td>
        <td>75점</td>
        <td>60점</td>
        <td>
          <button type="button" class="btn btn-sm nlecture">미리보기</button>
        </td>
      </tr>
    </tbody>
  </table>
  <!-- Pagination -->
  <div class="list_pagination" aria-label="Page_navigation">
        <ul class="pagination d-flex justify-content-center">
              <li class="page-item">
                  <a class="page-link">1</a>
              </li>
        </ul>
    </div>
</div>
<script>
  $('.title-cell').each(function () {
    const originalText = $(this).text().trim(); // 셀의 원래 텍스트를 가져옴
    if (originalText.length > 20) {
      $(this).text(originalText.substring(0, 25) + '...'); // 20자 이후 잘라내고 ... 추가
    }
  });
</script>


<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');

?>