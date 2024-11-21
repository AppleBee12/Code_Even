<?php

  $title = "강좌 수정";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

  // 강좌 ID 가져오기
  $leid = isset($_GET['id']) ? intval($_GET['id']) : null; // 'id'로 변경

  if (!$leid) {
    echo "<script>alert('잘못된 접근입니다.'); location.href = 'lecture_list.php';</script>";
    exit;
  }

  // 카테고리 데이터 가져오기
  $sql_cate = "SELECT * FROM category ORDER BY step, pcode";
  $result_cate = $mysqli->query($sql_cate);
  $categories = [];
  while ($row = $result_cate->fetch_object()) {
      $categories[] = $row;
  }


  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 폼 데이터 수집
    $leid = $_POST['leid'] ?? null;
    $title = $_POST['title'] ?? null;
    $cate1 = $_POST['cate1'] ?? null;
    $cate2 = $_POST['cate2'] ?? null;
    $cate3 = $_POST['cate3'] ?? null;
    $price = $_POST['price'] ?? 0;
    $period = $_POST['period'] ?? 30;
    $isrecipe = isset($_POST['courseType']) && $_POST['courseType'] === 'isrecipe' ? 1 : 0;
    $isgeneral = isset($_POST['courseType']) && $_POST['courseType'] === 'isgeneral' ? 1 : 0;
    $boid = $_POST['book'] ?? null; // 선택된 교재 ID
    $imagePath = $lecture->image; // 기존 이미지 경로 유지

    // 강좌 데이터 업데이트
    $sql_update = "
        UPDATE lecture 
        SET cate1 = ?, cate2 = ?, cate3 = ?, title = ?, price = ?, period = ?, isrecipe = ?, isgeneral = ?, boid = ?, image = ?
        WHERE leid = ?
    ";
    $stmt = $mysqli->prepare($sql_update);
    $stmt->bind_param(
        "ssssiiisisi",
        $cate1,
        $cate2,
        $cate3,
        $title,
        $price,
        $period,
        $isrecipe,
        $isgeneral,
        $boid,
        $imagePath,
        $leid
    );
    if ($stmt->execute()) {
        echo "<script>alert('강좌가 성공적으로 수정되었습니다.'); location.href = 'lecture_list.php';</script>";
    } else {
        echo "<script>alert('수정에 실패했습니다: " . $stmt->error . "'); history.back();</script>";
    }
    $stmt->close();

    $books = [];
    $sql = "
    SELECT l.*, b.title AS book_title, b.boid AS book_id
    FROM lecture l
    LEFT JOIN book b ON l.boid = b.boid
    WHERE l.leid = ?
    ";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $leid);
    $stmt->execute();
    $result = $stmt->get_result();
    $lecture = $result->fetch_object();


    // 선택된 교재 ID 설정 (예: 첫 번째 교재를 기본 선택으로 처리)
    if (!empty($books)) {
        $selectedBookId = $books[0]->boid; // 첫 번째 교재 ID를 기본 값으로 설정
    }
  }


    // 강좌에 연결된 동영상 정보 가져오기
    $lecture_videos = [];
    $sql_videos = "SELECT * FROM lecture WHERE leid = ?";
    $stmt = $mysqli->prepare($sql_videos);
    $stmt->bind_param('i', $leid); // $leid는 강좌 ID
    $stmt->execute();
    $result_videos = $stmt->get_result();

    while ($row = $result_videos->fetch_assoc()) {
        $lecture_videos[] = $row;
    }
    $stmt->close();




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
        echo "<pre>";
          print_r($_POST);
        echo "</pre>";
        // echo "<script>alert('분류와 강좌명은 필수 입력 항목입니다.');</script>";
        exit;
    }


    if (!is_numeric($price) || $price < 0) {
        echo "<script>alert('수강료는 0 이상의 숫자여야 합니다.');</script>";
        exit;
    }

    // 강좌 데이터 업데이트 쿼리
    $sql_update = "
      UPDATE lecture 
      SET cate1 = ?, cate2 = ?, cate3 = ?, title = ?, price = ?, period = ?, isrecipe = ?, isgeneral = ?, image = ?
      WHERE leid = ?
    ";

    if ($stmt = $mysqli->prepare($sql_update)) {
      $stmt->bind_param(
        "ssssiiisii",
        $cate1,
        $cate2,
        $cate3,
        $title,
        $price,
        $period,
        $isrecipe,
        $isgeneral,
        $imagePath,
        $leid
      );

      // 쿼리 실행
      if ($stmt->execute()) {
        echo "<script>alert('강좌가 수정되었습니다.'); location.href = 'lecture_list.php';</script>";
      } else {
        echo "<script>alert('수정에 실패했습니다: " . $stmt->error . "');</script>";
      }
      $stmt->close();
    } else {
      echo "<script>alert('쿼리 준비에 실패했습니다: " . $mysqli->error . "');</script>";
    }
  

  // // 강좌에 등록된 퀴즈와 시험 데이터를 불러오는 코드
  // $selected_quiz = [];
  // $selected_test = [];

  // // 강좌에 연결된 퀴즈 가져오기
  // $sql_selected_quiz = "SELECT quiz_id FROM quiz WHERE lecture_id = ?";
  // $stmt_quiz = $mysqli->prepare($sql_selected_quiz);
  // $stmt_quiz->bind_param('i', $leid); // $leid는 강좌 ID
  // $stmt_quiz->execute();
  // $result_selected_quiz = $stmt_quiz->get_result();
  // while ($row = $result_selected_quiz->fetch_assoc()) {
  //     $selected_quiz[] = $row['quiz_id'];
  // }
  // $stmt_quiz->close();

  // // 강좌에 연결된 시험 가져오기
  // $sql_selected_test = "SELECT test_id FROM test WHERE lecture_id = ?";
  // $stmt_test = $mysqli->prepare($sql_selected_test);
  // $stmt_test->bind_param('i', $leid); // $leid는 강좌 ID
  // $stmt_test->execute();
  // $result_selected_test = $stmt_test->get_result();
  // while ($row = $result_selected_test->fetch_assoc()) {
  //     $selected_test[] = $row['test_id'];
  // }
  // $stmt_test->close();



?>
  <div class="container">
    <h2>강좌 수정</h2>
    <div class="content_bar d-flex justify-content-between align-item-center cent">
      <h3>강좌 기본 정보 입력</h3>
      <small>* 분류 설정과 강자명은 필수로 입력해야 임시 저장 가능합니다.</small>
    </div>
    <form method="POST" action="lecture_final_ok.php" enctype="multipart/form-data">
      <input type="hidden" name="leid" value="<?= $lecture->leid; ?>">
      <table class="table">
        <tbody>
          <tr>
            <th scope="row">분류 설정 <b>*</b></th>
            <td colspan="2">
              <select name="cate1" id="cate1" class="form-select" aria-label="대분류">
                <option value="" disabled>대분류</option>
                <?php foreach ($categories as $category) {
                    if ($category->step == 1) {
                        $selected = $lecture->cate1 === $category->code ? 'selected' : '';
                        echo "<option value='{$category->code}' $selected>{$category->name}</option>";
                    }
                } ?>
              </select>
            </td>
            <td colspan="2">
              <select name="cate2" id="cate2" class="form-select" aria-label="중분류">
                <option value="" disabled>중분류</option>
                <?php foreach ($categories as $category) {
                    if ($category->step == 2) {
                        $selected = $lecture->cate2 === $category->code ? 'selected' : '';
                        echo "<option value='{$category->code}' $selected>{$category->name}</option>";
                    }
                } ?>
              </select>
            </td>
            <td colspan="2">
              <select name="cate3" id="cate3" class="form-select" aria-label="소분류">
                <option value="" disabled>소분류</option>
                <?php foreach ($categories as $category) {
                    if ($category->step == 3) {
                        $selected = $lecture->cate3 === $category->code ? 'selected' : '';
                        echo "<option value='{$category->code}' $selected>{$category->name}</option>";
                    }
                } ?>
              </select>
            </td>
          </tr>
          <tr>
            <th scope="row">강좌명 <b>*</b></th>
            <td colspan="6">
              <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($lecture->title); ?>" required>
            </td>
          </tr>
          <tr>
            <th scope="row">강사명 <b>*</b></th>
            <td colspan="2">
              <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($lecture->name); ?>" readonly>
            </td>
            <td name="image" class="box_container" colspan="4" rowspan="5">
              <div class="box">
                <span>강좌 썸네일 이미지를 선택해주세요.</span>
                <div class="image">
                  <img src="<?= $lecture->image; ?>" alt="강좌 이미지" style="max-width: 100%;">
                </div>
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
                <input name="price" type="text" class="form-control" value="<?= $lecture->price; ?>" required>
                <span class="input-group-text">원</span>
              </div>
            </td>
          </tr>
          <tr>
          <th scope="row">교재 선택 <b>*</b></th>
          <td colspan="2">
            <select name="book" id="book" class="form-select">
                <option value="0">SELECT</option>
                <option value="1" <?= isset($lecture->boid) && $lecture->boid == 1 ? 'selected' : ''; ?>>없음</option>
                <?php foreach ($books as $book): ?>
                    <option value="<?= $book->boid; ?>" <?= isset($lecture->boid) && $lecture->boid == $book->boid ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($book->title); ?>
                    </option>
                <?php endforeach; ?>
            </select>
              <small class="text-muted">* 필요한 교재가 있다면 교재 목록에서 우선 등록해 주세요.</small>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="period">교육 기간 <b>*</b></label></th>
            <td colspan="2">
              <select id="period" name="period" class="form-select">
                <option value="30" <?= $lecture->period === 30 ? 'selected' : ''; ?>>30일</option>
                <option value="60" <?= $lecture->period === 60 ? 'selected' : ''; ?>>60일</option>
                <option value="90" <?= $lecture->period === 90 ? 'selected' : ''; ?>>90일</option>
                <option value="120" <?= $lecture->period === 120 ? 'selected' : ''; ?>>120일</option>
                <option value="150" <?= $lecture->period === 150 ? 'selected' : ''; ?>>150일</option>
                <option value="180" <?= $lecture->period === 180 ? 'selected' : ''; ?>>180일</option>
              </select>
              <small class="text-muted">* 교육 기간은 30일 단위로 설정 가능합니다.</small>
            </td>
          </tr>
          <tr>
            <th scope="row">강좌 유형 <b>*</b></th>
            <td colspan="4">
              <div class="d-flex gap-4">
                <div class="form-check">
                  <input name="courseType" class="form-check-input" type="radio" id="recipeCourse" value="isrecipe" <?= $lecture->isrecipe ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="recipeCourse">레시피 강좌</label>
                </div>
                <div class="form-check">
                  <input name="courseType" class="form-check-input" type="radio" id="generalCourse" value="isgeneral" <?= $lecture->isgeneral ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="generalCourse">일반 강좌</label>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="content_bar cent">
      <h3>강의 설정</h3>
    </div>
    <div>
      <?php foreach ($lecture_videos as $index => $video): ?>
        <div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
          <h5 class="mb-0"><?= ($index + 1); ?>강</h5>
          <i class="bi bi-x" onclick="removeVideo(this, <?= $video['id']; ?>)"></i>
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
                <input type="text" name="lecture_name[]" class="form-control" value="<?= htmlspecialchars($video['name']); ?>" required>
              </td>
            </tr>
            <tr>
              <th scope="row">강의 설명</th>
              <td colspan="3">
                <textarea name="lecture_description[]" class="form-control" rows="3"><?= htmlspecialchars($video['description']); ?></textarea>
              </td>
            </tr>
            <tr>
              <th scope="row">퀴즈 선택</th>
              <td>
                <select name="quiz_id[]" class="form-select">
                  <option value="">퀴즈를 선택해 주세요.</option>
                  <?php foreach ($quiz_data as $quiz): ?>
                    <option value="<?= $quiz['id']; ?>" <?= $video['quiz_id'] == $quiz['id'] ? 'selected' : ''; ?>>
                      <?= htmlspecialchars($quiz['title']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
              <th scope="row">시험 선택</th>
              <td>
                <select name="test_id[]" class="form-select">
                  <option value="">시험을 선택해 주세요.</option>
                  <?php foreach ($test_data as $test): ?>
                    <option value="<?= $test['id']; ?>" <?= $video['test_id'] == $test['id'] ? 'selected' : ''; ?>>
                      <?= htmlspecialchars($test['title']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
            </tr>
            <tr>
              <th scope="row">실습 파일 등록</th>
              <td>
                <input name="practice_file[]" class="form-control" type="file">
                <?php if (!empty($video['practice_file'])): ?>
                  <small class="text-muted">현재 파일: <?= $video['practice_file']; ?></small>
                <?php endif; ?>
              </td>
              <th scope="row">동영상 주소 <b>*</b></th>
              <td>
                <div class="input-group">
                  <span class="input-group-text">https://</span>
                  <input type="text" name="video_url[]" class="form-control" value="<?= htmlspecialchars($video['video_url']); ?>" required>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      <?php endforeach; ?>
      <div class="leplus d-flex justify-content-center align-items-center bg-white border rounded-3 boder-secondary" onclick="addVideoRow()">
        <i class="bi bi-plus"></i>
      </div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4 mb-5">
      <button type="submit" class="btn btn-primary">수정 완료</button>
      <button type="button" class="btn btn-danger" onclick="window.location.href='/lecture_list.php'">취소</button>
    </div>
  </form>
  </div>
<script>
  // 비디오 삭제
  $(document).on('click', '.bi-x', function () {
      const $videoRow = $(this).closest('.video'); // 삭제하려는 강의의 div
      const videoId = $(this).data('video-id'); // `data-video-id` 속성에서 강의 ID 가져오기

      if (confirm('정말로 이 강의를 삭제하시겠습니까?')) {
          // UI에서 제거
          $videoRow.next('table').remove(); // 해당 강의와 관련된 테이블 삭제
          $videoRow.remove();

          // 서버로 삭제 요청 보내기
          if (videoId) {
              $.ajax({
                  url: `/delete_lecture_video.php?id=${videoId}`,
                  method: 'GET',
                  success: function (response) {
                      console.log('삭제 완료:', response);
                  },
                  error: function (xhr, status, error) {
                      console.error('삭제 실패:', error);
                      alert('강의 삭제 중 문제가 발생했습니다.');
                  }
              });
          }

          // 강의 번호 재정렬
          reorderLectures();
      }
  });

// 새로운 강의 추가
$('.leplus').on('click', function () {
    const lectureCount = $('.video').length + 1; // 현재 강의 개수 + 1
    const newVideoTemplate = `
        <div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
            <h5 class="mb-0">${lectureCount}강</h5>
            <i class="bi bi-x" data-video-id=""></i>
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
                            <?php foreach ($quiz_data as $quiz): ?>
                                <option value="<?= $quiz['id']; ?>"><?= htmlspecialchars($quiz['title']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <th scope="row">시험 선택</th>
                    <td>
                        <select name="test_id[]" class="form-select">
                            <option value="">시험을 선택해 주세요.</option>
                            <?php foreach ($test_data as $test): ?>
                                <option value="<?= $test['id']; ?>"><?= htmlspecialchars($test['title']); ?></option>
                            <?php endforeach; ?>
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
    `;

    // 새로운 강의 템플릿을 추가
    $(this).before(newVideoTemplate);
  });

  // 강의 번호 재정렬
  function reorderLectures() {
    $('.video').each(function (index) {
      $(this).find('h5').text(`${index + 1}강`);
    });
  }

  // 카테고리 변경 시 교재 목록 업데이트
  function updateBooks() {
    const cate1 = $('#cate1').val();
    const cate2 = $('#cate2').val();
    const cate3 = $('#cate3').val();
    const title = $('#title').val();

    if (cate1 && cate2 && cate3 && title) {
        $.ajax({
            url: 'bselect_update.php',
            type: 'POST',
            data: { cate1, cate2, cate3, title },
            success: function (response) {
                const books = JSON.parse(response);
                const currentBookId = <?= json_encode($lecture->boid ?? null); ?>; // 현재 선택된 boid

                $('#book').html('<option value="0">SELECT</option>');
                books.forEach(book => {
                    const selected = book.boid == currentBookId ? 'selected' : '';
                    $('#book').append(`<option value="${book.boid}" ${selected}>${book.title}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('교재 데이터를 불러오는 중 문제가 발생했습니다.');
            }
        });
    } else {
        $('#book').html('<option value="0">SELECT</option>');
    }
  }


  // 카테고리 선택 시 교재 목록 업데이트 트리거
  $('#cate1, #cate2, #cate3').on('change', updateBooks);





</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>