<?php
$title = '마이페이지-강좌보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

?>
<!--탭 메뉴 시작-->
<div class="mypage_tap_wrapper d-flex">
  <div class="mypage_tap active headt6"><a href="#">진행 강좌</a></div>
  <div class="mypage_tap headt6"><a href="">종료 강좌</a></div>
</div>
<!--탭 메뉴 끝-->
<div class="my_lecture_wrapper">
  <div class="my_lecture">
    <div class="my_lec_top d-flex">
      <img src="https://picsum.photos/180/180" alt="">
      <div>
        <p>상단 메뉴부터 사이드메뉴까지 메뉴의 모든 것, 최종 끝판왕</p>
        <p><b>이븐 선생님</b> | <span>레시피강좌</span></p>
      </div>
    </div>
    <hr>
    <div>
      <div class="my_lec_desc">
        <ul>
          <li class="">
            <p>강좌기간</p>
            <p>30일(2024-11-30 ~ 2024-01-04)</p>
          </li>
          <li class="">
            <p>진도율</p>
            <p>33%</p>
          </li>
          <li class="">
            <p>평균 점수</p>
            <p>90점</p>
          </li>
        </ul>
        <div class="my_lec_btn d-flex">
          <div><a href="">수료기준</a></div>
          <button>수료증</button>
        </div>
      </div>
      <div class="my_lec_graph_wrapper">
        <div class="my_lec_graph">
          <div>
            <p>1/3</p>
          </div>
          <p>강의</p>
        </div>
        <div class="my_lec_graph">
          <div>
            <p>1/3</p>
          </div>
          <p>퀴즈</p>
        </div>
        <div class="my_lec_graph">
          <div>
            <p>1/1</p>
          </div>
          <p>시험</p>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-success">
    <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/mypage/mypage_copy.php">Copy</a>
    <p>안녕하세요 팀원님!</p>
    <p>혹시 마이 페이지 복사하러 오셨나요?</p>
    <p>위쪽 Copy를 누르시면 mypage_copy로 이동합니다</p>
    <p>해당 페이지의 내용을 확인하시고 진행하세용!</p>
  </div>





</div>
</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>