<?php
$title = "블로그 글쓰기";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$sql = "SELECT userid FROM user";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2><?php $title ?></h2>
  <div class="content_bar">
    <h3>글 쓰기</h3>
  </div>

  <form action="blog_write_ok.php" id="blog_save" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="userid" value=" <?= $data->userid; ?>">
    <input type="hidden" name="contents" id="contents" value="">
    <table class="table info_table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="titles">글 제목 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="titles" name="titles" class="form-control" placeholder="입력 필수 값 입니다." value="">
          </td>
          <th scope="row" rowspan="2">썸네일 미리보기</th>
          <td rowspan="2" class="thumb_parent_prev">
            <img id="thumbnail_preview" src="http://<?=$_SERVER['HTTP_HOST']?>/code_even/admin/images/adminprofile.png" class="thumb_child_prev" width=110 height=110 alt="프로필 이미지">
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="thumnails">썸네일 등록</label>
          </th>
          <td>
            <input type="file" accept="image/*" id="thumnails" name="thumnails" class="form-control" value="">
          </td>
        </tr>
        <tr>
          <th scope="row">글 내용 <b>*</b></th>
          <td colspan="5" class="editor">
            <div name="contents" id="summernote"></div>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="d-flex justify-content-end gap-2">
      <a href="javascript:history.back();"><button class="btn btn-outline-danger">취소</button></a>
      <button class="btn btn-secondary">등록</button>
    </div>
  </form>
</div>


<script>
  // 썸네일
  let thumbnail = $('#thumnails');
  thumbnail.on('change', (e) => {
    let file = e.target.files[0];

    const reader = new FileReader();
    reader.onloadend = (e) => {
      let attachment = e.target.result;
      if (attachment) {
        let target = $('#thumbnail_preview');
        target.attr('src', attachment)
      }
    }
    reader.readAsDataURL(file);
  });

//에디터
$('#teacher_save').submit(function(e){
    //e.preventDefault();
    var markup = target.summernote('code');
    let content = encodeURIComponent(markup);
    $('#contents').val(markup);
  });

</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>