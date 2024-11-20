<?php
$title = "수강 후기";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$rvid = $_GET['rvid'];
$sql = "SELECT review.*, class_data.*, lecture.*, user.* 
        FROM review 
        JOIN class_data ON review.cdid = class_data.cdid 
        JOIN lecture ON class_data.leid = lecture.leid 
        JOIN user ON class_data.uid = user.uid 
        WHERE rvid = $rvid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

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
        <td><?=$data->name;?></td>
      </tr>
      <tr>
        <th scope="row">강좌명</th>
        <td colspan="5"><?=$data->title;?></td>
      </tr>
      <tr class="none">
        <th scope="row">제목</th>
        <td colspan="3">
          <div>
            <input type="text" name="title" class="form-control" id="title" value="<?=$data->rtitle;?>" disabled>
          </div>
        </td>
      </tr>
      <tr class="none">
        <th scope="row">이름(아이디)</th>
        <td><?=$data->username;?>(<?=$data->userid;?>)</td>
      </tr>
      <tr>
        <th scope="row">평점</th>
        <td>
          <div>
            <?php
              for ($i = 0; $i < 5; $i++) { 
                if ($i < $data->rating) {
                  if ($i < $data->rating) {
            ?>
                    <i class="bi bi-star-fill"></i>
                <?php } else { ?>
                    <i class="bi bi-star"></i>
            <?php 
                  }
                }
              }
            ?>
          </div>
        </td>
        <th scope="row">등록일</th>
        <td><?=$data->regdate;?></td>
      </tr>
      <tr class="none">
        <th scope="row">내용</th>
        <td colspan="3">
          <textarea name="" id="" class="form-control" disabled><?=$data->content;?></textarea>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="custom-hr"></div>
  <div class="d-flex justify-content-end gap-2">
    <a 
    <?php if ($level == 100): ?>
    href="course_reviews.php" 
    <?php endif; ?>
    <?php if ($level == 10): ?>
    href="teacher_course_reviews.php" 
    <?php endif; ?>
    class="btn btn-outline-danger">취소</a>

  <?php if ($level == 100): ?>
    <a href="course_reviews_delete.php?rvid=<?=$rvid;?>" type="button" class="btn btn-danger">삭제</a>
  <?php endif; ?>
  </div>

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
  ?>