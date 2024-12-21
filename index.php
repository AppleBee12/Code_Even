<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');
$main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/main.js\"></script>";

/* lecture_section 시작 */

$leid = $_GET['leid'] ?? null;

// isbest = 1
$sql_best = "SELECT * FROM lecture 
  WHERE isbest = 1 
  ORDER BY leid DESC 
  LIMIT 8
";
$result_best = $mysqli->query($sql_best);
$best_lectures = [];
if ($result_best && $result_best->num_rows > 0) {
  while ($row = $result_best->fetch_object()) {
    $best_lectures[] = $row;
  }
}

// isnew = 1
$sql_new = "SELECT * FROM lecture
  WHERE isnew = 1
  ORDER BY leid DESC
  LIMIT 8
";
$result_new = $mysqli->query($sql_new);
$new_lectures = [];
if ($result_new && $result_new->num_rows > 0) {
  while ($row = $result_new->fetch_object()) {
    $new_lectures[] = $row;
  }
}

// course_type = 'recipe'
  $sql_recipe = "SELECT * FROM lecture
  WHERE course_type = 'recipe'
  ORDER BY leid DESC
  LIMIT 6
";
$result_recipe = $mysqli->query($sql_recipe);
$recipe_lectures = [];
if ($result_recipe && $result_recipe->num_rows > 0) {
  while ($row = $result_recipe->fetch_object()) {
    $recipe_lectures[] = $row;
  }
}

/* lecture_section 끝 */

/* teacher_section 시작 */
$tc_sql = "SELECT * FROM teachers WHERE isrecom = 1 ORDER BY RAND() LIMIT 3;";
$tc_result = $mysqli->query($tc_sql); 

$tc_dataArr = [];
if ($tc_result && $tc_result->num_rows > 0) {
  while ($data = $tc_result->fetch_object()) {
    $tc_dataArr[] = $data;
  }
}
/* teacher_section 끝 */

?>
<style>
.cookie_underline a:hover{
  text-decoration : underline;
  font-weight: 600;
}
</style>

<!-- 쿠키 모달 창 -->
<div id="cookieModal" class="cookie-modal ">
  <div class="cookie-modal-content ">
    <h4 class="d-flex justify-content-center mb-3">CODE EVEN | 프론트 페이지</h4>
    <p>본 웹사이트는 구직용 포트폴리오 웹사이트이며, <br>
      실제로 운영되는 사이트가 아닙니다.</p>
    <hr>
    <div class="text-start">
      <div>
        <span><b>팀원 : </b>홍수진(팀장), 배유나, 조채림, 최은화, 홍은진</span><br>
        <span><b>제작기간</b> : 2024.11.24 - 2024.12.23 </span><br>
        <span><b>개발환경</b> : HTML/CSS, Javascript, PHP</span><br>
        <div class="link3">
          <span><b>기획자료 :</b> <a href="https://www.figma.com/deck/MQfJi66QGjjvn4nzpNfIQz/CODE_EVEN_LMS%EA%B5%AC%ED%98%84%EB%B0%9C%ED%91%9C-%EC%B5%9C%EC%A2%85?node-id=1-466&node-type=slide&viewport=-123%2C-137%2C0.7&t=QMdQYEzDrnraOO0y-1&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1" target="_blank">figma</a>
            <b> 코드 :</b> <a href="https://github.com/AppleBee12/Code_Even.git" target="_blank">github</a>
            <b> 관리자 페이지 :</b> <a href="http://localhost/code_even/admin/index.php" target="_blank">Admin Page</a></p>
        </div>
      </div>
      <hr>
      <div>
        <span><b>업무분장</b></span>
        <p><b>기획 : </b>팀원 전체 <b>디자인 : </b>구현 담당자</p>
      </div>
      <hr>
      <div class="link3 cookie_underline">
        <span><b>* 구현 완료 페이지 *</b></span><br>
        <span><b>홍수진 : </b>
          <a href="#">메인 대시보드, </a> 
          <a href="front/what_recipe/what_recipe.php">레시피강좌란, </a>
          <a href="front/community/teamproject.php">커뮤니티, </a>
          <a href="#">마이페이지, </a><br>
          <a href="front/mypage/mypage_lecture.php">진행/종료강좌, </a>
          <a href="front/mypage/mypage_lecture.php">내가 쓴 글/댓글 </a>
        </span><br>
        <span><b>배유나 : </b>
          <a href="front/service/faq.php">고객센터, </a>
          <a href="front/mypage/mypage_qna.php">내 문의글/답변, </a>
          <a href="front/mypage/mypage_reivew.php">내 강의후기 </a>
        </span><br>
        <span><b>조채림 : </b>
          <a href="#">로그인, </a>
          <a href="front/signup/signup.php">회원가입, </a>
          <a href="front/signup/tc_applyform.php">강사등록, </a>
          <a href="front/mypage/mypage_coupons.php">보유쿠폰 </a>
          <a href="front/mypage/mypage_info_edit.php">기본정보수정 </a>
        </span><br>
        <span><b>최은화 : </b>
          <a href="front/lecture_list.php">강좌관리</a>
          <a href="#">강의/퀴즈시험</a>
        </span><br>
        <span><b>홍은진 : </b>
          <a href="front/cart.php">장바구니, </a>
          <a href="#">최근 본 상품, </a>
          <a href="#">결제내역, </a>
          <a href="#">찜한강좌 </a>
        </span><br>
      </div>
      <hr>
      <div>
        <span><b>학생용 아이디 </b>: even_student</span><br>
        <span><b>학생용 비밀번호 </b>: 12345</span>
      </div>
    </div>
    <hr>
    <p class="link3"><a href="http://localhost/code_even/admin/login/login.php">어드민(관리자&강사)페이지 바로가기</a></p>
    <hr>
    <div class="d-flex justify-content-start gap-2 mb-3">
      <label class="align-items-end cookie_btn td_hidden" for="check">오늘 하루 안보기</label>
      <input type="checkbox" id="check">
    </div>
    <button id="cookieCloseBtn" type="button" class="close_txt alarm">
      <img src="admin/images/sb_logo.png" width="50" height="30" alt="코드이븐로고">
      close
    </button>
  </div>
</div>

<section class="sec01">
  <div>
    <div class="swiper sec01_swiper">
      <ul class="swiper-wrapper">
        <li class="swiper-slide">
          <div class="sec01_banner sec01_banner01">
            <div class="sec01_textwrapper">
              <p class="headt5">EVENT</p>
              <p class="headt3">비슷한 부분을 자꾸 잊는다면?</p>
              <p class="headt3">코드이븐 레시피 강좌를 만날 때!</p>
            </div>
            <img src="front/images/sec01_banner01.png" alt="">
          </div>
        </li>
        <li class="swiper-slide">
          <div class="sec01_banner sec01_banner02">
            <div class="sec01_textwrapper">
              <p class="headt5">2024.12.01 - 12.31</p>
              <p class="headt3">크리스마스 특별 50% 쿠폰 증정!</p>
              <p class="headt3">추운 날 따뜻한 쿠폰 받아가세요</p>
            </div>
            <img src="front/images/sec01_banner02.png" alt="">
          </div>
        </li>
        <li class="swiper-slide">
          <div class="sec01_banner sec01_banner03">
            <div class="sec01_textwrapper">
              <p class="headt5">OPEN</p>
              <p class="headt3">HTML의 정석</p>
              <p class="headt3">개발자를 위한 HTML강의</p>
            </div>
            <img src="front/images/sec01_banner03.png" alt="">
          </div>
        </li>
        <li class="swiper-slide">
          <div class="sec01_banner sec01_banner04">
            <div class="sec01_textwrapper">
              <p class="headt5">BEST</p>
              <p class="headt3">이달의 베스트 선생님</p>
              <p class="headt3">웹코딩의 절대강자 김동주</p>
            </div>
            <img src="front/images/sec01_banner04.png" alt="">
          </div>
        </li>
      </ul>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
      <div class="autoplay-progress">
        <svg viewBox="0 0 48 48">
          <circle cx="24" cy="24" r="20"></circle>
        </svg>
        <span></span>
      </div>
    </div>
  </div>
</section>
<section class="sec02 container d-flex align-items-center justify-content-center">
  <ul class="images_wh">
    <li>
      <div>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/lecture_list.php?category=B0001"><img src="front/images/frontend.png" alt="프론트엔드">
          <div class="headt5 mb-2">프론트엔드</div>
          <div>프론트엔드 개발자를 위한, <br> 실전 웹 성능 최적화 <br>(feat. React)</div>
        </a>
      </div>
    </li>
    <li>
      <div>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/lecture_list.php?category=B0002"><img src="front/images/backend.png" alt="백엔드">
          <div class="headt5 mb-2">백엔드</div>
          <div>탄탄한 백엔드 NestJS,  <br>기초부터 심화까지</div>
        </a>
      </div>
    </li>
    <li>
      <div>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/lecture_list.php?category=B0003"><img src="front/images/cloud.png" alt="클라우드/DB">
          <div class="headt5 mb-2">클라우드/DB</div>
          <div>스스로 구축하는 <br>AWS 클라우드 <br>  인프라 </div>
        </a>
      </div>
    </li>
    <li>
      <div>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/lecture_list.php?category=B0004"><img src="front/images/database.png" alt="데이터베이스">
          <div class="headt5 mb-2">데이터베이스</div>
          <div>초보자를 위한 쉬운 파이썬 <br> 기초와 데이터 분석</div>
        </a>
      </div>
    </li>
    <li>
      <div>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/lecture_list.php?category=B0005"><img src="front/images/network.png" alt="네트워크 관리">
          <div class="headt5 mb-2">네트워크 관리</div>
          <div>실습으로 배우는  <br> 핵심 네트워크 기술</div>
        </a>
      </div>
    </li>
    <li>
      <div>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/lecture_list.php?category=B0001"><img src="front/images/security.png" alt="보안">
          <div class="headt5 mb-2">보안</div>
          <div>기초부터 따라하는  <br> 디지털포렌식</div>
        </a>
      </div>
    </li>
  </ul>
</section>
<section class="sec03 container">
  <div class="best_title">
    <h2 class="headt4">베스트 추천 강좌</h2>
  </div>
  <div class="row">
    <?php
    if (isset($best_lectures) && !empty($best_lectures)) { // BEST 강좌 배열
      foreach ($best_lectures as $item) {
        ?>
        <div class="lecture_box col-3 mb-3">
          <!-- 링크 전체를 감싸도록 설정 -->
          <a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/lecture_view.php?leid=<?= $item->leid; ?>" class="d-block">
            <div class="image_box mb-2">
              <img src="<?= htmlspecialchars($item->image); ?>" alt="강좌 이미지" class="img-fluid" />
            </div>
            <div class="d-flex justify-content-between">
              <div>
                <?php if ($item->isbest == 1) { ?>
                  <span class="badge badge-outline">BEST</span>
                <?php } ?>
                <?php if ($item->isnew == 1) { ?>
                  <span class="badge badge-outline">NEW</span>
                <?php } ?>
                <?php 
                if ($item->course_type === 'recipe') { ?>
                  <span class="badge text-bg-danger">레시피</span>
                <?php } elseif ($item->course_type !== 'general') { ?>
                  <span class="badge text-bg-danger"><?= htmlspecialchars($item->course_type); ?></span>
                <?php } ?>
              </div>
              <div class="d-flex gap-2">
                <i class="bi bi-star-fill"></i>
                <span>5.0</span>
              </div>
            </div>
            <div>
              <p><?= htmlspecialchars($item->title); ?></p>
            </div>
            <div>
              <p class="tc_name"><?= htmlspecialchars($item->name); ?></p>
            </div>
          </a>
          <div class="d-flex justify-content-between">
            <div>
              <b><?= number_format($item->price); ?></b>원
            </div>       
            <div class="icon-container">
              <i class="bi bi-heart heart-icon" id="heart-icon"></i>
              <i class="bi bi-heart-fill heart-icon-filled d-none" id="heart-icon-filled"></i>
              <i class="bi bi-cart-plus"></i>
            </div>
          </div>
        </div>
        <?php
      }
    } else {
        echo "<p>베스트 추천 강좌가 없습니다.</p>";
    }
    ?>
  </div>
</section>
<section class="sec04 container">
  <div class="recipe_title">
    <h2 class="headt4">지금 가장 인기있는 레시피</h2>
  </div>
  <div class="row">
    <?php
    if (isset($recipe_lectures) && !empty($recipe_lectures)) { // BEST 강좌 배열
      foreach ($recipe_lectures as $item) {
        ?>
        <div class="lecture_box col-4 mb-3"> <!-- 한 줄에 4개 출력 -->
          <!-- 링크를 강좌 정보까지 감싸기 -->
          <a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/lecture_view.php?leid=<?= urlencode($item->leid); ?>" class="d-block text-decoration-none">
            <div class="image_box mb-2">
              <img src="<?= htmlspecialchars($item->image); ?>" alt="강좌 이미지" class="img-fluid" />
            </div>
            <div class="d-flex justify-content-between">
              <div>
                <?php if ($item->isbest == 1) { ?>
                  <span class="badge badge-outline">BEST</span>
                <?php } ?>
                <?php if ($item->isnew == 1) { ?>
                  <span class="badge badge-outline">NEW</span>
                <?php } ?>
                <?php 
                // course_type이 recipe일 경우 '레시피'로 표시
                if ($item->course_type === 'recipe') { ?>
                  <span class="badge text-bg-danger">레시피</span>
                <?php 
                // course_type이 general이 아닌 경우만 출력
                } elseif ($item->course_type !== 'general') { ?>
                  <span class="badge text-bg-danger"><?= htmlspecialchars($item->course_type); ?></span>
                <?php } ?>
              </div>
              <div class="d-flex gap-2">
                <i class="bi bi-star-fill"></i>
                <span>5.0</span>
              </div>
            </div>
            <div>
              <p><?= htmlspecialchars($item->title); ?></p>
            </div>
            <div>
              <p class="tc_name"><?= htmlspecialchars($item->name); ?></p>
            </div>
          </a> <!-- 링크 닫힘 -->

          <!-- 가격 및 아이콘 부분은 링크 밖에 위치 -->
          <div class="d-flex justify-content-between">
            <div>
              <b><?= number_format($item->price); ?></b>원
            </div>
            <div class="icon-container">
              <i class="bi bi-heart heart-icon" id="heart-icon"></i>
              <i class="bi bi-heart-fill heart-icon-filled d-none" id="heart-icon-filled"></i>
              <i class="bi bi-cart-plus"></i>
            </div>
          </div>
        </div>
        <?php
      }
    } else {
        echo "<p>레시피 강좌가 없습니다.</p>";
    }
    ?>
  </div>
</section>
<section class="sec05">
  <div class="container d-flex">
    <div class="reviewContent">
      <h3 class="headt3 reviewTitle">수강생들의 이야기,
      코드이븐에서 확인해보세요!</h3>
    </div>
    <div class="swiper sec05_swiper">
      <ul class="swiper-wrapper">
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">HTML/CSS : 기초부터 실전까지 올인원</p>
                <div class="box">
                  <span class="review_bk">김태희</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">웹 페이지의 구조를 더욱 깔끔하게 만들 수 있을 것 같습니다.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!...</p>
                <div class="box">
                  <span class="review_bk">이세훈</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">이해도가 높아졌습니다.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">HTML/CSS : 기초부터 실전까지 올인원</p>
                <div class="box">
                  <span class="review_bk">조윤호</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk"> 다양한 레이아웃을 만드는 데 자신감을 얻었습니다.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!...</p>
                <div class="box">
                  <span class="review_bk">최하늘</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-empty"></i>
              </span>
            </div>
            <p class="review_bk">당장 웹 페이지를 개선할 수 있을 것 같아요.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">HTML/CSS : 기초부터 실전까지 올인원</p>
                <div class="box">
                  <span class="review_bk">서영준</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">실제 프로젝트에서 바로 적용할 수 있을 것 같습니다.</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>
<section class="sec06 container">
  <h2 class="headt4">이달의 BEST 강사</h2>
  <div class="row">
  <?php
    if(isset($tc_dataArr)){
      foreach($tc_dataArr as $item){
  ?> 
    <div class="col-4">
      <a href="#" class="card">
        <span class="badge eng">Best Teacher</span>
        <img src="<?= $item->tc_thumbnail; ?>" class="card-img-top" alt="<?= $item->tc_name; ?>">
        <div class="card-body">
          <p class="card-text tc_desc"><?= $item->tc_main_intro; ?></p>
          <p class="card-text tc_tit">
                <?= $item->tc_name; ?> | 
                <?php
                if ($item->tc_cate == 1) {
                  echo "웹개발";
                } elseif ($item->tc_cate == 2) {
                  echo "클라우드·DB";
                } elseif ($item->tc_cate == 3) {
                  echo "보안·네트워크";
                } else {
                  echo "기타";
                }
                ?>
              </p>
        </div>
      </a>
    </div>
  <?php
      }
    }
  ?>
  </div>
</section>
<section class="sec07">
  <div class="container">
    <div class=" d-flex justify-content-between sec_height align-items-center row">
      <div class="col-6">
        <div class="">
          <div class="headt3">현직자 리드멘토가 되어주세요!</div>
          <div class="headt5">여러분들만의 지식과 배움을 공유하고 <br>
          코드이븐의 꿈나무들에게 미래를 응원해주세요!</div>
        </div>  
        <div class="tc_borderline_banner mt-5">
          <a href="front/signup/tc_applyform.php">강사 신청하러 가기</a>
        </div>
      </div>
      <div class="logo_img d-flex align-items-center col-6 justify-content-end">
        <div class="headt3 text_shadow">CODE EVEN</div>
        <img src="front/images/superhero.png" alt="">
      </div>
    </div>
  </div>
</section>
<section class="sec08 container">
  <div class="new_title">
    <h2 class="headt4">최신 강좌</h2>
  </div>
  <div class="row">
    <?php
    if (isset($new_lectures) && !empty($new_lectures)) { // NEW 강좌 배열
      foreach ($new_lectures as $item) {
        ?>
        <div class="lecture_box col-3 mb-3"> <!-- 한 줄에 4개 출력 -->
          <!-- 강좌 정보 부분을 감싸는 링크 -->
          <a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/lecture_view.php?leid=<?= urlencode($item->leid); ?>" class="d-block text-decoration-none">
            <div class="image_box mb-2">
              <img src="<?= htmlspecialchars($item->image); ?>" alt="강좌 이미지" class="img-fluid" />
            </div>
            <div class="d-flex justify-content-between">
              <div>
                <?php if ($item->isbest == 1) { ?>
                  <span class="badge badge-outline">BEST</span>
                <?php } ?>

                <?php if ($item->isnew == 1) { ?>
                  <span class="badge badge-outline">NEW</span>
                <?php } ?>
                <?php 
                // course_type이 recipe일 경우 '레시피'로 표시
                if ($item->course_type === 'recipe') { ?>
                  <span class="badge text-bg-danger">레시피</span>
                <?php 
                // course_type이 general이 아닌 경우만 출력
                } elseif ($item->course_type !== 'general') { ?>
                  <span class="badge text-bg-danger"><?= htmlspecialchars($item->course_type); ?></span>
                <?php } ?>
              </div>
              <div class="d-flex gap-2">
                <i class="bi bi-star-fill"></i>
                <span>5.0</span>
              </div>
            </div>
            <div>
              <p><?= htmlspecialchars($item->title); ?></p>
            </div>
            <div>
              <p class="tc_name"><?= htmlspecialchars($item->name); ?></p>
            </div>
          </a> <!-- 링크 종료 -->

          <!-- 가격 및 아이콘 부분 -->
          <div class="d-flex justify-content-between">
            <div>
              <b><?= number_format($item->price); ?></b>원
            </div>       
            <div class="icon-container">
              <i class="bi bi-heart heart-icon" id="heart-icon"></i>
              <i class="bi bi-heart-fill heart-icon-filled d-none" id="heart-icon-filled"></i>
              <i class="bi bi-cart-plus"></i>
            </div>
          </div>
        </div>
        <?php
      }
    } else {
        echo "<p>새로운 강좌가 없습니다.</p>";
    }
    ?>
  </div>
</section>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>