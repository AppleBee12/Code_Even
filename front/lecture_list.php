<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');
$wishlist_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/wishlist.js\"></script>";
$cart_icon_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/cart_icon.js\"></script>";


if (isset($_SESSION['UID'])) {
  $uid = (int)$_SESSION['UID']; // 로그인한 사용자의 UID
} else {
  $uid = 'NULL'; // 로그인하지 않은 경우 UID는 NULL
}

// 찜한 강좌 목록 가져오기
$wishlist = [];
if ($uid > 0) {
    $wishlist_sql = "SELECT leid FROM wishlist WHERE uid = $uid";
    $wishlist_result = $mysqli->query($wishlist_sql);
    if ($wishlist_result && $wishlist_result->num_rows > 0) {
        while ($row = $wishlist_result->fetch_object()) {
            $wishlist[] = $row->leid;
        }
    }
}

// 검색어 가져오기
$search = isset($_GET['search']) ? trim($_GET['search']) : null;

// 현재 선택된 카테고리 코드 가져오기
$category_code = isset($_GET['category']) ? $_GET['category'] : null;

// 페이지네이션 설정
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // 현재 페이지 번호
$list = 9; // 한 페이지에 보여줄 강좌 수
$block_ct = 5; // 한 번에 보여질 페이지 블록 수
$start_num = ($page - 1) * $list; // LIMIT 시작점


// 검색어와 카테고리 조건 추가
$conditions = [];

// 검색 조건 추가
if ($search) {
  $search = $mysqli->real_escape_string($search); // SQL Injection 방지
  $conditions[] = "(l.title LIKE '%$search%' OR l.name LIKE '%$search%')";
}


// 카테고리 조건 추가
if ($category_code) {
  $conditions[] = "(l.cate1 = '$category_code' OR l.cate2 = '$category_code' OR l.cate3 = '$category_code')";
}

// 조건 연결
$where_clause = count($conditions) > 0 ? "WHERE " . implode(" AND ", $conditions) : "";


// 전체 강좌 수 가져오기 (카테고리 조건 포함)
$page_sql = "SELECT COUNT(*) AS cnt FROM lecture l $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_object();
$row_num = $page_data->cnt; // 전체 강좌 수

// 전체 페이지 및 블록 계산
$total_page = ceil($row_num / $list); // 전체 페이지 수
$total_block = ceil($total_page / $block_ct); // 전체 블록 수
$block_num = ceil($page / $block_ct); // 현재 블록
$block_start = (($block_num - 1) * $block_ct) + 1; // 블록 시작 페이지
$block_end = $block_start + $block_ct - 1; // 블록 끝 페이지
if ($block_end > $total_page)
  $block_end = $total_page; // 블록 끝이 총 페이지를 초과할 경우 조정

// 강좌 리스트 가져오기 (카테고리 조건 및 페이지네이션 포함, 교재 정보 추가)
$sql = "SELECT 
        l.*, 
        b.book AS book_title, 
        b.price AS book_price
    FROM lecture l
    LEFT JOIN book b ON l.boid = b.boid
    $where_clause
    ORDER BY l.leid DESC 
    LIMIT $start_num, $list
";

$result = $mysqli->query($sql);

// 결과를 객체 배열에 저장
$lecture_sql = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_object()) {
    $lecture_sql[] = $row;
  }
}

?>

<!-- 장바구니 모달 -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">교재 구매 여부</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>교재가 포함된 강좌입니다. 함께 구매하시겠습니까?</p>
                <p>교재명 : <strong class="book-title"></strong></p>
                <p>교재가격 : <strong class="book-price"></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="nobookAddToCart">강좌만 구매</button>
                <button type="button" class="btn btn-primary" id="yesbookAddToCart">교재와 함께 구매</button>
            </div>
        </div>
    </div>
</div>



<div class="container title_wrap">
  <!-- 상단에 모든 강좌 링크 -->
  <p class="headt3">
    <a href="lecture_list.php">강좌</a>
  </p>
</div>
<div class="container d-flex justify-content-center accordion" id="accordionExample">
  <div class="row w-100">
    <!-- 강좌 리스트 아코디언 시작 -->
    <div class="col-3">
      <div class="acc_title">
        <p>웹 개발</p>
      </div>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseFrontend" aria-expanded="true" aria-controls="collapseFrontend">
            프론트엔드
          </button>
        </li>
        <li>
          <div id="collapseFrontend" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <ul class="accordion-body eng">
              <li>
                <a href="lecture_list.php?category=C0001">HTML / CSS</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0002">Javascript</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0003">jQuery</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0004">React</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0005">Angular</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0006">Vue.js</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0007">TypeScript</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseBackend" aria-expanded="false" aria-controls="collapseBackend">
            백엔드
          </button>
        </li>
        <li>
          <div id="collapseBackend" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <ul class="accordion-body eng">
              <li>
                <a href="lecture_list.php?category=C0008">Java</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0009">PHP</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0010">Next.js</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0011">Node.js</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
      <div class="acc_title">
        <p>클라우드 / DB</p>
      </div>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseCloud" aria-expanded="true" aria-controls="collapseCloud">
            클라우드 컴퓨팅
          </button>
        </li>
        <li>
          <div id="collapseCloud" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <ul class="accordion-body eng">
              <li>
                <a href="lecture_list.php?category=C0012">AWS</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0013">Azure</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0014">Google Cloud Platform</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0015">DevOps</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0016">Kubernetes</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseDatabase" aria-expanded="false" aria-controls="collapseDatabase">
            데이터베이스
          </button>
        </li>
        <li>
          <div id="collapseDatabase" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <ul class="accordion-body eng">
              <li>
                <a href="lecture_list.php?category=C0017">SQL</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0018">MySQL</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0019">PostgreSQL</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0020">Oracle</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0021">NoSQL</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0022">MongoDB</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0023">Cassandra</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0024">Couchbase</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
      <div class="acc_title">
        <p>보안 / 네트워크</p>
      </div>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseNetwork" aria-expanded="true" aria-controls="collapseNetwork">
            네트워크 관리
          </button>
        </li>
        <li>
          <div id="collapseNetwork" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <ul class="accordion-body eng">
              <li>
                <a href="lecture_list.php?category=C0025">TCP / IP</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0026">C / C++</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseSecurity" aria-expanded="false" aria-controls="collapseSecurity">
            보안
          </button>
        </li>
        <li>
          <div id="collapseSecurity" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <ul class="accordion-body eng">
              <li>
                <a href="lecture_list.php?category=C0027">CPPG</a>
              </li>
              <li>
                <a href="lecture_list.php?category=C0028">Security</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <!-- 강좌 리스트 출력 시작-->
    <div class="col-9">
      <div class="row w-100">
        <?php if (empty($lecture_sql)) { ?>
        <!-- 검색 결과가 없을 경우 -->
        <div class="col-12">
          <p class="text-center mt-5">&#128064;</p>
          <p class="text-center my-5"> 원하시는 강좌를 찾을 수 없습니다. 방금 검색한 강좌의 첫 번째 강사가 되어보세요!</p>
          <div class="tc_borderline text-center">
          <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/signup/tc_applyform.php">강사 신청하러 가기 <i class="bi bi-box-arrow-up-right"></i>
          </a>
        </div>
        </div>
        <?php } else { ?>
        <!-- 검색 결과 있을경우 또는 리스트 출력 -->
        <?php foreach ($lecture_sql as $item) { ?>
            <div class="lecture_box col-4 mb-3">
              <a href="lecture_view.php?leid=<?= $item->leid; ?>">
                <div class="image_box mb-2">
                  <img src="<?= $item->image; ?>" alt="강좌 이미지">
                </div>
                <div class="d-flex justify-content-between">
                  <!-- 상 시작-->
                  <div>
                    <?php if ($item->isbest == 1) { ?>
                      <span class="badge badge-outline">BEST</span>
                    <?php } ?>
                    <?php if ($item->isnew == 1) { ?>
                      <span class="badge badge-outline">NEW</span>
                    <?php } ?>
                    <?php
                    if ($item->course_type === 'recipe') { ?>
                      <span class="badge text-bg-danger">레시피</span>
                    <?php } elseif ($item->course_type !== 'general') { ?>
                      <span class="badge text-bg-danger"><?= htmlspecialchars($item->course_type); ?></span>
                    <?php } ?>
                  </div>
                  <div class="d-flex gap-2">
                    <i class="bi bi-star-fill"></i>
                    <span class="custom_tt">5.0</span>
                  </div>
                </div>
                <!-- 중 시작 -->
                <div>
                  <p class="custom_tt"><?= $item->title; ?></p>
                </div>
                <div>
                  <p class="tc_name"><?= $item->name; ?></p>
                </div>
              </a>
              <!-- 하 시작 -->
              <div class="d-flex justify-content-between">
                <div>
                  <b><?= number_format($item->price); ?></b>원
                </div>
                <div class="icon-container">
                  <!-- 빈 하트 -->
                  <i class="bi bi-heart heart-icon <?= in_array($item->leid, $wishlist) ? 'd-none' : ''; ?>" data-leid="<?= $item->leid; ?>"></i>
                  <!-- 채워진 하트 -->
                  <i class="bi bi-heart-fill heart-icon-filled <?= in_array($item->leid, $wishlist) ? '' : 'd-none'; ?>" data-leid="<?= $item->leid; ?>"></i>
                  <!-- 장바구니 추가 아이콘 -->
                  <i class="bi bi-cart-plus cart-add-icon"
                    data-leid="<?= $item->leid; ?>" 
                    data-boid="<?= $item->boid ?? null; ?>" 
                    data-price="<?= $item->price; ?>" 
                    data-has-book="<?= !empty($item->book_title) ? 1 : 0; ?>"
                    data-book-title="<?= $item->book_title ?? ''; ?>"
                    data-book-price="<?= $item->book_price ?? 0; ?>">
                  </i>
                </div>
              </div>
              <!-- 하 끝 -->
            </div>
            <?php
          }
        }
        ?>
      </div>
    </div>
    <!-- 강좌 리스트 출력 끝 -->
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-3"></div>
    <!-- Pagination -->
    <div class="list_pagination col-9">
      <ul class="pagination d-flex justify-content-center">
        <?php
        $previous = $block_start - $block_ct;
        if ($previous < 1)
          $previous = 1;
        if ($block_num > 1) {
          ?>
          <li class="page-item">
            <a class="page-link" href="lecture_list.php?page=<?= $previous; ?>" aria-label="Previous">
              <i class="bi bi-chevron-left"></i>
            </a>
          </li>
        <?php } ?>
        <?php
        for ($i = $block_start; $i <= $block_end; $i++) {
          $active = ($page == $i) ? 'active' : '';
          ?>
          <li class="page-item <?= $active; ?>">
            <a class="page-link" href="lecture_list.php?page=<?= $i; ?>"><?= $i; ?></a>
          </li>
        <?php } ?>
        <?php
        $next = $block_end + 1;
        if ($total_block > $block_num) {
          ?>
          <li class="page-item">
            <a class="page-link" href="lecture_list.php?page=<?= $next; ?>" aria-label="Next">
              <i class="bi bi-chevron-right"></i>
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>

<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');

?>