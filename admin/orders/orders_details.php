<?php
$title = "주문상세정보";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>주문결제상세</h2>
  <div class="content_bar">
    <h3>주문상세목록</h3>
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
        <tr>
          <th scope="row">1</th>
          <td><a href="teacher_details.php">124</a></td>
          <td><a href="teacher_details.php">교재</td>
          <td><a href="orders_details.php">기초부터 확실하게! 페이지의 내용 전달을 위한...</td>
          <td><a href="teacher_details.php">1</td>
          <td><a href="teacher_details.php">13,000</td>
          <td><a href="teacher_details.php">-</td>
          <td><a href="teacher_details.php">0</td>
          <td><a href="teacher_details.php">13,000</td>
          <td><a href="teacher_details.php">결제완료</td>
        </tr>
    </tbody> 
  </table>

  <div class="content_bar">
    <h3>결제 정보</h3>
  </div>
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
          125
        </td>
        <th scope="row">아이디</th>
        <td>
          nany
        </td>
      </tr>
      <tr>
        <th scope="row">결제일 <b>*</b></th>
        <td>
          2024/10/29
        </td>
        <th scope="row">이름</th>
        <td>
          홍나니
        </td>
      </tr>
      <tr>
        <th scope="row">주문명</th>
        <td colspan="3">
        기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습) 외 1건
        </td>
      </tr>
      <tr>
        <th scope="row">결제금액</th>
        <td colspan="3">
          102,000 원
        </td>
      </tr>
      <tr>
        <th scope="row">결제방법</th>
        <td colspan="3">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
            <label class="form-check-label" for="inlineRadio1">신용카드</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" disabled>
            <label class="form-check-label" for="inlineRadio2">무통장입금</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
            <label class="form-check-label" for="inlineRadio3">실시간 계좌이체</label>
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
  </form>

  <div class="d-flex justify-content-end gap-2">
    <a href="teacher_list.php" type="button" class="btn btn-outline-danger">취소</a>
    <a href="teacher_list.php" type="button" class="btn btn-outline-secondary">수정</a>
  </div>
</div>



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>