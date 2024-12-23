<?php
$title = '마이페이지-후기글보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

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
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">나의 후기 상세</p>
    </div> 
    <!--제목 끝-->

    <div class="qna_details">
      <div class="title">
        <p class="category">
          <?= $data->title;?>
        </p>
        <h2 class="headt4"><?=$data->rtitle;?></h2>
        <div class="writer">
          <span>작성자: <?=$data->username;?></span>
          <span>|</span>
          <span>등록일: <?=$data->regdate;?></span>
        </div>
        <p>
          <?php
            for ($i = 0; $i < 5; $i++) { 
              if ($i < $data->rating) {
                echo '<i class="bi bi-star-fill"></i>';
              } else {
                echo '<i class="bi bi-star-fill empty"></i>';
              }
            }
          ?>
        </p>
      </div>
      <div class="content">
        <p><?=$data->content;?></p>
      </div>
    </div>
    <div class="d-flex justify-content-end btn_box">
      <a 
        href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_reivew.php" 
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
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>