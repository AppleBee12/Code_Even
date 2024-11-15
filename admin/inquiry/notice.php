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

  <form action="" method="">
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
          <td>2</td>
          <td>admin</td>
          <td>관리자</td>
          <td><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_details.php"
              class="underline">[공지] 결제요청 가이드라인 안내</a></td>
          <td>9,999</td>
          <td>2024/10/31</td>
          <td>
            <span class="badge text-bg-success">노출</span>
          </td>
          <td>
            <a href="">
              <i class="bi bi-pencil-fill"></i>
            </a>
            <a href="">
              <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <input class="form-check-input itemCheckbox" type="checkbox" value="">
          </th>
          <td>1</td>
          <td>admin</td>
          <td>관리자</td>
          <td><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_details.php"
              class="underline">[공지] 결제요청 가이드라인 안내</a></td>
          <td>9,999</td>
          <td>2024/10/31</td>
          <td>
            <span class="badge text-bg-light">숨김</span>
          </td>
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
      <button type="button" data-bs-toggle="modal" data-bs-target="#status_modal"
        class="btn btn-outline-secondary">상태일괄수정</button>
      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_write.php"
        class="btn btn-secondary">등록</a>
      <button type="button" class="btn btn-danger">삭제</button>
    </div>
</div>

<!-- //Pagination -->
<div class="list_pagination" aria-label="Page navigation example">
  <ul class="pagination d-flex justify-content-center">
    <li class="page-item">
      <a class="page-link" href="" aria-label="Previous">
        <i class="bi bi-chevron-left"></i>
      </a>
    </li>
    <li class="page-item active"><a class="page-link" href="">1</a></li>
    <li class="page-item"><a class="page-link" href="">2</a></li>
    <li class="page-item"><a class="page-link" href="">3</a></li>
    <li class="page-item">
      <a class="page-link" href="" aria-label="Next">
        <i class="bi bi-chevron-right"></i>
      </a>
    </li>
  </ul>
</div>

<!-- //상태 변경 모달창 -->
<div class="modal" id="status_modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">글 상태 변경</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="">
          <table class="table">
            <colgroup>
              <col style="width:110px">
              <col style="width:auto">
            </colgroup>
            <thead class="thead-hidden">
              <tr>
                <th scope="col">구분</th>
                <th scope="col">내용</th>
              </tr>
            </thead>
            <tbody>
              <tr class="none">
                <th scope="row">제목</th>
                <td><input type="text" class="form-control w-75" placeholder="[공지] 결제요청 가이드라인 안내" disabled></td>
              </tr>
              <tr class="none">
                <th scope="row">상태 <b>*</b></th>
                <td class="d-flex gap-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status" checked>
                    <label class="form-check-label" for="status">
                      노출
                    </label>
                  </div>
                  <div class="form-check">
                    <input class=" form-check-input" type="radio" name="status" id="status">
                    <label class="form-check-label" for="status">
                      숨김
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
        <button type="button" class="btn btn-outline-secondary">수정</button>
      </div>
    </div>
  </div>
</div>
</form>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>