<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
$title = "쿠폰 목록";
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');

if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='../login/login.php';
  </script>";
}

$search_where = '';

$search_keyword = $_GET['search_keyword'] ?? '';

if($search_keyword){ 
  $search_where .= " and (coupon_name LIKE '%$search_keyword%')";
}


//데이터의 개수 조회
$page_sql = "SELECT COUNT(*) AS cnt FROM coupons WHERE 1=1 $search_where";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

//페이지네이션 
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}

$list = 10;
$start_num=($page-1)*$list;
$block_ct = 5;
$block_num = ceil($page/$block_ct); //$page1/5 0.2 = 1

$block_start = (($block_num-1)*$block_ct) + 1;
$block_end = $block_start + $block_ct - 1;

$total_page = ceil($row_num/$list); //총75개 10개씩, 8
$total_block = ceil($total_page/$block_ct);

if($block_end > $total_page ) $block_end = $total_page;

 
$sql = "SELECT * FROM coupons WHERE 1=1 $search_where ORDER BY cpid DESC LIMIT $start_num, $list"; //products 테이블에서 모든 데이터를 조회

$result = $mysqli->query($sql); //쿼리 실행 결과


while($data = $result->fetch_object()){
  $dataArr[] = $data;
}

?>

<style>

.box {
  height: 280px !important;
  width: 400px !important;
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


</style>

<div class="container">
  <h2 class="mb-5">쿠폰 등록</h2>
  <form action="coupon_ok.php" method="POST" enctype="multipart/form-data">
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">쿠폰이미지</th>
          <td>
          <div class="box mb-3">
            <span>쿠폰 이미지를 등록해주세요.</span>
            <div class="image"><img src="" alt=""></div>
          </div>
            <input type="file" accept="image/*" class="form-control w-50" name="coupon_image" value="file" required>
          </td>
        </tr>
        <tr>
        <tr>
          <th scope="row">쿠폰명</th>
          <td><input type="text" class="form-control w-25" name="coupon_name" placeholder="쿠폰명을 입력하세요" required></td>
        </tr>
        <tr>
          <th scope="row">쿠폰내용</th>
          <td><input type="text" class="form-control w-25" name="coupon_name" placeholder="쿠폰내용을 입력하세요" required></td>
        </tr>
        <div class="d-flex">
          <th scope="row">사용기한</th>
            <td class="d-flex gap-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                  제한
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                  무제한
                </label>
              </div>
                <input type="text" name="sale_end_date" id="datepicker" class="form-control w-25 bi bi-calendar-week">
            </td>
                
        </tr> 
            </td>
          </th>
          <tr>
            <th scope="row">상태</th>
            <td>
              <select class="form-select w-25" name="status" aria-label="상태">                            
                <option value="1">활성화</option>
                <option value="2">비활성화</option>
              </select>
            </td>
          </tr>    
        </div>


          <th scope="row">쿠폰타입</th>
          <td>
            <select class="form-select w-25" name="coupon_type" id="coupon_type" aria-label="쿠폰타입">                            
              <option value="1" selected>정액</option>
              <option value="2">정률</option>
              <div class="input-group mb-3">
            </select>
          </td>
        </tr>
        <tr id="ct1">
          <th scope="row">할인가</th>
          <td>
            <div class="input-group mb-3">
              <input type="text" name="coupon_price" class="form-control" aria-label="할인가" value="0" aria-describedby="coupon_price"> 
              <span class="input-group-text" id="coupon_price">원</span>
            </div>
          </td>
        </tr>        
        <tr id="ct2">
          <th scope="row">할인비율</th>
          <td>
            <div class="input-group mb-3">
              <input type="text" name="coupon_ratio" class="form-control" aria-label="할인비율" value="0" aria-describedby="coupon_ratio">
              <span class="input-group-text" id="coupon_ratio">%</span>
            </div>
          </td>
        </tr>  
        <tr>
          <th scope="row">최소사용금액</th>
          <td>
            <div class="input-group mb-3 w-50">
              <input type="text" name="use_min_price" class="form-control" aria-label="최소사용금액" value="0" aria-describedby="use_min_price">
              <span class="input-group-text" id="use_min_price">원</span>
            </div>
          </td>
        </tr>        
        <tr id="">
          <th scope="row">최대할인금액</th>
          <td>
            <div class="input-group mb-3  w-50">
              <input type="text" name="max_value" class="form-control" aria-label="최대할인금액" value="0" aria-describedby="max_value">
              <span class="input-group-text" id="max_value">원</span>
            </div>
          </td>
        </tr>    
                
      </tbody>
    </table>
    <div class="d-flex justify-content-end">
      <a href="coupons_up.php" >
        <button class="btn btn-outline-danger mt-3 ">취소</button>
        <button class="btn btn-secondary mt-3 ">쿠폰등록</button>
      </a>
    </div>
  </form>
</div>

<script>
  $(document).ready(function() {
  $('.use-coupon').on('click', function() {
    let cpid = $(this).closest('li').data('cpid');
    alert(`쿠폰 ID: ${cpid}를 사용합니다.`);
    
    // Ajax 요청 등을 추가하여 쿠폰 사용 처리 가능
    /*
    $.ajax({
      type: 'POST',
      url: 'use_coupon.php',
      data: { cpid: cpid },
      success: function(response) {
        alert('쿠폰이 성공적으로 사용되었습니다.');
      },
      error: function(error) {
        alert('쿠폰 사용에 실패했습니다.');
      }
    });
    */
  });
});




  $('#ct2 input').prop('disabled', true);

  $('#coupon_type').change(function(){
    let value = $(this).val();
    $('#ct1 input, #ct2 input').prop('disabled', true);
    if(value == 1){
      $('#ct1 input').prop('disabled', false);
    } else{
      $('#ct2 input').prop('disabled', false);
    }
  });



  function attachFile(file){

  let formData = new FormData(); //페이지전환 없이, 폼전송없이(submit 이벤트 없이) 파일 전송, 빈폼을 생성
  formData.append('coupon_image',file); //<input type="file" name="savefile" value="file"> 이미지 첨부

  $.ajax({
    url:'product_image_save.php',
    data:formData,
    cache: false, //이미지 정보를 브라우저 저장, 안한다
    contentType:false, //전송되는 데이터 타입지정, 안한다.
    processData:false, //전송되는 데이터 처리(해석), 안한다.
    dataType:'json', //product_image_save.php이 반환하는 값의 타입
    type:'POST', //파일 정보를 전달하는 방법
    success:function(returned_data){ //product_image_save.php과 연결(성공)되면 할일
      console.log(returned_data);

      if(returned_data.result === 'size'){
        alert('10MB 이하만 첨부할 수 있습니다.');
        return;
      } else if(returned_data.result === 'image'){
        alert('이미지만 첨부할 수 있습니다.');
        return;   
      } else if(returned_data.result === 'error'){
        alert('첨부실패, 관리자에게 문의하세요');
        return;
      } else{ //파일 첨부가 성공하면
        let imgids = $('#product_image_id').val() + returned_data.imgid + ',';
        $('#product_image_id').val(imgids);
        let html = `
          <div class="card" style="width: 9rem;" id="${returned_data.imgid}">
            <img src="${returned_data.savefile}" class="card-img-top" alt="...">
            <div class="card-body">                
              <button type="button" class="btn btn-danger btn-sm">삭제</button>
            </div>
          </div>
        `;
        $('#addedImages').append(html);
      }
    }

  })
  }
</script>




<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>