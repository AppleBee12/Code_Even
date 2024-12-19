<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

  if(isset($_SESSION['UID'])){
      $userid = $_SESSION['UID'];
  } else {
      $userid =  '';
  }
  
  // 카트 조회
  $cart_sql = "SELECT 
      c.*, 
      l.leid, 
      l.image, 
      l.title, 
      l.name, 
      l.price AS lecture_price, 
      b.book AS book_name, 
      b.price AS book_price,
      b.writer AS book_writer,
      b.company AS book_company
    FROM 
      cart c
    LEFT JOIN 
      lecture l ON c.leid = l.leid
    LEFT JOIN 
      book b ON c.boid = b.boid
    WHERE 
      c.ssid = '$session_id' OR c.uid = '$userid'
  ";


  $cart_result = $mysqli->query($cart_sql);
  $cartArr = [];
  while ($cart_data = $cart_result->fetch_object()) {
      $cartArr[] = $cart_data;
  }
?>

<div class="white container_wrap">
  <div class="container">
    <main>
      <h2 class="headt5">장바구니</h2>
      <div class="row">
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
          
          <!-- 상품 테이블 -->
          <ul class="cart_list">
            <?php
              $total = 0;
              if(isset($cartArr)){
                  foreach($cartArr as $cart){
                      $total += $cart->lecture_price;                               
            ?>
            <li>
              <div class="d-flex align-items-center">
                <div class="item_check">
                  <input type="checkbox" class="item-check form-check-input">
                </div>
                <a href="" class="item_lnfo d-flex flex-fill">
                  <img src="<?= $cart->image;?>" alt="강좌 이미지" class="item_img">
                  <div class="item_txt d-flex flex-column justify-content-between">
                    <p class="lec_title"><?= $cart->title;?></p>
                    <p class="lec_tc"><?= $cart->name;?></p>
                  </div>     
                </a>
                <div class="item_price d-flex  align-items-center justify-content-center">
                  <p><span class="number"><?= $cart->lecture_price;?></span>원</p>
                </div>
                <button type="button" class="btn btn_item_del" aria-label="Delete"><i class="bi bi-x-circle-fill"></i></button>
              </div>
            </li>

          <?php if (!empty($cart->boid)) { ?>
            <li class="d-flex align-items-center book_list">
              <span class="badge_custom book_badge">교재포함강좌</span>
              <p class="book_title"><?= $cart->book_name;?><span class="book_info"> | <?= $cart->book_writer;?> | <?= $cart->book_company;?></span></p>
              <p class="book_price"><span class="number"><?= $cart->book_price;?></span>원</p>
            </li>
            <?php 
        $total += $cart->book_price; 
      } 
    }
}
?> 
          </ul>
          <button type="button" class="btn btn-outline-secondary mt-3">선택삭제</button>
        </div>

        <!-- 결제 정보 -->
        <div class="col-md-4">
          <ul class="list-group mb-3 payment_sum">
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
            <li class="list-group-item d-flex justify-content-between price_sum">
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
