<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<style>
  .table {
    margin: 25px 25px;
  }

  .table thead {
    flex: 0 0 160px;
  }

  tr {
    height: 50px;
  }

  th,
  td {
    vertical-align: middle;
  }

  .table tbody {
    flex: 1;
    /* 나머지 공간을 차지 */
  }
</style>

<div class="container">
  <h2>문의게시판 관리</h2>
  <div class="content_bar">
    <h3>전체 공지사항 작성</h3>
  </div>
  <div class="row">
    <div class="col">
      <table class="table d-flex none">
        <thead>
          <tr>
            <th>이름(아이디)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>관리자(admin)</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col">
      <table class="table d-flex none">
        <thead>
          <tr>
            <th>상태<em> *</em></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="d-flex gap-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="emailCheck" id="flexRadioDisabled" checked>
                <label class="form-check-label" for="flexRadioDisabled">
                  노출
                </label>
              </div>
              <div class="form-check">
                <input class=" form-check-input" type="radio" name="emailCheck" id="flexRadioDisabled">
                <label class="form-check-label" for="flexRadioCheckedDisabled">
                  숨김
                </label>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <table class="table d-flex none">
    <thead>
      <tr>
        <th>제목<em> *</em></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <input type="text" class="form-control form-control-sm" placeholder="제목을 입력해주세요.">
        </td>
      </tr>
    </tbody>
  </table>
  <div class="custom-hr"></div>
  <div class="d-flex justify-content-end">
    <a href="student_question.php" type="button" class="btn btn-outline-danger">취소</a>
    <a href="" type="button" class="btn btn-danger">삭제</a>
  </div>
</div>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>