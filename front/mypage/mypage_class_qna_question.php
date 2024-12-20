<?php
$title = '마이페이지-1:1문의하기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

?>
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">수강 문의 작성</p>
    </div> 
    <!--제목 끝-->

    <div class="question_content">
      <div class="head">
        <div class="description_box">
          <i class="bi bi-book"></i>
          <div class="desc">
            <ul>
              <li>강의를 듣거나 혹은 강의에 관련된 질문이 있다면 자유롭게 질문해주세요.</li>
              <li>강사님께서 직접 답변해드립니다.</li>
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
                <th scope="row">강좌명</th>
                <td>
                  <select class="form-select w-50" name="category" required>
                    <!-- <option value="">분류 선택</option>
                    <option value="1">결제/환불</option>
                    <option value="2">강의</option>
                    <option value="3">쿠폰</option>
                    <option value="4">가입/탈퇴</option>
                    <option value="5">기타</option>
                    <option value="6">수료</option>
                    <option value="7">정산</option>
                    <option value="8">강사</option> -->
                  </select>
                </td>
              </tr>
              <tr class="none">
                <th scope="row">제목</th>
                <td>
                  <input type="text" name="title" class="form-control w-75" id="title" placeholder="제목을 입력해주세요." required>
                </td>
              </tr>
              <tr class="none">
                <th scope="row">내용</th>
                <td>
                  <textarea name="content" class="form-control" placeholder="문의 내용을 입력해주세요."></textarea>
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