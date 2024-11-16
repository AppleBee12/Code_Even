<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 검색어 받기
$keywords = isset($_GET['keywords']) ? $_GET['keywords'] : '';

// 쿼리 실행: 검색어로 제목과 이름을 찾기
$sql = "SELECT notice.*, user.username, user.userid 
        FROM notice 
        JOIN user ON notice.uid = user.uid 
        WHERE notice.title LIKE '%$keywords%' OR user.username LIKE '%$keywords%' 
        ORDER BY notice.ntid DESC";
$result = $mysqli->query($sql);

?>

<div class="container">
  <h2>검색 결과</h2>
  <form action="notice_search_result.php" class="row justify-content-end">
    <div class="col-lg-4">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="검색어를 입력하세요." name="keywords" value="<?= htmlspecialchars($keywords); ?>">
        <button type="button" class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </form>

  <?php if ($result->num_rows > 0): ?>
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
          <th scope="col">제목</th>
          <th scope="col">조회수</th>
          <th scope="col">등록일</th>
          <th scope="col">상태</th>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($no = $result->fetch_object()): ?>
          <tr>
            <td><?= $no->ntid; ?></td>
            <td><?= $no->userid; ?></td>
            <td><?= $no->username; ?></td>
            <td><a href="notice_modify.php?ntid=<?= $no->ntid; ?>" class="underline"><?= $no->title; ?></a></td>
            <td><?= $no->view; ?></td>
            <td><?= $no->regdate; ?></td>
            <td>
              <?php
              $class = $no->status == 'on' ? 'text-bg-success' : 'text-bg-light';
              $text = $no->status == 'on' ? '노출' : '숨김';
              echo "<span class='badge $class'>$text</span>";
              ?>
            </td>
            <td>
              <a href="notice_modify.php?ntid=<?= $no->ntid; ?>"><i class="bi bi-pencil-fill"></i></a>
              <a href="notice_delete.php?ntid=<?= $no->ntid; ?>"><i class="bi bi-trash-fill"></i></a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>검색 결과가 없습니다.</p>
  <?php endif; ?>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>
