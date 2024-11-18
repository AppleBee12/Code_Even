<?php
  $title = "회원상세정보";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

  $uid = $_GET['uid'];


  $sql = "SELECT * FROM user WHERE uid = $uid";
  $result = $mysqli->query($sql);
  $data = $result->fetch_object();
?>



<div class="container">
  <h2>회원정보수정</h2>
  <div class="content_bar">
    <h3>회원정보</h3>
  </div>
  <form action="teacher_edit_ok.php" id="teacher_save" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="uid" value="<?= $data->uid; ?>">
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
            <input type="text" class="form-control" id="exampleFormControlInput1" name="username" value="<?= $data->username; ?>" required>
          </td>
          <th scope="row">가입일</th>
          <td>
            <?= $data->signup_date; ?>
          </td>
        </tr>
        <tr>
          <th scope="row">아이디 <b>*</b></th>
          <td>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="userid" value="<?= $data->userid; ?>">
          </td>
          <th scope="row">마지막접속일</th>
          <td>
            <?= $data->last_date; ?>
          </td>
        </tr>
        <tr>
          <th scope="row">비밀번호</th>
          <td>
            <input type="password" class="form-control" id="userpw" name="userpw" value="" placeholder="비밀번호는 변경시에만 입력해주세요.">
          </td>
          <th scope="row">회원구분</th>
          <td>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="user_level"  value="">
          </td>
        </tr>
        <tr>
        <th scope="row">비밀번호 확인</th>
          <td>
            <input type="password" class="form-control" id="userpw" name="userpw" value="" placeholder="비밀번호는 변경시에만 입력해주세요.">
          </td>
        </tr>
        <tr>
          <th scope="row">상태 <b>*</b></th>
          <td>
            <select class="form-select" name="tc_cate" aria-label="대표분야">
              <option value="1" selected>웹개발</option>
              <option value="2">클라우드</option>
              <option value="3">보안</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row">회원상태</th>
          <td>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_status" id="inlineRadio1" value="0" <?php if($data->user_status == 0){echo 'checked';}?>>
              <label class="form-check-label" for="inlineRadio1">정상</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_status" id="inlineRadio2" value="1" <?php if($data->user_status == 1){echo 'checked';}?>> 
              <label class="form-check-label" for="inlineRadio2">정지</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_status" id="inlineRadio3" value="-1" <?php if($data->user_status == -1){echo 'checked';}?>> 
              <label class="form-check-label" for="inlineRadio3">탈퇴</label>
            </div>
          </td>
          <th scope="row">강사전시옵션</th>
          <td>
          <div class="form-check form-check-inline d-inline-block">
                <input class="form-check-input" type="checkbox" <?php echo $data->email_ok ? 'checked' : ''; ?> value="<?= $data->email_ok ?>" name="email_ok" id="email_ok">
                <label class="form-check-label" for="email_ok">
                  동의
                </label>
              </div>
          </td>
        </tr>
        <tr>
          <td colspan="4">
              <hr>
          </td>
        </tr>
 
      </tbody>
    </table>
    <div class="d-flex justify-content-end gap-2">
      <a href="teacher_list.php" type="button" class="btn btn-outline-danger">취소</a>
      <button class="btn btn-outline-secondary">수정</button>
    </div>
  </form>

  
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

  const hypenTel = (target) => {
  target.value = target.value
    .replace(/[^0-9]/g, '')
    .replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  }

  $('#tc_phone').on('input', function() {
    hypenTel(this);
  });


    $('table .form-check-input').change(function(){
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
    
    //var plainText = $('#summernote').summernote('code').replace(/<\/?[^>]+(>|$)/g, ""); // HTML 태그 제거
    //$('#contents').val(plainText);
    //console.log(markup); 
  });

</script>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>