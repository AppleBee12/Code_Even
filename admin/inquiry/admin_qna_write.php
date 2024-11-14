<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>1:1 문의</h2>
  <div class="content_bar">
    <h3>1:1 문의 질문</h3>
  </div>

    <table class="table details_table">
      <colgroup>
        <col style="width:160px">
        <col style="width:516px">
        <col style="width:160px">
        <col style="width:516px">
      </colgroup>
      <thead class="thead-hidden">
        <tr>
          <th scope="col">구분</th>
          <th scope="col">내용</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">유형</th>
          <td>
            <select class="form-select w-50" aria-label="Default select example" disabled>
              <option selected>일반회원</option>
              <option value="1">강사</option>
            </select>
          </td>
          <th scope="row">분류</th>
          <td>
            <select class="form-select w-50" aria-label="Default select example" disabled>
              <option selected>결제/환불</option>
              <option value="1">강의</option>
              <option value="1">쿠폰</option>
              <option value="1">가입/탈퇴</option>
              <option value="1">기타</option>
              <option value="1">수료</option>
              <option value="1">정산</option>
              <option value="1">강사</option>
            </select>
          </td>
        </tr>
        <tr class="none">
          <th scope="row">제목</th>
          <td colspan="3">
            <div>
              <input type="text" name="title" class="form-control w-75" id="title" placeholder="모바일 접속이 안됩니다." disabled>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">이름(아이디)</th>
          <td>흑백핑(dark1234)</td>
          <th scope="row">등록일</th>
          <td>2024/10/31</td>
        </tr>
        <tr class="none">
          <th scope="row">질문 내용</th>
          <td colspan="3">
            <textarea name="" id="" class="form-control w-75" placeholder="모바일 접속이 안됩니다." disabled></textarea>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="content_bar">
      <h3>답변 내용</h3>
    </div>
    <textarea name="" id="" class="form-control w-75"></textarea>
    <input type="file" class="form-control" id="inputGroupFile02" class="w-50">
    <div class="custom-hr"></div>
  
    <div class="d-flex justify-content-end gap-2">
      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/admin_qna.php" type="button" class="btn btn-outline-danger">취소</a>
    </div>

</div>

<script>
  function printPage() {
    const fileUrl = "../../images/certificate of completion.pdf";

    // PDF를 iframe으로 페이지에 삽입
    const iframe = document.createElement("iframe");
    iframe.style.position = "absolute";
    iframe.style.width = "0px";
    iframe.style.height = "0px";
    iframe.style.border = "none";
    iframe.src = fileUrl;

    // iframe을 body에 추가
    document.body.appendChild(iframe);

    // PDF 파일이 로드된 후 인쇄
    iframe.onload = function () {
      iframe.contentWindow.print();  // iframe 내에서 print() 호출
    };
  }

  document.getElementById("printButton").addEventListener("click", printPage);
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>