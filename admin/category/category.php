<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>카테고리 관리</h2>
  <div class="d-flex gap-5">
    <select class="form-select w-25" aria-label="Default select example">
      <option selected>대분류</option>
      <option value="1">웹개발</option>
      <option value="2">클라우드 / DB</option>
      <option value="3">보안 / 네트워크</option>
    </select>
    <select class="form-select w-25" aria-label="Default select example">
      <option selected>중분류</option>
      <option value="1">프론트엔드</option>
      <option value="2">백엔드</option>
    </select>
    <select class="form-select w-25" aria-label="Default select example">
      <option selected>소분류</option>
      <option value="1">HTML / CSS</option>
      <option value="2">Javascript</option>
      <option value="3">J-Query</option>
    </select>
  </div>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>