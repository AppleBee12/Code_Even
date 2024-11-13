<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>강좌 등록</h2>
  <div class="content_bar">
    <h3>강좌 기본 정보 입력</h3>
  </div>
  <table class="table">
    <thead class="thead-hidden">
      <tr>
        <th scope="col">구분</th>
        <th scope="col">내용</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">분류 설정 <span>*</span></th>
        <td>
          <select class="form-select" aria-label="Default select example">
            <option selected>대분류</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
        <td>
          <select class="form-select" aria-label="Default select example">
            <option selected>중분류</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
        <td>
          <select class="form-select" aria-label="Default select example">
            <option selected>소분류</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row">강좌명 <span>*</span></th>
        <td colspan="2">
          <div class="mb-3">
            <!-- <label for="exampleFormControlInput1" class="form-label"></label> -->
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)">
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">강사명 <span>*</span></th>
        <td>
          <div class="mb-3">
            <!-- <label for="exampleFormControlInput1" class="form-label"></label> -->
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="admin">
          </div>
        </td>
        <td colspan="2" rowspan="5">
          <div class="box">
            <span>강좌 섬네일 이미지를 선택해주세요.</span>
            <div id="addedImages" class="d-flex gap-3"></div>
            <div class="input-group mb-3">
              <input type="file" class="form-control" id="inputGroupFile02">
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">수강료 <span>*</span></th>
        <td>
          <div class="input-group mb-3">
            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
            <span class="input-group-text">원</span>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">교재 선택 <span>*</span></th>
        <td>
          <select class="form-select" aria-label="Default select example">
            <option selected>SELECT</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row">교육 기간 <span>*</span></th>
        <td>
          <select class="form-select" aria-label="Default select example">
            <option selected>60일</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row">강좌 유형 <span>*</span></th>
        <td>
          <div class="d-flex gap-5">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">레시피 강좌</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
              <label class="form-check-label" for="flexRadioDefault2">일반 강좌</label>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>


<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>