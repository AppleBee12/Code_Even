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

.nlecture{
border-color: var(--bk0);
background-color: var(--bk900);
color: var(--bk0);
}

.nlecture:hover{
  border-color: var(--bk900);
  color: var(--bk900);
}

</style>

<div class="container">
  <h2>퀴즈 / 시험 결과 관리</h2>
  <form action="" class="d-flex justify-content-end align-items-center gap-4 mb-3">
    <div class="d-flex w-25 mb-3">
      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="검색어를 입력하세요.">
      <button type="button" class="btn lesearch"><i class="bi bi-search"></i></button>
    </div>
  </form>
  <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">번호</th>
        <th scope="col">이름</th>
        <th scope="col">강좌명</th>
        <th scope="col">강의명</th>
        <th scope="col">퀴즈 점수</th>
        <th scope="col">시험 점수</th>
        <th scope="col">미리보기</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>김기역</td>
        <td>HTML 도장 깨기</td>
        <td>HTML 알아보기~~</td>
        <td>90점</td>
        <td>80점</td>
        <td>
          <button type="button" class="btn btn-sm nlecture">미리보기</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>


<?php

include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');

?>