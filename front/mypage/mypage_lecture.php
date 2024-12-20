<?php
$title = '마이페이지-강좌보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/mypage_cmain.js\"></script>";
?>
<!--탭 메뉴 시작-->
<nav>
  <div class="mypage_tap_wrapper nav nav-underline headt6" id="nav-tab" role="tablist">
    <button class="mypage_tap nav-link active" id="nav-myLecTab1-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab1"  role="tab" aria-controls="nav-myLecTab1" aria-selected="true">진행강좌</button>
    <button class="mypage_tap nav-link" id="nav-myLecTab2-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab2"  role="tab" aria-controls="nav-myLecTab2" aria-selected="false">종료 강좌</button>
  </div>
</nav>
<!--탭 메뉴 끝-->
    <div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
      <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
        <div class="my_lecture_wrapper"><!-- 탭메뉴1내용 -->
          <div class="my_lecture">
            <div class="my_lec_top d-flex">
              <img src="https://picsum.photos/180/180" alt="">
              <div class="d-flex flex-column justify-content-evenly">
                <p class="headt5">상단 메뉴부터 사이드메뉴까지 메뉴의 모든 것, 최종 끝판왕</p>
                <p><b>이븐 선생님</b> | <span>레시피강좌</span></p>
              </div>
            </div>
            <div>
              <div class="my_lec_desc">
                <ul>
                  <li class="d-flex gap-5">
                    <p>강좌기간</p>
                    <p>30일(2024-11-30 ~ 2024-01-04)</p>
                  </li>
                  <li class="d-flex gap-5">
                    <p>진도율</p>
                    <p>33%</p>
                  </li>
                  <li class="d-flex gap-5">
                    <p>평균 점수</p>
                    <p>90점</p>
                  </li>
                </ul>
                <div class="my_lec_btn d-flex">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#howToGetCertificate">
                    수료기준
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="howToGetCertificate" tabindex="-1" aria-labelledby="howToGetCertificateLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="howToGetCertificateLabel">수료기준</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <p>강좌 진도율: 총 <span>80%</span> 이상</p>
                        <p>평균 점수: 총 <span>80점</span> 이상</p>
                        </div>
                      </div>
                    </div>
                  </div>
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

          <!-- <div class="bg-success">
            <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/mypage/mypage_copy.php">Copy</a>
            <p>안녕하세요 팀원님!</p>
            <p>혹시 마이 페이지 복사하러 오셨나요?</p>
            <p>위쪽 Copy를 누르시면 mypage_copy로 이동합니다</p>
            <p>해당 페이지의 내용을 확인하시고 진행하세용!</p>
          </div> -->
        </div><!-- 탭메뉴1내용 끝-->
      </div><!-- 탭메뉴1 끝 -->
      <div class="tab-pane fade" id="nav-myLecTab2" role="tabpanel" aria-labelledby="nav-myLecTab2-tab"><!-- 탭메뉴2 -->
        <div>탭 메뉴 2의 내용이 들어갈 자리입니다~~</div>
      </div><!-- 탭메뉴2 끝-->
    </div>
</div>
</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>