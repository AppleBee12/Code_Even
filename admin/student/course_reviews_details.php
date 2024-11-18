<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>수강생 관리</h2>
  <div class="content_bar">
    <h3>수강생 상세정보</h3>
  </div>

  <table class="table details_table">
    <colgroup>
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
      <tr class="none">
        <th scope="row">강사명</th>
        <td>김동주</td>
      </tr>
      <tr>
        <th scope="row">강좌명</th>
        <td colspan="5">기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)</td>
      </tr>
      <tr class="none">
        <th scope="row">제목</th>
        <td colspan="3">
          <div>
            <input type="text" name="title" class="form-control" id="title" placeholder="정말 좋은 강의 감사합니다." disabled>
          </div>
        </td>
      </tr>
      <tr class="none">
        <th scope="row">이름(아이디)</th>
        <td>흑백핑(dark1234)</td>
        <th scope="row">등록일</th>
        <td>2024/10/19 10:10:10</td>
      </tr>
      <tr>
        <th scope="row">평점</th>
        <td>
          <div>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
        </td>
      </tr>
      <tr class="none">
        <th scope="row">내용</th>
        <td colspan="3">
          <textarea name="" id="" class="form-control" placeholder="정말 좋은 강의 감사합니다." disabled></textarea>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="custom-hr"></div>
  <div class="d-flex justify-content-end gap-2">
    <a href="student_question.php" type="button" class="btn btn-outline-danger">취소</a>
    <a href="" type="button" class="btn btn-danger">삭제</a>
  </div>

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
  ?>