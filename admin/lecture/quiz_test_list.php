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
</style>

<div class="container">
  <h2>퀴즈 / 시험 목록</h2>
  <form action="" class="d-flex justify-content-end align-items-center gap-4 mb-3">
    <p class="mb-0">퀴즈 / 시험 검색</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="courseType" id="recipeCourse">
      <label class="form-check-label" for="recipeCourse">과정명</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="courseType" id="generalCourse" checked>
      <label class="form-check-label" for="generalCourse">시험지명</label>
    </div>
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
        <th scope="col">강좌명</th>
        <th scope="col">문제 유형</th>
        <th scope="col">시험지명</th>
        <th scope="col">등록자</th>
        <th scope="col">관리</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <input class="form-check-input itemCheckbox" type="checkbox" value="">
        </th>
        <th scope="row">1</th>
        <td>HTML 도장 깨기</td>
        <td>시험</td>
        <td>HTML, CSS 기초 시험</td>
        <td>admin</td>    
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
    <button type="button" class="btn selecmodify">일괄 수정</button>
  </div>
</div>


<?php

include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');

?>