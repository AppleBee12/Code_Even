<?php
$host = $_SERVER['HTTP_HOST'];
$address_js = "<script src=\"//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js\"></script>";
$store_js = "<script src=\"http://$host/code_even/admin/js/store.js\"></script>";
$title = "상점 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

"<script>
 new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분입니다.
            // 예제를 참고하여 다양한 활용법을 확인해 보세요.
        }
    }).open();
</script>"
  ?>


<div class="container">
  <h2 class="page_title">상점 관리</h2>

</div>


<form action="">
  <div class="upload mt-5 mb-3">
    <img src="https://picsum.photos/200" width=100 height=100 alt="">
    <div class="round">
      <input type="file">
      <i class="bi bi-camera-fill"></i>
    </div>
  </div>
  <p class="text-center mb-5">프로필 이미지</p>

  <div class="content_bar cent">
    <h3>회사 정보 설정</h3>
  </div>
  <table class="table w-100 info_table">
    <colgroup>
      <col width="160">
      <col width="516">
      <col width="160">
      <col width="516">
    </colgroup>
    <tbody>
      <?php
      $sql = "SELECT * FROM company_info ORDER BY comid ";
      $result = $mysqli->query($sql);

      $user_id = $_SESSION['AUID'];
      // print_r($result->fetch_assoc());
      //print_r($user_id);
      
      // # 상점 정보
// type CompanyInfo {
      
      //   # 상세주소
//   addressTwo: String!
//   # 사업자등록번호
//   bussinessRegistrationNum: String!
//   # 통신판매업신고 번호
//   commerceRegistrationNum: String!
//   # 고객센터 전화번호
//   csNumber: String!
//   # 이메일
//   email: String!
//   # 상점개설일
//   createdAt: String!
//   # 세무 담당자 부서
//   taxManagerDepartment: String
//   # 세무 담당자
//   taxManagerName: String!
//   # 세금계산서 발급 이메일
//   taxBillEmail: String!
//   # 세무 담당자 전화번호
//   taxManagerPhone: String!
//   # 개인정보
//   담당자 부서
//   privacyManagerDepartment: String
//   # 개인정보  담당자 
//   privacyManagerName: String!
//   # 개인정보
//   담당자 이메일
//   privacyManagerEmail: String!
//   # 개인정보
//   담당자 전화번호
//   privacyManagerPhone: String
// }
      
      ?>
      <tr>
        <th scope="row">
          <label for="company">회사명 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="company" name="company" class="form-control" placeholder="입력 필수 값 입니다." value="">
        </td>
        <th scope="row">
          <label for="bank">사업자 등록번호 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="bank" name="bank" class="form-control" placeholder="입력 필수 값 입니다." value="">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="ceoName">대표이사 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="ceoName" name="ceoName" class="form-control" placeholder="입력 필수 값 입니다." value="">
        </td>
        <th scope="row">
          <label for="bank">통신판매업 신고 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="bank" name="bank" class="form-control" placeholder="입력 필수 값 입니다." value="">
        </td>
      </tr>
      <input type="text" id="sample3_postcode" placeholder="우편번호">
<input type="button" onclick="sample3_execDaumPostcode()" value="우편번호 찾기"><br>
<input type="text" id="sample3_address" placeholder="주소"><br>
<input type="text" id="sample3_detailAddress" placeholder="상세주소">
<input type="text" id="sample3_extraAddress" placeholder="참고항목">

<div id="wrap" style="display:none;border:1px solid;width:500px;height:300px;margin:5px 0;position:relative">
<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
</div>
      <tr>
        <th scope="row">
          <label for="address_num">주소 <b>*</b></label>
        </th>
        <td colspan="3" class="d-flex gap-2">
          <input type="text" id="address_num" name="address_num" class="form-control address_num" placeholder="우편번호" >
          <input type="button" onclick="findPostcode()" id="find-postcode" value="우편번호 찾기">
        </td>
        <th scope="row">
          <label for="bank">대표 연락처<b>*</b></label>
        </th>
        <td colspan="3">
          <input type="text" id="bank" name="bank" class="form-control" placeholder="입력 필수 값 입니다." value="">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="addressOne">주소 <b>*</b></label>
        </th>
        <td>
        <input type="text" id="addressOne" name="addressOne" class="form-control" placeholder="입력 필수 값 입니다." value="">
        </td>
        <th scope="row">
          <label for="email">이메일 <b>*</b></label>
        </th>
        <td colspan="3">
          <input type="email" id="email" name="email" class="form-control w_512" placeholder="입력 필수 값 입니다." value="">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="addressTwo">주소 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="addressTwo" name="addressTwo" class="form-control" placeholder="입력 필수 값 입니다." value="">
        </td>
        <th scope="row">
          <label for="email">서비스 시작일 </label>
        </th>
        <td colspan="3">
          <input type="email" id="email" name="email" class="form-control w_512" placeholder="입력 필수 값 입니다." value=""
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
          <label for="username">세무 담당부서</label>
        </th>
        <td>
          <input type="text" id="username" name="username" class="form-control" placeholder="입력해 주세요." value="">
        </td>
        <th scope="row">
          <label for="email">계산서 발급 이메일 <b>*</b></label>
        </th>
        <td colspan="3">
          <input type="email" id="email" name="email" class="form-control w_512" placeholder="입력 필수 값 입니다." value="">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="userid">세무 담당자 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="userid" name="userid" class="form-control" placeholder="입력 필수 값 입니다." value="">
        </td>
        <th scope="row">
          <label for="contact">세무 담당자 연락처</label>
        </th>
        <td>
          <input type="text" id="contact" name="contact" class="form-control" placeholder="입력해 주세요." value="">
        </td>
      </tr>
      <tr>
        <td colspan="4">
          <hr>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="username">개인정보 담당부서</label>
        </th>
        <td>
          <input type="text" id="username" name="username" class="form-control" placeholder="입력해 주세요." value="">
        </td>
        <th scope="row">
          <label for="email">개인정보 담당 이메일 <b>*</b></label>
        </th>
        <td colspan="3">
          <input type="email" id="email" name="email" class="form-control w_512" placeholder="입력 필수 값 입니다." value="">
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="userid">개인정보 담당자 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="userid" name="userid" class="form-control" placeholder="입력 필수 값 입니다." value="">
        </td>
        <th scope="row">
          <label for="contact">개인정보 담당 연락처</label>
        </th>
        <td>
          <input type="text" id="contact" name="contact" class="form-control" placeholder="입력해 주세요." value="">
        </td>
      </tr>
    </tbody>
  </table>
</form>

<div class="d-flex justify-content-end gap-2">
  <a href="javascript:history.back();" type="button" class="btn btn-outline-danger">취소</a>
  <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/index.php" type="button"
    class="btn btn-outline-secondary">수정</a>
</div>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>