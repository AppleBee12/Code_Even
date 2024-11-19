<?php

$title = "강좌 등록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

// 현재 로그인된 사용자 세션 값 가져오기
$session_userid = $_SESSION['AUID'] ?? null; // 세션의 AUID는 user 테이블의 userid와 매칭
$session_username = $_SESSION['AUNAME'] ?? null; // 세션의 AUNAME은 user 테이블의 username과 매칭

// 세션 값 검증
if (!$session_userid || !$session_username) {
    echo "<script>alert('로그인 정보가 없습니다. 다시 로그인해 주세요.');</script>";
    echo "<script>location.href='/CODE_EVEN/admin/login.php';</script>";
    exit;
}

// 사용자 정보 가져오기 (확인용)
$sql_user = "SELECT uid, username FROM user WHERE userid = ?";
if ($stmt_user = $mysqli->prepare($sql_user)) {
    $stmt_user->bind_param("s", $session_userid);
    $stmt_user->execute();
    $stmt_user->bind_result($uid, $username);
    $stmt_user->fetch();
    $stmt_user->close();
} else {
    echo "<script>alert('사용자 정보를 가져오는 데 실패했습니다.');</script>";
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
    // 폼 데이터 수집
    $cate1 = $_POST['cate1'] ?? null;
    $cate2 = $_POST['cate2'] ?? null;
    $cate3 = $_POST['cate3'] ?? null;
    $title = $_POST['title'] ?? null;
    $price = $_POST['price'] ?? 0;
    $period = $_POST['period'] ?? 30;
    $isrecipe = $_POST['isrecipe'] ?? 0;
    $isgeneral = $_POST['isgeneral'] ?? 1;
    $imagePath = 'uploads/images/default.png';

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
        echo "<script>alert('필수 항목을 모두 입력해주세요.');</script>";
        exit;
    }

    // 강좌 데이터 임시 저장 쿼리
    $sql_lecture = "
      INSERT INTO lecture 
      (lecid, cate1, cate2, cate3, title, name, price, period, isrecipe, isgeneral, image, date, state, approval) 
      VALUES 
      (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 0, '대기')
    ";

    // 데이터 준비
    if ($stmt = $mysqli->prepare($sql_lecture)) {
        $stmt->bind_param(
            "issssssiiiss", // 데이터 타입 문자열
            $uid,           // 로그인된 사용자 uid
            $cate1,
            $cate2,
            $cate3,
            $title,
            $user_name,     // 사용자 이름
            $price,
            $period,
            $isrecipe,
            $isgeneral,
            $imagePath
        );

        // 쿼리 실행 후 결과 체크
        if ($stmt->execute()) {
            echo "<script>alert('강좌가 임시 저장되었습니다.');</script>";
            echo "<script>location.href='lecture_list.php';</script>";
        } else {
            echo "<script>alert('임시 저장에 실패했습니다: " . $stmt->error . "');</script>";
        }
    } else {
        echo "<script>alert('쿼리 준비에 실패했습니다: " . $mysqli->error . "');</script>";
    }
}

// 실습 파일 엽로드
  // 요청 방식이 POST 이고, 폼에 사용자가 파일을 업로드 했으며 강사 아이디랑 강의 아이디가 품을 통해 들어왔을 때 실행
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['practice_file']) && isset($_POST['lecture_id']) && isset($_POST['instructor_id'])) {
    // 데이터 받기
    $lectureVideoId = $_POST['lecture_video_id'];
    $instructorId = $_POST['instructor_id'];
    $file = $_FILES['practice_file'];

    // 지원되는 파일 형식
    $fileType = ['application/pdf', 'application/msword', 'application/zip', 'application/x-zip-compressed'];
    
    // 파일이 지원되는 형식인지 체크
    if (in_array($file['type'], $fileType)) {
      $uploadFile = 'uploads/files/';
      $filePath = $uploadFile . basename($file['name']);
      
      // 파일 저장
      if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // 데이터베이스에 삽입
        // 아래와 같이 다른 이름을 사용해도 됩니다.
        $uploadfileQuery = $mysqli->prepare("INSERT INTO lefile (lecdid, lepid, fname, fpath, ftype) VALUES (?, ?, ?, ?, ?)");
        // 쿼리 실행
        $uploadfileQuery->bind_param("iisss", $lectureId, $instructorId, $file['name'], $filePath, $file['type']);
        $uploadfileQuery->execute();

        echo "실습 파일이 업로드되었습니다!";
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

  // 퀴즈 / 시험 데이터 불러오기
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'get_quiz_test') {
    $cate1 = $_POST['cate1'];
    $cate2 = $_POST['cate2'];
    $cate3 = $_POST['cate3'];
    $title = $_POST['title'];

    // quiz 데이터 가져오기
    $sql_quiz = "SELECT exid, tt FROM quiz WHERE cate1 = ? AND cate2 = ? AND cate3 = ? AND title = ?";
    $stmt_quiz = $mysqli->prepare($sql_quiz);
    $stmt_quiz->bind_param("ssss", $cate1, $cate2, $cate3, $title);
    $stmt_quiz->execute();
    $result_quiz = $stmt_quiz->get_result();
    $quiz_data = [];
    while ($row = $result_quiz->fetch_object()) {
        $quiz_data[] = $row;
    }

    // test 데이터 가져오기
    $sql_test = "SELECT exid, tt FROM test WHERE cate1 = ? AND cate2 = ? AND cate3 = ? AND title = ?";
    $stmt_test = $mysqli->prepare($sql_test);
    $stmt_test->bind_param("ssss", $cate1, $cate2, $cate3, $title);
    $stmt_test->execute();
    $result_test = $stmt_test->get_result();
    $test_data = [];
    while ($row = $result_test->fetch_object()) {
        $test_data[] = $row;
    }

    // JSON으로 반환
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
  <form method="POST" action="lecture_up_ok.php" id="lecture_save" enctype="multipart/form-data">
  <input type="hidden" name="leid" value="<?= $leid; ?>">
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
            <input type="text" name="title" id="title" class="form-control" placeholder="기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)">
          </td>
        </tr>
        <tr>
          <th scope="row">강사명 <b>*</b></th>
          <td colspan="2">
            <input type="text" name="name" id="name" class="form-control" 
                  value="<?= htmlspecialchars($username); ?>" readonly>
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
              <input name="price" type="text" class="form-control" aria-label="원" oninput="priceNum(this)">
              <span class="input-group-text">원</span>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">교재 선택 <b>*</b></th>
          <td colspan="2">
            <select name="" id="book" class="form-select">
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
                <input name="isrecipe" class="form-check-input" type="radio" name="courseType" id="recipeCourse">
                <label class="form-check-label" for="isrecipe">레시피 강좌</label>
              </div>
              <div class="form-check">
                <input name="isgeneral" class="form-check-input" type="radio" name="courseType" id="generalCourse" checked>
                <label class="form-check-label" for="isgeneral">일반 강좌</label>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  
    <!-- 강의 설정 영역 -->
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
          <col width="160">  
          <col width="516">  
          <col width="160">
          <col width="516">  
        </colgroup>
        <tbody>
          <tr>
            <th scope="row">강의명 <b>*</b></th>
            <td colspan="3">
              <input type="text" class="form-control" placeholder="강의명을 입력해 주세요.">
            </td>
          </tr>
          <tr>
            <th scope="row">강의 설명</th>
            <td colspan="3">
              <textarea class="form-control" rows="3" placeholder="강의 설명을 입력해 주세요."></textarea>
            </td>
          </tr>
          <tr>
            <th scope="row">퀴즈 선택</th>
            <td>
              <select name="quiz_id" class="form-select">
                <option value="">퀴즈를 선택해 주세요.</option>
              </select>
            </td>
            <th scope="row">시험 선택</th>
            <td>
              <select name="test_id" class="form-select">
                <option value="">시험을 선택해 주세요.</option>
              </select>
            </td>
          </tr>
          <tr>
            <th scope="row">실습 파일 등록</th>
            <td>
              <input name="practice_file" class="form-control" type="file">
            </td>
            <th scope="row">동영상 주소 <b>*</b></th>
            <td>
              <div class="input-group">
                <span class="input-group-text">https://</span>
                <input type="text" class="form-control" placeholder="www.code_even.com">
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
      <button type="submit" class="btn btn-primary" name="action" value="final_save">등록</button>
      <button type="submit" class="btn btn-secondary" name="action" value="draft_save">임시 저장</button>
      <button type="button" class="btn btn-danger" onclick="window.location.href='/lecture_list.php'">취소</button>
    </div>
  </form>
</div>

<script>

  // 카테고리 데이터 변환
  const categories = <?php echo json_encode($categories); ?>;

  // 대분류 선택 -> 중분류 업데이트
  $('#cate1').on('change', function() {
    const cate1 = $(this).val();

    if(cate1) {
      const filterCate2 = categories.filter(category => category.step == 2 && category.pcode == cate1);

      $('#cate2').html('<option value="">중분류</option>');
      filterCate2.forEach(category => {
        $('#cate2').append(`<option value="${category.code}">${category.name}</option>`);
      });
      $('#cate3').html('<option value="">소분류</option>');

    }else{

      $('#cate2').html('<option value="">중분류</option>');
      $('#cate3').html('<option value="">소분류</option>');

    }
  });

  // 중분류 선택 -> 소분류 업데이트
  $('#cate2').on('change', function() {
    const cate2 = $(this).val();

    if(cate2) {
      const filterCate3 = categories.filter(category => category.step == 3 && category.pcode == cate2);

      $('#cate3').html('<option value="">소분류</option>')
      filterCate3.forEach(category => {
        $('#cate3').append(`<option value="${category.code}">${category.name}</option>`);
      });

    }else{

      $('#cate3').html('<option value="">소분류</option>');

    }
  });

  // 수강료 입력 시 1,000 단위 반점
  function priceNum(input) {
    let value = input.value.replace(/[^0-9]/g, ''); // 숫자만 입력 가능하게!
    let priceValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // 100 단위 반점 추가
    input.value = priceValue; // input에 입력한 값에 세 자릿수마다 반점 추가
  }
  
  // 카테고리 변경 시 교재 목록 업데이트
  function updateBooks() {
    console.log({
        cate1: $('#cate1').val(),
        cate2: $('#cate2').val(),
        cate3: $('#cate3').val(),
        title: $('#title').val()
    }); // 콘솔 확인용

    let formData = new FormData(); // formData 정의
    formData.append('cate1', $('#cate1').val());
    formData.append('cate2', $('#cate2').val());
    formData.append('cate3', $('#cate3').val());
    formData.append('title', $('#title').val());

    if (cate1 && cate2 && cate3) { // 모든 카테고리 선택 시
      $.ajax({
        url: 'bselect_update.php',
        data:formData,
        method: 'POST',
        dataType:'json',
        processData: false,
        contentType: false,
        success: function (data) {
          console.log(data);
          $('#book').html('<option value="">SELECT</option>'); // 기존 옵션 초기화
          data.forEach(book => {
            $('#book').append(`<option value="${book.boid}">${book.book}</option>`);
          });
        },
        error: function () {
          alert('교재 데이터를 가져오는 중 오류가 발생했습니다.');
        }
      });
    } else {
      $('#book').html('<option value="">SELECT</option>');
    }
  }

  // 카테고리 변경 시 교재 목록 업데이트
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
            url: 'lecture_up_ok.php', // 요청을 보낼 URL
            type: 'POST',
            data: {
                action: 'get_quiz_test', // AJAX 요청임을 알리는 필드
                cate1: cate1,
                cate2: cate2,
                cate3: cate3,
                title: title,
            },
            dataType: 'json',
            success: function (response) {
                // 퀴즈 목록 업데이트
                const quizSelect = $('select[name="quiz_id"]');
                quizSelect.html('<option value="">퀴즈를 선택해 주세요.</option>');
                response.quiz.forEach(quiz => {
                    quizSelect.append(`<option value="${quiz.exid}">${quiz.tt}</option>`);
                });

                // 시험 목록 업데이트
                const testSelect = $('select[name="test_id"]');
                testSelect.html('<option value="">시험을 선택해 주세요.</option>');
                response.test.forEach(test => {
                    testSelect.append(`<option value="${test.exid}">${test.tt}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('퀴즈와 시험 데이터를 가져오는 데 실패했습니다.');
            }
        });
    }
}

// 카테고리나 강좌명이 변경될 때 이벤트 실행
$('#cate1, #cate2, #cate3, #title').on('change', updateQuizAndTest);







</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>



