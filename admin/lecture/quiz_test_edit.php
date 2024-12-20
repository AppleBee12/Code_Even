<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

// DB에서 카테고리 데이터 가져오기
$sql_cate = "SELECT * FROM category ORDER BY step, pcode";
$result_cate = $mysqli->query($sql_cate);

// 카테고리 초기화
$categories = [];
if ($result_cate) {
  while ($row = $result_cate->fetch_object()) {
    $categories[] = $row;
  }
} else {
  echo "카테고리 데이터를 가져오는 데 실패했습니다.";
  $categories = []; // 기본값으로 빈 배열 설정
}


$lecture_id = $data->lecture_id ?? ''; // 기존 lecture_id 가져오기

// 빈 배열로 초기화
$lectures = [];

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

  if ($result) {
    while ($row = $result->fetch_object()) { // fetch_object로 변경
      $lectures[] = $row;
    }
  }

  // JSON 형식으로 반환
  header('Content-Type: application/json');
  echo json_encode($lectures);
  exit; // AJAX 요청만 처리하고 종료
}



// 수정할 데이터 ID와 타입 가져오기
$quizId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$type = isset($_GET['type']) ? $_GET['type'] : 'quiz';

if (!$quizId || !in_array($type, ['quiz', 'test'])) {
  echo "잘못된 접근입니다.";
  exit;
}

// 테이블 선택
$tableName = ($type === 'quiz') ? 'quiz' : 'test';

// 데이터 가져오기 쿼리
$sql = "SELECT exid, cate1, cate2, cate3, title, tt, answer, pn, question, explan, pnlevel FROM $tableName WHERE exid = $quizId";
$result = $mysqli->query($sql);

// 데이터 가져오기
if ($result && $result->num_rows > 0) {
  $data = $result->fetch_object(); // fetch_object 사용
} else {
  echo "데이터를 찾을 수 없습니다.";
  exit;
}

// 기본값 설정
$cate1 = $data->cate1 ?? '';
$cate2 = $data->cate2 ?? '';
$cate3 = $data->cate3 ?? '';
$title = $data->title ?? '';
$tt = $data->tt ?? '';
$answer = $data->answer ?? '';
$pn = $data->pn ?? '';
$question = json_decode($data->question, true) ?? []; // JSON을 배열로 디코딩
$explan = $data->explan ?? '';
$pnlevel = $data->pnlevel ?? '';


// 기존 데이터 디코딩
$decodedQuestions = json_decode($data->question, true) ?? []; // JSON을 디코드하여 decodedQuestions 변수에 저장

?>

<div class="container">
  <h2><?= ($type === 'quiz') ? '퀴즈' : '시험' ?> 수정</h2>
  <div class="content_bar cent d-flex justify-content-between align-item-center">
    <h3>기본 정보 입력</h3>
    <small>* 과정이 생성된 상태(임시 저장)에서만 퀴즈 / 시험 등록이 가능합니다.</small>
  </div>
  <form action="quiz_test_edit_ok.php" method="post">
    <input type="hidden" name="type" value="<?= $type ?>">
    <input type="hidden" name="exid" value="<?= $quizId ?>">

    <!-- 기본 정보 입력 -->
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
            <div class="d-flex gap-3 justify-content-between">
              <!-- 대분류 -->
              <select name="cate1" id="cate1" class="form-select">
                <option value="" <?= $cate1 == '' ? 'selected' : '' ?>>대분류</option>
                <?php foreach ($categories as $category): ?>
                      <?php if ($category->step == 1): ?>
                            <option value="<?= $category->code ?>" <?= $cate1 == $category->code ? 'selected' : '' ?>>
                              <?= $category->name ?>
                            </option>
                      <?php endif; ?>
                <?php endforeach; ?>
              </select>

              <!-- 중분류 -->
              <select name="cate2" id="cate2" class="form-select">
                <option value="" <?= $cate2 == '' ? 'selected' : '' ?>>중분류</option>
                <?php foreach ($categories as $category): ?>
                      <?php if ($category->step == 2 && $category->pcode == $cate1): ?>
                            <option value="<?= $category->code ?>" <?= $cate2 == $category->code ? 'selected' : '' ?>>
                              <?= $category->name ?>
                            </option>
                      <?php endif; ?>
                <?php endforeach; ?>
              </select>

              <!-- 소분류 -->
              <select name="cate3" id="cate3" class="form-select">
                <option value="" <?= $cate3 == '' ? 'selected' : '' ?>>소분류</option>
                <?php foreach ($categories as $category): ?>
                      <?php if ($category->step == 3 && $category->pcode == $cate2): ?>
                            <option value="<?= $category->code ?>" <?= $cate3 == $category->code ? 'selected' : '' ?>>
                              <?= $category->name ?>
                            </option>
                      <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </td>
        </tr>
        <tr>
        <th scope="row">강좌명 <b>*</b></th>
        <td>
          <select id="lectureSelect" name="lecture_id" class="form-select">
            <option value=""><?= htmlspecialchars($title) ?></option>
            <?php foreach ($lectures as $lecture): ?>
              <option value="<?= htmlspecialchars($lecture->leid) ?>" <?= $lecture_id == $lecture->leid ? 'selected' : '' ?>>
                <?= htmlspecialchars($lecture->title) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </td>
          <th scope="row">문제 유형 <b>*</b></th>
          <td colspan="3">
            <div class="d-flex custom-gap">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="courseType" id="testType" value="test"
                  <?= ($type === 'test') ? 'checked' : '' ?>>
                <label class="form-check-label" for="testType">시험</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="courseType" id="quizType" value="quiz"
                  <?= ($type === 'quiz') ? 'checked' : '' ?>>
                <label class="form-check-label" for="quizType">퀴즈</label>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">시험지명 <b>*</b></th>
          <td colspan="6">
            <input type="text" name="tt" class="form-control" value="<?= htmlspecialchars($tt) ?>"
              placeholder="시험지명을 입력하세요">
          </td>
        </tr>
      </tbody>
    </table>
    <!-- 문제 정보 입력 -->
    <div class="content_bar cent">
      <h3><?= ($type === 'quiz') ? '퀴즈' : '시험' ?> 정보 수정</h3>
    </div>
    <div class="quiz_test">
      <table class="table">
        <colgroup>
          <col class="col-width-160">
          <col class="col-width-516">
          <col class="col-width-160">
          <col class="col-width-516">
        </colgroup>
        <tbody>
          <!-- 문제명 -->
          <tr>
            <th scope="row">문제명 <b>*</b></th>
            <td colspan="3">
              <input type="text" name="questions[0][pn]" class="form-control"
                value="<?= htmlspecialchars($data->pn ?? '') ?>" placeholder="문제의 제목을 입력해 주세요.">
            </td>
          </tr>
          <!-- 해설 -->
          <tr>
            <th scope="row">해설</th>
            <td colspan="3">
              <textarea name="questions[0][explan]" class="form-control" rows="3"
                placeholder="해설을 입력해 주세요."><?= htmlspecialchars($data->explan ?? '') ?></textarea>
            </td>
          </tr>
          <!-- 정답 -->
          <tr>
            <th scope="row">정답 <b>*</b></th>
            <td>
              <div class="d-flex gap-4">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                      <div class="form-check">
                        <input name="questions[0][answer]" class="form-check-input" type="radio" value="<?= $i ?>"
                          id="answer_<?= $i ?>" <?= ($data->answer ?? '') == $i ? 'checked' : '' ?>>
                        <label class="form-check-label" for="answer_<?= $i ?>"><?= $i ?>번</label>
                      </div>
                <?php endfor; ?>
              </div>
            </td>
          </tr>
          <!-- 문항 -->
          <tr>
            <th scope="row">문항 <b>*</b></th>
            <td colspan="3">
              <?php
              $options = $decodedQuestions ?? ['', '', '', '']; // 기본값 설정
              foreach ($options as $index => $option): ?>
                    <input name="questions[0][options][]" type="text" class="form-control mb-2"
                      value="<?= htmlspecialchars($option) ?>" placeholder="<?= $index + 1 ?>번 문항을 입력해 주세요.">
              <?php endforeach; ?>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
    <!-- 저장 및 취소 버튼 -->
    <div class="d-flex justify-content-end gap-2 mt-4 mb-5">
      <button type="submit" class="btn btn-secondary">저장</button>
      <button type="button" class="btn btn-danger" onclick="history.back()">취소</button>
    </div>
  </form>
</div>
<script>
  // 카테고리 데이터
  const categories = <?= json_encode($categories) ?>;

  // 대분류 선택 시 중분류 갱신
  $('#cate1').on('change', function () {
    const cate1 = $(this).val();
    updateCategories(cate1, '#cate2');
    $('#cate3').html('<option value="">-- 선택 --</option>'); // 소분류 초기화
    updateLectures(); // 강좌 목록 갱신
  });

  // 중분류 선택 시 소분류 갱신
  $('#cate2').on('change', function () {
    const cate2 = $(this).val();
    updateCategories(cate2, '#cate3');
    updateLectures(); // 강좌 목록 갱신
  });

  // 소분류 선택 시 강좌 목록 갱신
  $('#cate3').on('change', function () {
    updateLectures();
  });

  // 카테고리 업데이트 함수
  function updateCategories(parentCode, childSelector) {
    const $childSelect = $(childSelector);

    // 하위 카테고리 초기화
    $childSelect.html('<option value="">-- 선택 --</option>');

    // 부모 코드에 해당하는 카테고리 필터링 및 옵션 추가
    $(categories).each(function (_, cat) {
      if (cat.pcode === parentCode) {
        $childSelect.append(`<option value="${cat.code}">${cat.name}</option>`);
      }
    });
  }

  // 강좌 목록 업데이트 함수
  function updateLectures() {
    const cate1 = $('#cate1').val();
    const cate2 = $('#cate2').val();
    const cate3 = $('#cate3').val();

    if (!cate1 || !cate2 || !cate3) {
      console.error("카테고리 값이 비어 있습니다.");
      return;
    }

    $.ajax({
      url: 'qnt_lecture_update.php',
      method: 'POST',
      data: { cate1, cate2, cate3 },
      dataType: 'json',
      success: function (data) {
        const lectureSelect = $('#lectureSelect');
        lectureSelect.html('<option value="">강좌를 선택하세요</option>');

        if (data.length === 0) {
          lectureSelect.append('<option value="">강좌가 없습니다</option>');
        } else {
          data.forEach(lecture => {
            const selected = lecture.leid === <?= json_encode($lecture_id) ?> ? 'selected' : '';
            lectureSelect.append(`<option value="${lecture.leid}" ${selected}>${lecture.title}</option>`);
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

  // 문제 유형(quiz/test)에 따른 버튼 상태 및 문제 추가 기능
  $(document).ready(function () {
    const addButton = $('.leplus');

    // 문제 유형 변경 시 문제 추가 버튼 상태 제어
    $('input[name="courseType"]').on('change', function () {
      const selectedType = $(this).val();

      if (selectedType === 'quiz') {
        // 퀴즈: 추가 버튼 비활성화
        addButton.addClass('disabled').css({
          'pointer-events': 'none',
          'opacity': '0.5',
        });
      } else if (selectedType === 'test') {
        // 시험: 추가 버튼 활성화
        addButton.removeClass('disabled').css({
          'pointer-events': 'auto',
          'opacity': '1',
        });
      }
    });

    // 초기 상태 설정
    const defaultType = $('input[name="courseType"]:checked').val();
    if (defaultType === 'quiz') {
      addButton.addClass('disabled').css({
        'pointer-events': 'none',
        'opacity': '0.5',
      });
    } else {
      addButton.removeClass('disabled').css({
        'pointer-events': 'auto',
        'opacity': '1',
      });
    }

</script>



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>