<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>강좌 등록</h2>
  <div class="content_bar">
    <h3>강좌 기본 정보 입력</h3>
  </div>
  <table class="table w-100">
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
        <td colspan="3">
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
            <div class="image"><img src="" alt=""></div>
          </div>
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02">
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
          <small class="text-muted d-block mt-1">* 필요한 교재가 있다면 교재 목록에서 우선 등록해 주세요.</small>
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
          <small class="text-muted d-block mt-1">* 교육 기간은 30일 단위로 설정 가능합니다.</small>
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
  <div class="content_bar">
    <h3>강의 설정</h3>
  </div>
  <div>
    <div class="video d-flex justify-content-between align-items-center bg-light border">
      <h5 class="mb-0">1강</h5>
      <i class="bi bi-x" style="cursor: pointer;"></i>
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
        <th scope="row">강의명 <span>*</span></th>
        <td colspan="3">
          <div class="mb-3">
            <!-- <label for="exampleFormControlInput1" class="form-label"></label> -->
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="강의명을 입력해 주세요.">
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">강의 설명 <span>*</span></th>
        <td colspan="3">
          <div class="mb-3">
            <!-- <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label> -->
            <textarea class="form-control" id="exampleFormControlTextarea1" colspan="3"  rows="3" placeholder="강의 설명을 입력해 주세요."></textarea>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">퀴즈 선택 <span>*</span></th>
        <td>
          <select class="form-select" aria-label="Default select example">
            <option selected>퀴즈를 선택해 주세요.</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
        <th scope="row">시험 선택 <span>*</span></th>
        <td>
          <select class="form-select" aria-label="Default select example">
            <option selected>시험을 선택해 주세요.</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row">실습 파일 등록 <span>*</span></th>
        <td>
          <div class="mb-3">
            <input class="form-control" type="file" id="formFile">
          </div>
        </td>
        <th scope="row">동영상 주소 <span>*</span></th>
        <td>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">https://</span>
            <input type="text" class="form-control" placeholder="www.code_even.com" aria-label="Recipient's username" aria-describedby="basic-addon2">
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  </div>
</div>


<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>