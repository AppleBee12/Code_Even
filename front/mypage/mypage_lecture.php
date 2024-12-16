<?php
$title = '마이페이지-강좌보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/mypage_cmain.js\"></script>";
?>
<!--탭 메뉴 시작-->
<div class="mypage_tap_wrapper nav nav-underline d-flex" id="nav-tab" role="tablist">
  <div class="mypage_tap active nav-item headt6">
    <a href="#myLecTab1" class="nav-link active" id="myLecTab1-tab" data-bs-toggle="tab" type="button" data-bs-target="#myLecTab1" role="tab" aria-controls="myLecTab1" aria-selected="true">진행 강좌</a>
  </div>
  <div class="mypage_tap headt6">
    <a href="#myLecTab2" class="nav-link" aria-current="page" id="myLecTab2-tab" data-bs-toggle="tab" data-bs-target="#myLecTab2" type="button" role="tab" aria-controls="myLecTab2" aria-selected="false">종료 강좌</a>
  </div>
</div>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
</div>



<!--탭 메뉴 끝-->
<div class="tab-content" id="nav-tabContent">
  <div id="myLecTab1 myLecNow" class="tab-pane fade show active" role="tabpanel" aria-labelledby="myLecTab1-tab">
    <div class="my_lecture_wrapper"><!-- 탭메뉴1 -->
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
  </div>
  <div id="myLecTab2 myLecFin" class="tab-pane fade" role="tabpanel" aria-labelledby="myLecTab2-tab"><!-- 탭메뉴2 -->
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
  </div>
</div>
</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>