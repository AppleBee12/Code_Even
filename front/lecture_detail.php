<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

// 파라미터에서 lecture_id 가져오기
// if (isset($_GET['lecture_id']) && is_numeric($_GET['lecture_id'])) {
//   $lecture_id = (int)$_GET['lecture_id']; // 안전하게 정수 변환
// } else {
//   die("강좌 ID가 잘못되었습니다.");
// }

// 강좌 ID 임시 설정
$lecture_id = 57;

// 강좌명 가져오기
$lecture_query = "SELECT title FROM lecture WHERE leid = $lecture_id";
$lecture_result = $mysqli->query($lecture_query);
$lecture_title = "강좌명 없음";

if ($lecture_result && $lecture_row = $lecture_result->fetch_object()) {
  $lecture_title = $lecture_row->title;
}

/* 유튜브 API 및 강의 동영상 */
function getYouTubeVideoDuration($video_url, $api_key)
{
  // 동영상 ID 추출
  parse_str(parse_url($video_url, PHP_URL_QUERY), $query_params);
  if (isset($query_params['v'])) {
    $video_id = $query_params['v'];
  } else {
    $video_id = basename(parse_url($video_url, PHP_URL_PATH));
  }

  // YouTube Data API 요청 URL
  $api_url = "https://www.googleapis.com/youtube/v3/videos?id={$video_id}&part=contentDetails&key={$api_key}";

  // API 호출 및 응답 확인
  $response = file_get_contents($api_url);
  if ($response) {
    $data = json_decode($response, true);
    if (!empty($data['items'][0]['contentDetails']['duration'])) {
      $duration = $data['items'][0]['contentDetails']['duration'];
      return formatYouTubeDuration($duration);
    }
  }
  return "시간 없음";
}

function formatYouTubeDuration($duration)
{
  // ISO 8601 형식 -> HH:MM:SS 변환
  $interval = new DateInterval($duration);
  return $interval->format('%H:%I:%S');
}

// YouTube API 키
$api_key = "AIzaSyC4aAKg0v67EziZJWlShXRlqsg7zKCPUVg";
// 강의 목록 가져오기
$detail_query = "SELECT * FROM lecture_detail WHERE lecture_id = $lecture_id";
$detail_result = $mysqli->query($detail_query);



?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lecture Detail</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/css/common.css">
<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/css/main.css">
<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/admin/css/reset.css">
<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/css/lecture_detail.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div class="container-fluid content-wrapper">
    <div class="row h-100">
      <div class="col-md-9 d-flex flex-column main-content">
        <div class="main-header d-flex gap-3 align-items-center">
          <div class="back-icon" onclick="goBack()">&larr;</div>
          <h6 id="lectureTitle" class="subtitle1"></h6>
        </div>
        <div id="mainContent" class="flex-grow-1">
          <!-- 유튜브 동영상 임베드 영역 -->
          <div id="defaultContent" class="h-100 d-flex">
            <iframe id="mainVideo" src="" style="flex-grow: 1; height: 100%; background-color: black; border: none;"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
            </iframe>
          </div>
        </div>
      </div>
      <div class="col-md-3 sidebar position-relative pb-0">
        <h6 class="mb-4 subtitle1">강좌명: <?= htmlspecialchars($lecture_title); ?></h6>
        <div class="lecture-list">
          <?php if ($detail_result && $detail_result->num_rows > 0): ?>
            <?php while ($row = $detail_result->fetch_object()): ?>
              <?php
              // 재생 시간을 가져오되 실패 시 기본값 설정
              $play_time = "시간 없음";
              if (!empty($row->video_url)) {
                $play_time = getYouTubeVideoDuration($row->video_url, $api_key);
              }
              ?>
              <div class="lecture-item mb-3" data-video-url="<?= htmlspecialchars($row->video_url); ?>"
                data-full-title="<?= htmlspecialchars($row->title); ?>">
                <div class="lecture-actions d-flex justify-content-between align-items-center">
                  <span class="lecture-title" style="cursor: pointer;">
                    <?= htmlspecialchars($row->video_order); ?>강.
                    <?= htmlspecialchars(mb_strimwidth($row->title, 0, 40, "...", "UTF-8")); ?>
                  </span>
                  <a href="#" class="text-decoration-none">
                    <i class="fas fa-download"></i> 실습 파일
                  </a>
                </div>
                <div class="lecture-time mt-2 d-flex justify-content-between">
                  <span><i class="fas fa-clock"></i> <?= htmlspecialchars($play_time); ?></span>
                  <div>
                    <button class="btn btn-sm btn-secondary quiz-btn" data-type="quiz"
                      data-id="<?= $row->quiz_id; ?>">퀴즈</button>
                    <button class="btn btn-sm btn-secondary exam-btn" data-type="exam"
                      data-id="<?= $row->test_id; ?>">시험</button>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p>등록된 강의가 없습니다.</p>
          <?php endif; ?>
        </div>
        <a href="inquiry.html" class="inquiry-link">
          <i class="fas fa-envelope"></i> 1:1 문의하러 가기
        </a>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
  <script>
    function goBack() {
      window.history.back();
    }

    $(document).ready(function () {
      var myModal = new bootstrap.Modal(document.getElementById('customModal'));
      myModal.show();
    });


    $(document).ready(function () {
      // 강의 제목 클릭 이벤트
      $(".lecture-title").on("click", function () {
        // 클릭된 강의 항목
        var $lectureItem = $(this).closest(".lecture-item");

        // 전체 강의명 가져오기 (data-full-title)
        var fullTitle = $lectureItem.data("full-title");

        // 왼쪽 상단 강의명 업데이트
        $("#lectureTitle").text(fullTitle);

        // 동영상 URL 가져오기
        var videoUrl = $lectureItem.data("video-url");

        // 메인 동영상 플레이어에 URL 적용
        var videoPlayer = $("#mainVideo");
        videoPlayer.attr("src", convertToEmbedUrl(videoUrl));

        // 선택된 항목 스타일 업데이트
        $(".lecture-item").removeClass("selected");
        $lectureItem.addClass("selected");
      });

      // 유튜브 URL -> 임베드 URL로 변환하는 함수
      function convertToEmbedUrl(videoUrl) {
        var videoId = "";
        if (videoUrl.includes("youtu.be")) {
          videoId = videoUrl.split("youtu.be/")[1];
        } else if (videoUrl.includes("youtube.com/watch?v=")) {
          videoId = videoUrl.split("v=")[1].split("&")[0];
        }
        return "https://www.youtube.com/embed/" + videoId;
      }
    });


    // 퀴즈/시험 버튼 클릭 이벤트
    $(document).on('click', '.quiz-btn, .exam-btn', function () {
      const type = $(this).data('type'); // quiz 또는 exam
      const exid = $(this).data('id');   // exid

      $.ajax({
        url: "fetch_quiz_exam.php",
        method: "POST",
        data: { type: type, id: exid },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            // 데이터가 성공적으로 로드되었을 경우 콘텐츠 렌더링
            renderContent(response.data, type);
          } else {
            alert("데이터를 불러오는 데 실패했습니다.");
          }
        },
        error: function () {
          alert("서버 요청 중 오류가 발생했습니다.");
        }
      });
    });

    // 퀴즈/시험 콘텐츠 렌더링 함수
    function renderContent(data, type) {
      const timeLimit = type === 'quiz' ? 10 * 60 : 60 * 60;

      // 콘텐츠 클리어
      $("#mainContent").empty();

      // 타이머 추가
      const timerHtml = `
    <div id="timerContainer" class="text-center my-3">
      <span id="timer" class="badge bg-danger fs-5"></span>
    </div>
  `;
      $("#mainContent").append(timerHtml);

      // 콘텐츠 생성
      let contentHtml = `
    <div class="p-5">
      <h5 class="text-center mb-4 fw-bold">
        해당 강의에 포함된 ${type === 'quiz' ? '퀴즈' : '시험'}는 
        <span class="text-danger">${type === 'quiz' ? '10분' : '1시간'}</span> 내 1회 한정 풀기 가능합니다.
      </h5>
      <form id="${type}Form" class="quiz-exam-container">
        <h3 class="mb-4 fw-bold headt5">${type === 'quiz' ? '퀴즈' : '시험'}</h3>
        <ol>`;

      if (type === 'quiz') {
        contentHtml += renderQuestion(data.question, data.options, 1);
      } else if (type === 'exam') {
        if (Array.isArray(data)) {
          data.forEach((item, index) => {
            contentHtml += renderQuestion(item.question, item.options, index + 1);
          });
        }
      }

      contentHtml += `
        </ol>
        <div class="text-center mt-4">
          <button type="submit" class="btn btn-danger">제출</button>
        </div>
      </form>
    </div>`;

      $("#mainContent").append(contentHtml);

      // 타이머 시작
      startTimer(timeLimit, type);
    }

    // 타이머 함수
    function startTimer(duration, type) {
      let timerDisplay = $("#timer");
      let remainingTime = duration;

      const timerInterval = setInterval(() => {
        const minutes = Math.floor(remainingTime / 60).toString().padStart(2, '0');
        const seconds = (remainingTime % 60).toString().padStart(2, '0');
        timerDisplay.text(`${minutes}:${seconds}`);

        if (remainingTime <= 0) {
          clearInterval(timerInterval);
          alert(`${type === 'quiz' ? '퀴즈' : '시험'} 시간이 종료되었습니다. 자동 제출됩니다.`);
          $("#mainContent form").submit(); // 자동 제출
        }

        remainingTime -= 1;
      }, 1000);
    }

    // 퀴즈/시험 문제 렌더링 함수
    function renderQuestion(question, options, number) {
      let questionHtml = `
    <li class="mb-4">
      <p class="mb-2">${number}. ${question}</p>
      <ul class="list-unstyled">`;

      if (Array.isArray(options)) {
        questionHtml += options.map((option, i) => `
      <li class="mb-2">
        <label>
          <input type="radio" name="q${number}" value="${i}"> ${option.trim()}
        </label>
      </li>
    `).join('');
      } else {
        questionHtml += `<li>옵션을 불러오지 못했습니다.</li>`;
      }

      questionHtml += `</ul></li>`;
      return questionHtml;
    }



  </script>
</body>

</html>