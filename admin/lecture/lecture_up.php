<?php

$title = "강좌 등록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 현재 로그인된 사용자 세션 값 가져오기
$session_userid = $_SESSION['AUID'] ?? null; // 세션의 AUID는 user 테이블의 userid와 매칭
$session_username = $_SESSION['AUNAME'] ?? null; // 세션의 AUNAME은 user 테이블의 username과 매칭

// 세션 값 검증
if (!isset($_SESSION['AUID']) || !isset($_SESSION['AUNAME'])) {
  echo "<script>alert('로그인 정보가 없습니다. 다시 로그인해 주세요.'); location.href='/code_even/admin/login.php';</script>";
  exit;
}

// 사용자 정보 가져오기
$session_userid_safe = $mysqli->real_escape_string($session_userid);
$sql_user = "SELECT uid, user_level, username FROM user WHERE userid = '$session_userid_safe'";
$result_user = $mysqli->query($sql_user);

if ($result_user && $result_user->num_rows > 0) {
  $user_data = $result_user->fetch_object();
  $uid = $user_data->uid;
  $username = $user_data->username;
  $user_level = $user_data->user_level;

  // user_level이 10인지 확인
  if ($user_level != 10) {
    echo "<script>alert('이 페이지에 접근할 권한이 없습니다.');</script>";
    echo "<script>location.href='/code_even/admin/lecture/lecture_list.php';</script>";
    exit;
  }
} else {
  echo "<script>alert('사용자 정보를 가져오는 데 실패했습니다. 관리자에게 문의하세요.');</script>";
  echo "<script>location.href='/code_even/admin/lecture/lecture_list.php';</script>";
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

// POST 요청 처리
$leid = $_POST['leid'] ?? null;
$title = $_POST['title'] ?? null;
$cate1 = $_POST['cate1'] ?? null;
$cate2 = $_POST['cate2'] ?? null;
$cate3 = $_POST['cate3'] ?? null;

// if (empty($title) || empty($cate1) || empty($cate2) || empty($cate3)) {
//     die("필수 항목을 입력해주세요.");
// }

// 선택 필드 처리
$price = $_POST['price'] ?? 0;
$book_id = $_POST['book'] ?? null;
$period = $_POST['period'] ?? 30;
$is_recipe = isset($_POST['courseType']) && $_POST['courseType'] === 'isrecipe';

// 이미지 업로드 처리
$image_path = null;
if (!empty($_FILES['image']['name'])) {
  $upload_dir = 'uploads/images/';
  $image_name = time() . '_' . $_FILES['image']['name'];
  $image_path = $upload_dir . $image_name;
  move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
}

// book 테이블에서 boid 확인
$boid = null;
if ($book_id) {
  $query_book = "SELECT boid FROM book WHERE boid = '$book_id'";
  $result_book = $mysqli->query($query_book);
  if ($result_book && $result_book->num_rows > 0) {
    $book_data = $result_book->fetch_object();
    $boid = $book_data->boid;
  }
}

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

// echo json_encode(['quiz' => $quiz_data, 'test' => $test_data]);


// 데이터베이스 연결 종료
$mysqli->close();

?>


<div class="container">
  <h2>강좌 등록</h2>
  <div class="content_bar d-flex justify-content-between align-item-center cent">
    <h3>강좌 기본 정보 입력</h3>
    <small>* 분류 설정과 강자명은 필수로 입력해야 임시 저장 가능합니다.</small>
  </div>
  <form method="POST" action="lecture_up_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="action" value="save_detail_info">
    <input type="hidden" name="leid" value="<?= $leid; ?>"> <!-- 강좌 ID 유지 -->
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
            <input type="text" name="name" id="name" class="form-control" value="<?= $username; ?>" disabled>
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
              <input name="price" id="price" type="text" class="form-control" aria-label="원">
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
                <input class="form-check-input" type="radio" name="courseType" id="isrecipe" value="recipe">
                <label class="form-check-label" for="isrecipe">레시피 강좌</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="courseType" id="isgeneral" value="general" checked>
                <label class="form-check-label" for="isgeneral">일반 강좌</label>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">강좌 설명</th>
          <td colspan="6">
            <textarea name="description" class="form-control"></textarea>
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
          <col class="col-width-160">
          <col class="col-width-516">
          <col class="col-width-160">
          <col class="col-width-516">
        </colgroup>
        <tbody>
          <tr>
            <th scope="row">강의명</th>
            <td colspan="3">
              <input name="lecture_name[]" type="text" class="form-control" placeholder="강의명을 입력해 주세요.">
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
      <div class="leplus btn d-flex justify-content-center align-items-center bg-white border rounded-3 boder-secondary cursor-pointer">
        <i class="bi bi-plus"></i>
      </div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4 mb-5">
      <button type="submit" class="btn btn-secondary">강의 등록</button>
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

    updateQuizAndTest()
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

    updateQuizAndTest()
  });

  // 소분류 선택 시에도 교재 목록 업데이트
  $('#cate3').on('change', updateBooks);


  function updateBooks() {
    const cate1 = $('#cate1').val();
    const cate2 = $('#cate2').val();
    const cate3 = $('#cate3').val();
    const title = $('#title').val(); // 강좌명 가져오기

    // 디버깅: 전달 데이터 확인
    //console.log('Updating books with:', { cate1, cate2, cate3, title });

    if (cate1 && cate2 && cate3 && title) { // 모든 값이 선택되었을 때만 실행
      $.ajax({
        url: 'bselect_update.php',
        type: 'POST',
        data: { cate1, cate2, cate3, title }, // 데이터를 객체로 전달
        dataType: 'json', // 서버에서 반환할 데이터 형식
        success: function (data) {
          //console.log('Books received:', data); // 데이터를 확인
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
      //console.warn('카테고리 또는 강좌명이 비어 있음.');
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
        url: 'quiz_test_update.php',
        type: 'POST',
        data: { cate1, cate2, cate3, title },
        dataType: 'json',
        success: function (response) {
          // 모든 퀴즈 및 시험 <select> 요소를 초기화
          $('select[name="lecture_quiz_id[]"]').html('<option value="">퀴즈를 선택해 주세요.</option>');
          $('select[name="lecture_test_id[]"]').html('<option value="">시험을 선택해 주세요.</option>');

          // 퀴즈 데이터 추가
          if (response.quiz && response.quiz.length > 0) {
            response.quiz.forEach(function (quiz) {
              $('select[name="lecture_quiz_id[]"]').append(`<option value="${quiz.exid}">${quiz.tt}</option>`);
            });
          }

          // 시험 데이터 추가
          if (response.test && response.test.length > 0) {
            response.test.forEach(function (test) {
              $('select[name="lecture_test_id[]"]').append(`<option value="${test.exid}">${test.tt}</option>`);
            });
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error:', error);
        }
      });
    }
  }

  // 이벤트 수정: 카테고리나 제목 변경 시 updateQuizAndTest 호출
  $('#cate1, #cate2, #cate3, #title').on('input change', updateQuizAndTest);

  // 새로운 강의 섹션 추가 시 <select> 요소에 데이터 업데이트
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
                              <input type="text" name="lecture_name[]" class="form-control" placeholder="강의명을 입력해 주세요.">
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
          </div>
      `;

    // 새로운 강의 섹션을 추가
    $(this).before(newLectureTemplate);

    // 새로 추가된 섹션에 대해 퀴즈 및 시험 데이터를 업데이트
    updateQuizAndTest();

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


</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>