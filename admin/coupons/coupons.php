<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
  integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

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
    width: 45%;
  }
  .cps {
    /* gap: 110px; */
    height: 250px;
  }
</style>

<div class="container">
  <h2 class="mb-5">쿠폰관리</h2>
  <!-- <div class="d-flex gap-5">
      <h5>총 쿠폰 수 18개</h5>
      <h5>활성화 쿠폰 수 9개</h5>
      <h5>비활성화 쿠폰 수 9개</h5>
    </div> -->
  <form class="row justify-content-end">
    <div class="col-lg-4">
      <div class="input-group mb-3">
        <input type="text" class="form-control" id="search" name="search_keyword" placeholder="검색어를 입력하세요."
          aria-label="Recipient's username" aria-describedby="basic-addon2">
        <button type="button" class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </form>

  <div class="row  mb-5 ">
    <?php
    if (isset($dataArr)) {
      foreach ($dataArr as $item) {
        ?>
      <div class="col-6 card p-0 m-3">
          <div class="row g-0">
            <div class="col-md-7 c-img">
              <img src="<?= $item->coupon_image; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-5">
              <div class="card-body">
                    <?php
                    if ($item->status == 1) {
                      echo '<h6><span class="badge text-bg-secondary mb-3">활성화</span>';
                    } else {
                      echo '<h6><span class="badge text-bd-secondary mb-3">비활성화</span>';
                    }
                    ?>
                  </span></h6>
                <h5 class="card-title "><?= $item->coupon_name; ?></h5>
                <p class="card-text bd">사용기한 : <?= $item->use_max_date; ?></p>
                <p class="card-text bd">할인금액 : <?= $item->max_value; ?>원</p>
                <p class="card-text bd"> 최소 사용금액 :<?= $item->use_min_price; ?>원</p>
                <div class="icons d-flex justify-content-end gap-2">
                  <a href="coupon_edit.php?cpid=<?= $item->cpid ?>" class="bi bi-pencil-fill"></a>
                  <a href="coupon_del.php?cpid=<?= $item->cpid ?>" class="delete bi bi-trash"></a>
                </div>
              </div>
            </div>
          </div>
    </div>
    <?php
      }
    }
    ?>
 
  </div>

  <div class="d-flex justify-content-end">
    <a href="coupons_up.php">
      <button class="btn btn-secondary mt-3 ">쿠폰등록</button>
    </a>
  </div>

  <div class="list_pagination" aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
      <?php
        $previous = $block_start - $block_ct;
        if ($previous < 1) $previous = 1;
        if ($block_num > 1) { 
      ?>
      <li class="page-item">
        <a class="page-link" href="notice.php?page=<?= $previous; ?>" aria-label="Previous">
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
      <li class="page-item <?= $active; ?>"><a class="page-link" href="notice.php?page=<?= $i; ?>"><?= $i; ?></a></li>
      <?php
        }
        $next = $block_end + 1;
        if($total_block > $block_num){
      ?>
      <li class="page-item">
        <a class="page-link" href="notice.php?page=<?= $next; ?>" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </a>
      </li>
      <?php
        }
      ?>
    </ul>
  </div>
</div>

<script>
  $('.delete').click(function (e) {
    e.preventDefault();
    if (confirm('정말 삭제할까요?')) {
      window.location.href = $(this).attr('href');
    }
  });
</script>




<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>