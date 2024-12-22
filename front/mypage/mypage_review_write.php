<?php
$title = '마이페이지-1:1문의하기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

$sql = "SELECT class_data.*, lecture.* 
        FROM class_data 
        JOIN lecture ON class_data.leid = lecture.leid 
        WHERE class_data.uid = '" . (isset($_SESSION['UID']) ? $_SESSION['UID'] : '') . "'";
$result = $mysqli->query($sql);
$dataArr = [];
while ($data = $result->fetch_object()) {
    $dataArr[] = $data;
}
?>
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">수강평 작성</p>
    </div> 
    <!--제목 끝-->

    <div class="question_content">
      <div class="line"></div>
      <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna_question_ok.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="uid" value="<?= isset($_SESSION['UID']) ? $_SESSION['UID'] : ''; ?>">
        <div class="body">
          <table class="table details_table">
            <colgroup>
              <col class="col-width-137">
              <col class="col-width-959">
            </colgroup>
            <thead class="thead-hidden">
              <tr>
                <th scope="col">구분</th>
                <th scope="col">내용</th>
              </tr>
            </thead>
            <tbody>
              <tr class="none">
                <th scope="row">강좌명</th>
                <td>
                  <select class="form-select w-50" name="cdid" required>
                  <?php 
                    foreach($dataArr as $data){
                  ?>
                    <option value="<?= htmlspecialchars($data->cdid) ?>">
                    [<?= htmlspecialchars($data->name) ?>] <?= htmlspecialchars($data->title) ?>
                    </option>
                  <?php
                    }
                  ?>
                  </select>
                </td>
              </tr>
              <tr class="none">
                <th scope="row">평가</th>
                <td>
                  <div class="rating">
                    <label class="rating__label rating__label--half" for="star1">
                      <input type="radio" id="star1" class="rating__input" name="rating" value="">
                      <span class="star-icon"></span>
                    </label>
                    <label class="rating__label rating__label--full" for="star2">
                      <input type="radio" id="star2" class="rating__input" name="rating" value="">
                      <span class="star-icon"></span>
                    </label>
                    <label class="rating__label rating__label--full" for="star3">
                      <input type="radio" id="star3" class="rating__input" name="rating" value="">
                      <span class="star-icon"></span>
                    </label>
                    <label class="rating__label rating__label--full" for="star4">
                      <input type="radio" id="star4" class="rating__input" name="rating" value="">
                      <span class="star-icon"></span>
                    </label>
                    <label class="rating__label rating__label--full" for="star5">
                      <input type="radio" id="star5" class="rating__input" name="rating" value="">
                      <span class="star-icon"></span>
                    </label>
                  </div>
                </td>
              </tr>
              <tr class="none">
                <th scope="row">제목</th>
                <td>
                  <input type="text" name="rtitle" class="form-control w-75" id="title" placeholder="제목을 입력해주세요." required>
                </td>
              </tr>
              <tr class="none">
                <th scope="row">내용</th>
                <td>
                  <textarea name="content" class="form-control" placeholder="내용을 입력해주세요." required></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="footer">
          <div class="d-flex justify-content-end button_box">
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna.php" class="btn">취소</a>
            <button type="submit" class="btn">등록</button>
          </div>
        </div>
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