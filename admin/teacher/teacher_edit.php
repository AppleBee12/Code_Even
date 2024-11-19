<?php
  $title = "강사상세정보";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

  $tcid = $_GET['tcid'];


  $sql = "SELECT * FROM teachers WHERE tcid = $tcid";
  $result = $mysqli->query($sql);
  $data = $result->fetch_object();

  // 'code'가 'A'로 시작하는 category 데이터를 가져오기
  $category_sql = "SELECT * FROM category WHERE code LIKE 'A%' ORDER BY cgid ASC";
  $category_result = $mysqli->query($category_sql);

  while($cate_data = $category_result->fetch_object()){
      $categories[] = $cate_data;
  }

  //user 레벨 조회
  $user_sql = "SELECT user_level FROM user WHERE uid = $data->uid";
  $user_result = $mysqli->query($user_sql);
  $user_data = $user_result->fetch_object();
  $user_level = $user_data ? $user_data->user_level : 'N/A'; // 값이 없을 경우 'N/A'로 표시
?>

<div class="container">
  <h2>강사 프로필 수정</h2>
  <div class="content_bar">
    <h3>강사기본정보</h3>
  </div>
  <form action="teacher_edit_ok.php" id="teacher_save" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="tcid" value="<?= $data->tcid; ?>">
    <input type="hidden" name="tc_intro" id="contents" value="">
    <div class="upload mt-5 mb-3">
      <?php 
        $thumbnail_path = !empty($data->tc_thumbnail) ? $_SERVER['DOCUMENT_ROOT'] . $data->tc_thumbnail : '';
        $image_src = (!empty($data->tc_thumbnail) && file_exists($thumbnail_path)) ? $data->tc_thumbnail : '/CODE_EVEN/admin/upload/teacher/tc_dummy.png';
      ?>
      <img id="thumbnail_preview" src="<?= $image_src; ?>" class="rounded_circle" width = 100 height = 100 alt="프로필 이미지">
      <div class="round">
        <input type="file" accept="image/*" name="tc_thumbnail" id="tc_thumbnail">
        <i class="bi bi-camera-fill"></i>
      </div>
    </div>
    <p class="text-center mb-5">프로필 이미지</p>

    <table class="table w-100 info_table">
      <colgroup>
        <col class="col-width-160">
        <col class="col-width-516">
        <col class="col-width-160">
        <col class="col-width-516">
      </colgroup>
      <tbody>
        <tr>
          <th scope="row"><label for="tc_name">이름 <b>*</b></label></th>
          <td>
            <input type="text" class="form-control" id="tc_name" name="tc_name" value="<?= $data->tc_name; ?>" required>
          </td>
          <th scope="row">대표분야 <b>*</b></th>
          <td>
            <select class="form-select" name="tc_cate" aria-label="대표분야">
              <?php foreach($categories as $category): ?>
                <option value="<?= $category->cgid;?>" <?= $data->tc_cate == $category->cgid ? 'selected' : ''; ?>>
                  <?= $category->name;?>
                </option>
              <?php endforeach; ?>
            </select>
          </td>
          
        </tr>
        <tr>
          <th scope="row"><label for="tc_userid">아이디 <b>*</b></label></th>
          <td>
            <input type="text" class="form-control" id="tc_userid" name="tc_userid" value="<?= $data->tc_userid; ?>">
          </td>
          <th scope="row"><label for="tc_bank">은행명</label></th>
          <td>
            <input type="text" class="form-control" id="tc_bank" name="tc_bank" value="<?= $data->tc_bank; ?>">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="tc_userphone">연락처 <b>*</b></label></th>
          <td>
          <input type="text" class="form-control" id="tc_userphone" name="tc_userphone" value="<?= $data->tc_userphone; ?>">
          </td>
          <th scope="row"><label for="tc_account">계좌번호</label></th>
          <td>
            <input type="text" class="form-control" id="tc_account" name="tc_account" value="<?= $data->tc_account; ?>">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="tc_email">이메일 <b>*</b></label></th>
          <td>
            <input type="text" class="form-control" id="tc_email" name="tc_email" value="<?= $data->tc_email; ?>">
          </td>
          <th scope="row"><label for="tc_url">링크</label></th>
          <td>
            <input type="text" class="form-control" id="tc_url" name="tc_url" value="<?= $data->tc_url; ?>" placeholder="https://">
          </td>
        </tr>
        <tr>
          <th scope="row">소개글 <b>*</b></th>
          <td colspan="3">
          <div id="summernote"><?= $data->tc_intro;?></div>
          </td>
        </tr>
        <tr>
          <td colspan="4">
              <hr>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="content_bar">
      <h3>강사상태관리</h3>
    </div>
    <table class="table w-100 info_table">
      <colgroup>
        <col class="col-width-160">
        <col class="col-width-516">
        <col class="col-width-160">
        <col class="col-width-516">
      </colgroup>
      <tbody>
        <tr>
          <th scope="row"><label for="tc_ok">승인상태 <b>*</b></label></th>
          <td>
            <select class="form-select tc_status" name="tc_ok" id="tc_ok" aria-label="승인상태 선택">
              <option value="-1" <?php if($data->tc_ok == -1){echo 'selected';}?>>승인거절</option>
              <option value="0" <?php if($data->tc_ok == 0){echo 'selected';}?>>심사중</option>
              <option value="1" <?php if($data->tc_ok == 1){echo 'selected';}?>>승인완료</option>
            </select>
          </td>
          <th scope="row"><label for="isnew">강사전시옵션</label></th>
          <td>
            <div class="form-check form-check-inline d-inline-block">
              <input class="form-check-input" type="checkbox" <?php echo $data->isnew ? 'checked' : ''; ?> value="<?= $data->isnew ?>" name="isnew" id="isnew">
              <label class="form-check-label" for="isnew">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" <?php echo $data->isrecom ? 'checked' : ''; ?> value="<?= $data->isrecom ?>" name="isrecom" id="isrecom">
              <label class="form-check-label" for="isrecom">
                추천
              </label>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">회원레벨</th>
          <td colspan="3">
          <?= htmlspecialchars($user_level); ?>
          </td>
        </tr>     
      </tbody>
    </table>

    <div class="d-flex justify-content-end gap-2">
      <a href="teacher_list.php" class="btn btn-outline-danger" role="button">취소</a>
      <button class="btn btn-outline-secondary">수정</button>
    </div>
  </form>
  
  <!-- 토스트 알림창 -->
  <div id="profileToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">&#x1F525; 알림</strong>
      <small>2초 후 종료</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
     먼저, 프로필 이미지를 등록해주세요!
    </div>
  </div>
</div>

<script>
  //토스트 알림창 제어
  $(document).ready(function() {
    let $thumbnailPreview = $('#thumbnail_preview');
    if ($thumbnailPreview.length && $thumbnailPreview.attr('src') === '../upload/teacher/tc_dummy.png') {
      let toastElement = new bootstrap.Toast($('#profileToast')[0], {
        autohide: true,
        delay: 2000 // 2초
      });
      toastElement.show();
    }
  });
</script>
<script>
  let tc_thumbnail = $('#tc_thumbnail');
  tc_thumbnail.on('change',(e)=>{
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

  const hypenTel = (target) => {
  target.value = target.value
    .replace(/[^0-9]/g, '')
    .replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  }

  $('#tc_phone').on('input', function() {
    hypenTel(this);
  });


    $('table .form-check-input[type="checkbox"]').change(function(){
    if($(this).prop( "checked" )){
      $(this).val('1');
    } else{
      $(this).val('0');
    }
  });

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