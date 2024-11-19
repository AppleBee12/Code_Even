<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$ntid = $_GET['ntid'];
$sql = "SELECT notice.*, user.username, user.userid FROM notice JOIN user ON notice.uid = user.uid WHERE ntid = $ntid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2>문의게시판 관리</h2>
  <div class="content_bar">
    <h3>전체 공지사항 수정</h3>
  </div>

  <form action="notice.php" method="POST">
    <table class="table details_table">
      <colgroup>
        <col class="col-width-160">
        <col class="col-width-516">
        <col class="col-width-160">
        <col class="col-width-516">
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
          <td><?= $data->username; ?>(<?= $data->userid; ?>)</td>
        </tr>
        <tr>
          <th scope="row">등록일</th>
          <td><?= $data->regdate; ?></td>
          <th scope="row">조회수</th>
          <td><?= $data->view; ?></td>
        </tr>
        <tr class="none">
          <th scope="row">제목</th>
          <td colspan="3"><?= $data->title; ?></p></td>
        </tr>
      </tbody>
    </table>
    <div class="card">
      <div class="card-body">
        <p><?= $data->content; ?></p>
      </div>
    </div>
    <div class="custom-hr"></div>
    <button type="button" class="btn btn-outline-danger ms-auto d-block" onclick="window.history.back();" aria-label="취소">취소</button>
  </form>

</div>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>