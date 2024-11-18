<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$aqid = $_GET['aqid'];
$sql = "SELECT 
          admin_question.*,
          user.username, 
          user.userid, 
          user.user_level, 
          admin_answer.answer_date 
        FROM 
            admin_question
        JOIN 
            user ON admin_question.uid = user.uid
        LEFT JOIN 
            admin_answer ON admin_question.aqid = admin_answer.aqid WHERE aqid = $aqid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2>1:1 문의</h2>
  <div class="content_bar">
    <h3>1:1 문의 질문</h3>
  </div>

  <form form action="admin_qna_answer.php" method="POST">
    <input type="hidden" name="aqid" value="<?=$data->aqid;?>">
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
        <tr class="none">
        <th scope="row">이름(아이디)</th>
          <td>
            <?=$data->username?>(<?=$data->userid?>)
            <?php
              $class = $data->user_level == '10' ? 'text-bg-dark' : 'text-bg-light';
              $text = $data->user_level == '10' ? '강사' : '수강생';
              echo "<span class='badge $class'>$text</span>";
            ?>
          </td>
        </tr>
        <tr>
        <th scope="row">분류</th>
        <td>
            <select class="form-select w-50" aria-label="Default select example" name="category">
              <option value="<?=$data->category?>">
              <?php
                $categories = [
                    1 => "결제/환불",
                    2 => "강의",
                    3 => "쿠폰",
                    4 => "가입/탈퇴",
                    5 => "기타",
                    6 => "수료",
                    7 => "정산",
                    8 => "강사"
                ];

                echo isset($categories[$data->category]) ? $categories[$data->category] : "알 수 없음";
              ?>
              </option>
            </select>
          </td>
          <th scope="row">등록일</th>
          <td><?=$data->regdate?></td>
        </tr>
        <tr>
          <th scope="row">제목</th>
          <td colspan="3">
            <div>
              <input type="text" name="title" class="form-control w-75" id="title" value="<?=$data->qtitle?>" disabled>
            </div>
          </td>
        </tr>
        <tr class="none">
          <th scope="row">질문 내용</th>
          <td colspan="3">
            <textarea name="" id="" class="form-control w-75" disabled><?=$data->qcontent?></textarea>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="content_bar">
      <h3>답변 내용</h3>
    </div>

    <div class="card">
      <div class="card-header">
        <img src="" alt="" id="propfile_thumbnail">
        <p>관리자</p>
      </div>
      <div class="card-body">
        <blockquote class="blockquote mb-0">
        </blockquote>
      </div>
    </div>

    <div class="custom-hr"></div>
  
    <div class="d-flex justify-content-end gap-2">
      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/admin_qna.php" class="btn btn-outline-danger">취소</a>
      <button type="submit" class="btn btn-secondary">답변 작성</button>
    </div>

  </form>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>