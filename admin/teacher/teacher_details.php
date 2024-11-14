<?php
$title = "강사상세정보";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>강사 프로필 수정</h2>
  <div class="content_bar">
    <h3>강사 상세정보</h3>
  </div>

  <form action="">
  <table class="table w-100">
    <thead class="thead-hidden">
      <tr>
        <th scope="col">구분</th>
        <th scope="col">내용</th>
      </tr>
    </thead>
    <tbody>
      
      <tr>
        <th scope="row">강좌명 <b>*</b></th>
        <td colspan="3">
          <div class="mb-3">
            <!-- <label for="exampleFormControlInput1" class="form-label"></label> -->
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)">
          </div>
        </td>
      </tr>
      
    </tbody>
  </table>
  </form>

  <div class="d-flex justify-content-end">
    <a href="student_list.php" type="button" class="btn btn-outline-danger">취소</a>
  </div>
</div>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>