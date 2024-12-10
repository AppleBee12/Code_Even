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

  <form action="faq_modify_ok.php" method="POST" enctype="multipart/form-data" id="WnEform">
    <input type="hidden" name="username" value="<?= $data->username ?>">
    <input type="hidden" name="userid" value="<?= $data->userid; ?>">
    <input type="hidden" name="fqid" value="<?= $data->fqid; ?>">
    <input type="hidden" name="content" id="faq_content">
    <input type="hidden" name="table_name" id="table_name" value="faq">
    <input type="hidden" name="table_id" id="table_id" value="<?= $data->fqid; ?>">
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
          <th scope="col">구분</th>
          <th scope="col">내용</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">유형 <b>*</b></th>
          <td>
          <select class="form-select w-50" name="target" id="target">
          <!-- student가 선택되었으면 teacher는 비활성화 -->
          <option value="student" <?= ($data->target === "student") ? 'selected' : ''; ?> <?= ($data->target !== "student") ? 'disabled' : ''; ?>>수강생</option>
          <!-- teacher가 선택되었으면 student는 비활성화 -->
          <option value="teacher" <?= ($data->target === "teacher") ? 'selected' : ''; ?> <?= ($data->target !== "teacher") ? 'disabled' : ''; ?>>강사</option>
        </select>
          </td>
          <th scope="row">분류 <b>*</b></th>
          <td>
            <select class="form-select w-50" name="category" required>
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
              <input class="form-check-input" type="radio" name="status" id="statusOn" value="on"
                <?= ($data->status === 'on') ? 'checked' : ''; ?> required>
              <label class="form-check-label" for="statusOn">
                노출
              </label>
            </div>
            <div class="form-check">
              <input class=" form-check-input" type="radio" name="status" id="statusOff" value="off"
                <?= ($data->status === 'off') ? 'checked' : ''; ?>>
              <label class="form-check-label" for="statusOff">
                숨김
              </label>
            </div>
          </td>
        </tr>
        <tr class="none">
          <th scope="row">제목 <b>*</b></th>
          <td colspan="3">
            <div>
              <input type="text" name="title" class="form-control w-75" id="title" placeholder="제목을 입력해주세요."
                value="<?= $data->title; ?>" required>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div name="content" id="summernote"><?=$data->content;?></div>
    <input type="file" class="form-control w-50" id="file">
    <div class="custom-hr"></div>

    <div class="d-flex justify-content-end gap-2">
      <a 
    <?php if ($data->target == 'student'): ?>
      href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/student_faq.php"
    <?php elseif ($data->target == 'teacher'): ?>
      href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/teacher_faq.php"
    <?php endif; ?>
        class="btn btn-outline-danger">취소</a>
      <button type="submit" class="btn btn-secondary">등록</button>
    </div>
  </form>

</div>

<script>

// 폼 제출 시 Summernote 내용 hidden 필드에 넣기
$('#WnEform').on('submit', function() {
  var faqContent = $('#summernote').summernote('code');  // Summernote 에디터에서 HTML 코드 가져오기
  $('#faq_content').val(faqContent);  // 숨겨진 input에 설정
});

</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>