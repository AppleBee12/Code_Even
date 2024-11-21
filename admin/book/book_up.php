<?php

$title = "교재 등록";

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

// 사용자 정보 가져오기 (확인용)
$sql_user = "SELECT uid, username FROM user WHERE userid = ?";
if ($stmt_user = $mysqli->prepare($sql_user)) {
  $stmt_user->bind_param("s", $session_userid);
  $stmt_user->execute();
  $stmt_user->bind_result($uid, $username);
  $stmt_user->fetch();
  $stmt_user->close();
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
while ($cates = $result_cate->fetch_object()) {
  $categories[] = $cates;
}

?>

<div class="container">
  <h2>교재 등록</h2>
  <div class="content_bar cent">
    <h3>교재 기본 정보 입력</h3>
  </div>
  <form action="book_up_ok.php" method="POST" enctype="multipart/form-data">
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
            <input name="title" type="text" class="form-control" placeholder="강좌명을 입력하세요.">
          </td>
        </tr>
        <tr>
          <th scope="row">교재명 <b>*</b></th>
          <td colspan="6">
            <!-- 기본 교재명 -->
            <input 
              name="book_name" 
              type="text" 
              class="form-control" 
              id="selected_book_name" 
              value="<?php echo htmlspecialchars($defaultBook['title']); ?>" 
              readonly 
            />
            <!-- 선택 가능한 교재 리스트 -->
            <select 
              name="book_select" 
              id="book_select" 
              class="form-control mt-2" 
              onchange="updateSelectedBook()">
              <option value="">-- 교재를 선택하세요 --</option>
              <?php foreach ($relatedBooks as $book): ?>
                <option value="<?php echo $book['boid']; ?>">
                  <?php echo htmlspecialchars($book['title']) . ' - ' . number_format($book['price']) . '원'; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </td>
        </tr>
          <th scope="row">출판사 <b>*</b></th>
          <td colspan="2">
            <input name="company" type="text" class="form-control" placeholder="길동사">
          </td>
          <td class="box_container" colspan="4" rowspan="4">
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
          <th scope="row">가격 <b>*</b></th>
          <td colspan="2">
            <div class="input-group">
              <input name="price" type="text" class="form-control" aria-label="원">
              <span class="input-group-text">원</span>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row">출판일 <b>*</b></th>
          <td colspan="2">
            <div class="input-group">
              <input name="pd" type="text" id="datepicker" class="form-control" placeholder="출판일을 선택하세요.">
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
            <input name="writer" type="text" class="form-control" placeholder="홍길동">
          </td>
        </tr>
        <tr>
          <th scope="row">교재 설명 <b>*</b></th>
          <td colspan="6">
            <textarea name="desc" class="form-control" rows="3" placeholder="교재 설명을 입력해 주세요."></textarea>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-end gap-2 mt-4 mb-5">
      <button type="submit" class="btn btn-secondary" name="action">등록</button>
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