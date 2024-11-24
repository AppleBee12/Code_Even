<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$ntid = $_GET['ntid'];

$sql = "SELECT notice.*, user.username, user.userid FROM notice JOIN user ON notice.uid = user.uid WHERE ntid = $ntid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

// print_r($data);

$view = $data->view + 1;

$viewSql = "UPDATE notice SET view = $view WHERE ntid = $ntid;";
$vresult = $mysqli->query($viewSql);

$sql = "SELECT notice.*, user.* FROM notice JOIN user ON notice.uid = user.uid WHERE ntid = $ntid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

$existingContent = htmlspecialchars_decode($data->content);

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
          <td><?= $data->username; ?>(<?= $data->userid; ?>)
          <?php
            $class = $data->user_level == '100' ? 'text-bg-danger' : 'text-bg-dark';
            $text = $data->user_level == '100' ? '관리자' : '강사';
            echo "<span class='badge $class'>$text</span>";
            ?>
        </td>
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
        <p><?= $existingContent; ?></p>
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