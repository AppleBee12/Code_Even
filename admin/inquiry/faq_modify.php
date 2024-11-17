<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$fqid = $_GET['fqid'];

$sql = "SELECT faq.*, user.username, user.userid FROM faq JOIN user ON faq.uid = user.uid WHERE fqid = $fqid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2>FAQ</h2>
  <div class="content_bar">
    <h3>FAQ 수정</h3>
  </div>

  <form action="faq_modify_ok.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="username" value="<?= $data->username ?>">
    <input type="hidden" name="userid" value="<?= $data->userid; ?>">
    <input type="hidden" name="fqid" value="<?= $data->fqid; ?>">
    <table class="table details_table">
      <colgroup>
        <col style="width:160px">
        <col style="width:516px">
        <col style="width:160px">
        <col style="width:516px">
      </colgroup>
      <thead class="thead-hidden">
        <tr>
          <th scope="col">구분</th>
          <th scope="col">내용</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">유형 <b>*</b></th>
          <td>
            <select class="form-select w-50" aria-label="Default select example" name="target" id="target">
              <option value="<?=$data->target;?>">
                <?php 
                  echo $data->target === "student" ? "수강생" : ($data->target === "teacher" ? "강사" : "알 수 없음"); 
                ?>
              </option>
            </select>
          </td>
          <th scope="row">분류 <b>*</b></th>
          <td>
            <select class="form-select w-50" aria-label="Default select example" name="category">
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
        <tr>
        <th scope="row">이름(아이디)</th>
        <td><?= $data->username; ?>(<?= $data->userid; ?>)</td>
          <th scope="row">상태 <b>*</b></th>
          <td class="d-flex gap-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="status" id="status" value="on"
                <?= ($data->status === 'on') ? 'checked' : ''; ?>
              >
              <label class="form-check-label" for="status">
                노출
              </label>
            </div>
            <div class="form-check">
              <input class=" form-check-input" type="radio" name="status" id="status" value="off"
                <?= ($data->status === 'off') ? 'checked' : ''; ?>
              >
              <label class="form-check-label" for="status">
                숨김
              </label>
            </div>
          </td>
        </tr>
        <tr class="none">
          <th scope="row">제목 <b>*</b></th>
          <td colspan="3">
            <div>
              <input type="text" name="title" class="form-control w-75" id="title" placeholder="제목을 입력해주세요." value="<?=$data->title;?>">
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <textarea name="content" id="content" class="form-control" ><?=$data->content;?></textarea>
    <input type="file" class="form-control" id="inputGroupFile02" class="w-50">
    <div class="custom-hr"></div>
  
    <div class="d-flex justify-content-end gap-2">
      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/student_faq.php"
        class="btn btn-outline-danger">취소</a>
      <button type="submit" class="btn btn-secondary">등록</button>
    </div>
  </form>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>