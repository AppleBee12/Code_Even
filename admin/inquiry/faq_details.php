<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$fqid = $_GET['fqid'];

$view = "viewed_$fqid";

if (!isset($_SESSION[$view]) || $_SESSION[$view] < strtotime('today')) {

    $viewSql = "UPDATE faq SET view = view + 1 WHERE fqid = $fqid;";
    $mysqli->query($viewSql);

    $_SESSION[$view] = time();
}

$sql = "SELECT faq.*, user.username, user.userid FROM faq JOIN user ON faq.uid = user.uid WHERE fqid = $fqid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

$sql = "SELECT faq.*, user.username, user.userid FROM faq JOIN user ON faq.uid = user.uid WHERE fqid = $fqid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2>FAQ</h2>
  <div class="content_bar">
    <h3>FAQ 상세</h3>
  </div>

  <form action="" method="GET">
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
        <tr>
          <th scope="row">등록일</th>
          <td><?= $data->regdate; ?></td>
          <th scope="row">조회수</th>
          <td><?= $data->view; ?></td>
        </tr>
        <tr>
          <th scope="row">유형</th>
          <td>
            <select class="form-select w-50" name="target" id="target" disabled>
              <option value="<?= $data->target; ?>">
                <?php
                echo $data->target === "student" ? "수강생" : ($data->target === "teacher" ? "강사" : "알 수 없음");
                ?>
              </option>
            </select>
          </td>
          <th scope="row">분류</th>
          <td>
            <select class="form-select w-50" aria-label="category select" name="category" disabled>
              <option value="">분류 선택</option>
              <option value="1" <?= $data->category == 1 ? 'selected' : '' ?>>결제/환불</option>
              <option value="2" <?= $data->category == 2 ? 'selected' : '' ?>>강의</option>
              <option value="3" <?= $data->category == 3 ? 'selected' : '' ?>>쿠폰</option>
              <option value="4" <?= $data->category == 4 ? 'selected' : '' ?>>가입/탈퇴</option>
              <option value="5" <?= $data->category == 5 ? 'selected' : '' ?>>기타</option>
              <option value="6" <?= $data->category == 6 ? 'selected' : '' ?>>수료</option>
              <option value="7" <?= $data->category == 7 ? 'selected' : '' ?>>정산</option>
              <option value="8" <?= $data->category == 8 ? 'selected' : '' ?>>강사</option>
            </select>
          </td>
        </tr>
      <?php if ($level == 100): ?>
        <tr>
          <th scope="row">이름(아이디)</th>
          <td><?= $data->username; ?>(<?= $data->userid; ?>)</td>
          <th scope="row">상태 <b>*</b></th>
          <td class="d-flex gap-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="status" id="status" value="on"
                <?= ($data->status === 'on') ? 'checked' : ''; ?> required>
              <label class="form-check-label" for="status">
                노출
              </label>
            </div>
            <div class="form-check">
              <input class=" form-check-input" type="radio" name="status" id="status" value="off"
                <?= ($data->status === 'off') ? 'checked' : ''; ?>>
              <label class="form-check-label" for="status">
                숨김
              </label>
            </div>
          </td>
        </tr>
      <?php endif; ?>
        <tr class="none">
          <th scope="row">제목</th>
          <td colspan="3">
            <div>
              <input type="text" name="title" class="form-control w-75" id="title" placeholder="제목을 입력해주세요."
                value="<?= $data->title; ?>" disabled>
            </div>
          </td>
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

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>