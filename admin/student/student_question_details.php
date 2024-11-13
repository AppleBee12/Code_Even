<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<style>
</style>

<div class="container">
  <h2>수강생 관리</h2>
  <div class="content_bar">
    <h3>수강생 질문</h3>
  </div>

  <div class="content_bar">
    <h3>수강 정보</h3>
  </div>

  <div class="d-flex justify-content-end">
    <a href="student_list.php" type="button" class="btn btn-outline-danger">취소</a>
    <a href="student_list.php" type="button" class="btn btn-danger">삭제</a>
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