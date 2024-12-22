<?php
$title = '마이페이지-강의후기보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

$sql = "SELECT review.*, class_data.*, lecture.*, user.* 
        FROM review 
        JOIN class_data ON review.cdid = class_data.cdid 
        JOIN lecture ON class_data.leid = lecture.leid 
        JOIN user ON class_data.uid = user.uid 
        WHERE class_data.uid = '" . (isset($_SESSION['UID']) ? $_SESSION['UID'] : '') . "'";
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
  // echo "<pre>";
  // print_r($dataArr);
  // echo "</pre>";
}
?>
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">수강 후기 목록</p>
    </div> 
    <!--제목 끝-->
    <div class="list_content">
      <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_review_write.php" class="qna_form">
        <div class="d-flex justify-content-between align-items-center">
          <p>총 건</p>
          <button type="submit">후기 작성하기</button>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">등록일</th>
              <th scope="col">강좌명</th>
              <th scope="col">제목</th>
              <th scope="col">평점</th>
              <th scope="col">삭제</th>
            </tr>
          </thead>
          <tbody>
            <?php
             foreach($dataArr as $data){
            ?>
            <tr>
              <th><?= $data->regdate; ?></th>
              <td>
                <?= mb_strlen($data->title) > 20 ? mb_substr($data->title, 0, 20) . '...' : $data->title; ?>
              </td>
              <td>
                <a href="" class="underline">
                <?= mb_strlen($data->rtitle) > 30 ? mb_substr($data->rtitle, 0, 30) . '...' : $data->rtitle; ?>
                </a>
              </td>
              <td>
              <?php
              for ($i = 0; $i < 5; $i++) { 
                  if ($i < $data->rating) {
                    echo '<i class="bi bi-star-fill"></i>';
                  } else {
                    echo '';
                  }
                }
              ?>
              </td>
              <td><a href="">X</a></td>
            </tr>
            <?php
             }
            ?>
          </tbody>
        </table>
      </form>
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