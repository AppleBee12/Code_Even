<?php
$title = "쿠폰수정";
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/img_upload_func.php');


if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='../login/login.php';
  </script>";
}

if(isset($_FILES['coupon_image'])){
  if($coupon_image['size'] > 10240000 ){
    echo "
     <script>
       alert('10MB이하만 첨부할 수 있습니다.');
       history.back();
     </script>
    ";
   }
   
   //파일 포멧 검사
   if(strpos($coupon_image['type'], 'image') === false){
     echo "
     <script>
       alert('이미지만 첨부할 수 있습니다.');
       history.back();
     </script>
    ";
   }
}

$cpid = $_GET['cpid'];

$sql = "SELECT * FROM coupons WHERE cpid = $cpid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();


// 예제 데이터: 데이터베이스에서 불러온 값
// 'unlimited' -> 무제한, 날짜 형식 (예: '2024-12-31') -> 제한
$use_max_date = $data->use_max_date ?? 'unlimited';

// 라디오 버튼 상태 설정
$unlimited_checked = ($use_max_date === 'unlimited') ? 'checked' : '';
$limited_checked = ($use_max_date !== 'unlimited') ? 'checked' : '';

// 제한 날짜 설정 (무제한일 경우 빈 값)
$limited_date = ($use_max_date !== 'unlimited') ? $use_max_date : '';

?>

<style>

.box {
  height: 280px !important;
  width: 383px !important;
  background-color: #ccc !important;
  position: relative;

  span{
    text-wrap: nowrap;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
}
.input-group input{
  width: 400px !important;
}
thead,
  tbody,
  tr,
  th,
  td {
    border-style: none;
  }

#datepicker{
  width: 150px !important;
}
#addedImages span{
  color: #a5a5a5;
  z-index: -1;
}
#addImages .image img{
  height: 280px;
}
</style>

<div class="container">
  <h2 class="mb-5">쿠폰수정</h2>
  <form action="coupon_edit_ok.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="cpid" value="<?= $cpid; ?>"> 
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">쿠폰이미지</th>
          <td>
          <div class="box mb-3 upload" id="addedImages">
          <?php 
            $thumbnail_path = !empty($data->coupon_image) ? $_SERVER['DOCUMENT_ROOT'] . $data->coupon_image : '';
            $image_src = (!empty($data->coupon_image) && file_exists($thumbnail_path)) ? $data->coupon_image : '';
          ?>
            <span>쿠폰 이미지를 등록해주세요.</span>
            <div class="coupon_image">
              <img id="thumbnail_preview" src="<?= $image_src; ?>" style="width:383px;height: 280px;" alt="">
            </div>
          </div>
          <input type="file" multiple accept="image/*" class="form-control w-50 coupon_image" name="coupon_image" id="coupon_image" value="" required>
        </td>
        </tr>
        <tr>
        <tr>
          <th scope="row">쿠폰명</th>
          <td><input type="text" class="form-control w-25" name="coupon_name" placeholder="쿠폰명을 입력하세요" required value="<?= $data->coupon_name; ?>" ></td>
        </tr>
        <tr>
          <th scope="row">쿠폰내용</th>
          <td><input type="text" class="form-control w-25" name="cp_desc" placeholder="쿠폰내용을 입력하세요" required value="<?= $data->cp_desc; ?>"></td>
        </tr>
        <div class="d-flex">
          <tr>
          <th scope="row">사용기한</th>
            <td class="d-flex gap-5">
              <div class="form-check"  id="ct4" >
                <input class="form-check-input" 
                type="radio" 
                name="use_max_date" 
                id="use_max_date_unlimited" 
                value="unlimited" <?= $unlimited_checked; ?>>
                <label class="form-check-label" for="use_max_date_unlimited" >
                  무제한
                </label>
              </div>
              <div class="form-check" id="ct3">
                <input class="form-check-input" 
                type="radio" 
                name="use_max_date" 
                id="use_max_date_limited" 
                value="limited" <?= $limited_checked; ?>>
                <label class="form-check-label d-flex gap-3" for="use_max_date_limited">
                  제한
                  <input type="date" 
                  name="use_max_date" 
                  id="datepicker" 
                  class="form-control w-25" 
                  value="<?= $data->use_max_date ?>"
                  disabled>
                </label>
              </div>
            </td>
          </tr>
        </div>
                
        </tr> 
            </td>
          </th>
          <tr>
            <th scope="row">상태</th>
            <td>
              <select class="form-select w-25" name="status" aria-label="상태">                            
                <option value="1" <?php if($data->status == 1){echo 'selected';} ?>>활성화</option>
                <option value="2" <?php if($data->status == 2){echo 'selected';} ?>>비활성화</option>
              </select>
            </td>
          </tr>    
        </div>

        <?php
        // $data->coupon_type에 따라 상태 설정
         $isCouponTypeFixed = $data->coupon_type; // 1: 정액, 2: 정률
        ?>
          <th scope="row">쿠폰타입</th>
          <td>
            <select class="form-select w-25" name="coupon_type" id="coupon_type" aria-label="쿠폰타입">                            
              <option value="1"  <?php if($data->coupon_type == 1){echo 'selected';} ?>>정액</option>
              <option value="2" <?php if($data->coupon_type == 2){echo 'selected';} ?>>정률</option>
            </select>
          </td>
        </tr>
        <tr id="ct1">
          <th scope="row">할인가</th>
          <td>
            <div class="input-group mb-3 w-50">
              <input type="text" name="coupon_price" class="form-control" aria-label="할인가" value=" <?= $data->coupon_price;?>" aria-describedby="coupon_price"> 
              <span class="input-group-text" id="coupon_price">원</span>
            </div>
          </td>
        </tr>        
        <tr id="ct2">
          <th scope="row">할인비율</th>
          <td>
            <div class="input-group mb-3 w-50">
              <input type="text" name="coupon_ratio" class="form-control" aria-label="할인비율" value=" <?= $data->coupon_ratio;?>" aria-describedby="coupon_ratio">
              <span class="input-group-text" id="coupon_ratio">%</span>
            </div>
          </td>
        </tr>  
        <tr>
          <th scope="row">최소사용금액</th>
          <td>
            <div class="input-group mb-3 w-50">
              <input type="text" name="use_min_price" class="form-control" aria-label="최소사용금액" value=" <?= $data->use_min_price;?>" aria-describedby="use_min_price">
              <span class="input-group-text" id="use_min_price">원</span>
            </div>
          </td>
        </tr>        
        <tr id="">
          <th scope="row">최대할인금액</th>
          <td>
            <div class="input-group mb-3  w-50">
              <input type="text" name="max_value" class="form-control" aria-label="최대할인금액" value=" <?= $data->max_value;?>" aria-describedby="max_value">
              <span class="input-group-text" id="max_value">원</span>
            </div>
          </td>
        </tr>   
      </tbody>
    </table>
    <div class="d-flex justify-content-end gap-2">
        <a href="coupons.php" class="btn btn-outline-danger mb-5 cancle">취소</a>
        <button type="submit" class="btn btn-secondary mb-5 ">쿠폰수정</button>
    </div>
  </form>
</div>

<script>
    let coupon_image = $('#coupon_image');
  coupon_image.on('change',(e)=>{
      let file = e.target.files[0];

      const reader = new FileReader(); 
      reader.onloadend = (e)=>{ 
        let attachment = e.target.result;
        if(attachment){
          let target = $('#thumbnail_preview');
          target.attr('src',attachment)
        }
      }
      reader.readAsDataURL(file); 
  });

  document.addEventListener('DOMContentLoaded', () => {
  const unlimitedRadio = document.getElementById('use_max_date_unlimited');
  const limitedRadio = document.getElementById('use_max_date_limited');
  const dateInput = document.getElementById('datepicker');

  // 라디오 버튼 상태에 따라 날짜 입력 필드 활성화/비활성화
  const toggleDateInput = () => {
    if (unlimitedRadio.checked) {
      dateInput.disabled = true;
      dateInput.value = ''; // 무제한 선택 시 날짜 초기화
    } else if (limitedRadio.checked) {
      dateInput.disabled = false;
    }
  };

  // 초기 상태 설정
  toggleDateInput();

  // 이벤트 리스너 등록
  unlimitedRadio.addEventListener('change', toggleDateInput);
  limitedRadio.addEventListener('change', toggleDateInput);
});

  $('.cancle').click(function(){
    location.href='coupons.php';
  });

  $('#coupon_type').change(function(){
    let value = $(this).val();
    $('#ct1 input, #ct2 input').prop('disabled', true);
    if(value == 1){
      $('#ct1 input').prop('disabled', false);
    } else{
      $('#ct2 input').prop('disabled', false);
    }
  });


  $('#coupon_image').on('change',(e)=>{
    let file = e.target.files[0];

    const reader = new FileReader(); 
    reader.onloadend = (e)=>{ 
      let attachment = e.target.result;
      if(attachment){
        let target = $('#coupon_old_image');
        target.attr('src',attachment)
      }
    }
    reader.readAsDataURL(file); 
  });

  $(document).ready(function () {
    // 초기 상태 설정
    let couponType = <?= $isCouponTypeFixed; ?>; // 1: 정액, 2: 정률
    updateFields(couponType);

    // 쿠폰 타입 변경 이벤트
    $('#coupon_type').on('change', function () {
      let selectedType = $(this).val();
      updateFields(selectedType);
    });

    function updateFields(type) {
      if (type == 1) { // 정액 선택
        $('input[name="coupon_price"]').prop('disabled', false);
        $('input[name="coupon_ratio"]').prop('disabled', true).val(''); // 값 초기화
      } else if (type == 2) { // 정률 선택
        $('input[name="coupon_ratio"]').prop('disabled', false);
        $('input[name="coupon_price"]').prop('disabled', true).val(''); // 값 초기화
      }
    }
  });
</script>




<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>