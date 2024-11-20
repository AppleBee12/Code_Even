<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
$title = "쿠폰등록";
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
// include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/img_upload_func.php');

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

$coupon_image = $_FILES['coupon_image']??'';
// POST로 값 받아오기 (HTML 폼의 name 속성에 맞춰주세요)
$coupon_name = $_POST['coupon_name'] ?? '';
$coupon_image = $_POST['coupon_image'] ?? ''; // 파일 업로드 시 파일명 사용
$coupon_type = $_POST['coupon_type'] ?? 0;
$coupon_price = $_POST['coupon_price'] ?? 0;
$coupon_ratio = $_POST['coupon_ratio'] ?? 0;
$status = $_POST['status'] ?? 0;
$max_value = $_POST['max_value'] ?? 0;
$use_min_price = $_POST['use_min_price'] ?? 0;
$use_max_date = $_POST['use_max_date'] ?? 'NULL';

// 세션에서 사용자 아이디 가져오기
$userid = $_SESSION['AUID'] ?? 'guest'; // 세션이 없으면 'guest'로 대체


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
  
     //파일 업로드
     $save_dir = $_SERVER['DOCUMENT_ROOT'].'code_even/admin/upload/coupons/';
     $filename = $coupon_image['name']; //insta.jpg
     $ext = pathinfo($filename,PATHINFO_EXTENSION); //파일명의 확장자를 추출, jpg
     $newFileName = date('YmdHis').substr(rand(), 0, 6);//202410091717123456
     $savefile = $newFileName.'.'.$ext;//202410091717123456.jpg
     
     if(move_uploaded_file($coupon_image['tmp_name'], $save_dir.$savefile)){ //tmp_name임시파일
       $coupon_image = 'code_even/admin/upload/coupons/'.$savefile;  
     } else{
       echo "<script>
         alert('이미지를 첨부할 수 없습니다.');
       </script>";
     }

}

$sql = "INSERT INTO coupons 
    (coupon_name, coupon_image, coupon_type, coupon_price, coupon_ratio, status, userid, max_value, use_min_price, use_max_date)
  VALUES
    ('$coupon_name', '$coupon_image', $coupon_type, $coupon_price, $coupon_ratio, $status, '{$_SESSION['AUID']}', $max_value, $use_min_price, $use_max_date)
";

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

#datepicker{
  width: 150px !important;
}

#addedImages span{
    color: #a5a5a5;
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
              <div class="box mb-3" id="addedImages">
                <span>쿠폰 이미지를 등록해주세요.</span>
                <div class="image">
                  <img src="" alt="">
                </div>
              </div>
              <input type="file" multiple accept="image/*" class="form-control w-50" name="coupon_image" id="coupon_image" value="file" required>
            </td>
        </tr>
        <tr>
        <tr>
          <th scope="row">쿠폰명</th>
          <td><input type="text" class="form-control w-25" name="coupon_name" placeholder="쿠폰명을 입력하세요" required></td>
        </tr>
        <tr>
          <th scope="row">쿠폰내용</th>
          <td><input type="text" class="form-control w-25" name="description" placeholder="쿠폰내용을 입력하세요" required></td>
        </tr>
        <div class="d-flex">
          <th scope="row">사용기한</th>
            <td class="d-flex gap-5" name="use_max_date" id="use_max_date">
              <div class="form-check" >
                  <input class="form-check-input" type="radio" name="use_max_date" checked>
                <label class="form-check-label" for="flexRadioDefault2"  id="ct4">
                  무제한
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="0" >
                <label class="form-check-label d-flex gap-3" for="flexRadioDefault1"  id="ct3">
                  제한
                  <input type="text" name="sale_end_date" id="datepicker" class="form-control w-25 bi bi-calendar-week">
                </label>
              </div>
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
              <div class="input-group mb-3"></div>
            </select>
          </td>
        </tr>
        <tr id="ct1">
          <th scope="row">할인가</th>
          <td>
            <div class="input-group mb-3 w-50">
              <input type="text" name="coupon_price" class="form-control" aria-label="할인가" value="0" aria-describedby="coupon_price"> 
              <span class="input-group-text" id="coupon_price">원</span>
            </div>
          </td>
        </tr>        
        <tr id="ct2">
          <th scope="row">할인비율</th>
          <td>
            <div class="input-group mb-3 w-50">
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
    <div class="d-flex justify-content-end gap-2">
        <button class="btn btn-outline-danger mt-3 cancle">취소</button>
        <button type="submit" class="btn btn-secondary mt-3 ">쿠폰등록</button>
    </div>
  </form>
</div>

<script>
  $('.cancle').click(function(){
    location.href='coupons.php';
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

  $('#ct3 input').prop('disabled', true);

  $('#use_max_date').change(function(){
    let value = $(this).val();
    $('#ct3 input, #ct4 input').prop('disabled', true);
    if(value == 0){
      $('#ct3 input').prop('disabled', false);
    } else{
      $('#ct4 input').prop('disabled', false);
    }
  });
</script>




<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>