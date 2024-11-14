<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>
<div class="container">
  <h2>수강 후기</h2>
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

  <form action="">
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
          <th scope="col">강의명</th>
          <th scope="col">강사</th>
          <th scope="col">평점</th>
          <th scope="col">등록일</th>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">
            <input class="form-check-input itemCheckbox" type="checkbox" value="">
          </th>
          <td>2</td>
          <td>ping09</td>
          <td>피곤핑</td>
          <td><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/course_reviews_details.php" class="underline">정말 좋은 강의 감사합니다.</a></td>
          <td>기초부터 확실하게!..</td>
          <td>이코딩</td>
          <td>
            <div>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
          </td>
          <td>2024/10/19 10:10:10</td>
          <td>
            <a href="">
              <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <input class="form-check-input itemCheckbox" type="checkbox" value="" id="flexCheckDefault">
          </th>
          <td>1</td>
          <td>hong1234</td>
          <td>홍길동</td>
          <td><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/course_reviews_details.php" class="underline">정말 좋은 강의 감사합니다.</a></td>
          <td>기초부터 확실하게!..</td>
          <td>이코딩</td>
          <td>
            <div>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
          </td>
          <td>2024/10/19 10:10:10</td>
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
   
    <!-- //email 모달창 -->
     <div class="modal modal-lg" id="send_email" tabindex="-1">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title">이메일 전송</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
           <form action="" method="">
            <table class="table">
              <colgroup>
                <col style="width:110px">
                <col style="width:250px">
              </colgroup>
              <thead class="thead-hidden">
                <tr>
                  <th scope="col">구분</th>
                  <th scope="col">내용</th>
                </tr>
              </thead>
              <tbody>
                <tr class="none">
                  <th scope="row">이름(아이디)</th>
                  <td>홍길동</td>
                  <th scope="row">이메일</th>
                  <td>hong1234@hong.com</td>
                </tr>
                <tr class="none">
                  <th scope="row">제목 <b>*</b></th>
                  <td colspan="3"><input type="text" class="form-control"></td>
                </tr>
                <tr class="none">
                  <th scope="row">내용 <b>*</b></th>
                  <td colspan="3"><textarea name="" id="" class="form-control"></textarea></td>
                </tr>
              </tbody>
            </table>
          </form>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
             <button type="button" class="btn btn-secondary">등록</button>
           </div>
         </div>
       </div>
     </div>

  </form>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>