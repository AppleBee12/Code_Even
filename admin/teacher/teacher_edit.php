<?php
  $title = "강사상세정보";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

  $tcid = $_GET['tcid'];
  if (!isset($tcid)) {
    echo "<script>alert('강사 정보가 없습니다.'); location.href = 'teacher_list.php';</script>";
  }

  $sql = "SELECT * FROM teachers WHERE tcid = $tcid";
  $result = $mysqli->query($sql);
  $data = $result->fetch_object();
?>



<div class="container">
  <h2>강사 프로필 수정</h2>
  <div class="content_bar">
    <h3>강사 상세정보</h3>
  </div>
  <form action="teacher_edit_ok.php" id="teacher_save"  method="POST">
    <input type="hidden" name="tcid" value="<?= $tcid; ?>">
    <input type="hidden" name="tc_intro" id="tc_intro" value="">
    <div class="upload mt-5 mb-3">
      <img id="thumbnail_preview" src="<?= $data->tc_thumbnail; ?>" width = 100 height = 100 alt="">
      <div class="round">
        <input type="file" accept="image/*" name="tc_thumbnail" id="tc_thumbnail">
        <i class="bi bi-camera-fill"></i>
      </div>
    </div>
    <p class="text-center mb-5">프로필 이미지</p>

    <table class="table w-100 info_table">
      <colgroup>
        <col width="160">  
        <col width="516">  
        <col width="160">
        <col width="516">  
      </colgroup>
      <tbody>
        <tr>
          <th scope="row">이름 <b>*</b></th>
          <td>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?= $data->tc_name; ?>" required>
          </td>
          <th scope="row">링크</th>
          <td>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?= $data->tc_url; ?>">
          </td>
        </tr>
        <tr>
          <th scope="row">아이디 <b>*</b></th>
          <td>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?= $data->tc_userid; ?>">
          </td>
          <th scope="row">은행명</th>
          <td>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?= $data->tc_bank; ?>">
          </td>
        </tr>
        <tr>
          <th scope="row">연락처 <b>*</b></th>
          <td>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?= $data->tc_name; ?>">
          </td>
          <th scope="row">계좌번호</th>
          <td>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?= $data->tc_account; ?>">
          </td>
        </tr>
        <tr>
          <th scope="row">이메일 <b>*</b></th>
          <td colspan="3">
            <input type="text" class="form-control w_512" id="exampleFormControlInput1" value="<?= $data->tc_email; ?>">
          </td>
        </tr>
        <tr>
          <th scope="row">대표분야 <b>*</b></th>
          <td colspan="3">
            <select class="form-select w_512" aria-label="Default select example">

              <option value="1" selected>웹개발</option>
              <option value="2">클라우드</option>
              <option value="3">보안</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <hr>
          </td>
        </tr>


        <tr>
          <th scope="row">승인상태</th>
          <td>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0" <?php if($data->tc_ok == 0){echo 'checked';}?>>
              <label class="form-check-label" for="inlineRadio1">심사중</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" <?php if($data->tc_ok == 1){echo 'checked';}?>> 
              <label class="form-check-label" for="inlineRadio2">승인완료</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="-1" <?php if($data->tc_ok == -1){echo 'checked';}?>> 
              <label class="form-check-label" for="inlineRadio3">승인거절</label>
            </div>
          </td>
        <th scope="row">강사전시옵션</th>
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
          <td colspan="4">
              <hr>
          </td>
        </tr>
        <tr>
          <th scope="row">소개글 <b>*</b></th>
          <td colspan="3">
          <div id="summernote"><?= $data->tc_intro;?></div>
          </td>

        </tr>
        
      </tbody>
    </table>
  </form>

  <div class="d-flex justify-content-end gap-2">
    <a href="teacher_list.php" type="button" class="btn btn-outline-danger">취소</a>
    <a href="teacher_list.php" type="button" class="btn btn-outline-secondary">수정</a>
  </div>
</div>


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
</script>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>