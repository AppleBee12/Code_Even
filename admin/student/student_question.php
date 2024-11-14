<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>수강생 질문</h2>
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
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          </th>
          <th scope="col">번호</th>
          <th scope="col">강사명</th>
          <th scope="col">강의명</th>
          <th scope="col">제목</th>
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
          <th scope="col">등록일</th>
          <th scope="col">상태</th>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          </th>
          <td>2</td>
          <td>김동주</td>
          <td>기초부터 확실하게!..</td>
          <td><a href="student_question_details.php" class="underline">sql 쿼리가 작동되지 않습니다.</a></td>
          <td>hong1234</td>
          <td>홍길동</td>
          <td>2024/10/19 10:10:10</td>
          <td>
            <span class="badge text-bg-success">답변완료</span>
          </td>
          <td>
            <a href="">
              <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          </th>
          <td>1</td>
          <td>김동주</td>
          <td>기초부터 확실하게!..</td>
          <td><a href="student_question_details.php" class="underline">왜 틀렸는지 모르겠습니다..</a></td>
          <td>dark1234</td>
          <td>흑백핑</td>
          <td>2024/10/19 10:10:10</td>
          <td>
            <span class="badge text-bg-light">답변대기</span>
          </td>
          <td>
            <a href="">
              <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-danger">삭제</button>
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
    
  </form>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>