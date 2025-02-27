<?php
$title = '마이페이지-문의글보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/mypage_header.php');

$aqid = $_GET['aqid'];

$question_sql = "SELECT admin_question.*, user.uid, user.username, admin_answer.aaid, admin_answer.acontent
                FROM admin_question 
                JOIN user ON admin_question.uid = user.uid 
                LEFT JOIN admin_answer ON admin_question.aqid = admin_answer.aqid 
                WHERE admin_answer.aqid = $aqid";
$question_result = $mysqli->query($question_sql);
$qdata = $question_result->fetch_object();


?>
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">나의 문의 상세</p>
    </div> 
    <!--제목 끝-->

    <div class="qna_details">
      <div class="title">
        <p class="category">
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

            echo isset($categories[$qdata->category]) ? $categories[$qdata->category] : "알 수 없음";
          ?>
        </p>
        <h2 class="headt4"><?=$qdata->qtitle;?></h2>
        <div class="writer">
          <span>작성자: <?=$qdata->username;?></span>
          <span>|</span>
          <span>등록일: <?=$qdata->regdate;?></span>
        </div>
      </div>
      <div class="content">
        <p><?=$qdata->qcontent;?></p>
      </div>
      <div class="answer">
        <p class="headt5">답변</p>
        <div class="profile">
          <img src="" alt="">
          <p>코드이븐</p>
        </div>
        <p><?=$qdata->acontent;?></p>
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
</div>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>