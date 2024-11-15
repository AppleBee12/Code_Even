<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');


$sql = "SELECT * FROM category WHERE step=1";
$result = $mysqli->query($sql);
while($data = $result->fetch_object()){
  $cate1[] = $data;
}
// print_r($cate1);

?>



<div class="container ">
  <h2>카테고리 관리</h2>
  <div class="row justify-content-between mt-5">
    <div class="col-md-4">
      <div class="bd d-flex justify-content-center"> 대분류</div>
      <select class="form-select mt-4" id="cate1" aria-label="Default select example">
        <option selected>대분류를 선택하세요</option>
        <?php
          foreach($cate1 as $c1){
        ?>
        <option value="<?= $c1-> code; ?>"><?= $c1->name; ?>
        <h6><span class="badge text-bg-secondary">수정</span></h6></option>
        <?php
          }
        ?>
      </select>
      <!-- Button trigger modal -->
      <div class="btns d-flex justify-content-center mt-4">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cate1_modal">
          대분류 등록
        </button>
      </div>
      

    </div>
    <div class="col-md-4">
    <div class="bd d-flex justify-content-center"> 중분류</div>
      <select class="form-select mt-4" id="cate2" aria-label="Default select example">
        <option selected>대분류를 먼저 선택하세요</option>
      </select>
            <!-- Button trigger modal -->
      <div class="btns d-flex justify-content-center mt-4 ">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cate2_modal">
          중분류 등록
        </button>
      </div>
    </div>

    <div class="col-md-4">
    <div class="bd d-flex justify-content-center"> 소분류</div>
      <select class="form-select mt-4" id="cate3" aria-label="Default select example">
        <option selected>중분류를 먼저 선택하세요</option>
      </select>
            <!-- Button trigger modal -->
      <div class="btns d-flex justify-content-center mt-4">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cate3_modal">
          소분류 등록
        </button>
      </div>
    </div>
  </div>
</div>
<!-- 모달 창 -->
<!-- Modal 1-->
<div class="modal fade" id="cate1_modal" tabindex="-1" aria-labelledby="exampleModalLabel"        aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex gap-1">
        <div class="col-md-6">
          <input class="form-control" type="text"  id="code1" name="code1"  placeholder="분류코드를 입력하세요" aria-label="default input example" pattern="A\d{4}">
        </div>
        <div class="col-md-6">
          <input class="form-control" type="text"  id="name1" name="name1"  placeholder="카테고리명을 입력하세요" aria-label="default input example">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
        <button type="button" class="btn btn-secondary">등록</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal 2-->
<div class="modal fade" id="cate2_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
        <button type="button" class="btn btn-secondary">등록</button>
      </div>
    </div>
  </div>
  </div>
<!-- Modal 3-->
<div class="modal fade" id="cate3_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">취소</button>
        <button type="button" class="btn btn-secondary">등록</button>
      </div>
    </div>
  </div>
</div>








<script>
$('#cate1').change(function(){
  makeOption($(this), 2, '중분류', $('#cate2'));
})
$('#cate2').change(function(){
  makeOption($(this), 3, '소분류', $('#cate3'));
})

function makeOption(e, step, category, target){
  let cate = e.val();
  // console.log(cate, step, category, target);
  let data = {
    cate:cate,
    step:step,
    category:category
  }
  console.log(data);
  
  $.ajax({
    async:false,
    data:data,
    dataType:'html',
    type:'post',
    url: "printOption.php", 

    success: function(result){
      console.log(result);
    target.html(result);
  },
  error: function(error){
    console.log(error);
    }
  });
  }






</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>