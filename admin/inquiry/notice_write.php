<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$sql = "SELECT userid, username FROM user";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2>문의게시판 관리</h2>
  <div class="content_bar">
    <h3>전체 공지사항 작성</h3>
  </div>

  <form action="notice_write_ok.php" method="POST" enctype="multipart/form-data" id="WnEform">
    <input type="hidden" name="username" value="<?= $data->username; ?>">
    <input type="hidden" name="userid" value="<?= $data->userid; ?>">
    <input type="hidden" name="content" id="notice_content">
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
          <th scope="row">이름(아이디)</th>
          <td><?= $data->username; ?>(<?= $data->userid; ?>)</td>
          <th scope="row">상태 <b>*</b></th>
          <td class="d-flex gap-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="fix" id="fixOn" value=1>
              <label class="form-check-label" for="fixOn">
                고정
              </label>
            </div>
            <div class="form-check">
              <input class=" form-check-input" type="radio" name="fix" id="fixOff" value=0 checked>
              <label class="form-check-label" for="fixOff">
                일반
              </label>
            </div>
          </td>
        </tr>
        <tr class="none">
          <th scope="row">제목 <b>*</b></th>
          <td colspan="3">
            <div>
              <input type="text" name="title" class="form-control w-75" id="title" placeholder="제목을 입력해주세요." required>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div name="content" id="summernote"></div>
    <div class="custom-hr"></div>
    <div class="d-flex justify-content-end gap-2">
      <button type="button" class="btn btn-outline-danger" onclick="window.history.back();" aria-label="취소">취소</button>
      <button type="submit" class="btn btn-secondary">등록</button>
    </div>
  </form>

</div>

<script>

$('#WnEform').on('submit', function() {
  var noticeContent = $('#summernote').summernote('code');  // Summernote 에디터에서 HTML 코드 가져오기
  $('#notice_content').val(noticeContent);  // 숨겨진 input에 설정
});

</script>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>