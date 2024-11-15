<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');
?>
<style>
    /* 테이블 고정 너비와 레이아웃 */
  table {
    width: 100%;
    table-layout: fixed;
    border-spacing: 0 8px; /* 행 사이에만 8px 간격을 줍니다 */
    border-collapse: separate;
  }

  table, th, td {
    border: none;
  }

  th[scope="row"] {
    width: 15%;
  }

  td[colspan="6"] {
    width: 85%;
  }

  .content_bar{
    margin-top: 50px;
  }

  tbody tr td .box {
    height: 170px !important;
    width: 100% !important;
    background-color: #ccc !important;
    align-items: end; 
    text-align: center;
    margin-bottom: 10px;
    position: relative;

    span{
      text-wrap: nowrap;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      
    }
  }
</style>

<div class="container">
  <h2>교재 등록</h2>
  <div class="content_bar cent">
    <h3>교재 기본 정보 입력</h3>
  </div>
  <table class="table">
    <thead class="thead-hidden">
      <tr>
        <th scope="col">구분</th>
        <th scope="col" colspan="6">내용</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">분류 설정 <b>*</b></th>
        <td colspan="2">
          <select class="form-select" aria-label="대분류">
            <option selected>대분류</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
        <td colspan="2">
          <select class="form-select" aria-label="중분류">
            <option selected>중분류</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
        <td colspan="2">
          <select class="form-select" aria-label="소분류">
            <option selected>소분류</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row">교재명 <b>*</b></th>
        <td colspan="6">
          <input type="text" class="form-control" placeholder="기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)">
        </td>
      </tr>
      <tr>
        <th scope="row">출판사 <b>*</b></th>
        <td colspan="2">
          <input type="text" class="form-control" placeholder="길동사">
        </td>
        <td class="box_container" colspan="3" rowspan="5">
          <div class="box">
            <span>강좌 썸네일 이미지를 선택해주세요.</span>
            <div class="image"><img src="" alt=""></div>
          </div>
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02">
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">가격 <b>*</b></th>
        <td colspan="2">
          <div class="input-group">
            <input type="text" class="form-control" aria-label="원">
            <span class="input-group-text">원</span>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">출판일 <b>*</b></th>
        <td colspan="2">
          <select class="form-select">
            <option selected>SELECT</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row">저자 <b>*</b></th>
        <td colspan="2">
          <input type="text" class="form-control" placeholder="홍길동">
        </td>
      </tr>
      <tr>
          <th scope="row">교재 설명 <b>*</b></th>
          <td colspan="6">
            <textarea class="form-control" rows="3" placeholder="교재 설명을 입력해 주세요."></textarea>
          </td>
        </tr>
    </tbody>
  </table>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>
