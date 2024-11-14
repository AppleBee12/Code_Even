<?php
$title = "강사상세정보";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>강사 프로필 수정</h2>
  <div class="content_bar">
    <h3>강사 상세정보</h3>
  </div>

  <form action="">
  <table class="table w-100">
    <colgroup>
      <col width="160">  
      <col>  
      <col width="160">
      <col>  
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
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
        <th scope="row">강사전시옵션</th>
        <td>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
      </tr>
      <tr>
        <td colspan="4">
            <hr>
        </td>
      </tr>
      <tr>
        <th scope="row">소개글 <b>*</b></th>
        <td>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
        <th scope="row">합칠곳</th>
        <td>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
        </td>
      </tr>
      
    </tbody>
  </table>
  </form>

  <div class="d-flex justify-content-end">
    <a href="student_list.php" type="button" class="btn btn-outline-danger">취소</a>
  </div>
</div>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>