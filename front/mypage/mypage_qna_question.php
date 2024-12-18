<?php
$title = '마이페이지-1:1문의하기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

$question_sql = "SELECT admin_question.*, user.* 
                FROM admin_question 
                JOIN user ON admin_question.uid = user.uid";
$question_result = $mysqli->query($question_sql);

$qdata = $question_result->fetch_object();
?>
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">서비스 문의 작성</p>
    </div> 
    <!--제목 끝-->

    <div class="question_content">
      <div class="head">
        <div class="description_box">
          <i class="bi bi-envelope-paper"></i>
          <div class="desc">
            <ul>
              <li>사이트를 이용하시면서 궁금한 사항이 있으시면 문의를 남겨주세요.</li>
              <li>답변 운영시간: 평일 9시 ~ 18시</li>
            </ul>
          </div>
        </div>
      </div>
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
                <th scope="row">문의 유형</th>
                <td>
                  <select class="form-select w-50" name="category" required>
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
                <th scope="row">제목</th>
                <td>
                  <input type="text" name="qtitle" class="form-control w-75" id="title" placeholder="제목을 입력해주세요." required>
                </td>
              </tr>
              <tr class="none">
                <th scope="row">이메일</th>
                <td>
                  <input type="email" name="useremail" class="form-control w-50" id="email" value="<?=$qdata->useremail;?>" readonly>
                </td>
              </tr>
              <tr class="none">
                <th scope="row">내용</th>
                <td>
                  <textarea name="qcontent" class="form-control"></textarea>
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