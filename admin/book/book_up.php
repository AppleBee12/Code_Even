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
while ($row = $result_cate->fetch_object()) {
  $categories[] = $row;
}

?>

<div class="container">
  <h2>교재 등록</h2>
  <div class="content_bar cent">
    <h3>교재 기본 정보 입력</h3>
  </div>
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
        <th scope="row">교재명 <b>*</b></th>
        <td colspan="6">
          <input type="text" class="form-control" placeholder="기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)">
        </td>
      </tr>
      <tr>
        <th scope="row">출판사 <b>*</b></th>
        <td colspan="2">
          <input type="text" class="form-control" placeholder="길동사">
        </td>
        <td class="box_container" colspan="4" rowspan="4">
          <div class=" bookBox">
            <span>강좌 썸네일 이미지를 선택해주세요.</span>
            <div class="image"><img src="" alt=""></div>
          </div>
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02">
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">가격 <b>*</b></th>
        <td colspan="2">
          <div class="input-group">
            <input type="text" class="form-control" aria-label="원">
            <span class="input-group-text">원</span>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">출판일 <b>*</b></th>
        <td colspan="2">
          <select class="form-select">
            <option selected>SELECT</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row">저자 <b>*</b></th>
        <td colspan="2">
          <input type="text" class="form-control" placeholder="홍길동">
        </td>
      </tr>
      <tr>
        <th scope="row">교재 설명 <b>*</b></th>
        <td colspan="6">
          <textarea class="form-control" rows="3" placeholder="교재 설명을 입력해 주세요."></textarea>
        </td>
      </tr>
    </tbody>
  </table>
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
  </script>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
  ?>