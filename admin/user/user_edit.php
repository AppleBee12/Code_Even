<?php
  $title = "회원상세정보";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

  $uid = $_GET['uid'];

  $sql = "SELECT * FROM user WHERE uid = $uid";
  $result = $mysqli->query($sql);
  $data = $result->fetch_object();

  //보유쿠폰 출력
  $sql_coupons = "SELECT 
    uc.*, c.coupon_name, c.cp_desc, c.coupon_type, c.coupon_price, c.coupon_ratio
    FROM user_coupons uc
    LEFT JOIN coupons c ON uc.couponid = c.cpid
    WHERE uc.userid = '{$data->userid}'
  ";
  $result_coupons = $mysqli->query($sql_coupons);
  $coupons = [];
  while ($row = $result_coupons->fetch_object()) {
      $coupons[] = $row;
  }
?>

<div class="container">
  <h2>회원정보수정</h2>
  <div class="content_bar">
    <h3>회원정보</h3>
  </div>
  <form action="user_edit_ok.php" id="user_save" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="uid" value="<?= $data->uid; ?>">
    <table class="table w-100 info_table">
      <colgroup>
        <col class="col-width-160">
        <col class="col-width-516">
        <col class="col-width-160">
        <col class="col-width-516">
      </colgroup>
      <tbody>
        <tr>
          <th scope="row"><label for="userid">아이디 <b>*</b></label></th>  
          <td>
            <input type="text" class="form-control" id="userid" name="userid" value="<?= $data->userid; ?>" disabled>
          </td>
          <th scope="row">가입일</th>
          <td>
            <?= $data->signup_date; ?>
          </td>
        </tr>
        <tr>
         <th scope="row"><label for="username">이름 <b>*</b></label></th>
          <td>
            <input type="text" class="form-control" id="username" name="username" value="<?= $data->username; ?>" required>
          </td>
          
          <th scope="row">마지막접속일</th>
          <td>
            <?= $data->last_date; ?>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="userpw">비밀번호</label></th>
          <td>
            <input type="password" class="form-control" id="userpw" name="userpw" value="" placeholder="* 비밀번호는 변경시에만 입력해주세요.">
          </td>
          <th scope="row">회원구분</th>
          <td>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_level" id="user_level1" value="1" <?php if($data->user_level == 1){echo 'checked';}?>>
              <label class="form-check-label" for="user_level">일반회원</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_level" id="user_level10" value="10" <?php if($data->user_level == 10){echo 'checked';}?>> 
              <label class="form-check-label" for="user_level">강사</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_level" id="user_level100" value="100" <?php if($data->user_level == 100){echo 'checked';}?>> 
              <label class="form-check-label" for="user_level">관리자</label>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="userpw">비밀번호 확인</label></th>
          <td>
            <input type="password" class="form-control" id="userpw" name="userpw" value="" placeholder="* 비밀번호는 변경시에만 입력해주세요.">
          </td>
          <th scope="row"><label for="user_status">회원상태</label></th>
          <td>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_status" id="user_status0" value="0" <?php if($data->user_status == 0){echo 'checked';}?>>
              <label class="form-check-label" for="user_status">정상</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_status" id="user_status-1" value="-1" <?php if($data->user_status == -1){echo 'checked';}?>> 
              <label class="form-check-label" for="user_status">탈퇴</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="user_status" id="user_status1" value="1" <?php if($data->user_status == 1){echo 'checked';}?>> 
              <label class="form-check-label" for="user_status">정지</label>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="usernick">닉네임 <b>*</b></label></th>
          <td>
            <input type="text" class="form-control" id="usernick" name="usernick" value="<?= $data->usernick; ?>">
          </td>
          <th scope="row" rowspan="4">주소</th>
          <td rowspan="4" class="user_addr">
            <div class="row">
              <div class="col-auto">
                <input type="text" class="form-control w_sm" id="sample6_postcode" name="post_code" placeholder="우편번호" value="<?= $data->post_code ?>">
              </div>
              <div class="col-auto">
                <input type="button" class="post_search_btn" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
              </div>
            </div>
            <input type="text" id="sample6_address" class="form-control" name="addr_line1" placeholder="주소" value="<?= $data->addr_line1 ?>">
            <input type="text" id="sample6_detailAddress" class="form-control" name="addr_line2" placeholder="상세주소" value="<?= $data->addr_line2 ?>"> 
            <input type="text" id="sample6_extraAddress" class="form-control" name="addr_line3" placeholder="참고항목(동이름)" value="<?= $data->addr_line3 ?>">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="userphonenum">연락처 <b>*</b></label></th>
          <td>
            <input type="text" class="form-control" id="userphonenum" name="userphonenum" value="<?= $data->userphonenum; ?>">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="useremail">이메일 <b>*</b></label></th>
          <td>
            <input type="email" class="form-control" id="useremail" name="useremail" value="<?= $data->useremail; ?>">
          </td>
        </tr>
        <tr>
          <th scope="row">이메일 수신여부</th>
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

    <div class="content_bar">
      <h3>보유쿠폰</h3>
    </div>
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">쿠폰명</th>
          <th scope="col">쿠폰내용</th>
          <th scope="col">할인가/할인비율</th>
          <th scope="col">사용기한</th>
          <th scope="col">사용여부</th>
          <th scope="col">쿠폰상태</th>
        </tr>
      </thead>
      <tbody>
        <?php
      foreach ($coupons as $index => $coupon) {
        ?>
      <tr> 
          <td> <?= ($index + 1) ?></td>
          <td> <?= $coupon->coupon_name ?></td>
          <td> <?= $coupon->cp_desc ?></td>
          <td> <?= ($coupon->coupon_type == 2 ? $coupon->coupon_ratio . '%' : number_format($coupon->coupon_price) . '원') ?></td>
          <td>
            <?= date('Y/m/d', strtotime($coupon->regdate)) ?> - 
            <?= $coupon->use_max_date ? date('Y/m/d', strtotime($coupon->use_max_date)) : '무제한' ?>
          </td>
          <td>
            <?= $coupon->status == 1 ? '미사용' : ($coupon->status == 2 ? '사용' : '알 수 없음') ?>
          </td>
          <td><?php
              if ($coupon->use_max_date) {
                $current_date = date('Y-m-d');
                $max_date = date('Y-m-d', strtotime($coupon->use_max_date));
                echo ($current_date <= $max_date) ? '사용가능' : '사용불가능';
              } else {
                echo '무제한';
              }
            ?></td>
        </tr>
        <?php
      }
      ?>


    </table>

    <div class="d-flex justify-content-end gap-2">
      <a href="user_list.php" class="btn btn-outline-danger" role="button">취소</a>
      <button class="btn btn-outline-secondary">수정</button>
    </div>
  </form>

  
</div>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    function sample6_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    document.getElementById("sample6_extraAddress").value = extraAddr;
                
                } else {
                    document.getElementById("sample6_extraAddress").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample6_postcode').value = data.zonecode;
                document.getElementById("sample6_address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("sample6_detailAddress").focus();
            }
        }).open();
    }
</script>
<script>
  const hypenTel = (target) => {
  target.value = target.value
    .replace(/[^0-9]/g, '')
    .replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  }

  $('#userphonenum').on('input', function() {
    hypenTel(this);
  });

    $('table .form-check-input[type="checkbox"]').change(function(){
    if($(this).prop( "checked" )){
      $(this).val('1');
    } else{
      $(this).val('0');
    }
  });
</script>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>