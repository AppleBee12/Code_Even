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
          <div class="box mb-3" id="addedImages">
            <span>쿠폰 이미지를 등록해주세요.</span>
            <div class="image">
              <img id="previewImage" class="image"><img src="" alt="">
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
    <div class="d-flex justify-content-end ">
        <button class="btn btn-outline-danger mt-3 cancle">취소</button>
        <button type="submit" class="btn btn-secondary mt-3 ">쿠폰등록</button>
    </div>
  </form>
</div>

<script>
  // $('#upfile').change(function(){
  //   let files = $(this).prop('files');
  //   console.log(files);
  //   files.foreach((item)=>{ //aattachFile에 일을 시킴 -> 할일
  //     attachFile(item);
  //   });
  // });

  // function attachFile(file){ //파일이 들어오면 할 일
  //   let formData = new FormData(); //비어있음
  //   formData.append('savefile',file); //이미지 첨부
  //   $.ajax({
  //     url:'coupons_image_save.php',
  //     data:formData,
  //     cache: false, //이미지 정보를 브라우저 저장
  //     contentType:false, //전송되는 데이터 타입
  //     processData:false, //전송되는 데이터 처리(해석)
  //     dataType:'json',
  //     type:'POST',
  //     success:function(return_data){ //성공한 데이터를 return_data로 받는다. 
  //       if(return_data.result === 'size'){
  //         alert('10MB 이하만 첨부할 수 있습니다.');
  //         return; //아무것도 없는채 내뱉음
  //       }else if(return_data.result === 'image'){
  //         alert('이미지만 첨부할 수 있습니다.');
  //         return; //아무것도 없는채 내뱉음
  //       }else if(return_data.result === 'error'){
  //         alert('첨부실패, 관리자에게 문의하세요.');
  //         return; //아무것도 없는채 내뱉음
  //       }else{
  //         $('#addedImages').append('') //
  //         alert('첨부완료');
  //       }
  //     }
  //   })
  // }
  const fileInput = document.getElementById('coupon_image');
  const previewImage = document.getElementById('previewImage');

  // 파일 입력 변경 시 이미지 미리보기
  fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0]; // 선택한 첫 번째 파일
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();

      // 파일 읽기 완료 시 실행
      reader.onload = (e) => {
        previewImage.src = e.target.result; // 이미지 src 설정
        previewImage.style.display = 'block'; // 이미지 표시
      };

      reader.readAsDataURL(file); // 파일을 Data URL로 읽기
    } else {
      previewImage.src = ''; 
      previewImage.style.display = 'none'; // 이미지 숨기기
    }
  });


// result size->용량 10메가 넘은것
//image -> image가아님 
</script>




<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>