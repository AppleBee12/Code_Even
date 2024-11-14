<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
?>

  <div class="container">
    <h2>쿠폰관리</h2>
    <div class="d-flex gap-5">
      <h5>총 쿠폰 수 18개</h5>
      <h5>활성화 쿠폰 수 9개</h5>
      <h5>비활성화 쿠폰 수 9개</h5>
    </div>
    <form class="row justify-content-end">
      <div class="col-lg-4">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="검색어를 입력하세요." aria-label="Recipient's username" aria-describedby="basic-addon2">
          <button type="button" class="btn btn-secondary">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </div>
    </form>


    <div class="card mb-3" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="..." class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">가입축하 쿠폰</h5>
            <p class="card-text">사용기한 : 무제한</p>
            <p class="card-text">할인금액 : 20,000원</p>
            <p class="card-text"> 최소 사용금액 : 10,000원</p>
            <i class="bi bi-trash"></i>
            <!-- <p class="card-text"><small class="text-body-secondary"></small></p> -->
            <i class="bi bi-pencil-fill"></i>
          </div>
        </div>
      </div>
    </div>


  </div>


<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>