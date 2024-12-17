<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

/* lecture, book Start */
$leid = isset($_GET['leid']) ? (int) $_GET['leid'] : 0;

// 강좌 book 이미지 정보 조회
$lecture_sql = "
    SELECT l.*, b.image AS book_image 
    FROM lecture l
    LEFT JOIN book b ON l.boid = b.boid
    WHERE l.leid = $leid
";

$lecture_result = $mysqli->query($lecture_sql);

if ($lecture_result && $lecture_result->num_rows > 0) {
    $lecture = $lecture_result->fetch_object();
} else {
    die("강좌 정보를 가져올 수 없습니다.");
}


// 강의 상세 정보 조회
$lecture_detail_sql = "
        SELECT * 
        FROM lecture_detail 
        WHERE lecture_id = $leid 
        ORDER BY CAST(video_order AS UNSIGNED) ASC";

$lecture_detail_result = $mysqli->query($lecture_detail_sql);

// YouTube API 키 설정
$apiKey = "AIzaSyC4aAKg0v67EziZJWlShXRlqsg7zKCPUVg";

// 유튜브 URL에서 Video ID 추출 함수
function getYouTubeVideoId($url)
{
  $videoId = null;
  $parsedUrl = parse_url($url);

  // 일반 URL 처리
  if (isset($parsedUrl['query'])) {
    parse_str($parsedUrl['query'], $query);
    if (isset($query['v'])) {
      $videoId = $query['v'];
    }
  }

  // 단축 URL 처리
  if (!$videoId && isset($parsedUrl['host']) && $parsedUrl['host'] === 'youtu.be') {
    $videoId = trim($parsedUrl['path'], '/');
  }

  return $videoId;
}

// 영상 길이 가져오는 함수 (cURL 사용)
function getYouTubeVideoDuration($videoId, $apiKey)
{
  $apiUrl = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id={$videoId}&key={$apiKey}";

  // cURL 초기화
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $apiUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);

  // HTTP 응답 코드 확인
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  if ($httpCode != 200) {
    return 0; // 실패 시 0초 반환
  }

  // 응답 처리
  $data = json_decode($response, true);
  if (!empty($data['items'][0]['contentDetails']['duration'])) {
    return durationToSeconds($data['items'][0]['contentDetails']['duration']);
  }
  return 0; // 실패 시 0초 반환
}

// ISO 8601 형식의 duration을 초 단위로 변환
function durationToSeconds($duration)
{
  $interval = new DateInterval($duration);
  return ($interval->h * 3600) + ($interval->i * 60) + $interval->s;
}

// 초 단위를 시:분:초로 변환
function secondsToHMS($seconds)
{
  $hours = floor($seconds / 3600);
  $minutes = floor(($seconds % 3600) / 60);
  $seconds = $seconds % 60;
  return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}

// 전체 강의 시간 계산
$totalSeconds = 0;

if ($lecture_detail_result && $lecture_detail_result->num_rows > 0) {
  // 루프를 돌며 총 시간 계산
  while ($lecture_detail = $lecture_detail_result->fetch_object()) {
    $videoId = getYouTubeVideoId($lecture_detail->video_url);
    $durationInSeconds = $videoId ? getYouTubeVideoDuration($videoId, $apiKey) : 0;
    $totalSeconds += $durationInSeconds;
  }
}

// 총 시간을 시:분:초로 변환
$totalTimeFormatted = secondsToHMS($totalSeconds);

/* lecture, book End */

?>

<div class="container">
  <div class="row img_info align-items-start">
    <div class="col-9 view_imgBox">
      <img src="<?= $lecture->image; ?>" alt="강좌 이미지">
    </div>
    <div class="con_border col-3 p-4">
      <h4 class="mb-2 lecture_tt"><?= $lecture->title; ?></h4>
      <p class="fs-5 fw-bold"><?= number_format($lecture->price); ?>원</p>
      <hr>
      <ul>
        <li>
          <div class=" d-flex gap-2 mb-2">
            <i class="bi bi-play-circle"></i>
            <p>VOD / 총 <?= $lecture_detail_result->num_rows; ?>강 / <?= $totalTimeFormatted; ?></p>
          </div>
        </li>
        <li>
          <div class=" d-flex gap-2 mb-2">
            <i class="bi bi-calendar"></i>
            <p><?= htmlspecialchars($lecture->period); ?>일 수강 가능</p>
          </div>
        </li>
        <li>
          <div class=" d-flex gap-2">
            <i class="bi bi-archive"></i>
            <p>강의 자료 있음</p>
          </div>
        </li>
      </ul>
      <hr>
      <p class="mt-4 fw-semibold mb-2">[교재] 목요일 TOO MUCH 친절한 HTML+CSS+자바...</p>
      <div class="d-flex justify-content-between">
        <p class="fs-5 fw-bold mb-3">28,800 원</p>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            <p>교재 함께 구매</p>
          </label>
        </div>
      </div>
      <hr>
      <div class="row gx-2 align-items-center mt-3">
        <!-- 장바구니 버튼 -->
        <div class="col-2">
          <button class="btn btn-light w-100">
            <i class="bi bi-cart"></i>
          </button>
        </div>
        <!-- 바로 결제하기 버튼 -->
        <div class="col-10">
          <button class="btn btn-outline-light w-100">
            바로 결제하기
          </button>
        </div>
      </div>
      <div class="row gx-2 mt-2 info_bottom">
        <!-- 찜하기 버튼 -->
        <div class="col-6">
          <button class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-heart"></i>
            <span>찜하기</span>
          </button>
        </div>
        <!-- 공유하기 버튼 -->
        <div class="col-6">
          <button class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-share"></i>
            <span>공유하기</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="row tab-menu text-center">
    <div class="col">
      <a href="#section-intro" class="tab-link active">강좌 소개</a>
    </div>
    <div class="col">
      <a href="#section-book" class="tab-link">교재 소개</a>
    </div>
    <div class="col">
      <a href="#section-teacher" class="tab-link">강사 소개</a>
    </div>
    <div class="col">
      <a href="#section-lecture" class="tab-link">강의</a>
    </div>
    <div class="col">
      <a href="#section-review" class="tab-link">리뷰</a>
    </div>
    <!-- 언더라인 추가 -->
    <div class="tab-underline"></div>
  </div>

  <!-- 섹션 콘텐츠 -->
  <div class="container mt-5">
    <section id="section-intro">
      <!-- 은화 -->
      <h2 class="mb-5">강좌 소개</h2>
      <p><?= $lecture->des; ?></p>
    </section>
    <section id="section-book">
      <h2 class="mb-5">교재 소개</h2>
      <div class="col-9 view_bookImg mb-3">
        <img src="<?php echo htmlspecialchars($lecture->book_image); ?>" alt="교재 이미지">
      </div>
      <p>교재 설명이 여기 나옵니다다</p>
    </section>
    <!-- // 은화 -->
    <!-- 은진 -->
    <section id="section-teacher">
      <h2 class="mb-5">강사 소개</h2>
      <p>강사에 대한 소개 내용을 여기에 넣습니다.</p>
    </section>
    <!-- // 은진 -->
    <!-- 은화 -->
    <section id="section-lecture">
      <h2 class="mb-5">강의</h2>
      <div class="lecture-container">
        <!-- 헤더 -->
        <div class="lecture-header"><?php echo htmlspecialchars($lecture->title ?? '강의 제목 없음'); ?></div>

        <?php
        // 강의 상세 리스트 출력
        if ($lecture_detail_result && $lecture_detail_result->num_rows > 0):
          $lecture_detail_result->data_seek(0); // 결과 포인터 초기화
          while ($lecture_detail = $lecture_detail_result->fetch_object()):
            $videoId = getYouTubeVideoId($lecture_detail->video_url);
            $duration = $videoId ? secondsToHMS(getYouTubeVideoDuration($videoId, $apiKey)) : "00:00:00";
            ?>
            <div class="lecture-item">
              <div>
                <i class="bi bi-play-circle"></i>
                <span><?= htmlspecialchars($lecture_detail->video_order); ?>강.
                  <?= htmlspecialchars($lecture_detail->title ?? "강의 제목 없음"); ?>
                </span>
              </div>
              <div>
                <i class="bi bi-alarm"></i>
                <span class="time"><?= $duration; ?></span>
              </div>
            </div>
            <?php
          endwhile;
        else:
          echo "<p>등록된 강의가 없습니다.</p>";
        endif;
        ?>
      </div>
    </section>
    <!-- // 은화 -->
    <!-- 유나 -->
    <section id="section-review">
      <h2 class="mb-5">수강평</h2>
      <p>수강평이 여기에 표시됩니다.</p>
    </section>
    <!-- // 유나 -->
  </div>
</div>
<script>

  /* 탭메뉴 언더라인 이동 */
  $(document).ready(function () {
    // 탭 클릭 이벤트
    $(".tab-link").on("click", function (e) {
      e.preventDefault();

      // 모든 탭에서 active 클래스 제거
      $(".tab-link").removeClass("active");

      // 클릭된 탭에 active 클래스 추가
      $(this).addClass("active");

      // 언더라인 이동
      const index = $(this).parent().index();
      const tabWidth = $(".tab-menu .col").outerWidth();
      $(".tab-underline").css("left", index * tabWidth + "px");

      // 해당 섹션으로 부드럽게 스크롤 이동
      const target = $(this).attr("href");
      $("html, body").animate(
        {
          scrollTop: $(target).offset().top - $(".tab-menu").outerHeight(), // 탭 메뉴 높이만큼 상단 여백 추가
        },
        500 // 부드러운 스크롤 애니메이션
      );
    });

    // 스크롤 이벤트: 탭이 상단에 고정된 상태 유지
    $(window).on("scroll", function () {
      const sections = $("section");
      let scrollTop = $(this).scrollTop();

      sections.each(function (index) {
        const sectionTop = $(this).offset().top - $(".tab-menu").outerHeight() - 50; // 상단 여백 추가
        const sectionBottom = sectionTop + $(this).outerHeight();

        if (scrollTop >= sectionTop && scrollTop < sectionBottom) {
          $(".tab-link").removeClass("active");
          $(".tab-link").eq(index).addClass("active");

          // 언더라인 이동
          const tabWidth = $(".tab-menu .col").outerWidth();
          $(".tab-underline").css("left", index * tabWidth + "px");
        }
      });
    });
  });




  $(document).ready(function () {
    $(".tab-link").on("click", function (e) {
      e.preventDefault(); // 기본 앵커 링크 동작 방지

      // 모든 탭에서 active 클래스 제거
      $(".tab-link").removeClass("active");

      // 클릭된 탭에 active 클래스 추가
      $(this).addClass("active");

      // 해당 섹션으로 부드럽게 스크롤 이동
      const target = $(this).attr("href");
      $("html, body").animate(
        {
          scrollTop: $(target).offset().top - 50, // 상단 여백 추가
        },
        500 // 애니메이션 시간 (밀리초 단위)
      );
    });
  });


</script>
<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');

?>