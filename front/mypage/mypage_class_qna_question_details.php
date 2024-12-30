<?php
$title = '마이페이지-문의글보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/mypage_header.php');

$sqid = $_GET['sqid'];
$sql = "SELECT student_qna.*, teacher_qna.*, class_data.*, lecture.*, user.* 
        FROM student_qna 
        LEFT JOIN teacher_qna ON student_qna.sqid = teacher_qna.sqid
        JOIN class_data ON student_qna.cdid = class_data.cdid
        JOIN lecture ON class_data.leid = lecture.leid
        JOIN user ON class_data.uid = user.uid 
        WHERE student_qna.sqid = $sqid
        ";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">나의 문의 상세</p>
    </div> 
    <!--제목 끝-->

    <div class="qna_details">
      <div class="title">
        <p class="category">
          <?= $data->title ?>
        </p>
        <h2 class="headt4"><?=$data->qtitle;?></h2>
        <div class="writer">
          <span>작성자: <?=$data->username;?></span>
          <span>|</span>
          <span>등록일: <?=$data->regdate;?></span>
        </div>
      </div>
      <div class="content">
        <p><?=$data->qcontent;?></p>
      </div>
      <div class="answer">
        <p class="headt5">답변</p>
        <div class="profile">
          <img src="" alt="">
          <p><?=$data->name;?></p>
        </div>
        <?php
          if (!empty($data->asid)) {
        ?>
        <p><?=$data->content;?></p>
        <?php
          }
        ?>
      </div>
    </div>
    <div class="d-flex justify-content-end btn_box">
      <a 
        href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna.php" 
        class="btn"
      ><i class="bi bi-list"></i>목록</a>
    </div>

  </div>
</div>


</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>