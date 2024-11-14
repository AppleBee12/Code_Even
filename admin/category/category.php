<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
?>

<style>
  .ctgr .ctgr-wrap {
    /* display: none; */
    text-align: center;
}
</style>

<div class="container ">
  <h2>카테고리 관리</h2>
  <div class="d-flex gap-5 ctgr">
    <div class="col-md-9 mt-5 ctgr-wrap">
      <h3>대분류</h3>
      <select class="form-select mt-4" aria-label="Default select example">
        <option selected>대분류</option>
        <option value="1">웹개발</option>
        <option value="2">클라우드 / DB</option>
        <option value="3">보안 / 네트워크</option>
      </select>
      <button class="btn btn-secondary mt-4">대분류 등록</button>
    </div>
    <div class="col-md-9 mt-5  ctgr-wrap">
    <h3>중분류</h3>
      <select class="form-select mt-4" aria-label="Default select example">
        <option selected>중분류</option>
        <option value="1">프론트엔드</option>
        <option value="2">백엔드</option>
      </select>
      <button class="btn btn-secondary mt-4">중분류 등록</button>
    </div>
    <div class="col-md-9 mt-5 ctgr-wrap">
    <h3>소분류</h3>
      <select class="form-select mt-4" aria-label="Default select example">
        <option selected>소분류</option>
        <option value="1">HTML / CSS</option>
        <option value="2">Javascript</option>
        <option value="3">J-Query</option>
      </select>
      <button class="btn btn-secondary mt-4">소분류 등록</button>
    </div>
  </div>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>