<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>수강생 관리</h2>
  <div class="content_bar">
    <h3>수강생 질문</h3>
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
        <td colspan="3">기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)</td>
      </tr>
      <tr class="none">
        <th scope="row">제목</th>
        <td colspan="3">
          <div>
            <input type="text" name="title" class="form-control w-75" id="title" placeholder="왜 틀렸는지 모르겠습니다.." disabled>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">이름(아이디)</th>
        <td>흑백핑(dark1234)</td>
        <th scope="row">등록일</th>
        <td>2024/10/19 10:10:10</td>
      </tr>
      <tr class="none">
        <th scope="row">질문 내용</th>
        <td colspan="3">
          <textarea name="" id="" class="form-control w-75" placeholder="왜 틀렸는지 모르겠습니다.." disabled></textarea>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="content_bar">
    <h3>강사 답변</h3>
  </div>
  <div class="card">
    <div class="card-header">
      <img src="" alt="" id="propfile_thumbnail">
      <p>김동주 강사</p>
    </div>
    <div class="card-body">
      <blockquote class="blockquote mb-0">
      </blockquote>
    </div>
  </div>
  <div class="custom-hr"></div>

  <div class="d-flex justify-content-end gap-2">
    <a href="student_question.php" type="button" class="btn btn-outline-danger">취소</a>
    <a href="" type="button" class="btn btn-danger">삭제</a>
  </div>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>