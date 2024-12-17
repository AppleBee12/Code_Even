<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');
?>

<div class="white container_wrap">
  <div class="container">
    <main>
      <h2 class="headt5">장바구니</h2>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
          <p>전체 선택 3/3</p>
          <p>3</p>
          <p>/3</p>
        </label>
      </div>

      <div class="row g-5">
        <div class="col-md-7 col-lg-8">
          <hr class="my-4">
          <button class="btn btn-primary btn-lg" type="submit">Continue to checkout</button>
  
          </div>
          <div class="col-md-5 col-lg-4">
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0">총 결제 금액</h6>
                </div>
                <span class="text-muted">114,000원</span>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0">선택 상품 수</h6>
                </div>
                <span class="text-muted">총 3건</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>주문 금액</span>
                <strong>114,000원</strong>
              </li>
            </ul>
            <button class="w-100 btn btn-primary btn-lg btn_ok_red" type="submit">주문하기</button>
          </div>
          
        </div>
    </main>
    <!-- 
    <div class="row">
      <div class="cart_detail col-8">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
        <label class="form-check-label" for="flexCheckChecked">
        전체 선택 3/3
        </label>
      </div>
    
      </div>
      <div class="cart_total col-4"></div>

      

    </div>
     -->
  </div>
</div>


<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>
