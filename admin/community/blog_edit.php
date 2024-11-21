<?php
$title = "블로그";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2><?php $title ?></h2>
  <div class="content_bar">
    <h3>글 수정하기</h3>
  </div>

  <form action="">
    <table class="table info_table">
      <tbody>
        <?php
        // URL에서 post_id 가져오기
        $post_id = $_GET['post_id'] ?? null;

        if ($post_id) {
          // Prepared Statement로 SQL 작성
          $stmt = $mysqli->prepare("
          SELECT b.*, u.usernick 
          FROM blog b
          JOIN user u ON b.uid = u.uid 
          WHERE b.post_id = ?
      ");
      $stmt->bind_param('s', $post_id); // 's'는 string 타입

          // 쿼리 실행
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result && $row = $result->fetch_assoc()) {
            // $row에서 데이터를 가져와서 input 태그에 출력
        ?>
            <tr>
              <th scope="row">
                <label for="titles">글 제목 <b>*</b></label>
              </th>
              <td>
                <input type="text" id="titles" name="titles" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $row['titles'] ?>">
              </td>
              <th scope="row" rowspan="3">썸네일 미리보기</th>
              <td rowspan="3" class="thumb_parent">
                <?php 
                  $thumbnail_path = !empty($row['thumnails']) ? 'http://' . $_SERVER['HTTP_HOST'] . $row['thumnails'] : '';
                  $image_src = (!empty($row['thumnails']) && file_exists($thumbnail_path)) ? $row['thumnails'] : '/CODE_EVEN/admin/upload/teacher/tc_dummy.png';
                ?>
                <img id="thumbnail_preview" src="<?= $thumbnail_path; ?>" class="angled_square thumb_child" width = 200 height = 200 alt="프로필 이미지">

              </td>
            </tr>
            <tr>
              <th scope="row">
                <label for="regdate">작성일</label>
              </th>
              <td>
                <input type="text" id="regdate" name="regdate" class="form-control"  value="<?= $row['regdate'] ?>" disabled readonly>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <label for="thumnails">썸네일 등록</label>
              </th>
              <td>
                <input type="file" accept="image/*" id="thumnails" name="thumnails" class="form-control" value="<?= $row['thumnails'] ?>" >
              </td>
            </tr>
            <tr>
              <th scope="row">글 내용 <b>*</b></th>
              <td colspan="5" class="editor">
                <div name="contents" id="summernote"><?= $row['contents'] ?></div>
              </td>
            </tr>
        <?php
          } else {
            echo "해당 게시글을 찾을 수 없습니다.";
          }

          $stmt->close();
        } else {
          echo "잘못된 요청입니다.";
        }


        ?>
      </tbody>
    </table>
  </form>
  <div class="d-flex justify-content-end gap-2">
    <a href="javascript:history.back();"><button class="btn btn-outline-danger">취소</button></a>
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/blog_edit_ok.php"><button class="btn btn-outline-secondary">수정</button></a>
  </div>
</div>


<script>
   let thumbnail = $('#thumnails');
  thumbnail.on('change',(e)=>{
      let file = e.target.files[0];

      const reader = new FileReader(); 
      reader.onloadend = (e)=>{ 
        let attachment = e.target.result;
        if(attachment){
          let target = $('#thumbnail_preview');
          target.attr('src',attachment)
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