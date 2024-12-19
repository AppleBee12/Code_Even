<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');
?>
<!--  
<div class="white container_wrap">
  <div class="container">
    <main>
      <h2 class="headt5">장바구니</h2>
      <div class="form-check">
      <div class="check_total d-flex gap-2 align-item-center">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            <p>전체 선택<span class="check_cnt"> 3</span> / 3</p>
        </label>
        </div>
      </div>

      <div class="row g-5">
        <div class="col-md-7 col-lg-8">
          <ul>
            <li>
              <div class="lec_item col-6">
                <img src="../admin/upload/lecture/20241215082240797607.png" alt="">
                <p>퍼블리셔 취업을 위해 제대로 배워 보는 html과 css 그리고 웹표준</p>
                <p>김코딩</p>
                <button>x</button>

                <div class="lec_book">
                  <span class="badge text-bg-secondary">교재포함강좌</span>
                  <p>html과 css 그리고 웹표준</p>
                  <button>-</button>
                  <span>1</span>
                  <button>+</button>
                </div>
              </div>
              <p class="item_price col-2">44,000원</p>
              <p class="item_price">15,000원</p>
            </li>
          </ul>
          <hr class="my-4">
          <button type="button" class="btn btn-outline-secondary">선택삭제</button>
  
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
  </div>
</div>
-->

<div class="white container_wrap">
  <div class="container">
    <main>
      <h2 class="headt5">장바구니</h2>


      <div class="row">
        <!-- 상품 테이블 -->
        <div class="col-md-8">

        <!-- 전체 선택 -->
       <div class="check_del d-flex align-items-center">
         <div class="form-check">
           <div class="check_total d-flex gap-3 align-items-center">
             <input class="form-check-input checkbox_custom" type="checkbox" id="selectAll">
             <label class="form-check-label" for="selectAll">
               <span>전체 선택</span>
               <span class="check_cnt">3</span>
               <span>/</span> 
               <span class="total_cnt">3</span>
             </label>   
           </div>
         </div>
       </div>
          <ul class="cart_list">
            <li>
              <div class="d-flex align-items-center">
                <div class="item_check">
                  <input type="checkbox" class="item-check form-check-input">
                </div>
                <a href="" class="item_lnfo d-flex flex-fill">
                  <img src="../admin/upload/lecture/20241215082240797607.png" alt="강좌 이미지" class="item_img">
                  <div class="item_txt d-flex flex-column justify-content-between">
                    <p class="lec_title">퍼블리셔 취업을 위해 제대로 배워 보는 html과 css 그리고 웹표준 그리고 웹표준 그리고 웹표준 그리고 웹표준</p>
                    <p class="lec_tc">이코딩</p>
                  </div>     
                </a>
                <div class="item_price flex-column d-flex  align-items-center justify-content-center">
                  <p>44,000원</p>
                </div>
                <button type="button" class="btn btn_item_del" aria-label="Delete"><i class="bi bi-x-circle-fill"></i></button>
              </div>
            </li>
            <li>
              <a href="" class="d-flex align-items-center">
                <span class="badge_custom bd_bk">교재포함강좌</span>
                <p class="lec_title">HTML과 CSS 그리고 웹표준</p>
                <p>이리닝</p>
                <p>15,000원</p>
                <button type="button" class="btn-close" aria-label="Close"></button>  
              </a>
            </li>


            <li>
              <div class="d-flex align-items-center">
                <div class="item_check">
                  <input type="checkbox" class="item-check form-check-input">
                </div>
                <a href="" class="item_lnfo d-flex flex-fill">
                  <img src="../admin/upload/lecture/20241215082240797607.png" alt="강좌 이미지" class="item_img">
                  <div class="item_txt d-flex flex-column justify-content-between">
                    <p class="lec_title">퍼블리셔 취업을 위해 제대로 배워 보는 html과 css 그리고 웹표준 그리고 웹표준 그리고 웹표준 그리고 웹표준</p>
                    <p class="lec_tc">이코딩</p>
                  </div>     
                </a>
                <div class="item_price flex-column d-flex  align-items-center justify-content-center">
                  <p>44,000원</p>
                </div>
                <button type="button" class="btn btn_item_del" aria-label="Delete"><i class="bi bi-x-circle-fill"></i></button>
              </div>
            </li>
            <li>
              <div class="d-flex align-items-center">
                <div class="item_check">
                  <input type="checkbox" class="item-check form-check-input">
                </div>
                <a href="" class="item_lnfo d-flex flex-fill">
                  <img src="../admin/upload/lecture/20241215082240797607.png" alt="강좌 이미지" class="item_img">
                  <div class="item_txt d-flex flex-column justify-content-between">
                    <p class="lec_title">퍼블리셔 취업을 위해 제대로 배워 보는 html과 css 그리고 웹표준 그리고 웹표준 그리고 웹표준 그리고 웹표준</p>
                    <p class="lec_tc">이코딩</p>
                  </div>     
                </a>
                <div class="item_price flex-column d-flex  align-items-center justify-content-center">
                  <p>44,000원</p>
                </div>
                <button type="button" class="btn btn_item_del" aria-label="Delete"><i class="bi bi-x-circle-fill"></i></button>
              </div>
            </li>

          </ul>
          <button type="button" class="btn btn-outline-secondary mt-3">선택삭제</button>
        </div>


        <!-- 결제 정보 -->
        <div class="col-md-4">
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
          <button class="w-100 btn btn-primary btn-lg btn_ok_red">주문하기</button>
        </div>
      </div>
    </main>
  </div>
</div>


<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>
