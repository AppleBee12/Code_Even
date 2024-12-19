<?php
$title = '마이페이지-강의후기보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

?>
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">수강 후기 목록</p>
    </div> 
    <!--제목 끝-->
    <div class="list_content">
      <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna_question.php" class="qna_form">
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
            <tr>
              <th></th>
              <td></td>
              <td>
                <a href="" class="underline"></a>
              </td>
              <td></td>
              <td><a href="">X</a></td>
            </tr>

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