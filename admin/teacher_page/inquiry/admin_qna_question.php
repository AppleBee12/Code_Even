<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$sql = "SELECT 
          admin_question.*,
          user.username, 
          user.userid, 
          user.user_level,
          admin_answer.aaid,  
          admin_answer.acontent 
        FROM 
            admin_question
        JOIN 
            user ON admin_question.uid = user.uid
        LEFT JOIN 
            admin_answer ON admin_question.aqid = admin_answer.aqid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2>1:1 문의</h2>
  <div class="content_bar">
    <h3>질문 작성</h3>
  </div>

  <form action="admin_qna_question_ok.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="username" value="<?= $data->username ?>">
    <input type="hidden" name="userid" value="<?= $data->userid ?>">
    <input type="hidden" name="user_level" value="<?= $data->user_level ?>">
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
          <td>
            <?= $data->username ?>(<?= $data->userid ?>)
            <?php
            $class = $data->user_level == '10' ? 'text-bg-dark' : 'text-bg-light';
            $text = $data->user_level == '10' ? '강사' : '수강생';
            echo "<span class='badge $class'>$text</span>";
            ?>
          </td>
          <th scope="row">분류</th>
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
              <input type="text" name="qtitle" class="form-control w-75" id="qtitle" placeholder="제목을 입력해주세요.">
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <textarea name="qcontent" id="content" class="form-control" placeholder="내용을 입력해주세요."></textarea>
  
    <div class="custom-hr"></div>
    <div class="d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-outline-danger" onclick="window.history.back();" aria-label="취소">취소</button>
        <button type="submit" class="btn btn-secondary">등록</button>
    </div>
  </form>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>