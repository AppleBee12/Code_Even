<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');
?>

<div class="container">
  <h2>퀴즈 / 시험 등록</h2>
  <div class="content_bar cent">
    <h3>
      기본 정보 입력
      <small>* 과정이 생성된 상태(임시 저장)에서만 퀴즈 / 시험 등록이 가능합니다.</small>
    </h3>
  </div>
  <form>
    <table class="table">
      <colgroup>
        <col width="160">  
        <col width="516">  
        <col width="160">
        <col width="516">  
      </colgroup>
      <tbody>
        <tr>
          <th scope="row">분류 설정 <b>*</b></th>
          <td colspan="3">
            <div class="d-flex gap-3 justify-content-bettwen">
              <select class="form-select" aria-label="대분류">
                <option selected>대분류</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
              <select class="form-select" aria-label="중분류">
                <option selected>중분류</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
              <select class="form-select" aria-label="소분류">
                <option selected>소분류</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">강좌명 <b>*</b></th>
          <td>
            <select class="form-select" aria-label="SECLECT">
              <option selected>SECLECT</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </td>
          <th scope="row">문제 유형 <b>*</b></th>
          <td>
            <div class="d-flex custom-gap">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="courseType" id="recipeCourse">
                <label class="form-check-label" for="recipeCourse">시험</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="courseType" id="generalCourse" checked>
                <label class="form-check-label" for="generalCourse">퀴즈</label>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">시험지명 <b>*</b></th>
          <td colspan="3">
            <input type="text" class="form-control" placeholder="HTML, CSS 기초 시험">
          </td>
        </tr>
      </tbody>
    </table>
  
    <!-- 강의 설정 영역 -->
    <div class="content_bar cent">
      <h3>퀴즈 / 시험 정보 입력</h3>
    </div>
    <div>
      <div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
        <h5 class="mb-0">1번</h5>
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
            <th scope="row">문제명 <b>*</b></th>
            <td colspan="3">
              <input type="text" class="form-control" placeholder="문제의 제목을 입력해 주세요.">
            </td>
          </tr>
          <tr>
            <th scope="row">해설 <b>*</b></th>
            <td colspan="3">
              <textarea class="form-control" rows="3" placeholder="강의 설명을 입력해 주세요."></textarea>
            </td>
          </tr>
          <tr>
            <th scope="row">문제 수준 <b>*</b></th>
            <td>
              <div class="d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="courseType" id="recipeCourse">
                  <label class="form-check-label" for="recipeCourse">상</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="courseType" id="generalCourse" checked>
                  <label class="form-check-label" for="generalCourse">중</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="courseType" id="generalCourse" checked>
                  <label class="form-check-label" for="generalCourse">하</label>
                </div>
              </div>
            </td>
            <th scope="row">정답 <b>*</b></th>
            <td>
              <div class="d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="courseType" id="recipeCourse">
                  <label class="form-check-label" for="recipeCourse">1번</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="courseType" id="generalCourse" checked>
                  <label class="form-check-label" for="generalCourse">2번</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="courseType" id="generalCourse" checked>
                  <label class="form-check-label" for="generalCourse">3번</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="courseType" id="generalCourse" checked>
                  <label class="form-check-label" for="generalCourse">4번</label>
                </div>
              </div>
          </tr>
          <tr>
            <th scope="row">문항 <b>*</b></th>
            <td colspan="3 d-flex gap">
              <input type="text" class="form-control mb-2" placeholder="1번 문항을 입력해 주세요.">
              <input type="text" class="form-control mb-2" placeholder="2번 문항을 입력해 주세요.">
              <input type="text" class="form-control mb-2" placeholder="3번 문항을 입력해 주세요.">
              <div class="input-group">
                <input type="text" class="form-control mb-2" placeholder="4번 문항을 입력해 주세요.">
                <span class="input-group-text add-input-btn d-flex align-item-center">
                  <i class="bi bi-plus"></i>
                </span>               
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </form>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>
