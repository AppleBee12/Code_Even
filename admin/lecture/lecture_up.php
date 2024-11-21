<?php

$title = "강좌 등록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

// 현재 로그인된 사용자 세션 값 가져오기
$session_userid = $_SESSION['AUID'] ?? null; // 세션의 AUID는 user 테이블의 userid와 매칭
$session_username = $_SESSION['AUNAME'] ?? null; // 세션의 AUNAME은 user 테이블의 username과 매칭

// 세션 값 검증
if (!isset($_SESSION['AUID']) || !isset($_SESSION['AUNAME'])) {
  echo "<pre>";
  print_r($_SESSION);
  echo "</pre>";
  echo "<script>alert('로그인 정보가 없습니다. 다시 로그인해 주세요.');</script>";
  echo "<script>location.href='/CODE_EVEN/admin/login.php';</script>";
  exit;
}

// 사용자 정보 가져오기
$session_userid_safe = $mysqli->real_escape_string($session_userid);
$sql_user = "SELECT uid, username FROM user WHERE userid = '$session_userid_safe'";
$result_user = $mysqli->query($sql_user);

if ($result_user && $result_user->num_rows > 0) {
  $user_data = $result_user->fetch_object();
  $uid = $user_data->uid;
  $username = $user_data->username;
} else {
  echo "<script>alert('사용자 정보를 가져오는 데 실패했습니다. 관리자에게 문의하세요.');</script>";
  echo "<script>location.href='/CODE_EVEN/admin/login.php';</script>";
  exit;
}

$leid = isset($_GET['leid']) ? $_GET['leid'] : '';

// DB에서 카테고리 데이터 가져오기
$sql_cate = "SELECT * FROM category ORDER BY step, pcode";
$result_cate = $mysqli->query($sql_cate);

$categories = [];
while ($row = $result_cate->fetch_object()) {
  $categories[] = $row;
}

// 임시 저장 처리
if (isset($_POST['draft_save']) && $_POST['draft_save'] == '1') {
  $cate1 = $mysqli->real_escape_string($_POST['cate1'] ?? null);
  $cate2 = $mysqli->real_escape_string($_POST['cate2'] ?? null);
  $cate3 = $mysqli->real_escape_string($_POST['cate3'] ?? null);
  $title = $mysqli->real_escape_string($_POST['title'] ?? null);
  $price = is_numeric($_POST['price']) ? (int) $_POST['price'] : 0;
  $period = is_numeric($_POST['period']) ? (int) $_POST['period'] : 30;
  $isrecipe = isset($_POST['isrecipe']) ? 1 : 0;
  $isgeneral = isset($_POST['isgeneral']) ? 1 : 0;
  $imagePath = '/uploads/images/default.png';

  // 이미지 업로드 처리
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/images/';
    $uploadedFile = $uploadDir . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
      $imagePath = '/uploads/images/' . basename($_FILES['image']['name']);
    }
  }

  // 데이터 검증
  if (empty($cate1) || empty($cate2) || empty($cate3) || empty($title)) {
    echo "<script>alert('분류와 강좌명은 필수 입력 항목입니다.');</script>";
    exit;
  }
  /*
  기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)
  html이 뭔가요?
  html을 처음 겪는 사람이라면 필수 시청해야 할 영상!
  https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM

  클라우드/DB 데이터베이스 MySQL
  데이터베이스, 나도 한다면 한다! MySQL 사용기
  MySQL 지식 쌓기
  도령사
  20000
  23-11-01
  이도령
  MySQL을 사용하고 싶으신 분들이라면 꼭 들어 보세요!

  이제 당당히 말할 수 있다! 나도 MySLQ 중급 사용자

  MySQL을 즐기는 게 거짓말인 것 같다구요?



  /Code_Even/admin/upload/lecture
  */

  $sql_lecture = "
    INSERT INTO lecture 
    (cgid, boid, lecid, cate1, cate2, cate3, image, title, des, name, video_url, file, period, isrecipe, isgeneral, isbest, isrecom, state, approval, price, level, date) 
    VALUES 
    ( NULL, NULL, '$uid' '$cate1', $cate2' '$cate3', '$imagePath', -- image: 이미지 경로 '$title', '$description', '$username', '$videoUrl', NULL, $period, " . ($isrecipe === 'on' ? 1 : 0) . ", " . ($isgeneral === 'on' ? 1 : 0) . ", 0,  NULL, 추천 1, 0, $price, NULL, NOW()
    )
";

  if ($mysqli->query($sql_lecture)) {
    echo "<script>alert('강좌가 임시 저장되었습니다.');</script>";
    echo "<script>location.href='lecture_list.php';</script>";
  } else {
    echo "<script>alert('임시 저장에 실패했습니다: " . $mysqli->error . "');</script>";
  }

}

// 실습 파일 엽로드
// 요청 방식이 POST 이고, 폼에 사용자가 파일을 업로드 했으며 강사 아이디랑 강의 아이디가 품을 통해 들어왔을 때 실행
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['practice_file']) && isset($_POST['lecture_id']) && isset($_POST['instructor_id'])) {
  $lectureVideoId = (int) $_POST['lecture_video_id'];
  $instructorId = (int) $_POST['instructor_id'];
  $file = $_FILES['practice_file'];

  if (in_array($file['type'], ['application/pdf', 'application/msword', 'application/zip', 'application/x-zip-compressed'])) {
    $uploadFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/';
    $filePath = $uploadFile . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
      $fileName = $mysqli->real_escape_string($file['name']);
      $filePathSafe = $mysqli->real_escape_string($filePath);
      $fileType = $mysqli->real_escape_string($file['type']);

      $sql_file = "
                INSERT INTO lefile (lecdid, lepid, fname, fpath, ftype) 
                VALUES ('$lectureVideoId', '$instructorId', '$fileName', '$filePathSafe', '$fileType')
            ";

      if ($mysqli->query($sql_file)) {
        echo "실습 파일이 업로드되었습니다!";
      } else {
        echo "데이터베이스에 파일을 저장하는 데 실패했습니다!";
      }
    } else {
      echo "파일 업로드 실패!";
    }
  } else {
    echo "지원되지 않는 파일 형식입니다!";
  }
}


// 강의 저장
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['video_url'], $_POST['lecture_id'], $_POST['instructor_id'], $_POST['video_order'])) {
  $videoUrl = $_POST['video_url'];
  $lectureId = $_POST['lecture_id'];
  $instructorId = $_POST['instructor_id'];
  $videoOrder = $_POST['video_order'];  // 동영상 순서 (optional)

  // URL 유효성 검사 및 저장
  if (filter_var($videoUrl, FILTER_VALIDATE_URL)) {
    // 동영상 정보를 levideo 테이블에 저장
    $uploadvideoQuery = $mysqli->prepare("
            INSERT INTO levideo (lecpid, lepid, video_url, orders)
            VALUES (?, ?, ?, ?)
        ");
    $uploadvideoQuery->bind_param("iisi", $lectureId, $instructorId, $videoUrl, $videoOrder);
    $uploadvideoQuery->execute();

    echo "동영상 URL이 저장되었습니다!";
  } else {
    echo "유효하지 않은 URL입니다.";
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'get_quiz_test') {
  $cate1 = $_POST['cate1'] ?? null;
  $cate2 = $_POST['cate2'] ?? null;
  $cate3 = $_POST['cate3'] ?? null;
  $title = $_POST['title'] ?? null;

  $sql_quiz = "SELECT exid, tt FROM quiz WHERE cate1 = '$cate1' AND cate2 = '$cate2' AND cate3 = '$cate3' AND title = '$title'";
  $result_quiz = $mysqli->query($sql_quiz);

  $quiz_data = [];
  while ($row = $result_quiz->fetch_object()) {
    $quiz_data[] = $row;
  }

  $sql_test = "SELECT exid, tt FROM test WHERE cate1 = '$cate1' AND cate2 = '$cate2' AND cate3 = '$cate3' AND title = '$title'";
  $result_test = $mysqli->query($sql_test);

  $test_data = [];
  while ($row = $result_test->fetch_object()) {
    $test_data[] = $row;
  }

  echo json_encode(['quiz' => $quiz_data, 'test' => $test_data]);
  exit;
}


?>

<div class="container">
  <h2>강좌 등록</h2>
  <div class="content_bar d-flex justify-content-between align-item-center cent">
    <h3>강좌 기본 정보 입력</h3>
    <small>* 분류 설정과 강자명은 필수로 입력해야 임시 저장 가능합니다.</small>
  </div>
  <form method="POST" enctype="multipart/form-data" id="lecture_save" onSubmit="lecture_save(e)">
    <input type="hidden" name="leid" value="<?= $leid; ?>">
    <input type="hidden" name="action" value="final_save">
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">분류 설정 <b>*</b></th>
          <td colspan="2">
            <select name="cate1" id="cate1" class="form-select" aria-label="대분류">
              <option selected>대분류</option>
              <?php foreach ($categories as $category) {
                if ($category->step == 1) {
                  echo "<option value='{$category->code}'>{$category->name}</option>";
                }
              } ?>
            </select>
          </td>
          <td colspan="2">
            <select name="cate2" id="cate2" class="form-select" aria-label="Default select example">
              <option selected value="">중분류</option>
            </select>
          </td>
          <td colspan="2">
            <select name="cate3" id="cate3" class="form-select" aria-label="Default select example">
              <option selected value="">소분류</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row">강좌명 <b>*</b></th>
          <td colspan="6">
            <input type="text" name="title" id="title" class="form-control"
              placeholder="기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)">
          </td>
        </tr>
        <tr>
          <th scope="row">강사명 <b>*</b></th>
          <td colspan="2">
            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($username); ?>"
              readonly>
          </td>
          <td name="image" class="box_container" colspan="4" rowspan="5">
            <div class="box">
              <span>강좌 썸네일 이미지를 선택해주세요.</span>
              <div class="image"><img src="" alt=""></div>
            </div>
            <div class="input-group mb-3">
              <input name="image" accept="image/*" type="file" id="image" class="form-control">
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">수강료 <b>*</b></th>
          <td colspan="2">
            <div class="input-group">
              <input name="price" id="price" type="text" class="form-control" aria-label="원" oninput="priceNum(this)">
              <span class="input-group-text">원</span>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">교재 선택 <b>*</b></th>
          <td colspan="2">
            <select name="book" id="book" class="form-select">
              <option value="0">SELECT</option>
              <option value="1">없음</option>
              <?php if (!empty($books)) {
                foreach ($books as $book) {
                  echo "<option value='{$book->boid}'>{$book->title}</option>";
                }
              } ?>
            </select>
            <small class="text-muted">* 필요한 교재가 있다면 교재 목록에서 우선 등록해 주세요.</small>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="period">교육 기간 <b>*</b></label>
          </th>
          <td colspan="2">
            <select id="period" name="period" class="form-select">
              <option value="30">30일</option>
              <option value="60">60일</option>
              <option value="90">90일</option>
              <option value="120">120일</option>
              <option value="150">150일</option>
              <option value="180">180일</option>
            </select>
            <small class="text-muted">* 교육 기간은 30일 단위로 설정 가능합니다.</small>
          </td>
        </tr>
        <tr>
          <th scope="row">강좌 유형 <b>*</b></th>
          <td colspan="4">
            <div class="d-flex gap-4">
              <div class="form-check">
                <input name="isrecipe" class="form-check-input" type="radio" name="courseType" id="isrecipe">
                <label class="form-check-label" for="isrecipe">레시피 강좌</label>
              </div>
              <div class="form-check">
                <input name="isgeneral" class="form-check-input" type="radio" name="courseType" id="isgeneral" checked>
                <label class="form-check-label" for="isgeneral">일반 강좌</label>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-end gap-2 mt-4 mb-5">
      <button type="submit" class="btn btn-outline-secondary" name="action" value="draft_save">기본 정보 저장</button>
    </div>
  </form>
  <!-- 강의 설정 영역 -->
  <form method="POST" action="lecture_up_ok.php" enctype="multipart/form-data" id="lecture_save">
    <div class="content_bar cent">
      <h3>강의 설정</h3>
    </div>
    <div>
      <div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
        <h5 class="mb-0">1강</h5>
        <i class="bi bi-x"></i>
      </div>
      <table class="table">
        <colgroup>
          <col class="col-width-160">
          <col class="col-width-516">
          <col class="col-width-160">
          <col class="col-width-516">
        </colgroup>
        <tbody>
          <tr>
            <th scope="row">강의명 <b>*</b></th>
            <td colspan="3">
              <input name="lecture_name[]" type="text" class="form-control" placeholder="강의명을 입력해 주세요.">
            </td>
          </tr>
          <tr>
            <th scope="row">강의 설명</th>
            <td colspan="3">
              <textarea name="lecture_description[]" class="form-control" rows="3"
                placeholder="강의 설명을 입력해 주세요."></textarea>
            </td>
          </tr>
          <tr>
            <th scope="row">퀴즈 선택</th>
            <td>
              <select name="lecture_quiz_id[]" class="form-select">
                <option value="">퀴즈를 선택해 주세요.</option>
              </select>
            </td>
            <th scope="row">시험 선택</th>
            <td>
              <select name="lecture_test_id[]" class="form-select">
                <option value="">시험을 선택해 주세요.</option>
              </select>
            </td>
          </tr>
          <tr>
            <th scope="row">실습 파일 등록</th>
            <td>
              <input name="lecture_file_id[]" class="form-control" type="file">
            </td>
            <th scope="row">동영상 주소 <b>*</b></th>
            <td>
              <div class="input-group">
                <span class="input-group-text">https://</span>
                <input type="text" name="lecture_video_url[]" class="form-control" placeholder="www.code_even.com">
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="leplus d-flex justify-content-center align-items-center bg-white border rounded-3 boder-secondary">
        <i class="bi bi-plus"></i>
      </div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4 mb-5">
      <button type="button" class="btn btn-secondary" name="action" value="final_save">강의 등록</button>
      <button type="button" class="btn btn-danger" onclick="window.location.href='/lecture_list.php'">취소</button>
    </div>
  </form>
</div>

<script>

  // 카테고리 데이터 변환
  const categories = <?php echo json_encode($categories); ?>;

  // 대분류 선택 -> 중분류 업데이트
  $('#cate1').on('change', function () {
    const cate1 = $(this).val();

    if (cate1) {
      const filterCate2 = categories.filter(category => category.step == 2 && category.pcode == cate1);

      $('#cate2').html('<option value="">중분류</option>');
      filterCate2.forEach(category => {
        $('#cate2').append(`<option value="${category.code}">${category.name}</option>`);
      });
      $('#cate3').html('<option value="">소분류</option>');
    } else {
      $('#cate2').html('<option value="">중분류</option>');
      $('#cate3').html('<option value="">소분류</option>');
    }

    // 교재 목록 업데이트 호출
    updateBooks();
  });

  // 중분류 선택 -> 소분류 업데이트
  $('#cate2').on('change', function () {
    const cate2 = $(this).val();

    if (cate2) {
      const filterCate3 = categories.filter(category => category.step == 3 && category.pcode == cate2);

      $('#cate3').html('<option value="">소분류</option>');
      filterCate3.forEach(category => {
        $('#cate3').append(`<option value="${category.code}">${category.name}</option>`);
      });
    } else {
      $('#cate3').html('<option value="">소분류</option>');
    }

    // 교재 목록 업데이트 호출
    updateBooks();
  });

  // 소분류 선택 시에도 교재 목록 업데이트
  $('#cate3').on('change', updateBooks);


  function updateBooks() {
    const cate1 = $('#cate1').val();
    const cate2 = $('#cate2').val();
    const cate3 = $('#cate3').val();
    const title = $('#title').val(); // 강좌명 가져오기

    // 디버깅: 전달 데이터 확인
    console.log('Updating books with:', { cate1, cate2, cate3, title });

    if (cate1 && cate2 && cate3 && title) { // 모든 값이 선택되었을 때만 실행
      $.ajax({
        url: 'bselect_update.php',
        type: 'POST',
        data: { cate1, cate2, cate3, title }, // 데이터를 객체로 전달
        dataType: 'json', // 서버에서 반환할 데이터 형식
        success: function (data) {
          console.log('Books received:', data); // 데이터를 확인
          $('#book').html('<option value="">SELECT</option>'); // 기존 옵션 초기화

          if (data && data.length > 0) {
            data.forEach(book => {
              $('#book').append(`<option value="${book.boid}">${book.book}</option>`);
            });
          } else {
            $('#book').append('<option value="">관련 교재가 없습니다.</option>');
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error:', status, error);
        }
      });
    } else {
      console.warn('카테고리 또는 강좌명이 비어 있음.');
      $('#book').html('<option value="">SELECT</option>'); // 카테고리가 미선택일 경우 초기화
    }
  }

  // 이벤트 수정: title 입력값 변경 시 업데이트 트리거
  $('#cate1, #cate2, #cate3, #title').on('input change', updateBooks);


  // 카테고리 선택 시 교재 목록 업데이트
  $('#cate1, #cate2, #cate3').on('change', updateBooks);


  // 썸네일 첨부하면 class image에 출력
  $('#image').on('change', function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        $('.image img').attr('src', e.target.result);
        $('.image img').attr('alt', file.name);
        $('.box span').css('display', 'none'); // 텍스트 숨기기
      };

      reader.readAsDataURL(file);
    }
  });

  // 카테고리 및 강좌명 변경 시 퀴즈/시험 데이터를 업데이트
  function updateQuizAndTest() {
    const cate1 = $('#cate1').val();
    const cate2 = $('#cate2').val();
    const cate3 = $('#cate3').val();
    const title = $('#title').val();

    if (cate1 && cate2 && cate3 && title) {
      $.ajax({
        url: 'lecture_up_ok.php',
        type: 'POST',
        data: {
          action: 'get_quiz_test',
          cate1: cate1,
          cate2: cate2,
          cate3: cate3,
          title: title
        },
        success: function (response) {
          var data = JSON.parse(response);

          // 퀴즈와 시험 데이터 업데이트
          var quizSelect = $('select[name="quiz_id"]');
          quizSelect.html('<option value="">퀴즈를 선택해 주세요.</option>');
          data.quiz.forEach(function (quiz) {
            quizSelect.append('<option value="' + quiz.exid + '">' + quiz.tt + '</option>');
          });

          var testSelect = $('select[name="test_id"]');
          testSelect.html('<option value="">시험을 선택해 주세요.</option>');
          data.test.forEach(function (test) {
            testSelect.append('<option value="' + test.exid + '">' + test.tt + '</option>');
          });
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error:', error);
        }
      });
    }
  }

  // 카테고리나 강좌명이 변경될 때 이벤트 실행
  $('#cate1, #cate2, #cate3, #title').on('change', updateQuizAndTest);


  // $('#lecture_save').on('submit', function (e) {
  //     const lectureDetails = [];
  //     $('.lecture-detail-row').each(function () {
  //         lectureDetails.push({
  //             title: $(this).find('input[name="lecture_title"]').val(),
  //             description: $(this).find('textarea[name="lecture_description"]').val(),
  //             quiz_id: $(this).find('select[name="quiz_id"]').val(),
  //             test_id: $(this).find('select[name="test_id"]').val(),
  //         });
  //     });

  //     console.log(lectureDetails); // 데이터를 콘솔에 출력

  //     $('<input>').attr({
  //         type: 'hidden',
  //         name: 'lecture_detail',
  //         value: JSON.stringify(lectureDetails),
  //     }).appendTo('#lecture_save');
  // });

  // 새로운 강의 추가
  $('.leplus').on('click', function () {
    const lectureCount = $('.video').length + 1; // 현재 강의 개수 + 1
    const newLectureTemplate = `
          <div class="lecture-section">
              <div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
                  <h5 class="mb-0">${lectureCount}강</h5>
                  <i class="bi bi-x" onclick="removeLecture(this)"></i>
              </div>
              <table class="table lecture-table">
                  <colgroup>
                      <col class="col-width-160">  
                      <col class="col-width-516">  
                      <col class="col-width-160">
                      <col class="col-width-516">  
                  </colgroup>
                  <tbody>
                      <tr>
                          <th scope="row">강의명 <b>*</b></th>
                          <td colspan="3">
                              <input type="text" name="lecture_name[]" class="form-control" placeholder="강의명을 입력해 주세요." required>
                          </td>
                      </tr>
                      <tr>
                          <th scope="row">강의 설명</th>
                          <td colspan="3">
                              <textarea name="lecture_description[]" class="form-control" rows="3" placeholder="강의 설명을 입력해 주세요."></textarea>
                          </td>
                      </tr>
                      <tr>
                          <th scope="row">퀴즈 선택</th>
                          <td>
                              <select name="quiz_id[]" class="form-select">
                                  <option value="">퀴즈를 선택해 주세요.</option>
                              </select>
                          </td>
                          <th scope="row">시험 선택</th>
                          <td>
                              <select name="test_id[]" class="form-select">
                                  <option value="">시험을 선택해 주세요.</option>
                              </select>
                          </td>
                      </tr>
                      <tr>
                          <th scope="row">실습 파일 등록</th>
                          <td>
                              <input name="practice_file[]" class="form-control" type="file">
                          </td>
                          <th scope="row">동영상 주소 <b>*</b></th>
                          <td>
                              <div class="input-group">
                                  <span class="input-group-text">https://</span>
                                  <input type="text" name="video_url[]" class="form-control" placeholder="www.code_even.com" required>
                              </div>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
      `;

    // 새로운 강의 섹션을 추가
    $(this).before(newLectureTemplate);

    // 강의 번호 재정렬
    reorderLectures();
  });

  // 강의 삭제
  function removeLecture(element) {
    // 해당 강의 섹션 삭제
    $(element).closest('.lecture-section').remove();

    // 강의 번호 재정렬
    reorderLectures();
  }

  // 강의 번호 재정렬
  function reorderLectures() {
    $('.video').each(function (index) {
      $(this).find('h5').text(`${index + 1}강`);
    });
  }

  // $('#lecture_save').on('submit', function (e) {
  //   e.preventDefault(); // 기본 폼 제출 동작 방지

  //   const lectureDetails = [];
  //   $('.lecture-section').each(function () {
  //       const title = $(this).find('input[name="lecture_name[]"]').val();
  //       const description = $(this).find('textarea[name="lecture_description[]"]').val();
  //       const quizId = $(this).find('select[name="quiz_id[]"]').val();
  //       const testId = $(this).find('select[name="test_id[]"]').val();
  //       const videoUrl = $(this).find('input[name="video_url[]"]').val();

  //       lectureDetails.push({
  //           title: title,
  //           description: description,
  //           quiz_id: quizId,
  //           test_id: testId,
  //           video_url: videoUrl,
  //       });
  //   });

  // 강의 데이터를 숨겨진 input에 추가
  //     $('<input>').attr({
  //         type: 'hidden',
  //         name: 'lecture_detail',
  //         value: JSON.stringify(lectureDetails),
  //     }).appendTo('#lecture_save');

  //     this.submit(); // 폼 제출
  // });

  // 강좌 기본 정보 저장
  $(document).ready(function () {
    $('#lecture_save').on('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      $.ajax({
        url: 'lecture_up_ok.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            alert('강좌 정보가 성공적으로 저장되었습니다.');
          } else {
            alert('강좌 저장 실패: ' + response.message);
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error:', error);
          alert('서버 요청 중 문제가 발생했습니다.');
        }
      });
    });
  });





</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>