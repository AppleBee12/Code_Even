<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

  if(isset($_SESSION['UID'])){
      $uid = $_SESSION['UID'];
      $userid = $_SESSION['AUID'];
  } else {
      $uid = '';
      $userid =  '';
  }

  //카트 조회
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
      c.ssid = '$session_id' OR c.uid = '$uid'
  ";


  $cart_result = $mysqli->query($cart_sql);
  $cartArr = [];
  while ($cart_data = $cart_result->fetch_object()) {
      $cartArr[] = $cart_data;
  }


  //사용 가능 쿠폰 조회
  /*

  $uc_sql = "SELECT uc.ucid, c.coupon_name, c.coupon_price, c.coupon_ratio, c.max_value, c.use_min_price  
  FROM user_coupons uc
  JOIN coupons c
  ON c.cpid = uc.couponid
  WHERE uc.status = 1 
  and uc.userid = '$userid' 
  and uc.use_max_date >=now() ";

  $uc_result = $mysqli->query($uc_sql);

  $ucArr = [];
  while($uc_data = $uc_result->fetch_object()){
  $ucArr[] = $uc_data;
  }
*/
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
            <li data-cart-id="<?= $cart->cartid; ?>"> 
              <div class="d-flex align-items-center">
                <div class="item_check">
                  <input type="checkbox" class="item-check form-check-input">
                </div>
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_view.php?leid=<?= $cart->leid; ?>" class="item_lnfo d-flex flex-fill">
                  <img src="<?= $cart->image;?>" alt="강좌 이미지" class="item_img">
                  <div class="item_txt d-flex flex-column justify-content-between">
                    <p class="lec_title"><?= $cart->title;?></p>
                    <p class="lec_tc"><?= $cart->name;?></p>
                  </div>     
                </a>
                <div class="item_price d-flex  align-items-center justify-content-center">
                  <p><span class="number" data-price="<?= $cart->lecture_price;?>"><?= $cart->lecture_price;?></span>원</p>
                </div>
                <button type="button" class="btn btn_item_del" aria-label="Delete"><i class="bi bi-x-circle-fill"></i></button>
              </div>
            </li>

          <?php if (!empty($cart->boid)) { ?>
            <li class="d-flex align-items-center book_list" data-cart-id="<?= $cart->cartid; ?>">
              <span class="badge_custom book_badge">교재포함강좌</span>
              <p class="book_title"><?= $cart->book_name;?><span class="book_info"> | <?= $cart->book_writer;?> | <?= $cart->book_company;?></span></p>
              <p class="book_price"><span class="number" data-price="<?= $cart->book_price;?>"><?= $cart->book_price;?></span>원</p>
            </li>
            <?php 
                    $total += $cart->book_price; 
                  } 
                }
            }
            ?> 
          </ul>
          <button type="button" class="btn btn-outline-secondary mt-3 selected_del">선택삭제</button>
        </div>

        <!-- 결제 정보 -->
        <div class="col-md-4">
          <ul class="list-group mb-3 payment_sum">
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <p class="my-0">강좌 금액</p>
              </div>
              <p class="lec_total_price">
                <span class="number">0</span>원
              </p>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <p class="my-0">교재 금액</p>
              </div>
              <p class="book_total_price">
                <span class="number">0</span>원
              </p>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <p class="my-0">선택 강좌 수</p>
              </div>
              <span class="lec_total_cnt">총 3건</span>
            </li>
            <li class="list-group-item d-flex justify-content-between price_sum">
              <span>주문 금액</span>
              <strong id="grandTotal">0</strong>
            </li>
          </ul>
          <button class="w-100 btn btn-primary btn-lg btn_ok_red">주문하기</button>
        </div>
      </div>
    </main>
  </div>
</div>

<!--
<script>
  function cart_calc(){
      console.log('실행');
      let sub_total = 0;
      $('.cart_list li').each(function(){
          console.log($(this));

          let cart_item_price = Number($(this).find('.item_price p .number').attr('data-price'));
          let cart_book_price = Number($(this).find('.book_price .number').attr('data-price'));

          let cart_total = cart_item_price + cart_book_price;
          //$(this).find('.cart_subtotal').val(cart_total);

          let cart_total_target = $(this).find('.#grandTotal');
          cart_total_target.text(cart_total);

      });

      $('.number').number( true );
  }
  cart_calc();
 

  $('.cart-table .cart_item_del').click(function(){
      let cartId = $(this).attr('id');

      if(confirm('정말 삭제할까요?')){
          let data = {
              cartid : cartId
          }
          $.ajax({
              url:'cart_delete.php',
              async:false, //결과가 나오면 일해, 동기 방식
              data:data,
              method:'post',
              dataType:'json', //javascript 객체 형식으로 받자
              error:function(e){
                  console.log(e);
              },
              success:function(data){
                  if(data.result == 'ok'){
                      alert('장바구니에서 삭제했습니다.');
                      location.reload();
                  }else{
                      alert('삭제 실패!');
                  }
              }

          })
      } else {
          alert('삭제를 취소했습니다.');
      }

  });
</script>
  -->

<script>
  function cart_calc() {
    let grandTotal = 0; // 전체 합계를 저장할 변수

    // 각 강좌와 교재의 가격 합산
    $('.cart_list > li').each(function () {
        // 강좌 가격
        let lecturePrice = $(this).find('.item_price .number').data('price') || 0;

        // 교재 가격
        let bookPrice = $(this).find('.book_price .number').data('price') || 0;

        // 합산
        let itemTotal = parseInt(lecturePrice) + parseInt(bookPrice);

        // 전체 합계에 추가
        grandTotal += itemTotal;
    });

    // grandTotal에 값을 표시
    $('#grandTotal').text(grandTotal.toLocaleString() + ' 원'); // 원 단위로 포맷
}

// 페이지 로드 후 계산 실행
cart_calc();




    // 페이지 로드 시 모든 체크박스를 기본적으로 선택
    function initializeCheckBoxes() {
        // 모든 체크박스 체크 상태로 변경
        $('#selectAll').prop('checked', true); // 전체 선택 체크박스
        $('.cart_list .item-check').prop('checked', true); // 목록의 체크박스들
        updateCheckCount(); // 선택된 숫자 초기화
    }

    // 전체 선택 / 해제 기능
    $('#selectAll').on('change', function () {
        const isChecked = $(this).is(':checked'); // 전체 선택 여부
        $('.cart_list .item-check').prop('checked', isChecked); // 목록의 체크박스 상태 변경
        updateCheckCount(); // 선택된 숫자 갱신
    });

    // 개별 체크박스 변경 시 전체 선택 상태 업데이트
    $('.cart_list').on('change', '.item-check', function () {
        const allChecked = $('.cart_list .item-check').length === $('.cart_list .item-check:checked').length;
        $('#selectAll').prop('checked', allChecked); // 전체 선택 체크박스 상태 동기화
        updateCheckCount(); // 선택된 숫자 갱신
    });

    // 선택된 숫자 및 전체 숫자 갱신
    function updateCheckCount() {
        const selectedCount = $('.cart_list .item-check:checked').length; // 선택된 체크박스 수
        const totalCount = $('.cart_list .item-check').length; // 전체 체크박스 수
        $('.check_cnt').text(selectedCount); // 선택된 숫자 갱신
        $('.total_cnt').text(totalCount); // 총 숫자 갱신
    }

    // 초기화
    initializeCheckBoxes(); // 모든 체크박스 기본적으로 체크 상태



// 장바구니 삭제
$('.btn_item_del').click(function () {
    if (confirm('정말 장바구니에서 삭제할까요?')) {
        const cartId = $(this).closest('li').data('cart-id'); // cart ID 가져오기

        // Ajax 요청
        $.ajax({
            url: '/code_even/front/cart/cart_delete.php', // 삭제 처리할 PHP 파일 경로
            type: 'POST',
            data: { cartid: cartId },
            dataType: 'json',
            success: function (response) {
                if (response.result === 'ok') {
                    alert('장바구니에서 삭제되었습니다.');
                    
                    // UI에서 강좌와 해당 교재 삭제
                    $(`li[data-cart-id="${cartId}"]`).remove();

                    // 합계 재계산
                    cart_calc();
                } else {
                    alert('삭제 실패: ' + response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert('삭제 요청 중 오류가 발생했습니다.');
            }
        });
    }
});


$('.btn_ok_red').click(function () {
    if ('<?= $uid ?>' === '') {
        alert('로그인 후 주문이 가능합니다.');
        return;
    }

    // 선택된 강좌와 교재 데이터 수집
    const selectedCartItems = [];

    // 선택된 강좌와 관련 데이터를 수집
    $('.cart_list > li').each(function () {
        const isChecked = $(this).find('.item-check').is(':checked');
        if (isChecked) {
            const cartId = $(this).data('cart-id');
            const lecturePrice = $(this).find('.item_price .number').data('price') || 0;
            const lectureTitle = $(this).find('.lec_title').text();
            const lectureInstructor = $(this).find('.lec_tc').text();

            // 기본 강좌 데이터
            const cartItem = {
                cartId: cartId,
                lecturePrice: lecturePrice,
                lectureTitle: lectureTitle,
                lectureInstructor: lectureInstructor,
                book: null // 교재 정보는 추가로 처리
            };

            // 강좌에 포함된 교재가 있다면 추가
            const bookElement = $(`.book_list[data-cart-id="${cartId}"]`);
            if (bookElement.length > 0) {
                const bookName = bookElement.find('.book_title').text();
                const bookPrice = bookElement.find('.book_price .number').data('price') || 0;
                const bookWriter = bookElement.find('.book_info').text();

                cartItem.book = {
                    name: bookName,
                    price: bookPrice,
                    writer: bookWriter
                };
            }

            selectedCartItems.push(cartItem);
        }
    });

    // 선택된 항목이 없으면 경고
    if (selectedCartItems.length === 0) {
        alert('선택된 강좌가 없습니다.');
        return;
    }

    // 총 결제 금액 계산
    const totalAmount = selectedCartItems.reduce((sum, item) => {
        const lecturePrice = parseInt(item.lecturePrice) || 0;
        const bookPrice = item.book ? parseInt(item.book.price) : 0;
        return sum + lecturePrice + bookPrice;
    }, 0);

    // 폼 생성 및 데이터 전송
    const form = $('<form>', {
        action: '/code_even/front/cart/checkout.php',
        method: 'POST'
    });

    // 선택된 항목 데이터를 추가
    form.append($('<input>', {
        type: 'hidden',
        name: 'data',
        value: JSON.stringify(selectedCartItems) // 선택된 데이터를 JSON 문자열로 변환하여 전송
    }));

    // 총 결제 금액 추가
    form.append($('<input>', {
        type: 'hidden',
        name: 'total',
        value: totalAmount
    }));

    // 폼을 문서에 추가한 뒤 제출
    $('body').append(form);
    form.submit();
});




</script>
<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>
