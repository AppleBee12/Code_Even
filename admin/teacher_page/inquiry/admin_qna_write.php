<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// $selected_target = isset($_POST['target']) ? $_POST['target'] : '';
// print_r($_GET);

$sql = "SELECT userid, username FROM user";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2>1:1 문의</h2>
  <div class="content_bar">
    <h3>1:1 문의 질문 작성</h3>
  </div>

  <form action="admin_qna_write_ok.php" method="POST" enctype="multipart/form-data">
    <table class="table details_table">
      <colgroup>
        <col class="col-width-160">
        <col class="col-width-516">
        <col class="col-width-160">
        <col class="col-width-516">
      </colgroup>
      <thead class="thead-hidden">
        <tr>
          <th scope="col">구분</th>
          <th scope="col">내용</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">이름(아이디)</th>
          <td><?= $data->username; ?>(<?= $data->userid; ?>)</td>
          <th scope="row">분류 <b>*</b></th>
          <td>
            <select class="form-select w-50" aria-label="category select" name="category" required>
              <option value="">분류 선택</option>
              <option value="1">결제/환불</option>
              <option value="2">강의</option>
              <option value="3">쿠폰</option>
              <option value="4">가입/탈퇴</option>
              <option value="5">기타</option>
              <option value="6">수료</option>
              <option value="7">정산</option>
              <option value="8">강사</option>
            </select>
          </td>
        </tr>
        <tr class="none">
          <th scope="row">제목 <b>*</b></th>
          <td colspan="3">
            <div>
              <input type="text" name="title" class="form-control w-75" id="title" placeholder="제목을 입력해주세요." aria-label="target select">
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <textarea name="content" id="" class="form-control w-75"></textarea>
    <input type="file" class="form-control" id="inputGroupFile02" class="w-50">
    <div class="custom-hr"></div>

    <div class="d-flex justify-content-end gap-2">
      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/student_faq.php"
        class="btn btn-outline-danger">취소</a>
      <button type="submit" class="btn btn-secondary">등록</button>
    </div>
  </form>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>