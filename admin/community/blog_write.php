<?php
$title = "블로그 글쓰기";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$target = $_GET['post'];

$sql = "SELECT userid, username FROM user";
$result = $mysqli->query($sql);
$data = $result->fetch_object();
?>

<div class="container">
  <h2><?php $title ?></h2>
  <div class="content_bar">
    <h3>글 쓰기</h3>
  </div>

  <form action="blo_write_ok.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="">
    <table class="table info_table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="titles">글 제목 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="titles" name="titles" class="form-control" placeholder="입력 필수 값 입니다." value="">
          </td>
          <th scope="row" rowspan="3">썸네일 미리보기</th>
          <td rowspan="3" class="thumb_parent">
            <?php
            $thumbnail_path = !empty($row['thumnails']) ? 'http://' . $_SERVER['HTTP_HOST'] . $row['thumnails'] : '';
            $image_src = (!empty($row['thumnails']) && file_exists($thumbnail_path)) ? $row['thumnails'] : '/CODE_EVEN/admin/upload/teacher/tc_dummy.png';
            ?>
            <img id="thumbnail_preview" src="<?= $thumbnail_path; ?>" class="angled_square thumb_child" width=200 height=200 alt="프로필 이미지">

          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="regdate">작성일</label>
          </th>
          <td>
            <input type="text" id="regdate" name="regdate" class="form-control" value="" disabled readonly>
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
            <div name="contents" id="summernote"><?= $row['contents'] ?></div>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
  <div class="d-flex justify-content-end gap-2">
    <a href="javascript:history.back();"><button class="btn btn-outline-danger">취소</button></a>
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/blog_write_ok.php"><button class="btn btn-outline-secondary">수정</button></a>
  </div>
</div>


<script>
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
</script>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>
<script>
  let target = $('#summernote');
  target.summernote({
    height: 400,
  });
</script>
