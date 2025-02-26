<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

/* lecture, book Start */
$leid = isset($_GET['leid']) ? (int) $_GET['leid'] : 0;

// 강좌 book 이미지 정보 조회
$lecture_sql = "
    SELECT l.*,
           b.boid AS boid, 
           b.image AS book_image,
           b.des AS book_description,
           b.book AS book_title,
           b.price AS book_price
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

/* 강좌 찜하기 Start */

if (isset($_SESSION['UID'])) {
  $uid = (int)$_SESSION['UID'];
  $wishlist_sql = "SELECT leid FROM wishlist WHERE uid = $uid";
  $wishlist_result = $mysqli->query($wishlist_sql);
  $wishlist = [];

  if ($wishlist_result && $wishlist_result->num_rows > 0) {
      while ($row = $wishlist_result->fetch_assoc()) {
          $wishlist[] = (int)$row['leid'];
      }
  }
} else {
  $wishlist = [];
}

/* 강좌 찜하기 End */

/* teacher Start */
$tc_sql = "SELECT t.tc_intro, t.tc_thumbnail, t.tc_url
    FROM lecture l
    JOIN teachers t 
    ON l.lecid = t.uid
    WHERE l.leid = $leid
";

$tc_result = $mysqli->query($tc_sql);
$tc_data = $tc_result->fetch_object();


/* teacher End */



/* Review Start */

$review_sql = "SELECT review.*, class_data.*, lecture.leid 
              FROM review 
              JOIN class_data ON review.cdid = class_data.cdid
              JOIN lecture ON class_data.leid = lecture.leid 
              WHERE class_data.leid = $leid";
$review_result = $mysqli->query($review_sql);

$reviewArr = [];
while ($review = $review_result->fetch_object()) {
  $reviewArr[] = $review;

}

/* Review End */

?>

<div class="container">
  <div class="row img_info align-items-start">
    <div class="col-9 view_imgBox">
      <img src="<?= $lecture->image; ?>" alt="강좌 이미지">
    </div>
    <div class="con_border col-3 p-4">
      <form method="post" id="cartform">
        <h4 class="mb-2 lecture_tt"><?= $lecture->title; ?></h4>
        <p class="fs-5 fw-bold"><?= number_format($lecture->price); ?> 원</p>
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
        <?php
        if (!empty($lecture->book_title) && !empty($lecture->book_price)):
          ?>
              <p class="mt-4 fw-semibold mb-2">[교재] <?php echo htmlspecialchars($lecture->book_title); ?></p>
              <div class="d-flex justify-content-between">
                  <p class="fs-5 fw-bold mb-3"><?php echo number_format($lecture->book_price); ?> 원</p>
                  <div class="form-check">
                      <input class="form-check-input" 
                      type="checkbox" 
                      name="book_name"
                      id="book_<?= $lecture->boid; ?>" 
                      value="<?= $lecture->boid; ?>" 
                      data-price="<?= $lecture->book_price; ?>" 
                      >
                      <label class="form-check-label" for="book_<?= $lecture->boid; ?>">
                          <span>교재 함께 구매</span>
                      </label>
                  </div>
              </div>
              <hr>
        <?php
        endif;
        ?>
        <div class="row gx-2 align-items-center mt-3">
          <!-- 장바구니 버튼 -->
          <div class="col-12">
            <button type="submit" class="btn btn-light w-100">
              <i class="bi bi-cart"> 장바구니에 담기</i>
            </button>
          </div>
          <!-- 바로 결제하기 버튼 -->
          <div class="col-10 visually-hidden">
            <button type="button" class="btn btn-outline-light w-100">
              바로 결제하기
            </button>
          </div>
        </div>
        <div class="row gx-2 mt-2 info_bottom">
          <!-- 찜하기 버튼 -->
          <div class="col-6">
            <button type="button" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2 btn-like">
              <i class="bi bi-heart heart-icon <?= in_array($leid, $wishlist) ? 'd-none' : ''; ?>" data-leid="<?= $leid; ?>"></i>
              <!-- 채워진 하트 -->
              <i class="bi bi-heart-fill heart-icon-filled <?= in_array($leid, $wishlist) ? '' : 'd-none'; ?>" data-leid="<?= $leid; ?>"></i>
              <span>
                <?= in_array($leid, $wishlist) ? '찜한 강좌' : '찜하기'; ?>
              </span>
            </button>
          </div>
          <!-- 공유하기 버튼 -->
          <div class="col-6">
            <button type="button" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2">
              <i class="bi bi-share"></i>
              <span>공유하기</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="tab-menu d-flex justify-content-around <?php echo !empty($lecture->book_title) ? 'with-book' : 'no-book'; ?>">
    <div class="col">
        <a href="#section-intro" class="tab-link active">강좌 소개</a>
    </div>
    <?php if (!empty($lecture->book_title) && !empty($lecture->book_image)): ?>
      <div class="col">
          <a href="#section-book" class="tab-link">교재 소개</a>
      </div>
    <?php endif; ?>
    <div class="col">
        <a href="#section-teacher" class="tab-link">강사 소개</a>
    </div>
    <div class="col">
        <a href="#section-lecture" class="tab-link">강의</a>
    </div>
    <div class="col">
        <a href="#section-review" class="tab-link">리뷰</a>
    </div>
    <div class="tab-underline"></div>
  </div>

    <!-- 언더라인 추가 -->
    <div class="tab-underline"></div>

  <!-- 섹션 콘텐츠 -->
  <div class="container mt-5">
    <section id="section-intro">
      <!-- 은화 -->
      <h2 class="mb-5">강좌 소개</h2>
      <p><?= $lecture->des; ?></p>
    </section>
    <?php if (!empty($lecture->book_image) && !empty($lecture->book_description)): ?>
      <section id="section-book">
        <h2 class="mb-5">교재 소개</h2>
        <div class="col-9 view_bookImg mb-3">
          <img src="<?php echo htmlspecialchars($lecture->book_image); ?>" alt="교재 이미지">
        </div>
        <p><?php echo htmlspecialchars($lecture->book_description); ?></p>
      </section>
    <?php endif; ?>
    <!-- // 은화 -->
    <!-- 은진 -->
    <section id="section-teacher">
      <h2 class="mb-5">강사 소개</h2>
      <div class="d-flex mb-4">
        <img src="<?= $tc_data->tc_thumbnail; ?>" class="tc_thumb" alt="강사이미지">
      </div>
      <p><?= $tc_data->tc_intro; ?></p>
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
      <div class="review_content container">
        <div class="average_score">
          <h3 class="headt1">5.0</h3>
          <div class="star_score">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
          <p><?= count($reviewArr);?>개의 수강평</p>
        </div>
        <div class="review_box">
          <div class="review_item">
            <div class="writer">
              <p>이븐학생</p>
              <span class="date">2024년 11월 30일</span>
              <div class="star_score">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
            </div>
            <div class="title">
              <p class="class_title">제대로 파는 HTML CSS</p>
              <p>HTML 기초부터 활용까지 완벽하게 배우는 강의 후기</p>
            </div>
            <div class="content">
              <p>이 강의는 HTML에 대한 환경 설정부터 기초 개념, 활용법까지 모두 배울 수 있어 매우 유익했습니다.

              HTML의 기본적인 구조와 태그 사용법을 확실히 이해할 수 있었고, 실전에서 어떻게 적용하는지에 대한 실용적인 팁도 배웠습니다.

              또한, 효과적인 공부 방법까지 소개해 주셔서 HTML을 더 잘 활용할 수 있는 자신감을 얻었습니다.

              이 강의를 통해 HTML에 대한 전반적인 이해를 높일 수 있었고, 웹 개발의 첫 단추를 잘 꿰어갈 수 있게 되었습니다.</p>
            </div>
          </div>
          <button>더보기</button>
        </div>
      </div>
    </section>
    <!-- // 유나 -->
  </div>
</div>
<script>
/* ---- 찜하기 스크립트 시작 --- */
  // btn-like 버튼 클릭 이벤트
  $('.btn-like').on('click', function (event) {
    event.preventDefault(); // 기본 동작 방지
    const $button = $(this);
    const $heartIcon = $button.find('.heart-icon');
    const $heartIconFilled = $button.find('.heart-icon-filled');
    const $buttonText = $button.find('span'); // 버튼 내 텍스트 요소 선택
    const lectureId = $heartIcon.data('leid'); // 강좌 ID 가져오기

    // 현재 상태에 따라 처리
    if ($heartIcon.hasClass('d-none')) {
        // 채워진 하트를 클릭한 경우 (찜 제거)
        handleWishlist('remove', lectureId, function (success, message) {
            if (success) {
                alert(message);
                $heartIcon.removeClass('d-none');
                $heartIconFilled.addClass('d-none');
                $buttonText.text('찜하기');
            } else {
                alert('오류가 발생했습니다. 다시 시도해주세요.');
            }
        });
    } else {
        // 빈 하트를 클릭한 경우 (찜 추가)
        handleWishlist('add', lectureId, function (success, message) {
            if (success) {
                alert(message);
                $heartIcon.addClass('d-none');
                $heartIconFilled.removeClass('d-none');
                $buttonText.text('찜한 강좌'); 
            } else {
                alert('오류가 발생했습니다. 다시 시도해주세요.');
            }
        });
    }
  });

  // 공통 찜하기 처리 함수
  function handleWishlist(action, lectureId, callback) {
      $.ajax({
          type: 'POST',
          url: '/code_even/front/wishlist_handler.php', // 공통 처리 PHP
          data: { action: action, lecture_id: lectureId },
          dataType: 'json',
          success: function (response) {
              if (response.status === 'success') {
                  callback(true, response.message);
              } else if (response.status === 'not_logged_in') {
                  alert('로그인이 필요합니다.');
                  $('#exampleModaltest').modal('show'); // 로그인 모달 열기
              } else {
                  callback(false, response.message);
              }
          },
          error: function () {
              alert('처리 중 오류가 발생했습니다.');
              callback(false, 'Ajax 요청 실패');
          }
      });
  }
/* ---- 찜하기 스크립트 끝 --- */

/* ---- 장바구니 추가 스크립트 시작 --- */
  // 장바구니 추가 이벤트
  $('#cartform').submit(function(e) {
      e.preventDefault();
      let book_id = ''; // 교재 ID 초기화 
      let sub_total = Number(<?= $lecture->price; ?>); // 기본 강좌 가격 설정

      // 체크된 교재의 정보를 가져와서 합산
      $(".con_border input[type='checkbox']:checked").each(function() {
          book_id = Number($(this).val());
          let price = Number($(this).attr('data-price'));
          sub_total += price;
      });

      let leid = <?= $leid; ?>; // 강좌 ID

      // 서버로 전송할 데이터 준비
      let data = {
          leid: leid,
          boid: book_id, // 선택된 교재 ID (없으면 빈값)
          price: sub_total // 총 금액
      };

      console.log(data);

      // AJAX 요청
      $.ajax({
          async: false,
          type: 'POST',
          url: 'cart/cart_insert.php',
          data: data,
          dataType: 'json',
          error: function(e) {
              console.log(e);
          },
          success: function(response) {
              if (response.result === '중복입니다.') {
                  alert('이미 장바구니에 추가한 강좌입니다.');
              } else if (response.result === 'ok') {
                  alert('장바구니에 추가되었습니다.');
              } else {
                  alert('장바구니 담기 실패하였습니다. 다시 시도해주세요.');
              }
          }
      });
  });
/* ---- 장바구니 추가 스크립트 끝 --- */

</script>


<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');

?>