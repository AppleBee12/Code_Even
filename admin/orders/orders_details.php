<?php
$title = "주문상세정보";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>강사 프로필 수정</h2>
  <div class="content_bar">
    <h3>강사 상세정보</h3>
  </div>
  <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">주문상세번호</th>
          <th scope="col">구분</th>
          <th scope="col">교재명</th>
          <th scope="col">수량</th>
          <th scope="col">청구금액</th>
          <th scope="col">할인액</th>
          <th scope="col">환불액</th>
          <th scope="col">결제금액</th>
          <th scope="col">상태</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td><a href="teacher_details.php">123</a></td>
          <td><a href="teacher_details.php">강좌</td>
          <td><a href="orders_details.php">기초부터 확실하게! 페이지의 내용 전달을 위한...</td>
          <td><a href="teacher_details.php">1</td>
          <td><a href="teacher_details.php">99,000</td>
          <td><a href="teacher_details.php">10,000</td>
          <td><a href="teacher_details.php">0</td>
          <td><a href="teacher_details.php">89,000</td>
          <td><a href="teacher_details.php">결제완료</td>
        </tr>   
    </table>
  <form action="">
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
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
        <th scope="row">링크</th>
        <td>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
      </tr>
      <tr>
        <th scope="row">아이디 <b>*</b></th>
        <td>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
        <th scope="row">은행명</th>
        <td>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
      </tr>
      <tr>
        <th scope="row">연락처 <b>*</b></th>
        <td>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
        <th scope="row">계좌번호</th>
        <td>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
      </tr>
      <tr>
        <th scope="row">이메일 <b>*</b></th>
        <td colspan="3">
          <input type="text" class="form-control w_512" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
      </tr>
      <tr>
        <th scope="row">대표분야 <b>*</b></th>
        <td colspan="3">
          <select class="form-select w_512" aria-label="Default select example">

            <option class="optionListItem" value="1" selected>웹개발</option>
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
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
            <label class="form-check-label" for="inlineRadio1">심사중</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">승인완료</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
            <label class="form-check-label" for="inlineRadio3">승인거절</label>
          </div>
        </td>
        <th scope="row">강사전시옵션</th>
        <td>
        <div class="form-check form-check-inline d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
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
        <div id="summernote"></div>
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



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>