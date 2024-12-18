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
      <!-- 전체 선택 -->
      <div class="form-check">
        <div class="check_total d-flex gap-2 align-items-center">
          <input class="form-check-input" type="checkbox" id="selectAll">
          <label class="form-check-label" for="selectAll">
            전체 선택<span class="check_cnt"> 3</span> / 3
          </label>
        </div>
      </div>

      <div class="row">
        <!-- 상품 테이블 -->
        <div class="col-md-8">
          <table class="table cart_table">
            <thead class="visually-hidden">
              <tr>
                <th><input type="checkbox" id="selectAllItems"></th>
                <th>상품 정보</th>
                <th>강사</th>
                <th>가격</th>
                <th>삭제</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox" class="item-check form-check-input"></td>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="../admin/upload/lecture/20241215082240797607.png" alt="상품 이미지" class="item_img">
                    <p class="lec_title">퍼블리셔 취업을 위해 제대로 배워 보는 html과 css 그리고 웹표준</p>
                  </div>
    
                </td>
                <td>김코딩</td>
                <td>44,000원</td>
                <td><button type="button" class="btn-close" aria-label="Close"></button></td>
              </tr>
              <tr>
                <td><input type="checkbox" class="item-check form-check-input"></td>
                <td>
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="badge_custom bd_bk">교재포함강좌</span>
                    <p class="lec_title">HTML과 CSS 그리고 웹표준</p>
                    <div class="lec_book">
                      <button class="btn btn-sm btn-outline-secondary btn_cnt">-</button>
                      <span class="quantity">1</span>
                      <button class="btn btn-sm btn-outline-secondary">+</button>
                    </div>
                  </div>
                </td>
                <td>이리닝</td>
                <td>15,000원</td>
                <td><button type="button" class="btn-close" aria-label="Close"></button></td>
              </tr>
            </tbody>
          </table>
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
