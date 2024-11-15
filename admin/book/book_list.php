<?php

include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');

?>

<style>

  /* 검색창 */
  .lesearch{
    background-color: var(--bk700);

    i{
      color: var(--bk0);
    }
  }

  .lesearch:hover{
    background-color: var(--bk700);

    i{
      color: var(--bk0);
    }
  }

  .selecmodify{
  border-color: var(--bk900);
  color: var(--bk900);
  }

  .selecmodify:hover{
  border-color: var(--bk0);
  background-color: var(--bk900);
  color: var(--bk0);
  }

  .custom-select-width {
    width: 200px;
  }

  /* 포커스 효과 */
  .form-check-input:focus,
  .form-control:focus,
  .form-select:focus {
    border-color: #ff5733;
    box-shadow: 0 0 0 0.25rem rgba(255, 87, 51, 0.25);
  }

</style>

<div class="container">
  <h2>교재 목록</h2>
  <form action="" class="d-flex justify-content-end align-items-center gap-4 mb-3">
    <p class="mb-0">분류 선택</p>
    <select class="form-select custom-select-width" aria-label="Default select example w-10">
      <option selected>대분류</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <select class="form-select custom-select-width" aria-label="Default select example">
      <option selected>중분류</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <select class="form-select custom-select-width" aria-label="Default select example">
      <option selected>소분류</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <div class="d-flex align-items-center">
      <input type="text" class="form-control me-2" id="exampleFormControlInput1" placeholder="검색어를 입력하세요.">
      <button type="button" class="btn lesearch"><i class="bi bi-search"></i></button>
    </div>
  </form>
  <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">
          <input class="form-check-input" type="checkbox" value="" id="allCheck">
        </th>
        <th scope="col">번호</th>
        <th scope="col">이미지</th>
        <th scope="col">교재명</th>
        <th scope="col">등록자</th>
        <th scope="col">출판사명</th>
        <th scope="col">출판일</th>
        <th scope="col">저자</th>
        <th scope="col">가격</th>
        <th scope="col">관리</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <input class="form-check-input itemCheckbox" type="checkbox" value="">
        </th>
        <th scope="row">1</th>
        <td><img src="" alt=""></td>
        <td>HTML 도장 깨기</td>
        <td>admin</td>    
        <td>길동사</td>
        <td>2021 / 01 / 29</td>
        <td>홍길동</td>
        <td>13,000원</td>
        <td>
          <div class="d-flex justify-content-center gap-4">
            <i class="bi bi-pencil-fill"></i>
            <i class="bi bi-trash"></i>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex justify-content-end gap-2 mt-20 mb-50">
    <button type="button" class="btn selecmodify">일괄 삭제</button>
  </div>
</div>


<?php

include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');

?>