<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$sql = "SELECT userid, username FROM user";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2>FAQ</h2>
  <div class="content_bar">
    <h3>FAQ 작성</h3>
  </div>

  <form action="notice_write_ok.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="username" value="<?= $data->username; ?>">
    <input type="hidden" name="userid" value="<?= $data->userid; ?>">
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
          <th scope="row">유형 <b>*</b></th>
          <td>
            <select class="form-select w-50" aria-label="Default select example" name="">
              <option value="">유형 선택</option>
              <option value="1">일반회원</option>
              <option value="2">강사</option>
            </select>
          </td>
          <th scope="row">분류 <b>*</b></th>
          <td>
            <select class="form-select w-50" aria-label="Default select example">
              <option value="">분류 선택</option>
              <option value="1">결제/환불</option>
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
        <tr>
            <th scope="row">이름(아이디)</th>
            <td><?= $data->username; ?>(<?= $data->userid; ?>)</td>
            <th scope="row">상태 <b>*</b></th>
            <td class="d-flex gap-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status" value="on">
                <label class="form-check-label" for="status">
                  노출
                </label>
              </div>
              <div class="form-check">
                <input class=" form-check-input" type="radio" name="status" id="status" value="off" checked>
                <label class="form-check-label" for="status">
                  숨김
                </label>
              </div>
            </td>
          </tr>
        <tr class="none">
          <th scope="row">제목 <b>*</b></th>
          <td colspan="3">
            <div>
              <input type="text" name="title" class="form-control w-75" id="title" placeholder="제목을 입력해주세요.">
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
  <textarea name="content" id="" class="form-control w-75"></textarea>
  <input type="file" class="form-control" id="inputGroupFile02" class="w-50">
  <div class="custom-hr"></div>

  <div class="d-flex justify-content-end gap-2">
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/student_faq.php"
      class="btn btn-outline-danger">취소</a>
    <a href="" class="btn btn-secondary">등록</a>
  </div>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>