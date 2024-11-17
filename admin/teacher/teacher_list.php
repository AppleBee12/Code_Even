<?php
$title = "강사 목록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

$sql = "SELECT * FROM teachers WHERE 1=1"; //teachers 테이블에서 모든 데이터를 조회
$result = $mysqli->query($sql); //쿼리 실행 결과

while($data = $result->fetch_object()){
  $dataArr[] = $data;
}

?>



<div class="container">
  <h2 class="page_title">강사목록</h2>


  <form action="" id="search_form" class="row justify-content-end">
    <div class="col-lg-3">
      <select class="form-select" aria-label="Default select example">
        <option selected>대분류를 선택해주세요(임시)</option>
        <option value="1">웹개발</option>
        <option value="2">클라우드</option>
        <option value="3">보안</option>
      </select>
    </div>
    <div class="col-lg-3">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="분류 선택 또는 검색어를 입력해주세요" aria-label="Recipient's username" aria-describedby="basic-addon2">
      <button type="button" class="btn btn-secondary">
        <i class="bi bi-search"></i>
      </button>
      </div>
    </div>
   
    
  </form>

  <form action="tclist_update.php" method="GET">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
          <th scope="col">이메일</th>
          <th scope="col">분류</th>
          <th scope="col">상태</th>
          <th scope="col">강사전시옵션</th>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
      <?php
          if(isset($dataArr)){
            foreach($dataArr as $item){
        ?> 
        <tr>
          <th scope="row">
            <input type="hidden" name="tcid[]" value="<?= $item->tcid; ?>">
            <?= $item->tcid; ?>
          </th>
          <td><?= $item->tc_userid; ?></td> 
          <td><?= $item->tc_name; ?></td> 
          <td><?= $item->tc_email; ?></td>
          <td><?= $item->tc_cate; ?></td> <!-- 웹개발 -->
          <td>
          <select class="form-select form-select-sm tc_status" aria-label="승인여부" name="tc_ok[<?= $item->tcid; ?>]" id="tc_ok[<?= $item->tcid; ?>]">
              <option value="-1" <?php if($item->tc_ok == -1){echo 'selected';}?>>승인거절</option>
              <option value="0" <?php if($item->tc_ok == 0){echo 'selected';}?>>심사중</option>
              <option value="1" <?php if($item->tc_ok == 1){echo 'selected';}?>>승인완료</option>
            </select>
          </td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" <?php echo $item->isnew ? 'checked' : ''; ?> name="isnew[<?= $item->tcid; ?>]" value="<?= $item->isnew ?>" id="flexCheckDefault">
              <label class="form-check-label" for="isnew">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" <?php echo $item->isrecom ? 'checked' : ''; ?> name="isrecom[<?= $item->tcid; ?>]" value="<?= $item->isrecom ?>" id="flexCheckDefault">
              <label class="form-check-label" for="isrecom">
                추천
              </label>
            </div>
          </td>
          <td class="edit_col">
            <a href="teacher_edit.php?tcid=<?= $item->tcid; ?>">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <?php
            }
          }
        ?>
        <!--
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">승인완료</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td class="edit_col">
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bd-secondary">승인거절</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td class="edit_col">
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        -->
      </tbody> 
    </table>
     <!--//table -->
    <button class="btn btn-outline-secondary ms-auto d-block">일괄수정</button>
  </form>



  <div class="list_pagination" aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
      <li class="page-item">
        <a class="page-link" href="" aria-label="Previous">
          <i class="bi bi-chevron-left"></i>
        </a>
      </li>
      <li class="page-item active"><a class="page-link" href="">1</a></li>
      <li class="page-item"><a class="page-link" href="">2</a></li>
      <li class="page-item"><a class="page-link" href="">3</a></li>
      <li class="page-item">
        <a class="page-link" href="" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </a>
      </li>
    </ul>
  </div>
   <!-- //Pagination -->
</div>

<script>
    $('table .form-check-input').change(function(){
    if($(this).prop( "checked" )){
      $(this).val('1');
    } else{
      $(this).val('0');
    }
  });
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>