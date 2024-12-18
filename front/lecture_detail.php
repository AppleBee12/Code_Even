<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/CODE_EVEN/admin/inc/dbcon.php');
// include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');
?>
<!DOCTYPE html>
<html lang="en">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lecture Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
          <h6 class="subtitle1">1강: HTML, CSS, JavaScript 기초</h6>
        </div>
        <div id="mainContent" class="flex-grow-1">
          <div id="defaultContent" class="h-100 d-flex align-items-center justify-content-center">
            <video src="" controls style="width: 100%; height: 100%; background-color: black;"></video>
          </div>
        </div>
      </div>
      <div class="col-md-3 sidebar position-relative pb-0">
        <h6 class="mb-4 subtitle1">강좌명: HTML, CSS, JavaScript</h6>
        <div class="lecture-list">
          <div class="lecture-item">
            <div class="lecture-actions">
              <span>1강: HTML 기본</span>
              <a href="#"><i class="fas fa-download"></i> 실습 파일</a>
            </div>
            <div class="lecture-time mt-2 d-flex justify-content-between">
              <span><i class="fas fa-clock"></i> 20:00</span>
              <div>
                <button class="btn btn-sm btn-secondary exam-btn" data-content="exam1">시험</button>
                <button class="btn btn-sm btn-secondary quiz-btn" data-content="quiz1">퀴즈</button>
              </div>
            </div>
          </div>
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

    $(document).ready(function() {
      var myModal = new bootstrap.Modal(document.getElementById('customModal'));
      myModal.show();
    });

    $(document).ready(function() {
      const contents = {
        quiz1: `
          <div class="p-5">
            <h5 class="text-center mb-4 fw-bold">해당 강의에 포함된 퀴즈는 <span class="text-danger">10분</span>, 시험은 <span class="text-danger">1시간</span> 내 1회 한정 풀기 가능합니다.</h5>
            <p class="text-center mb-4">네트워크 환경을 꼭 체크해 주세요.</p>
            <form id="quizForm" class="quiz-exam-container">
              <h3 class="mb-4 fw-bold headt5">퀴즈</h3>
              <ol>
                <li class="mb-3 headt6"> <b>&lt;button&gt;</b>과 <b>&lt;input&gt;</b> 요소에 대한 설명으로 올바른 것을 고르세요.</li>
                <ul>
                  <li class="mb-2"><input type="radio" name="q1" /> A. 버튼은 기본적으로 text 타입이다.</li>
                  <li class="mb-2"><input type="radio" name="q1" /> B. input은 단일 요소이다.</li>
                  <li class="mb-2"><input type="radio" name="q1" /> C. 버튼은 스크립트를 연결한다.</li>
                </ul>
              </ol>
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-danger">제출</button>
              </div>
            </form>
          </div>
        `,
        exam1: `
          <div class="p-5">
            <h5 class="text-center mb-4 fw-bold">해당 강의에 포함된 퀴즈는 <span class="text-danger">10분</span>, 시험은 <span class="text-danger">1시간</span> 내 1회 한정 풀기 가능합니다.</h5>
            <p class="text-center mb-4">네트워크 환경을 꼭 체크해 주세요.</p>
            <form id="examForm" class="quiz-exam-container">
              <h3 class="mb-4 fw-bold headt5">시험</h3>
              <ol>
                <li class="mb-4">
                  <p class="headt6 mb-3">1. HTML의 시맨틱 태그에 대한 설명으로 올바른 것을 고르세요.</p>
                  <ul>
                    <li class="mb-2"><input type="radio" name="q1" /> A. 시맨틱 태그는 스타일 태그이다.</li>
                    <li class="mb-2"><input type="radio" name="q1" /> B. 시맨틱 태그는 의미를 가진 태그이다.</li>
                    <li class="mb-2"><input type="radio" name="q1" /> C. 시맨틱 태그는 스크립트 태그이다.</li>
                  </ul>
                </li>
                <li class="mb-4">
                  <p class="headt6 mb-3">2. CSS의 Flexbox 주요 기능은?</p>
                  <ul>
                    <li class="mb-2"><input type="radio" name="q2" /> A. 요소를 숨긴다.</li>
                    <li class="mb-2"><input type="radio" name="q2" /> B. 요소를 정렬한다.</li>
                    <li class="mb-2"><input type="radio" name="q2" /> C. 요소 색상을 변경한다.</li>
                  </ul>
                </li>
              </ol>
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-danger">제출</button>
              </div>
            </form>
          </div>
        `
      };

      $(document).on('click', '.quiz-btn, .exam-btn', function() {
        const contentKey = $(this).data('content');
        $('#defaultContent').hide();
        $('#mainContent').html(contents[contentKey]);
      });
    });

    $(document).on('submit', '#quizForm, #examForm', function(e) {
      e.preventDefault();
      const formData = $(this).serialize();
      console.log("제출된 데이터:", formData);
      alert('제출되었습니다!');
      $('#mainContent').html(`
        <div id="defaultContent" class="h-100 d-flex align-items-center justify-content-center">
          <video src="" controls style="width: 100%; height: 100%; background-color: black;"></video>
        </div>
      `);
    });
  </script>
</body>
</html>
