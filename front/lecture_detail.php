<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// URL 파라미터에서 detail_id 가져오기
$detail_id = isset($_GET['detail_id']) ? intval($_GET['detail_id']) : 0;

if ($detail_id === 0) {
  echo "유효하지 않은 강의 ID입니다.";
  exit;
}

// Step 1: detail_id로 lecture_id 조회
$lecture_id_query = "
    SELECT lecture_id 
    FROM lecture_detail 
    WHERE id = $detail_id
";

$lecture_id_result = $mysqli->query($lecture_id_query);

if (!$lecture_id_result || $lecture_id_result->num_rows === 0) {
  echo "해당 강의 정보를 찾을 수 없습니다.";
  exit;
}

$lecture_id_row = $lecture_id_result->fetch_object();
$lecture_id = intval($lecture_id_row->lecture_id); // 안전하게 정수로 변환

// Step 2: lecture_id로 강좌 정보 조회
$lecture_query = "
    SELECT title, name, date
    FROM lecture 
    WHERE leid = $lecture_id
";

$lecture_result = $mysqli->query($lecture_query);
$lecture_title = "강좌명 없음";
$lecture_teacher = "강사명 없음";
$lecture_date = "날짜 정보 없음";

if ($lecture_result && $lecture_row = $lecture_result->fetch_object()) {
  $lecture_title = $lecture_row->title;
  $lecture_teacher = $lecture_row->name;
  $lecture_date = $lecture_row->date;
}

// Step 3: detail_id로 강의 세부 정보 조회
$detail_query = "
    SELECT 
        title AS lecture_detail_title,
        video_url,
        quiz_id,
        test_id
    FROM lecture_detail 
    WHERE id = $detail_id
";


$lecture_detail_title = "강의명 없음";
$lecture_video_url = "";

$detail_result = $mysqli->query($detail_query);

if ($detail_result && $detail_row = $detail_result->fetch_object()) {
  $lecture_detail_title = htmlspecialchars($detail_row->lecture_detail_title ?? "강의명 없음");
  $lecture_video_url = htmlspecialchars($detail_row->video_url ?? "");
}

// 유튜브 URL 임베드 ID 추출
function getYouTubeEmbedUrl($video_url)
{
  parse_str(parse_url($video_url, PHP_URL_QUERY), $query_params);
  return $query_params['v'] ?? basename(parse_url($video_url, PHP_URL_PATH));
}


/* 유튜브 API 및 강의 동영상 */
function getYouTubeVideoDuration($video_url, $api_key)
{
  parse_str(parse_url($video_url, PHP_URL_QUERY), $query_params);
  $video_id = $query_params['v'] ?? basename(parse_url($video_url, PHP_URL_PATH));

  $api_url = "https://www.googleapis.com/youtube/v3/videos?id={$video_id}&part=contentDetails&key={$api_key}";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $api_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

  $response = curl_exec($ch);

  if (curl_errno($ch)) {
    error_log('cURL Error: ' . curl_error($ch));
    curl_close($ch);
    return "시간 없음";
  }

  curl_close($ch);

  $data = json_decode($response, true);
  if (!empty($data['items'][0]['contentDetails']['duration'])) {
    return formatYouTubeDuration($data['items'][0]['contentDetails']['duration']);
  }

  return "시간 없음";
}

// ISO 8601 포맷 시간을 사람이 읽을 수 있는 형식으로 변환
function formatYouTubeDuration($duration)
{
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/css/common.css">
<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/css/main.css">
<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/admin/css/reset.css">
<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/css/lecture_detail.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div class="container-fluid content-wrapper">
    <div class="modal fade" id="customModal" tabindex="-1" aria-labelledby="customModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title subtitle1" id="customModalLabel">수료증을 향한 첫걸음!</h5>
          </div>
          <hr>
          <div class="modal-body subtitle2">
            코드이븐의 각 강의는 <br>
            <span class="message_str">퀴즈와 시험이 제출 되어야 진도 확인이 가능</span>합니다.<br>
            그래야만 차후 수료증을 받아 보실 수 있어요.<br>
            미루지 말고 꼭 풀고 다음 강의를 시청해 주세요.<br>
            끝까지 풀고 멋진 수료증을 손에 쥘 수강생 여러분을 응원합니다!
          </div>
          <hr>
          <div class="modal-footer">
            <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">확인</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row h-100">
      <div class="col-md-9 d-flex flex-column main-content">
        <div class="main-header d-flex gap-3 align-items-center">
          <div class="back-icon" onclick="goBack()">&larr;</div>
          <h6 id="lectureTitle" class="subtitle1"><?= $lecture_detail_title; ?></h6>
        </div>
        <div id="mainContent" class="flex-grow-1">
          <div id="defaultContent" class="h-100 d-flex">
            <iframe id="mainVideo"
              src="<?= !empty($lecture_video_url) ? 'https://www.youtube.com/embed/' . getYouTubeEmbedUrl($lecture_video_url) : ''; ?>"
              style="flex-grow: 1; height: 100%; background-color: black; border: none;"
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
                          $play_time = "시간 없음";
                          if (!empty($row->video_url)) {
                            $play_time = getYouTubeVideoDuration($row->video_url, $api_key);
                          }
                          ?>
                          <div class="lecture-item mb-3" data-video-url="<?= htmlspecialchars($row->video_url); ?>"
                            data-full-title="<?= htmlspecialchars($row->title); ?>">
                            <div class="lecture-actions d-flex justify-content-between align-items-center">
                              <span class="lecture-title"><?= htmlspecialchars($row->video_order); ?>강.
                                <?= htmlspecialchars(mb_strimwidth($row->title, 0, 40, "...", "UTF-8")); ?>
                              </span>
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


    document.addEventListener("DOMContentLoaded", function () {
      const lectureTitle = document.getElementById('lectureTitle');
      const mainVideo = document.getElementById('mainVideo');

      if (lectureTitle && mainVideo) {
        const lectureDetailTitle = "<?= $lecture_detail_title; ?>";
        const lectureVideoUrl = "<?= $lecture_video_url; ?>";

        lectureTitle.textContent = lectureDetailTitle;

        if (lectureVideoUrl) {
          const videoId = lectureVideoUrl.includes("youtu.be")
            ? lectureVideoUrl.split("youtu.be/")[1]
            : lectureVideoUrl.split("v=")[1]?.split("&")[0];

          mainVideo.src = `https://www.youtube.com/embed/${videoId}`;
        }
      }
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
            renderContent(response.data, type, exid);
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
    function renderContent(data, type, exid) {
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
      <div class="text-center mb-5">
        <h5 class="fw-bold mb-2">
          해당 강의에 포함된 ${type === 'quiz' ? '퀴즈' : '시험'}는 
          <span class="text-danger">${type === 'quiz' ? '10분' : '1시간'}</span> 내 1회 한정 풀기 가능합니다.
        </h5>
        <p>네트워크 환경을 꼭 체크해 주세요.</p>
      </div>
      <form id="${type}Form" class="quiz-exam-container">
        <input type="hidden" name="type" value="${type}">
        <input type="hidden" name="id" value="${exid}">
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
        <div class="d-flex justify-content-end mt-4">
          <button type="button" id="submitQuizExam" class="btn btn-danger">제출</button>
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
          $("#mainContent form").submit();
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
          <input type="radio" name="answer_${number}" value="${i + 1}"> ${option.trim()}
        </label>
      </li>`).join('');
      } else {
        questionHtml += `<li>옵션을 불러오지 못했습니다.</li>`;
      }

      questionHtml += `</ul></li>`;
      return questionHtml;
    }

    let lastVideoUrl = ''; // 마지막 시청한 동영상 URL 저장 변수

    // 강의 제목 클릭 시 URL 저장
    $(".lecture-title").on("click", function () {
      const $lectureItem = $(this).closest(".lecture-item");
      lastVideoUrl = $lectureItem.data("video-url"); // 마지막 시청 URL 저장

      $("#lectureTitle").text($lectureItem.data("full-title"));
      $("#mainVideo").attr("src", convertToEmbedUrl(lastVideoUrl));
    });

    // 퀴즈/시험 버튼 클릭 시
    $(document).on('click', '.quiz-btn, .exam-btn', function () {
      const $button = $(this); // 클릭된 버튼 참조
      const type = $button.data('type'); // quiz 또는 exam
      const exid = $button.data('id'); // 퀴즈/시험 ID

      $.ajax({
        url: "fetch_quiz_exam.php",
        method: "POST",
        data: { type: type, id: exid },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            renderContent(response.data, type, exid);
          } else {
            alert("데이터를 불러오는 데 실패했습니다.");
          }
        },
        error: function () {
          alert("서버 요청 중 오류가 발생했습니다.");
        }
      });
    });

    // 마지막 시청 동영상으로 돌아가는 함수
    function showLastVideo() {
      if (lastVideoUrl) {
        $("#mainContent").html(`
      <div id="defaultContent" class="h-100 d-flex">
        <iframe id="mainVideo" src="${convertToEmbedUrl(lastVideoUrl)}"
          style="flex-grow: 1; height: 100%; background-color: black; border: none;"
          allowfullscreen>
        </iframe>
      </div>
    `);
        $("#lectureTitle").text("마지막 시청 동영상");
      }
    }

    // 퀴즈/시험 제출 버튼 클릭 시
    $(document).on('click', '#submitQuizExam', function (e) {
      e.preventDefault();

      const $submitButton = $(this); // 제출 버튼 참조
      $submitButton.prop('disabled', true).text('제출 중...'); // 제출 버튼 비활성화

      const form = $(this).closest('form');
      const type = form.find('input[name="type"]').val();
      const id = form.find('input[name="id"]').val();

      const answers = {};
      form.find('input[type="radio"]:checked').each(function (index) {
        answers[`answer_${index + 1}`] = $(this).val();
      });

      if (!type || !id || Object.keys(answers).length === 0) {
        alert('⚠️ 모든 필드를 채워주세요.');
        $submitButton.prop('disabled', false).text('제출'); // 실패 시 버튼 활성화
        return;
      }

      $.ajax({
        url: 'save_score.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
          type: type,
          id: id,
          answers: answers
        }),
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            alert(response.message || '점수가 성공적으로 저장되었습니다.');

            // 사이드바 퀴즈/시험 버튼 비활성화
            $(`.quiz-btn[data-id="${id}"], .exam-btn[data-id="${id}"]`)
              .prop('disabled', true)
              .addClass('disabled')
              .text('완료');

            // 원래 동영상 화면으로 복원
            showLastVideo();
          } else {
            alert(response.message || '점수 저장에 실패했습니다.');
            $submitButton.prop('disabled', false).text('제출'); // 실패 시 버튼 활성화
          }
        },
        error: function (xhr, status, error) {
          console.error('❌ AJAX 오류:', status, error);
          alert('⚠️ 서버 요청 중 오류가 발생했습니다.');
          $submitButton.prop('disabled', false).text('제출'); // 실패 시 버튼 활성화
        }
      });
    });

    // 유튜브 URL -> 임베드 URL로 변환하는 함수
    function convertToEmbedUrl(videoUrl) {
      let videoId = "";
      if (videoUrl.includes("youtu.be")) {
        videoId = videoUrl.split("youtu.be/")[1];
      } else if (videoUrl.includes("youtube.com/watch?v=")) {
        videoId = videoUrl.split("v=")[1].split("&")[0];
      }
      return `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    }



  </script>
</body>

</html>