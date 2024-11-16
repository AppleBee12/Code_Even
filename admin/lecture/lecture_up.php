<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');
?>

<div class="container">
  <h2>강좌 등록</h2>
  <div class="content_bar cent">
    <h3>강좌 기본 정보 입력</h3>
  </div>
  <form action="lecture_up_ok.php" id="lecture_save" enctype="multipart/form-data">
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">분류 설정 <b>*</b></th>
          <td colspan="2">
            <select name="cate1" class="form-select" aria-label="대분류">
              <option selected>대분류</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </td>
          <td colspan="2">
            <select name="cate2" class="form-select" aria-label="중분류">
              <option selected>중분류</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </td>
          <td colspan="2">
            <select name="cate3" class="form-select" aria-label="소분류">
              <option selected>소분류</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row">강좌명 <b>*</b></th>
          <td colspan="6">
            <input type="text" name="title" class="form-control" placeholder="기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)">
          </td>
        </tr>
        <tr>
          <th scope="row">강사명 <b>*</b></th>
          <td colspan="2">
            <input type="text" name="name" class="form-control" placeholder="admin">
          </td>
          <td name="image" class="box_container" colspan="4" rowspan="5">
            <div class="box">
              <span>강좌 썸네일 이미지를 선택해주세요.</span>
              <div class="image"><img src="" alt=""></div>
            </div>
            <div class="input-group mb-3">
              <input name="image" accept="image/*" type="file" class="form-control" id="inputGroupFile02">
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">수강료 <b>*</b></th>
          <td colspan="2">
            <div class="input-group">
              <input name="price" type="text" class="form-control" aria-label="원">
              <span class="input-group-text">원</span>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">교재 선택 <b>*</b></th>
          <td colspan="2">
            <select name="" class="form-select">
              <option selected>SELECT</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            <small class="text-muted">* 필요한 교재가 있다면 교재 목록에서 우선 등록해 주세요.</small>
          </td>
        </tr>
        <tr>
          <th scope="row">교육 기간 <b>*</b></th>
          <td colspan="2">
            <select name="period" class="form-select">
              <option selected>60일</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            <small class="text-muted">* 교육 기간은 30일 단위로 설정 가능합니다.</small>
          </td>
        </tr>
        <tr>
          <th scope="row">강좌 유형 <b>*</b></th>
          <td colspan="4">
            <div class="d-flex gap-4">
              <div class="form-check">
                <input name="isrecipe" class="form-check-input" type="radio" name="courseType" id="recipeCourse">
                <label class="form-check-label" for="isrecipe">레시피 강좌</label>
              </div>
              <div class="form-check">
                <input name="isgeneral" class="form-check-input" type="radio" name="courseType" id="generalCourse" checked>
                <label class="form-check-label" for="isgeneral">일반 강좌</label>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  
    <!-- 강의 설정 영역 -->
    <div class="content_bar cent">
      <h3>강의 설정</h3>
    </div>
    <div>
      <div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
        <h5 class="mb-0">1강</h5>
        <i class="bi bi-x"></i>
      </div>
      <table class="table">
        <colgroup>
          <col width="160">  
          <col width="516">  
          <col width="160">
          <col width="516">  
        </colgroup>
        <tbody>
          <tr>
            <th scope="row">강의명 <b>*</b></th>
            <td colspan="3">
              <input type="text" class="form-control" placeholder="강의명을 입력해 주세요.">
            </td>
          </tr>
          <tr>
            <th scope="row">강의 설명 <b>*</b></th>
            <td colspan="3">
              <textarea class="form-control" rows="3" placeholder="강의 설명을 입력해 주세요."></textarea>
            </td>
          </tr>
          <tr>
            <th scope="row">퀴즈 선택 <b>*</b></th>
            <td>
              <select class="form-select">
                <option selected>퀴즈를 선택해 주세요.</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </td>
            <th scope="row">시험 선택 <b>*</b></th>
            <td>
              <select class="form-select">
                <option selected>시험을 선택해 주세요.</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </td>
          </tr>
          <tr>
            <th scope="row">실습 파일 등록 <b>*</b></th>
            <td>
              <input class="form-control" type="file">
            </td>
            <th scope="row">동영상 주소 <b>*</b></th>
            <td>
              <div class="input-group">
                <span class="input-group-text">https://</span>
                <input type="text" class="form-control" placeholder="www.code_even.com">
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="leplus d-flex justify-content-center align-items-center bg-white border rounded-3 boder-secondary">
        <i class="bi bi-plus"></i>
      </div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4 mb-5">
      <a href="" type="button" class="btn btn-secondary">등록</a>
      <a href="" type="button" class="btn btn-secondary">임시 저장</a>
      <a href="" type="button" class="btn btn-danger">취소</a>
    </div>
  </form>
</div>

<script>

</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>
