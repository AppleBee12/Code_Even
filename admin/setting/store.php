<?php
$host = $_SERVER['HTTP_HOST'];
$address_js = "<script src=\"//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js\"></script>";
$store_js = "<script src=\"http://$host/code_even/admin/js/store.js\"></script>";
$title = "상점 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');



$sql = "SELECT * FROM company_info WHERE comid = 1";
$result = $mysqli->query($sql);
$cidata = $result->fetch_object();

?>


<div class="container">
  <h2 class="page_title">상점 관리</h2>

</div>


<form action="store_edit_ok.php" method="POST">
  <input type="hidden" name="comid" value="<?= $cidata->comid; ?>">

  <div class="content_bar cent">
    <h3>회사 정보 설정</h3>
  </div>
  <table class="table w-100 info_table">
    <colgroup>
      <col class="col-width-160">
      <col class="col-width-516">
      <col class="col-width-160">
      <col class="col-width-516">
    </colgroup>
    <tbody>
      <?php
      $sql = "SELECT * FROM company_info ORDER BY comid ";
      $result = $mysqli->query($sql);

      // $user_id = $_SESSION['AUID'];
      // print_r($result->fetch_assoc());
      //print_r($user_id);

      ?>
      <tr>
        <th scope="row">
          <label for="company">회사명 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="company" name="company" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $cidata->company ?>">
        </td>
        <th scope="row">
          <label for="bs_reg">사업자 등록번호 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="bs_reg" name="bs_reg" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $cidata->bussiness_registration_num ?>">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="ceoname">대표이사 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="ceoname" name="ceoname" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $cidata->ceo_name ?>">
        </td>
        <th scope="row">
          <label for="com_reg">통신판매업 신고 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="com_reg" name="com_reg" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $cidata->commerce_registration_num ?>">
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="postcode">우편번호 <b>*</b></label>
        </th>
        <td colspan="3" class="d-flex gap-2">
          <input type="text" id="postcode" name="postcode" class="form-control address_num" placeholder="우편번호" value="<?= $cidata->post_code ?>">
          <input type="button" onclick="execDaumPostcode()" value="우편번호 찾기"><br>
        </td>
        <th scope="row">
          <label for="cs_number">대표 연락처<b>*</b></label>
        </th>
        <td colspan="3">
          <input type="text" id="cs_number" name="cs_number" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $cidata->cs_number ?>">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="addressOne">기본 주소 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="addressOne" name="addressOne" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $cidata->address_one ?>">
        </td>
        <th scope="row">
          <label for="email">이메일 <b>*</b></label>
        </th>
        <td colspan="3">
          <input type="email" id="email" name="email" class="form-control w_512" placeholder="입력 필수 값 입니다." value="<?= $cidata->email ?>">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="addressTwo">상세 주소 <b>*</b></label>
        </th>
        <td class="d-flex gap-2">
          <input type="text" id="extraAddress" name="extraAddress" class="form-control address" placeholder="참고 주소(동이름)" value="<?= $cidata->address_three ?>">
          <input type="text" id="detailAddress" name="addressTwo" class="form-control address" placeholder="입력 필수 값 입니다." value="<?= $cidata->address_two ?>">
        </td>
        <th scope="row">
          <label for="created_at">서비스 시작일 </label>
        </th>
        <td colspan="3">
          <input type="text" id="created_at" name="created_at" class="form-control w_512"  value="<?= $cidata->created_at ?>"
            disabled readonly>
        </td>
      </tr>
      <tr>
        <td colspan="4">
          <div class="content_bar cent">
            <h3>회사 정보 설정</h3>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="tax_dept">세무 담당부서</label>
        </th>
        <td>
          <input type="text" id="tax_dept" name="tax_dept" class="form-control" placeholder="입력해 주세요." value="<?= $cidata->tax_manager_department ?>">
        </td>
        <th scope="row">
          <label for="tax_email">계산서 발급 이메일 <b>*</b></label>
        </th>
        <td colspan="3">
          <input type="email" id="tax_email" name="tax_email" class="form-control w_512" placeholder="입력 필수 값 입니다." value="<?= $cidata->tax_bill_email ?>">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="tax_name">세무 담당자 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="tax_name" name="tax_name" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $cidata->tax_manager_name ?>">
        </td>
        <th scope="row">
          <label for="tax_contact">세무 담당자 연락처</label>
        </th>
        <td>
          <input type="text" id="tax_contact" name="tax_contact" class="form-control" placeholder="입력해 주세요." value="<?= $cidata->tax_manager_phone ?>">
        </td>
      </tr>
      <tr>
        <td colspan="4">
          <hr>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="prv_dept">개인정보 담당부서</label>
        </th>
        <td>
          <input type="text" id="prv_dept" name="prv_dept" class="form-control" placeholder="입력해 주세요." value="<?= $cidata->privacy_manager_department ?>">
        </td>
        <th scope="row">
          <label for="prv_email">개인정보 담당메일 <b>*</b></label>
        </th>
        <td colspan="3">
          <input type="email" id="prv_email" name="prv_email" class="form-control w_512" placeholder="입력 필수 값 입니다." value="<?= $cidata->privacy_manager_email ?>">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="prv_name">개인정보 담당자 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="prv_name" name="prv_name" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $cidata->privacy_manager_name ?>">
        </td>
        <th scope="row">
          <label for="prv_contact">개인정보 담당 연락처</label>
        </th>
        <td>
          <input type="text" id="prv_contact" name="prv_contact" class="form-control" placeholder="입력해 주세요." value="<?= $cidata->privacy_manager_phone ?>">
        </td>
      </tr>
    </tbody>
  </table>
  
  <div class="d-flex justify-content-end gap-2">
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/setting/store_cancle.php" type="button" class="btn btn-outline-danger">취소</a>
    <button class="btn btn-outline-secondary">수정</button>
  </div>
</form>




<script>
  function execDaumPostcode() {
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
        if (data.userSelectedType === 'R') {
          // 법정동명이 있을 경우 추가한다. (법정리는 제외)
          // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
          if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
            extraAddr += data.bname;
          }
          // 건물명이 있고, 공동주택일 경우 추가한다.
          if (data.buildingName !== '' && data.apartment === 'Y') {
            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
          }
          // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
          if (extraAddr !== '') {
            extraAddr = ' (' + extraAddr + ')';
          }
          // 조합된 참고항목을 해당 필드에 넣는다.
          document.getElementById("extraAddress").value = extraAddr;

        } else {
          document.getElementById("extraAddress").value = '';
        }

        // 우편번호와 주소 정보를 해당 필드에 넣는다.
        document.getElementById('postcode').value = data.zonecode;
        document.getElementById("address").value = addr;
        // 커서를 상세주소 필드로 이동한다.
        document.getElementById("detailAddress").focus();
      }
    }).open();
  }
</script>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>