<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
?>

<style>
  .text-bg-secondary-light{
    background-color: var(--bk300); /* light 배경 색상 */
  }
  .c-img img{
    /* display: none; */
    height: 232px;
  }
  .cps{
    gap: 110px;
    height: 250px;
  }
</style>

  <div class="container">
    <h2 class="mb-5">쿠폰관리</h2>
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
    
    <div class="d-flex cps">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-7 c-img">
            <img src="../../images/coupons1.png" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-5">
            <div class="card-body">
              <h6><span class="badge text-bg-secondary">활성화</span></h6>
              <h5 class="card-title mt">환승회원 전용 쿠폰</h5>
              <p class="card-text bd">사용기한 : 무제한</p>
              <p class="card-text bd">할인금액 : 20,000원</p>
              <p class="card-text bd"> 최소 사용금액 : 10,000원</p>
              <div class="icons d-flex justify-content-end gap-2">
                <i class="bi bi-trash"></i>
                <i class="bi bi-pencil-fill"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-7 c-img">
            <img src="../../images/coupons2.png" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-5">
            <div class="card-body">
            <h6><span class="badge text-bg-secondary-light">비활성화</span></h6>
              <h5 class="card-title mt">강의할인 쿠폰</h5>
              <p class="card-text bd">사용기한 : 2025/10/29</p>
              <p class="card-text bd">할인금액 : 5,000원</p>
              <p class="card-text bd"> 최소 사용금액 : 10,000원</p>
              <div class="icons d-flex justify-content-end gap-2">
                <i class="bi bi-trash"></i>
                <i class="bi bi-pencil-fill"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex cps">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-7 c-img">
            <img src="../../images/coupons3.png" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-5">
            <div class="card-body">
            <h6><span class="badge text-bg-secondary-light">비활성화</span></h6>
              <h5 class="card-title mt">가입축하 쿠폰</h5>
              <p class="card-text bd">사용기한 : 2025/12/24</p>
              <p class="card-text bd">할인금액 : 7,000원</p>
              <p class="card-text bd"> 최소 사용금액 : 14,000원</p>
              <div class="icons d-flex justify-content-end gap-2">
                <i class="bi bi-trash"></i>
                <i class="bi bi-pencil-fill"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-7 c-img">
            <img src="../../images/coupons4.png" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-5">
            <div class="card-body">
            <h6><span class="badge text-bg-secondary-light">활성화</span></h6>
              <h5 class="card-title mt">리뷰작성  쿠폰</h5>
              <p class="card-text bd">사용기한 : 2025/11/14</p>
              <p class="card-text bd">할인금액 : 20,000원</p>
              <p class="card-text bd"> 최소 사용금액 : 13,000원</p>
              <div class="icons d-flex justify-content-end gap-2">
                <i class="bi bi-trash"></i>
                <i class="bi bi-pencil-fill"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>