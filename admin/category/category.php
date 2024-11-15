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
  <div class="row">
    <div class="col-md-4">
      <select class="form-select mt-4" id="cate1" aria-label="Default select example">
        <option selected>대분류를 선택하세요</option>
        <?php
          foreach($cate1 as $c1){
        ?>
        <option value="<?= $c1-> code; ?>"><?= $c1->name; ?></option>
        <?php
          }
        ?>
      </select>
    </div>
    <div class="col-md-4">
      <select class="form-select mt-4" id="cate2" aria-label="Default select example">
        <option selected>대분류를 먼저 선택하세요</option>
      </select>
    </div>
    <div class="col-md-4">
      <select class="form-select mt-4" id="cate3" aria-label="Default select example">
        <option selected>중분류를 먼저 선택하세요</option>
      </select>
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