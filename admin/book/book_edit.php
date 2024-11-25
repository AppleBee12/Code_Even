<?php

$title = "교재 수정";

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

// 현재 로그인된 사용자 세션 값 가져오기
$session_userid = $_SESSION['AUID'] ?? null;
$session_username = $_SESSION['AUNAME'] ?? null;

// 세션 값 검증
if (!isset($_SESSION['AUID']) || !isset($_SESSION['AUNAME'])) {
  echo "<script>alert('로그인 정보가 없습니다. 다시 로그인해 주세요.');</script>";
  echo "<script>location.href='/CODE_EVEN/admin/login.php';</script>";
  exit;
}

// 수정할 교재의 ID 가져오기
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($book_id <= 0) {
  echo "<script>alert('잘못된 요청입니다.');</script>";
  echo "<script>location.href='/CODE_EVEN/admin/book_list.php';</script>";
  exit;
}

// DB에서 교재 데이터 가져오기
$sql_book = "SELECT * FROM book WHERE boid = $book_id";
$result_book = $mysqli->query($sql_book);
$book_data = $result_book->fetch_assoc();

if (!$book_data) {
  echo "<script>alert('교재 정보를 찾을 수 없습니다.');</script>";
  echo "<script>location.href='/CODE_EVEN/admin/book_list.php';</script>";
  exit;
}

// DB에서 카테고리 데이터 가져오기
$sql_cate = "SELECT * FROM category ORDER BY step, pcode";
$result_cate = $mysqli->query($sql_cate);

$categories = [];
while ($cates = $result_cate->fetch_object()) {
  $categories[] = $cates;
}

// 분류 값 초기화
$cate1_selected = substr($book_data['category'] ?? '', 0, 2); // 대분류 코드
$cate2_selected = substr($book_data['category'] ?? '', 2, 2); // 중분류 코드
$cate3_selected = substr($book_data['category'] ?? '', 4, 2); // 소분류 코드

?>

<div class="container">
  <h2>교재 수정</h2>
  <div class="content_bar cent">
    <h3>교재 기본 정보 수정</h3>
  </div>
  <form action="book_update_ok.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $book_data['boid']; ?>">
    <table class="table">
      <thead class="thead-hidden">
        <tr>
          <th scope="col">구분</th>
          <th scope="col" colspan="6">내용</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">분류 설정 <b>*</b></th>
          <td colspan="2">
            <select name="cate1" id="cate1" class="form-select" aria-label="대분류">
              <option value="">대분류</option>
              <?php foreach ($categories as $category): ?>
                  <?php if ($category->step == 1): ?>
                      <option value="<?php echo $category->code; ?>" 
                        <?php echo $category->code == $cate1_selected ? 'selected' : ''; ?>>
                        <?php echo $category->name; ?>
                      </option>
                  <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </td>
          <td colspan="2">
            <select name="cate2" id="cate2" class="form-select" aria-label="중분류">
              <option value="">중분류</option>
              <?php foreach ($categories as $category): ?>
                  <?php if ($category->step == 2 && $category->pcode == $cate1_selected): ?>
                      <option value="<?php echo $category->code; ?>" 
                        <?php echo $category->code == $cate2_selected ? 'selected' : ''; ?>>
                        <?php echo $category->name; ?>
                      </option>
                  <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </td>
          <td colspan="2">
            <select name="cate3" id="cate3" class="form-select" aria-label="소분류">
              <option value="">소분류</option>
              <?php foreach ($categories as $category): ?>
                  <?php if ($category->step == 3 && $category->pcode == $cate2_selected): ?>
                      <option value="<?php echo $category->code; ?>" 
                        <?php echo $category->code == $cate3_selected ? 'selected' : ''; ?>>
                        <?php echo $category->name; ?>
                      </option>
                  <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row">강좌명 <b>*</b></th>
          <td colspan="6">
            <input name="title" type="text" class="form-control" value="<?php echo $book_data['title']; ?>" placeholder="강좌명을 입력하세요.">
          </td>
        </tr>
        <tr>
          <th scope="row">교재명 <b>*</b></th>
          <td colspan="6">
            <input name="book" type="text" class="form-control" value="<?php echo $book_data['book']; ?>" placeholder="교재명을 입력하세요.">
          </td>
        </tr>
        <tr>
          <th scope="row">출판사 <b>*</b></th>
          <td colspan="2">
            <input name="company" type="text" class="form-control" value="<?php echo $book_data['company']; ?>" placeholder="길동사">
          </td>
          <td class="box_container" colspan="4" rowspan="4">
          <div class="bookBox">
            <div class="image">
              <img src="<?php echo !empty($book_data['image']) ? $book_data['image'] : '/default/path/to/image.jpg'; ?>" alt="교재 이미지">
            </div>
          </div> 
            <div class="input-group mb-3">
              <input name="image" accept="image/*" type="file" id="image" class="form-control">
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">가격 <b>*</b></th>
          <td colspan="2">
            <div class="input-group">
              <input name="price" type="text" class="form-control" value="<?php echo $book_data['price']; ?>" aria-label="원">
              <span class="input-group-text">원</span>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">출판일 <b>*</b></th>
          <td colspan="2">
            <div class="input-group">
              <input name="pd" type="text" id="datepicker" class="form-control" value="<?php echo $book_data['pd']; ?>" placeholder="출판일을 선택하세요.">
              <div class="input-group-append" id="calendar-icon-wrapper">
                <span class="input-group-text" id="calendar-icon">
                  <i class="bi bi-calendar"></i>
                </span>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">저자 <b>*</b></th>
          <td colspan="2">
            <input name="writer" type="text" class="form-control" value="<?php echo $book_data['writer']; ?>" placeholder="홍길동">
          </td>
        </tr>
        <tr>
          <th scope="row">교재 설명 <b>*</b></th>
          <td colspan="6">
            <textarea name="desc" class="form-control" rows="3" placeholder="교재 설명을 입력해 주세요.">
              <?php echo !empty($book_data['desc']) ? $book_data['desc'] : ''; ?>
            </textarea>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-end gap-2 mt-4 mb-5">
      <button type="submit" class="btn btn-secondary" name="action">수정</button>
      <button type="button" class="btn btn-danger" onclick="window.location.href='/CODE_EVEN/admin/book_list.php'">취소</button>
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

      $('#cate3').html('<option value="">소분류</option>');
      filterCate3.forEach(category => {
        $('#cate3').append(`<option value="${category.code}">${category.name}</option>`);
      });
    } else {
      $('#cate3').html('<option value="">소분류</option>');
    }
  });

  // 썸네일 첨부하면 class image에 출력
  $('#image').on('change', function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        $('.image img').attr('src', e.target.result);
        $('.image img').attr('alt', file.name);
        $('.bookBox span').css('display', 'none'); // 텍스트 숨기기
      };

      reader.readAsDataURL(file);
    }
  });

  $(document).ready(function () {
    const dateInput = $("#datepicker");
    const calendarIconWrapper = $("#calendar-icon-wrapper");
    const calendarIcon = $("#calendar-icon");

    // 페이지 로드 시 기본 placeholder 설정
    dateInput.attr("placeholder", "출판일을 선택하세요.");

    // 아이콘 클릭 시 입력 필드에 포커스
    calendarIconWrapper.on("click", function () {
      dateInput.focus();
    });

    // 입력 필드에 포커스되면 아이콘 숨김
    dateInput.on("focus", function () {
      $(this).attr("type", "date"); // type을 date로 변경
      $(this).attr("placeholder", ""); // placeholder 제거
      calendarIcon.hide(); // 달력 아이콘 숨김
    });

    // 입력 필드가 변경되었을 때 아이콘 상태 확인
    dateInput.on("change", function () {
      if ($(this).val()) {
        calendarIconWrapper.hide(); // 입력된 값이 있으면 아이콘 전체 숨김
      }
    });

    // 입력 필드 focus-out 시 처리
    dateInput.on("blur", function () {
      if (!$(this).val()) {
        $(this).attr("type", "text"); // 값이 비어 있으면 type을 text로 복구
        $(this).attr("placeholder", "출판일을 선택하세요."); // placeholder 복구
        calendarIconWrapper.show(); // 아이콘 다시 표시
      }
    });
  });
</script>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>
