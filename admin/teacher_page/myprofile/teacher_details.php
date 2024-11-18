<?php
$title = "강사";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>내 프로필 수정</h2>
  <div class="content_bar">
    <h3>강사 상세정보</h3>
  </div>

  <form action="">
    <div class="upload mt-5 mb-3">
      <img src="https://picsum.photos/200" width=100 height=100 alt="">
      <div class="round">
        <input type="file">
        <i class="bi bi-camera-fill"></i>
      </div>
    </div>
    <p class="text-center mb-5">프로필 이미지</p>

    <table class="table w-100 info_table">
      <colgroup>
        <col width="160">
        <col width="516">
        <col width="160">
        <col width="516">
      </colgroup>
      <tbody>
        <?php
        $sql = "SELECT * FROM user ORDER BY uid ";
        $result = $mysqli->query($sql);

        $user_id = $_SESSION['AUID'];
        // print_r($result->fetch_assoc());
        print_r($user_id);

        ?>
        <tr>
          <th scope="row">
            <label for="username">이름 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="username" name="username" class="form-control" placeholder="입력 필수 값 입니다." value="">
          </td>
          <th>
          <label for="link">링크 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="link" name="link" class="form-control" id="exampleFormControlInput1" placeholder="냠냠">
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="userid">아이디 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="userid" name="userid" class="form-control" placeholder="입력 필수 값 입니다." value="">
          </td>
          <th scope="row">
            <label for="bank">은행명 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="bank" name="bank" class="form-control" placeholder="입력 필수 값 입니다." value="">
          </td>

        </tr>
        <tr>
          <th scope="row">
            <label for="contact">연락처 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="contact" name="contact" class="form-control" placeholder="입력 필수 값 입니다." value="">

          <th scope="row">
            <label for="bankaccount">계좌번호 <b>*</b></label>
          </th>
          <td>
            <input type="text" id="bankaccount" name="bankaccount" class="form-control" placeholder="입력 필수 값 입니다." value="">
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="email">이메일 <b>*</b></label>
          </th>
          <td colspan="3">
            <input type="email" id="email" name="email" class="form-control w_512" placeholder="입력 필수 값 입니다." value="">
          </td>
        </tr>
        <tr>
        <th scope="row">
          <label for="cate">대표분야 <b>*</b></label>
        </th>
        <td colspan="3">
          <select class="form-select w_512" id="cate" name="cate" aria-label="대표 분야">
            <option value="1" selected>웹개발</option>
            <option value="2">클라우드</option>
            <option value="3">보안</option>
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
        <div id="summernote"></div>
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