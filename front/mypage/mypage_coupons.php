<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/common.css">

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
$title = '마이페이지-보유쿠폰';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/mypage_header.php');


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
$sql_available = "
SELECT 
    c.coupon_name, 
    c.coupon_image, 
    c.max_value, 
    c.use_min_price, 
    uc.use_max_date, 
    uc.status 
FROM 
    user_coupons uc
JOIN 
    coupons c ON uc.couponid = c.cpid 
WHERE 
    uc.userid = ? AND uc.status = 1
ORDER BY 
    uc.couponid DESC";
$stmt_available = $mysqli->prepare($sql_available);
$stmt_available->bind_param('s', $userid);
$stmt_available->execute();
$result_available = $stmt_available->get_result();
$data_available = $result_available->fetch_all(MYSQLI_ASSOC);

// 사용 완료 또는 기간 만료 쿠폰 조회
$sql_expired = "
SELECT 
    c.coupon_name, 
    c.coupon_image, 
    c.max_value, 
    c.use_min_price, 
    uc.use_max_date, 
    uc.status 
FROM 
    user_coupons uc
JOIN 
    coupons c ON uc.couponid = c.cpid 
WHERE 
    uc.userid = ? AND uc.status = 0
ORDER BY 
    uc.couponid DESC";
$stmt_expired = $mysqli->prepare($sql_expired);
$stmt_expired->bind_param('s', $userid);
$stmt_expired->execute();
$result_expired = $stmt_expired->get_result();
$data_expired = $result_expired->fetch_all(MYSQLI_ASSOC);

?>
<style>
  .text-bg-secondary-light {
    background-color: var(--bk300);
    /* light 배경 색상 */
  }

  .card {
    /* width: 46%; */
    height: 230px;
    .c-img img{
      /* height: 210px; */
      /* width: 366px; */
    }
  }
  .cps {
    /* gap: 110px; */
    height: 250px;
  }
  .text-bd-secondary{
    color: var(--bk700);
  }
  .card-title{
    font-size:19px;
  }
  
</style>
<!--탭 메뉴 시작-->
<div class="mypage_tap_wrapper d-flex justify-content-between">
  <!--탭 메뉴 시작-->
  <nav>
    <div class=" nav nav-underline headt6" id="nav-tab" role="tablist">
      <button class="mypage_tap nav-link active" id="nav-myLecTab1-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab1"  role="tab" aria-controls="nav-myLecTab1" aria-selected="true">사용 가능한 쿠폰 (1)</button>
      <button class="mypage_tap nav-link" id="nav-myLecTab2-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab2"  role="tab" aria-controls="nav-myLecTab2" aria-selected="false">사용완료·기간만료 (1)</button>
    </div>
  </nav>
  <!--탭 메뉴 끝-->
  <div class="asdf d-flex align-items-center">
    <button type="button" class="btn discount_box subtitle2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    쿠폰 및 할인 이용 안내
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modao_dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 coupon_info_wrapper" id="exampleModalLabel">쿠폰 이용 안내서</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body color_change coupon_info">
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

<!--제목 끝-->
<div class="container p-0">
  <div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
    <div class="tab-pane fade show active mb-5" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
        <?php if (!empty($data_available)) : ?>
            <?php foreach ($data_available as $coupon) : ?>
              <div class="col-12 mb-3">
                <div class="card col-6">
                  <div class="row g-0 align-items-center">
                    <div class="col-md-7">
                      <img src="<?= htmlspecialchars($coupon['coupon_image']) ?>" class="img-fluid rounded-start" alt="Coupon Image">
                    </div>
                    <div class="col-md-5">
                      <div class="card-body">
                      <span class="badge bg-success mb-3">사용 가능</span>
                      <h5 class="card-title"><?= htmlspecialchars($coupon['coupon_name']) ?></h5>
                      <p class="card-text mb-1">사용 기한: <?=substr(htmlspecialchars($coupon['use_max_date']), 0, 10);?></p>
                        <p class="card-text mb-1">최대 할인 금액: <?= number_format($coupon['max_value']) ?>원</p>
                        <p class="card-text mb-1">최소 사용 금액: <?= number_format($coupon['use_min_price']) ?>원</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12">
                <p>사용 가능한 쿠폰이 없습니다.</p>
            </div>
        <?php endif; ?>
    </div>
  </div>

  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show mb-5" id="nav-myLecTab2" role="tabpane2" aria-labelledby="nav-myLecTab2-tab"><!-- 탭메뉴1 -->
      <!-- 탭메뉴1내용 -->
          <div class="card col-6">
            <div class="row g-0 align-items-center">
              <div class="col-md-7 c-img">
                <img src="../../admin/upload/coupons/coupons1.png" class="img-fluid rounded-start" alt="Coupon Image">
                </div>
                <div class="col-md-5">
                  <div class="card-body">
                  <span class="badge text-bd-secondary mb-3">사용불가능</span>
                    <h5>
                      <div class="card-title">환승회원쿠폰</div>
                    </h5>
                    <p class="card-text bd">사용기한 : 2024-12-21
                    </p>
                    <p class="card-text bd">할인금액 : 20,000원</p>
                    <p class="card-text bd"> 최소 사용금액 : 10,000원</p>
                  </div>
                </div>
              </div>
            </div>
      </div>
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
  <!--나중에 이 div만 삭제하고 사용하세요-->


</div>
</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</div>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>