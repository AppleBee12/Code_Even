<?php
$title = "수강생 질문";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$sqid = $_GET['sqid'];
$sql = "SELECT student_qna.*, class_data.*, lecture.*, user.* 
        FROM student_qna 
        JOIN class_data ON student_qna.cdid = class_data.cdid
        JOIN lecture ON class_data.leid = lecture.leid
        JOIN user ON class_data.uid = user.uid 
        WHERE sqid = $sqid
        ";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2>수강생 관리</h2>
  <div class="content_bar">
    <h3>수강생 질문</h3>
  </div>

  <form action="student_question_answer" method="POST">
    <input type="hidden" name="sqid" value="<?= $sqid; ?>">
    <table class="table details_table">
      <colgroup>
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
          <th scope="row">강좌명</th>
          <td colspan="3"><?=$data->title;?></td>
        </tr>
        <tr class="none">
          <th scope="row">제목</th>
          <td colspan="3">
            <div>
              <input type="text" name="title" class="form-control w-75" id="title" value="<?=$data->qtitle;?>" disabled>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">이름(아이디)</th>
          <td><?=$data->username;?>(<?=$data->userid;?>)</td>
          <th scope="row">등록일</th>
          <td><?=$data->regdate;?></td>
        </tr>
        <tr class="none">
          <th scope="row">질문 내용</th>
          <td colspan="3">
            <textarea class="form-control w-75" disabled><?=$data->qcontent;?></textarea>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="content_bar">
      <h3>강사 답변</h3>
    </div>
  
    <textarea name="content" id="content" class="form-control" placeholder="내용을 입력해주세요."></textarea>
  
    <div class="custom-hr"></div>
  
    <div class="d-flex justify-content-end gap-2">
      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/teacher_page/student/teacher_student_question.php"
    class="btn btn-outline-danger">취소</a>
  
      <button type="submit" class="btn btn-secondary">등록</button>
  
    </div>
  </form>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>