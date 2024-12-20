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
            <div class="my_lec_desc">
              <div class="d-flex justify-content-between">
                <div class="my_lec_txt">
                  <ul class="d-flex flex-column gap-2">
                    <li class="d-flex gap-5">
                      <p class="my_lec_title">강좌기간</p>
                      <p>30일(2024-11-30 ~ 2024-01-04)</p>
                    </li>
                    <li class="d-flex gap-5 align-items-center">
                      <p class="my_lec_title">진도율</p>

                      <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" style="width: 33%">33%</div>
                      </div>
                    </li>
                    <li class="d-flex gap-5">
                      <p class="my_lec_title">평균 점수</p>
                      <p>90점</p>
                    </li>
                  </ul>
                  <div class="my_lec_btn d-flex mt-3 gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#howToGetCertificate">
                      수료기준
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="howToGetCertificate" tabindex="-1" aria-labelledby="howToGetCertificateLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="howToGetCertificateLabel">수료기준</h1>
                          </div>
                          <div class="modal-body">
                          <p>강좌 진도율: 총 <span>80%</span> 이상</p>
                          <p>평균 점수: 총 <span>80점</span> 이상</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-outline-dark btn-sm printButton">이수증</button>
                  </div>
                </div>
                <div class="my_lec_graph_wrapper d-flex">
                  <div class="my_lec_graph d-flex flex-column align-items-center">
                    <div class="donut-chart" style="--percentage: 33.3%;">
                      <div class="percentage-label">33.3%</div>
                    </div>
                    <p>강의</p>
                  </div>
                  <div class="my_lec_graph d-flex flex-column align-items-center">
                    <div class="donut-chart" style="--percentage: 33.3%;">
                      <div class="percentage-label">33.3%</div>
                    </div>
                    <p>퀴즈</p>
                  </div>
                  <div class="my_lec_graph d-flex flex-column align-items-center">
                    <div class="donut-chart" style="--percentage: 0%;">
                      <div class="percentage-label">0%</div>
                    </div>
                    <p>시험</p>
                  </div>
                </div>         
              </div>
              <div>
                <hr>
                <div class="d-flex flex-column">
                  <!-- 여기부터 1강 -->
                  <div class="lecture_one d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-3 lecture_title">
                      <p>1강</p>
                      <p>제목이 나옵니다 기이이이일수도 있어요</p>
                    </div>
                    <div class="score_wrapper d-flex gap-3">
                      <div class="d-flex gap-2">
                        <p class="weight">퀴즈 점수</p>
                        <p><span>100</span>점</p>
                      </div>
                      <div class="d-flex gap-2">
                        <p class="weight">시험 점수</p>
                        <p><span>100</span>점</p>
                      </div>
                      <div class="d-flex gap-2">
                        <p class="weight">진행 여부</p>
                        <p><span>100</span>점</p>
                      </div>
                    </div>
                    <div>
                      <button class="btn btn-secondary">강의보러가기</button>
                    </div>
                  </div><!--1강 끝 -->
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
      
        <div class="my_end_lecture">
            <div class="my_lec_top d-flex">
              <img src="https://picsum.photos/180/180" alt="">
              <div class="d-flex flex-column justify-content-evenly">
                <p class="headt5">상단 메뉴부터 사이드메뉴까지 메뉴의 모든 것, 최종 끝판왕</p>
                <p><b>이븐 선생님</b> | <span>레시피강좌</span></p>
              </div>
            </div>
            <div class="my_lec_desc">
              <div class="d-flex justify-content-between">
                <div class="my_lec_txt">
                  <ul class="d-flex flex-column gap-2">
                    <li class="d-flex gap-5">
                      <p class="my_lec_title">강좌기간</p>
                      <p>30일(2024-11-30 ~ 2024-01-04)</p>
                    </li>
                    <li class="d-flex gap-5 align-items-center">
                      <p class="my_lec_title">진도율</p>

                      <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" style="width: 33%">33%</div>
                      </div>
                    </li>
                    <li class="d-flex gap-5">
                      <p class="my_lec_title">평균 점수</p>
                      <p>90점</p>
                    </li>
                  </ul>
                  <div class="my_lec_btn d-flex mt-3 gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#howToGetCertificate">
                      수료기준
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="howToGetCertificate" tabindex="-1" aria-labelledby="howToGetCertificateLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="howToGetCertificateLabel">수료기준</h1>
                          </div>
                          <div class="modal-body">
                          <p>강좌 진도율: 총 <span>80%</span> 이상</p>
                          <p>평균 점수: 총 <span>80점</span> 이상</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-outline-dark btn-sm">수료증</button>
                  </div>
                </div>
                <div class="my_lec_graph_wrapper d-flex">
                  <div class="my_lec_graph d-flex flex-column align-items-center">
                    <div class="donut-chart" style="--percentage: 33.3%;">
                      <div class="percentage-label">33.3%</div>
                    </div>
                    <p>강의</p>
                  </div>
                  <div class="my_lec_graph d-flex flex-column align-items-center">
                    <div class="donut-chart" style="--percentage: 33.3%;">
                      <div class="percentage-label">33.3%</div>
                    </div>
                    <p>퀴즈</p>
                  </div>
                  <div class="my_lec_graph d-flex flex-column align-items-center">
                    <div class="donut-chart" style="--percentage: 0%;">
                      <div class="percentage-label">0%</div>
                    </div>
                    <p>시험</p>
                  </div>
                </div>         
              </div>
              <div>
                <hr>
                <div class="d-flex flex-column">
                  <!-- 여기부터 1강 -->
                  <div class="lecture_one d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-3 lecture_title">
                      <p>1강</p>
                      <p>제목이 나옵니다 기이이이일수도 있어요</p>
                    </div>
                    <div class="score_wrapper d-flex gap-3">
                      <div class="d-flex gap-2">
                        <p class="weight">퀴즈 점수</p>
                        <p><span>100</span>점</p>
                      </div>
                      <div class="d-flex gap-2">
                        <p class="weight">시험 점수</p>
                        <p><span>100</span>점</p>
                      </div>
                      <div class="d-flex gap-2">
                        <p class="weight">진행 여부</p>
                        <p><span>100</span>점</p>
                      </div>
                    </div>
                    <div>
                      <button class="btn btn-secondary">강의보러가기</button>
                    </div>
                  </div><!--1강 끝 -->
                </div>
              </div>  
            </div>
        



        </div>
      </div><!-- 탭메뉴2 끝-->
    </div>
</div>
</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>

<script>
    // 도넛 차트를 업데이트하는 함수
    function updateDonut(percentage) {
      const donutChart = document.querySelector('.donut-chart');
      const label = donutChart.querySelector('.percentage-label');
      donutChart.style.setProperty('--percentage', `${percentage}%`);
      label.textContent = `${percentage}%`;
     }

    // // 슬라이더 값 변경 시 업데이트
    // const progressInput = document.getElementById('progress');
    // progressInput.addEventListener('input', (e) => {
    //   const percentage = e.target.value;
    //   updateDonut(percentage);
    // });


    /* 이수증 버튼 함수 */
    function printPage() {
    const fileUrl = "../../images/certificate_of_completion.pdf";

    // PDF를 iframe으로 페이지에 삽입
    const iframe = document.createElement("iframe");
    iframe.style.position = "absolute";
    iframe.style.width = "0px";
    iframe.style.height = "0px";
    iframe.style.border = "none";
    iframe.src = fileUrl;

    // iframe을 body에 추가
    document.body.appendChild(iframe);

    // PDF 파일이 로드된 후 인쇄
    iframe.onload = function () {
      iframe.contentWindow.print();  // iframe 내에서 print() 호출
    };
  }

  const button = document.querySelector(".printButton");
  if (button) {
    button.addEventListener("click", printPage);
  }
  </script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>