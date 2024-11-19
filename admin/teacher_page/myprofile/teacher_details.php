<?php
$title = "강사";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');




$uid = $_SESSION['UID'];

$sql = "SELECT * FROM teachers WHERE uid = $uid";
$result = $mysqli->query($sql);
$tc = $result->fetch_object();
$tcid = $tc->tcid;

$category_sql = "SELECT * FROM category WHERE code LIKE 'A%' ORDER BY cgid ASC";
$category_result = $mysqli->query($category_sql);

while($cate_data = $category_result->fetch_object()){
    $categories[] = $cate_data;
}

?>

<div class="container">
  <h2>내 프로필 수정</h2>
  <div class="content_bar">
    <h3>강사 상세정보</h3>
  </div>

  <form action="teacher_edit_ok.php" id="teacher_save" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="tcid" value="<?= $tc->tcid; ?>">
    <div class="upload mt-5 mb-3">
      <img src="http://<?= $_SERVER['HTTP_HOST'] . $tc->tc_thumbnail ?>" width=100 height=100 alt="강사 프로필 섬네일">
      <div class="round">
        <input type="file">
        <i class="bi bi-camera-fill"></i>
      </div>
    </div>
    <p class="text-center mb-5">프로필 이미지</p>

    <table class="table w-100 info_table">
      <colgroup>
      <col class="col-width-160">
        <col class="col-width-516">
        <col class="col-width-160">
        <col class="col-width-516">
      </colgroup>
      <tbody>

        <tr>
          <th scope="row">
            <label for="tc_name">이름 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="tc_name" name="tc_name" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $tc->tc_name ?>" required>
          </td>
          <th>
          <label for="link">링크 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="link" name="link" class="form-control" id="exampleFormControlInput1" placeholder="입력 필수 값 입니다." required>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="tc_userid">아이디 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="tc_userid" name="tc_userid" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $tc->tc_userid ?>" required>
          </td>
          <th scope="row">
            <label for="tc_bank">은행명 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="tc_bank" name="tc_bank" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $tc->tc_bank ?>" required>
          </td>

        </tr>
        <tr>
          <th scope="row">
            <label for="tc_userphone">연락처 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="tc_userphone" name="tc_userphone" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $tc->tc_userphone ?>">

          <th scope="row">
            <label for="tc_account">계좌번호 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="tc_account" name="tc_account" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $tc->tc_account ?>">
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="tc_email">이메일 <b>*</b></label>
          </th>
          <td colspan="3">
            <input type="text" id="tc_email" name="tc_email" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $tc->tc_account ?>">
          </td>
        </tr>
        <tr>
        <th scope="row">
          <label for="tc_cate">대표분야 <b>*</b></label>
        </th>
        <td colspan="3">
          <select class="form-select" id="tc_cate" name="tc_cate" aria-label="대표 분야">
          <?php foreach($categories as $category): ?>
                <option value="<?= $category->cgid;?>" <?= $tc->tc_cate == $category->cgid ? 'selected' : ''; ?>>
                  <?= $category->name;?>
                </option>
              <?php endforeach; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="4">
          <hr>
        </td>
      </tr>
      <tr>
        <th scope="row">소개글 <b>*</b></th>
        <td colspan="3">
        <div id="summernote"><?= $tc->tc_intro;?></div>
        </td>

      </tr>
      </tbody>
    </table>
  </form>

  <div class="d-flex justify-content-end gap-2">
    <a href="javascript:history.back();" type="button" class="btn btn-outline-danger">취소</a>
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/index.php" type="button" class="btn btn-outline-secondary">수정</a>
  </div>
</div>



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');

?>