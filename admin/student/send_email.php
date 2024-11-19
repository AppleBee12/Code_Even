<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE send_email.title LIKE '%$keywords%' OR user.username LIKE '%$keywords%' OR user.userid LIKE '%$keywords%'";
}

// 이메일 발송 목록 게시글 개수 조회
$page_sql = "SELECT COUNT(*) AS cnt FROM send_email 
             JOIN user ON send_email.uid = user.uid 
             $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

// 페이지네이션 설정
$page = isset($_GET['page']) ? $_GET['page'] : 1; // 현재 페이지
$list = 10; // 한 페이지에 표시할 게시글 개수
$start_num = ($page - 1) * $list; // 페이지 시작 번호
$block_ct = 5; // 한 블록에 표시할 페이지 개수
$block_num = ceil($page / $block_ct); // 현재 블록 번호
$block_start = (($block_num - 1) * $block_ct) + 1; // 블록 시작 페이지
$block_end = $block_start + $block_ct - 1; // 블록 끝 페이지

$total_page = ceil($row_num / $list); // 총 페이지 수
$total_block = ceil($total_page / $block_ct); // 총 블록 수

if ($block_end > $total_page) {
  $block_end = $total_page; // 블록 끝 페이지가 총 페이지 수를 넘지 않도록 설정
}

// 이메일 발송 목록 조회 쿼리
$sql = "SELECT send_email.*, user.username, user.userid 
        FROM send_email 
        JOIN user ON send_email.uid = user.uid 
        $where_clause 
        ORDER BY send_email.regdate DESC 
        LIMIT $start_num, $list";

$result = $mysqli->query($sql);

$dataArr = [];
$firstData = null;
if ($result->num_rows > 0) {
  while ($u = $result->fetch_object()) {

    $user_query = "SELECT username, useremail, userid FROM user WHERE uid = '$u->uid'";
    $user_result = $mysqli->query($user_query);
    $user_data = $user_result->fetch_object();
    

    $dataArr[] = (object)[
      'emid' => $u->emid,
      'userid' => $user_data->userid,
      'username' => $user_data->username,
      'useremail' => $user_data->useremail,
      'title' => $u->title,
      'content' => $u->content,
      'regdate' => $u->regdate
    ];

      // 첫 번째 데이터만 따로 저장
      if ($firstData === null) {
        $firstData = $u;
        // print_r($firstData);
    }
  }
}


?>

<div class="container">
  <h2>이메일 발송 목록</h2>
  <form class="row justify-content-end">
    <div class="col-lg-4">
      <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="검색어를 입력하세요." name="keywords"
      value="<?= htmlspecialchars($keywords); ?>">
        <button type="submit" class="btn btn-secondary">
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
        <th scope="col">제목</th>
        <th scope="col">발송일</th>
      </tr>
    </thead>
    <tbody>
    <?php
      if ($dataArr) {
          foreach ($dataArr as $e) {
      ?>
      <tr>
        <td><?= $e->emid ?></td>
        <td><?= htmlspecialchars($e->userid); ?></td>
        <td><?= htmlspecialchars($e->username); ?></td>
        <td><?= htmlspecialchars($e->useremail); ?></td>
        <td><a href="#" class="underline email-detail-link" data-bs-toggle="modal" data-bs-target="#email_details" data-id="<?= $e->emid ?>" ><?= $e->title ?></a></td>
        <td><?= $e->regdate ?></td>
      </tr>
      <?php
            }
        } else {
            echo "<tr><td colspan='6'>검색 결과가 없습니다.</td></tr>";
        }
      ?>
    </tbody>
  </table>

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
          <a class="page-link" href="send_email.php?page=<?= $previous; ?>" aria-label="Previous">
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
        <li class="page-item <?= $active; ?>"><a class="page-link" href="send_email.php?page=<?= $i; ?>"><?= $i; ?></a></li>
        <?php
      }
      $next = $block_end + 1;
      if ($total_block > $block_num) {
        ?>
        <li class="page-item">
          <a class="page-link" href="send_email.php?page=<?= $next; ?>" aria-label="Next">
            <i class="bi bi-chevron-right"></i>
          </a>
        </li>
        <?php
      }
      ?>
    </ul>
  </div>

    <!-- //email 상세 모달창 -->
  <div class="modal" tabindex="-1" id="email_details" aria-labelledby="emailModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">이메일 내용 상세</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <table class="table">
              <colgroup>
                <col class="col-width-130">
                <col>
              </colgroup>
              <thead class="thead-hidden">
                <tr>
                  <th scope="col">구분</th>
                  <th scope="col">내용</th>
                </tr>
              </thead>
              <tbody>
                <tr class="none">
                  <th scope="row">이름(아이디)</th>
                  <td class="modal_username"></td>
                </tr>
                <tr>
                  <th scope="row">이메일</th>
                  <td class="modal_useremail"></td>
                </tr>
                <tr class="none">
                  <th scope="row">제목</th>
                  <td colspan="3"><input type="text" name="title" class="form-control" disabled></td>
                </tr>
                <tr class="none">
                  <th scope="row">내용</th>
                  <td colspan="3"><textarea name="content" class="form-control" disabled></textarea></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
          </div>
      </div>
    </div>
  </div>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>

<script>

    const emailData = <?= json_encode($dataArr); ?>;
    $(document).on('click', '.email-detail-link', function (e) {
      e.preventDefault();
    const id = $(this).data('id'); // 클릭한 링크의 id 값 가져오기
    const email = emailData.find(e => e.emid == id); // 배열에서 해당 id의 데이터 찾기

    if (email) {
        // 모달창 업데이트
        $('.modal_username').text(`${email.username} (${email.userid})`);
        $('.modal_useremail').text(email.useremail);
        $('input[name="title"]').val(email.title);
        $('textarea[name="content"]').val(email.content); // 콘텐츠 수정
    } else {
        alert('데이터를 찾을 수 없습니다.');
    }
});
</script>