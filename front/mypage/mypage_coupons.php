<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/common.css">

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
$title = '마이페이지-보유쿠폰';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');



if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='../login/login.php';
  </script>";
}
// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE coupons.coupon_name LIKE '%$keywords%'";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM coupons $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

// 페이지네이션
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$list = 4;
$start_num = ($page - 1) * $list;
$block_ct = 5;
$block_num = ceil($page / $block_ct);
$block_start = (($block_num - 1) * $block_ct) + 1;
$block_end = $block_start + $block_ct - 1;

$total_page = ceil($row_num / $list);
$total_block = ceil($total_page / $block_ct);
if ($block_end > $total_page) {
  $block_end = $total_page;
}

$sql = "SELECT coupons.* 
        FROM coupons 
        $where_clause 
        ORDER BY coupons.cpid DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);


// $sql = "SELECT * FROM coupons WHERE 1=1 $search_where ORDER BY cpid DESC LIMIT $start_num, $list"; //products 테이블에서 모든 데이터를 조회

// $result = $mysqli->query($sql); //쿼리 실행 결과

while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}


?>
<style>
  .text-bg-secondary-light {
    background-color: var(--bk300);
    /* light 배경 색상 */
  }

  .card {
    width: 46%;
    height: 210px;
    .c-img img{
      height: 210px;
      width: 366px;
    }
  }
  .cps {
    /* gap: 110px; */
    height: 250px;
  }
  .text-bd-secondary{
    color: var(--bk700);
  }
  
</style>
<!--탭 메뉴 시작-->
<div class="mypage_tap_wrapper d-flex justify-content-between">
  <div class="coupons_wrapper d-flex">
    <div class="mypage_tap headt6 active"><a href="#">사용 가능한 쿠폰 (4)</a></div>
    <div class="mypage_tap headt6"><a href="">사용완료·기간만료 (1)</a></div>
  </div>
  <div class="asdf d-flex align-items-center">
    <button type="button" class="btn discount_box subtitle2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    쿠폰 및 할인 이용 안내
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">쿠폰 이용 안내서</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body color_change">
          <ol>
            <li>쿠폰 확인
              <ul>
                <li>내 쿠폰함에서 보유하고 있는 쿠폰을 확인하세요.</li>
                <li>쿠폰의 유효기간과 사용 조건을 반드시 확인해야 합니다.</li>
              </ul>
            </li>
            <li>쿠폰 선택
              <ul>
                <li>강좌를 구매할 때 쿠폰을 선택할 수 있습니다.</li>
                <li>구매 화면에서 사용할 쿠폰을 선택하여 적용하세요.</li>
              </ul>
            </li>
            <li>이용 제한 확인
              <ul>
                <li>유효기간이 지난 쿠폰은 사용할 수 없으니 미리 확인하고 사용하세요.</li>
              </ul>
            </li>
            <li>기타 유의사항
              <ul>
                <li>하나의 강좌에 한 개의 쿠폰만 사용할 수 있습니다.</li>
                <li>쿠폰은 다른 할인 혜택과 중복 적용되지 않습니다.</li>
                <li>쿠폰을 사용한 구매는 환불 시 쿠폰이 복원되지 않을 수 있으니 신중히 사용하세요.</li>
              </ul>
            </li>
            <li>문의사항
              <ul>
                <li>쿠폰 사용에 문제가 있거나 도움이 필요하시면 고객센터에 문의하세요.</li>
              </ul>
            </li>
          </ol>
          </div>
          <div class="modal-footer ok_btn">
            <button type="button" class="btn" data-bs-dismiss="modal">확인</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Button trigger modal -->
</div>
<!--탭 메뉴 끝-->
<!--제목 시작-->
<div class="mypage_title_wrapper">
  <p class="mypage_title headt5">사용 가능한 쿠폰</p>
</div>
<!--제목 끝-->
<div class="container">


  <!--나중에 이 div만 삭제하고 사용하세요-->
  <div class="for_explain_remove_plz">
    <div class="row  mb-5 justify-content-center">
      <?php
      if (isset($dataArr)) {
      foreach ($dataArr as $item) {
        ?>
      <div class="col-6 card p-0 m-3">
        <div class="row g-0">
          <div class="col-md-7 c-img">
            <img src="<?= $item->coupon_image; ?>" class="img-fluid rounded-start" alt="Coupon Image">
            </div>
            <div class="col-md-5">
              <div class="card-body">
                <?php
                if ($item->status == 1) {
                  echo '<span class="badge text-bg-secondary mb-3">활성화</span>';
                } else {
                  echo '<span class="badge text-bd-secondary mb-3">비활성화</span>';
                }
                ?>
                <h5>
                  <div class="card-title"><?= $item->coupon_name; ?></div>
                </h5>
                <p class="card-text bd">사용기한 : 
                <?php 
                  if($item->use_max_date === 'unlimited'){
                    echo "무제한";
                  }else{
                    echo htmlspecialchars($item->use_max_date);
                  }
                ?>  
                </p>
                <p class="card-text bd">할인금액 : <?= $item->max_value; ?>원</p>
                <p class="card-text bd"> 최소 사용금액 : <?= $item->use_min_price; ?>원</p>
                
              </div>
            </div>
          </div>
        </div>
      <?php
        }
      }
      ?>
    </div>
    <div class="list_pagination" aria-label="Page navigation example">
      <ul class="pagination d-flex justify-content-center">
        <?php
          $previous = $block_start - $block_ct;
          if ($previous < 1) $previous = 1;
          if ($block_num > 1) { 
        ?>
        <li class="page-item">
          <a class="page-link" href="coupons.php?page=<?= $previous; ?>" aria-label="Previous">
            <i class="bi bi-chevron-left"></i>
          </a>
        </li>
        <?php
          }
        ?>
        <?php
          for ($i = $block_start; $i <= $block_end; $i++) {
            $active = ($page == $i) ? 'active' : '';
        ?>
        <li class="page-item <?= $active; ?>"><a class="page-link" href="coupons.php?page=<?= $i; ?>"><?= $i; ?></a></li>
        <?php
          }
          $next = $block_end + 1;
          if($total_block > $block_num){
        ?>
        <li class="page-item">
          <a class="page-link" href="coupons.php?page=<?= $next; ?>" aria-label="Next">
            <i class="bi bi-chevron-right"></i>
          </a>
        </li>
        <?php
          }
        ?>
      </ul>
  </div>
</div>
  <!--나중에 이 div만 삭제하고 사용하세요-->


</div>
</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>