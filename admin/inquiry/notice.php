<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');


?>

<div class="container">
  <h2>전체 공지사항</h2>
  <form class="row justify-content-end">
    <div class="col-lg-4">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="검색어를 입력하세요." aria-label="Recipient's username"
          aria-describedby="basic-addon2">
        <button type="button" class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </form>

  <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">
          <input class="form-check-input" type="checkbox" value="" id="allCheck">
        </th>
        <th scope="col">번호</th>
        <th scope="col">아이디</th>
        <th scope="col">이름</th>
        <th scope="col">제목</th>
        <th scope="col">조회수</th>
        <th scope="col">등록일</th>
        <th scope="col">상태</th>
        <th scope="col">관리</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <input class="form-check-input itemCheckbox" type="checkbox" value="">
        </th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <a href="">
            <i class="bi bi-pencil-fill"></i>
          </a>
          <a href="">
            <i class="bi bi-trash-fill"></i>
          </a>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex justify-content-end gap-2">
    <button type="button" class="btn btn-outline-secondary">상태일괄수정</button>
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_write.php" type="button"
      class="btn btn-secondary">등록</a>
    <button type="button" class="btn btn-danger">삭제</button>
  </div>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>