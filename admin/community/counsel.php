<?php
$title = "고민 상담";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');
?>



<div class="container">
  <h2 class="page_title">고민 상담</h2>


  <form action="" id="search_form" class="row justify-content-end">
    <div class="col-lg-3">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="검색어를 입력해주세요" aria-label="counsel" aria-describedby="basic-addon2">
        <button type="button" class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>


  </form>

  <form action="">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">닉네임</th>
          <th scope="col">제목</th>
          <th scope="col">내용</th>
          <th scope="col">상태</th>
          <th scope="col">좋아요</th>
          <th scope="col">댓글수</th>
          <th scope="col">조회수</th>
          <th scope="col">작성일</th>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">152</th>
          <td>Mark</td>
          <td><a href="#">뭐부터 공부해야 할지..</a></td>
          <td><a href="#">백엔드 개발자가 되고픈 30대..</a></td>
          <td><span class="badge text-bg-light">미해결</span></td>
          <td>0 <b>개</b></td>
          <td>0<b>개</b></td>
          <td>6<b>개</b></td>
          <td>2024/11/17</td>
          <td class="edit_col">
            <a href="">
              <i class="bi bi-pencil-fill"></i>
            </a>
            <a href="">
              <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <tr>
          <th scope="row">151</th>
          <td>Jacob</td>
          <td><a href="#">c언어 기출문제의 변형</a></td>
          <td><a href="#">앞 뒤가 똑같은 숫자 한번만...</a></td>
          <td><span class="badge text-bg-success">해결</span></td>
          <td>0 <b>개</b></td>
          <td>2<b>개</b></td>
          <td>5<b>개</b></td>
          <td>2024/11/17</td>
          <td class="edit_col">
            <a href="">
              <i class="bi bi-pencil-fill"></i>
            </a>
            <a href="">
              <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <tr>
          <th scope="row">150</th>
          <td>Larry</td>
          <td><a href="#">index.html 500오류..</a></td>
          <td><a href="#">에러뜨고 안되여ㅠㅠ<!DOCT..</a></td>
          <td><span class="badge text-bg-light">미해결</span></td>
          <td>0 <b>개</b></td>
          <td>0 <b>개</b></td>
          <td>11<b>개</b></td>
          <td>2024/11/17</td>
          <td class="edit_col">
            <a href="">
              <i class="bi bi-pencil-fill"></i>
            </a>
            <a href="">
              <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <tr>
          <th scope="row">149</th>
          <td>Larry</td>
          <td><a href="#">1-D런타임에러가 ..</a></td>
          <td><a href="#">vscode에선 잘 실행되는데 제..</a></td>
          <td><span class="badge text-bg-success">해결</span></td>
          <td>2 <b>개</b></td>
          <td>2 <b>개</b></td>
          <td>14<b>개</b></td>
          <td>2024/11/17</td>
          <td class="edit_col">
            <a href="">
              <i class="bi bi-pencil-fill"></i>
            </a>
            <a href="">
              <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        

    </table>
    <!-- //table -->
    <button type="button" class="btn btn-outline-secondary ms-auto d-block">일괄수정</button>
  </form>



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
  <!-- //Pagination -->
</div>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>