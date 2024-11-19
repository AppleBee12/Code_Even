<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');

$title = $_POST['title'];
$content = $_POST['content'];
$regdate = date('Y-m-d H:i:s');

$sql = "INSERT INTO send_email (title, content, regdate) 
        VALUES ('$title', '$content', '$regdate')";

if ($mysqli->query($sql) === TRUE) {
  echo "Email data saved successfully.";
} else {
  echo "Error: " . $mysqli->error;
}

?>

<div class="container">
  <h2>이메일 발송</h2>
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
          <th scope="col">번호</th>
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
          <th scope="col">이메일</th>
          <th scope="col">제목</th>
          <th scope="col">발송일</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2</td>
          <td>ping09</td>
          <td>피곤핑</td>
          <td>hong@hong.com</td>
          <td><a href="" class="underline" data-bs-toggle="modal" data-bs-target="#email_details">입금하실 계좌 정보입니다.</a></td>
          <td>2024/10/19 10:10:10</td>
        </tr>
        <tr>
          <td>1</td>
          <td>hong1234</td>
          <td>홍길동</td>
          <td>hong@hong.com</td>
          <td><a href="" class="underline" data-bs-toggle="modal" data-bs-target="#email_details">입금하실 계좌 정보입니다.</a></td>
          <td>2024/10/19 10:10:10</td>
        </tr>
      </tbody>
    </table>

    <!-- //이메일 상세 모달창 -->
    <div class="modal modal-lg" id="email_details" tabindex="-1">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title">이메일 상세</h5>
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
                  <th scope="row">제목</th>
                  <td colspan="3"><input type="text" class="form-control w-75" placeholder="입금하실 계좌 정보입니다." disabled></td>
                </tr>
                <tr class="none">
                  <th scope="row">내용</th>
                  <td colspan="3"><textarea name="" id="" class="form-control w-75" placeholder="입금하실 계좌 정보입니다." disabled></textarea></td>
                </tr>
              </tbody>
            </table>
          </form>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
           </div>
         </div>
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

  </form>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>