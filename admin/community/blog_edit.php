<?php
$title = "블로그";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2><?php $title ?></h2>
  <div class="content_bar">
    <h3>글 수정하기</h3>
  </div>

  <form action="/code_even/admin/community/blog_edit_ok.php" method="POST" id="blog_form" enctype="multipart/form-data">
    <input type="hidden" name="content" id="blog_content">
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
          <input type="hidden" name="post_id" value="<?= $post_id ?>">
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
                  $thumbnail_path = !empty($row['thumbnails']) ? 'http://' . $_SERVER['HTTP_HOST'] . $row['thumbnails'] : '';
                  $image_src = (!empty($row['thumbnails']) && file_exists($thumbnail_path)) ? $row['thumbnails'] : '/code_even/admin/upload/teacher/tc_dummy.png';
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
                <label for="thumbnails">썸네일 등록</label>
              </th>
              <td>
                <input type="file" accept="image/*" id="thumbnails" name="thumbnails" class="form-control" value="<?= $row['thumbnails'] ?>" >
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
    <div class="d-flex justify-content-end gap-2">
      <button type="button" class="btn btn-outline-danger" onClick="cancle()">취소</button>
      <button class="btn btn-outline-secondary">수정</button>
    </div>
  </form>
</div>


<script>
  //섬네일 미리보기
   let thumbnail = $('#thumbnails');
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

  //취소 버튼 클릭시 alert
  function cancle() {
    if (confirm('취소하시겠습니까?')) {
      history.back(); //formdata가 넘어감, type:button 으로 해결
    }
  };
  

  // 폼 제출 시 Summernote 내용 hidden으로 넘기기
  $('#blog_form').on('submit', function() {
    var blogContent = $('#summernote').summernote('code'); // Summernote 에디터에서 HTML 코드 가져오기
    $('#blog_content').val(blogContent); // 숨겨진 input에 설정
  });
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>
