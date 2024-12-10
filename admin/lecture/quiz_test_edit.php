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
?>

<div class="container">
  <h2><?= ($type === 'quiz') ? '퀴즈' : '시험' ?> 수정</h2>
  <div class="content_bar cent d-flex justify-content-between align-item-center">
    <h3>기본 정보 입력</h3>
    <small>* 과정이 생성된 상태(임시 저장)에서만 퀴즈 / 시험 등록이 가능합니다.</small>
  </div>
  <form action="quiz_test_update_ok.php" method="post">
    <input type="hidden" name="exid" value="<?= $quizId ?>">
    <input type="hidden" name="type" value="<?= $type ?>">

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
              <?php
              // $categories 배열이 비어있는 경우 기본 메시지 출력
              if (!empty($categories)) {
                foreach ($categories as $category) {
                  if ($category->step == 1) { // 대분류만 출력
                    $selected = ($cate1 == $category->code) ? 'selected' : '';
                    echo "<option value='{$category->code}' {$selected}>{$category->name}</option>";
                  }
                }
              } else {
                echo "<option value=''>카테고리가 없습니다</option>";
              }
              ?>
            </select>

            <!-- 중분류 -->
            <select name="cate2" id="cate2" class="form-select">
              <option value="" <?= $cate2 == '' ? 'selected' : '' ?>>중분류</option>
              <?php
              // 중분류 목록 동적으로 출력
              if (!empty($categories)) {
                foreach ($categories as $category) {
                  if ($category->step == 2 && $category->pcode == $cate1) { // 대분류(cate1)에 종속된 중분류만 출력
                    $selected = ($cate2 == $category->code) ? 'selected' : '';
                    echo "<option value='{$category->code}' {$selected}>{$category->name}</option>";
                  }
                }
              }
              ?>
            </select>

            <!-- 소분류 -->
            <select name="cate3" id="cate3" class="form-select">
              <option value="" <?= $cate3 == '' ? 'selected' : '' ?>>소분류</option>
              <?php
              // 소분류 목록 동적으로 출력
              if (!empty($categories)) {
                foreach ($categories as $category) {
                  if ($category->step == 3 && $category->pcode == $cate2) { // 중분류(cate2)에 종속된 소분류만 출력
                    $selected = ($cate3 == $category->code) ? 'selected' : '';
                    echo "<option value='{$category->code}' {$selected}>{$category->name}</option>";
                  }
                }
              }
              ?>
            </select>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">강좌명 <b>*</b></th>
        <td>
          <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($title) ?>" placeholder="강좌명을 입력하세요">
        </td>
        <th scope="row">문제 유형 <b>*</b></th>
          <td colspan="3">
            <div class="d-flex custom-gap">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="courseType" id="quizType" value="quiz" <?= ($type === 'quiz') ? 'checked' : '' ?>>
                <label class="form-check-label" for="quizType">퀴즈</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="courseType" id="testType" value="test" <?= ($type === 'test') ? 'checked' : '' ?>>
                <label class="form-check-label" for="testType">시험</label>
              </div>
            </div>
          </td>
        </tr>
      <tr>
        <th scope="row">시험지명 <b>*</b></th>
        <td>
          <input type="text" name="tt" class="form-control" value="<?= htmlspecialchars($tt) ?>" placeholder="시험지명을 입력하세요">
        </td>
      </tr>
    </tbody>
  </table>
        <!-- 문제 정보 입력 -->
        <div class="content_bar cent">
          <h3><?= ($type === 'quiz') ? '퀴즈' : '시험' ?> 정보 수정</h3>
        </div>
        <div class="quiz_test">
          <?php foreach ($questions as $index => $question) { ?>
            <div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
              <h5 class="mb-0"><?= $index + 1 ?>번</h5>
              <i class="bi bi-x" onclick="removeQuiz(this)"></i>
            </div>
            <table class="table">
              <colgroup>
                <col class="col-width-160">
                <col class="col-width-516">
                <col class="col-width-160">
                <col class="col-width-516">
              </colgroup>
          <tr>
            <th scope="row">문제명 <b>*</b></th>
            <td colspan="3">
              <input type="text" name="pn" class="form-control" value="<?= htmlspecialchars($pn) ?>" placeholder="문제명을 입력하세요">
            </td>
          </tr>
          <tr>
            <th scope="row">문항 <b>*</b></th>
            <td colspan="3">
              <?php foreach ($question as $index => $option) { ?>
                    <input name="question[]" type="text" class="form-control mb-2" value="<?= htmlspecialchars($option) ?>" placeholder="문항 <?= $index + 1 ?>을 입력하세요">
              <?php } ?>
            </td>
          </tr>
          <tr>
            <th scope="row">정답 <b>*</b></th>
            <td>
              <div class="d-flex gap-4">
                <?php
                // 정답 라디오 버튼 생성
                for ($i = 1; $i <= 4; $i++) {
                  $checked = ($answer == $i) ? 'checked' : ''; // 기존 선택된 값 유지
                  echo "
                  <div class='form-check'>
                    <input name='answer' class='form-check-input' type='radio' value='{$i}' id='answer{$i}' {$checked}>
                    <label class='form-check-label' for='answer{$i}'>{$i}번</label>
                  </div>
                  ";
                }
                ?>
              </div>
            </td>
          </tr>
          <tr>
            <th scope="row">해설</th>
            <td colspan="3">
              <textarea name="questions[<?= $index ?>][explan]" class="form-control" rows="3" placeholder="해설을 입력하세요"><?= htmlspecialchars($question['explan']) ?></textarea>
            </td>
          </tr>
        </tbody>
      </table>
    <?php } ?>
  </div>

  <!-- 추가 버튼 -->
  <div class="leplus btn d-flex justify-content-center align-items-center bg-white border rounded-3 border-secondary cursor-pointer">
    <i class="bi bi-plus"></i>
  </div>

<script>
  // 카테고리 연동 스크립트
  const categories = <?= json_encode($categories) ?>;

  // 대분류 선택 시 중분류 갱신
  $('#cate1').on('change', function () {
    const cate1 = $(this).val();
    updateCategories(cate1, '#cate2');
    $('#cate3').html('<option value="">-- 선택 --</option>'); // 소분류 초기화
  });

  // 중분류 선택 시 소분류 갱신
  $('#cate2').on('change', function () {
    const cate2 = $(this).val();
    updateCategories(cate2, '#cate3');
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
</script>



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>
