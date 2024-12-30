<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// DB에서 카테고리 데이터 가져오기
$sql_cate = "SELECT * FROM category ORDER BY step, pcode";
$result_cate = $mysqli->query($sql_cate);

$categories = [];
while ($row = $result_cate->fetch_object()) {
  $categories[] = $row;
}

// AJAX 요청 처리
if (isset($_GET['action']) && $_GET['action'] == 'get_lectures') {
  $cate1 = $_GET['cate1'];
  $cate2 = $_GET['cate2'];
  $cate3 = $_GET['cate3'];

  // 카테고리에 해당하고 state가 0인 강좌만 가져오기
  $sql = "SELECT leid, title FROM lecture WHERE cate1 = ? AND cate2 = ? AND cate3 = ? AND state = 0";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sss", $cate1, $cate2, $cate3);
  $stmt->execute();
  $result = $stmt->get_result();

  $lectures = [];
  while ($row = $result->fetch_assoc()) {
    $lectures[] = $row;
  }

  // JSON 형식으로 반환
  header('Content-Type: application/json');
  echo json_encode($lectures);
  exit; // AJAX 요청만 처리하고 나머지 HTML은 출력하지 않도록 종료
}
?>

<div class="container">
  <h2>퀴즈 / 시험 등록</h2>
  <div class="content_bar cent d-flex justify-content-between align-item-center">
    <h3>
      기본 정보 입력
    </h3>
    <small>* 과정이 생성된 상태(임시 저장)에서만 퀴즈 / 시험 등록이 가능합니다.</small>
  </div>
  <form action="quiz_test_up_ok.php" method="post">
    <table class="table">
      <colgroup>
        <col class="col-width-160">
        <col class="col-width-516">
        <col class="col-width-160">
        <col class="col-width-516">
      </colgroup>
      <tbody>
        <tr>
          <th scope="row">분류 설정 <b>*</b></th>
          <td colspan="3">
            <div class="d-flex gap-3 justify-content-bettwen">
              <select name="cate1" id="cate1" class="form-select" aria-label="대분류">
                <option value="" selected>대분류</option>
                <?php foreach ($categories as $category) {
                  if ($category->step == 1) {
                    echo "<option value='{$category->code}'>{$category->name}</option>";
                  }
                } ?>
              </select>
              <select name="cate2" id="cate2" class="form-select" aria-label="Default select example">
                <option selected value="">중분류</option>
              </select>
              <select name="cate3" id="cate3" class="form-select" aria-label="Default select example">
                <option selected value="">소분류</option>
              </select>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">강좌명 <b>*</b></th>
          <td>
            <select id="lectureSelect" name="lecture_id" class="form-select">
              <option value="">SELECT</option>
              <?php
              $sql = "SELECT leid, title FROM lecture WHERE state = 1";
              $result = $mysqli->query($sql);
              while ($row = $result->fetch_object()) { // fetch_object로 가져오기
                echo "<option value='{$row->leid}'>{$row->title}</option>";
              }
              ?>
            </select>
          </td>
          <th scope="row">문제 유형 <b>*</b></th>
          <td>
            <div class="d-flex custom-gap">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="courseType" id="recipeCourse" value="exam">
                <label class="form-check-label" for="recipeCourse">시험</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="courseType" id="generalCourse" value="quiz" checked>
                <label class="form-check-label" for="generalCourse">퀴즈</label>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">시험지명 <b>*</b></th>
          <td colspan="3">
            <input type="text" name="tt" class="form-control" placeholder="HTML, CSS 기초 시험">
          </td>
        </tr>
      </tbody>
    </table>

    <!-- 강의 설정 영역 -->
    <div class="content_bar cent">
      <h3>퀴즈 / 시험 정보 입력</h3>
    </div>
    <div class="quiz_test">
      <div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
        <h5 class="mb-0">1번</h5>
        <i class="bi bi-x" onclick="removeQuiz(this)"></i>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <th scope="row">문제명 <b>*</b></th>
            <td colspan="3">
              <input name="pn[1]" type="text" class="form-control" placeholder="문제의 제목을 입력해 주세요.">
            </td>
          </tr>
          <tr>
            <th scope="row">해설</th>
            <td colspan="3">
              <textarea name="explan[1]" class="form-control" rows="3" placeholder="해설을 입력해 주세요."></textarea>
            </td>
          </tr>
          <tr>
            <th scope="row">정답 <b>*</b></th>
            <td>
              <div class="d-flex gap-4">
                <div class="form-check">
                  <input name="answer[1]" class="form-check-input" type="radio" value="1" id="answer1_1">
                  <label class="form-check-label" for="answer1_1">1번</label>
                </div>
                <div class="form-check">
                  <input name="answer[1]" class="form-check-input" type="radio" value="2" id="answer2_1">
                  <label class="form-check-label" for="answer2_1">2번</label>
                </div>
                <div class="form-check">
                  <input name="answer[1]" class="form-check-input" type="radio" value="3" id="answer3_1">
                  <label class="form-check-label" for="answer3_1">3번</label>
                </div>
                <div class="form-check">
                  <input name="answer[1]" class="form-check-input" type="radio" value="4" id="answer4_1">
                  <label class="form-check-label" for="answer4_1">4번</label>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <th scope="row">문항 <b>*</b></th>
            <td colspan="3">
              <input name="question[1][]" type="text" class="form-control mb-2" placeholder="1번 문항을 입력해 주세요.">
              <input name="question[1][]" type="text" class="form-control mb-2" placeholder="2번 문항을 입력해 주세요.">
              <input name="question[1][]" type="text" class="form-control mb-2" placeholder="3번 문항을 입력해 주세요.">
              <input name="question[1][]" type="text" class="form-control mb-2" placeholder="4번 문항을 입력해 주세요.">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div
      class="leplus btn d-flex justify-content-center align-items-center bg-white border rounded-3 boder-secondary cursor-pointer">
      <i class="bi bi-plus"></i>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4 mb-5">
      <input type="hidden" name="final_save">
      <button type="submit" class="btn btn-secondary">등록</button>
      <button type="button" class="btn btn-danger">취소</button>
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
  });

  // 중분류 선택 -> 소분류 업데이트
  $('#cate2').on('change', function () {
    const cate2 = $(this).val();

    if (cate2) {
      const filterCate3 = categories.filter(category => category.step == 3 && category.pcode == cate2);

      $('#cate3').html('<option value="">소분류</option>')
      filterCate3.forEach(category => {
        $('#cate3').append(`<option value="${category.code}">${category.name}</option>`);
      });

    } else {

      $('#cate3').html('<option value="">소분류</option>');

    }
  });

  // 강좌 목록 업데이트 함수
  function updateLectures() {
    const cate1 = $('#cate1').val();
    const cate2 = $('#cate2').val();
    const cate3 = $('#cate3').val();

    // 카테고리 값 확인
    if (!cate1 || !cate2 || !cate3) {
      console.error("카테고리 값이 비어 있습니다.");
      return;
    }

    // Ajax 요청
    $.ajax({
      url: 'qnt_lecture_update.php',
      method: 'POST',
      data: { cate1, cate2, cate3 },
      dataType: 'json',
      success: function (data) {
        console.log("응답 데이터:", data);
        $('#lectureSelect').html('<option value="">SELECT</option>'); // 초기화
        if (data.length === 0) {
          $('#lectureSelect').append('<option value="">강좌가 없습니다</option>');
        } else {
          data.forEach(lecture => {
            $('#lectureSelect').append(`<option value="${lecture.leid}">${lecture.title}</option>`);
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX 오류:", xhr.responseText);
        alert('강좌 데이터를 가져오는 중 오류가 발생했습니다.');
      }
    });
  }

  // 카테고리 변경 이벤트 핸들러 등록
  $('#cate1, #cate2, #cate3').on('change', updateLectures);


  $(document).ready(function () {
    // 문제 유형 변경 시 문제 추가 버튼 상태 제어
    $('input[name="courseType"]').on('change', function () {
      const selectedType = $(this).val();
      const addButton = $('.leplus'); // 문제 추가 버튼

      if (selectedType === 'quiz') {
        console.log('퀴즈가 선택되었습니다.');
        addButton.addClass('disabled').css({
          'pointer-events': 'none',
          'opacity': '0.5',
        }); // 버튼 비활성화
      } else if (selectedType === 'exam') {
        console.log('시험이 선택되었습니다.');
        addButton.removeClass('disabled').css({
          'pointer-events': 'auto',
          'opacity': '1',
        }); // 버튼 활성화
      }
    });

    // 초기 상태 설정
    const defaultType = $('input[name="courseType"]:checked').val();
    const addButton = $('.leplus');
    if (defaultType === 'quiz') {
      addButton.addClass('disabled').css({
        'pointer-events': 'none',
        'opacity': '0.5',
      }); // 퀴즈 선택 시 초기 상태에서 버튼 비활성화
    } else {
      addButton.removeClass('disabled').css({
        'pointer-events': 'auto',
        'opacity': '1',
      }); // 시험 선택 시 초기 상태에서 버튼 활성화
    }
  });





  // 문제 유형
  $(document).ready(function () {
    // 라디오 버튼 클릭 시 값 변경 감지
    $('input[name="courseType"]').on('change', function () {
      const selectedType = $(this).val();
      console.log('선택된 문제 유형:', selectedType);

      // 선택된 유형에 따라 추가 로직 작성 가능
      if (selectedType === 'exam') {
        console.log('시험 유형이 선택되었습니다.');
        // 필요한 경우 시험 유형에 따른 처리 로직 추가
      } else if (selectedType === 'quiz') {
        console.log('퀴즈 유형이 선택되었습니다.');
        // 필요한 경우 퀴즈 유형에 따른 처리 로직 추가
      }
    });

    // 폼 전송 시 선택된 문제 유형 확인
    $('#quizTestForm').on('submit', function (e) {
      const selectedType = $('input[name="courseType"]:checked').val();
      if (!selectedType) {
        alert('문제 유형을 선택해주세요.');
        e.preventDefault(); // 폼 전송 막기
        return false;
      }
      console.log('폼 전송: 선택된 유형은', selectedType);
    });
  });

  // 새로운 퀴즈 섹션 추가 시 요소에 데이터 업데이트
  $('.leplus').on('click', function () {
    const quizTestCount = $('.quiz_test').length + 1; // 현재 문제 개수 + 1
    const newQuizTestTemplate = `
    <div class="quiz_test">
      <div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
        <h5 class="mb-0">${quizTestCount}번</h5>
        <i class="bi bi-x" onclick="removeQuiz(this)"></i>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <th scope="row">문제명 <b>*</b></th>
            <td colspan="3">
              <input name="pn[${quizTestCount}]" type="text" class="form-control" placeholder="문제의 제목을 입력해 주세요.">
            </td>
          </tr>
          <tr>
            <th scope="row">해설</th>
            <td colspan="3">
              <textarea name="explan[${quizTestCount}]" class="form-control" rows="3" placeholder="해설을 입력해 주세요."></textarea>
            </td>
          </tr>
          <tr>
            <th scope="row">정답 <b>*</b></th>
            <td>
              <div class="d-flex gap-4">
                <div class="form-check">
                  <input name="answer[${quizTestCount}]" class="form-check-input" type="radio" value="1" id="answer1_${quizTestCount}">
                  <label class="form-check-label" for="answer1_${quizTestCount}">1번</label>
                </div>
                <div class="form-check">
                  <input name="answer[${quizTestCount}]" class="form-check-input" type="radio" value="2" id="answer2_${quizTestCount}">
                  <label class="form-check-label" for="answer2_${quizTestCount}">2번</label>
                </div>
                <div class="form-check">
                  <input name="answer[${quizTestCount}]" class="form-check-input" type="radio" value="3" id="answer3_${quizTestCount}">
                  <label class="form-check-label" for="answer3_${quizTestCount}">3번</label>
                </div>
                <div class="form-check">
                  <input name="answer[${quizTestCount}]" class="form-check-input" type="radio" value="4" id="answer4_${quizTestCount}">
                  <label class="form-check-label" for="answer4_${quizTestCount}">4번</label>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <th scope="row">문항 <b>*</b></th>
            <td colspan="3">
              <input name="question[${quizTestCount}][]" type="text" class="form-control mb-2" placeholder="1번 문항을 입력해 주세요.">
              <input name="question[${quizTestCount}][]" type="text" class="form-control mb-2" placeholder="2번 문항을 입력해 주세요.">
              <input name="question[${quizTestCount}][]" type="text" class="form-control mb-2" placeholder="3번 문항을 입력해 주세요.">
              <input name="question[${quizTestCount}][]" type="text" class="form-control mb-2" placeholder="4번 문항을 입력해 주세요.">
            </td>
          </tr>
        </tbody>
      </table>
    </div>`;

    $(this).before(newQuizTestTemplate);
    reorderQuizzes();
    
  });


  // 삭제 함수
  function removeQuiz(element) {
    $(element).closest('.quiz_test').remove();
    reorderQuizzes();
  }

  function reorderQuizzes() {
    $('.quiz_test').each(function (index) {
      $(this).find('h5').text(`${index + 1}번`);
    });
  }

</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>