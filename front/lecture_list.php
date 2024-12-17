<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

// 현재 선택된 카테고리 코드 가져오기
$category_code = isset($_GET['category']) ? $_GET['category'] : null;

// 페이지네이션 설정
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // 현재 페이지 번호
$list = 9; // 한 페이지에 보여줄 강좌 수
$block_ct = 5; // 한 번에 보여질 페이지 블록 수
$start_num = ($page - 1) * $list; // LIMIT 시작점

// 카테고리 조건 추가
$where_clause = "";
if ($category_code) {
  $where_clause = "WHERE cate1 = '$category_code' OR cate2 = '$category_code' OR cate3 = '$category_code'";
}

// 전체 강좌 수 가져오기 (카테고리 조건 포함)
$page_sql = "SELECT COUNT(*) AS cnt FROM lecture $where_clause";
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

// 강좌 리스트 가져오기 (카테고리 조건 및 페이지네이션 포함)
$sql = "SELECT * FROM lecture $where_clause ORDER BY leid DESC LIMIT $start_num, $list";
$result = $mysqli->query($sql);

// 결과를 객체 배열에 저장
$lecture_sql = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_object()) {
    $lecture_sql[] = $row;
  }
} else {
  echo "데이터가 없습니다.";
}

?>

</head>
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
      </ul>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseBackend" aria-expanded="false" aria-controls="collapseBackend">
            백엔드
          </button>
        </li>
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
      </ul>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseDatabase" aria-expanded="false" aria-controls="collapseDatabase">
            데이터베이스
          </button>
        </li>
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
      </ul>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseSecurity" aria-expanded="false" aria-controls="collapseSecurity">
            보안
          </button>
        </li>
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
      </ul>
    </div>
    <!-- 강좌 리스트 출력 시작-->
    <div class="col-9">
      <div class="row w-100">
        <?php
        if (isset($lecture_sql)) {
          foreach ($lecture_sql as $item) {
            ?>
            <div class="lecture_box col-4 mb-3">
              <a href="lecture_view.php?leid=<?= $item->leid; ?>" class="text-decoration-none text-dark">
                <div class="image_box mb-2">
                  <img src="<?= $item->image; ?>" alt="강좌 이미지" />
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
                    <span>5.0</span>
                  </div>
                </div>
                <!-- 중 시작 -->
                <div>
                  <p><?= $item->title; ?></p>
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
                  <i class="bi bi-heart heart-icon" id="heart-icon"></i>
                  <i class="bi bi-heart-fill heart-icon-filled d-none" id="heart-icon-filled"></i>
                  <i class="bi bi-cart-plus"></i>
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
    <div class="list_pagination col-9" aria-label="Page navigation example">
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

<script>

  $(document).ready(function () {
    // 부모 요소를 통해 이벤트 위임
    $(document).on("click", ".heart-icon", function () {
      $(this).addClass("d-none"); // 빈 하트 숨기기
      $(this).siblings(".heart-icon-filled").removeClass("d-none"); // 채워진 하트 보이기
    });

    $(document).on("click", ".heart-icon-filled", function () {
      $(this).addClass("d-none"); // 채워진 하트 숨기기
      $(this).siblings(".heart-icon").removeClass("d-none"); // 빈 하트 보이기
    });
  });

</script>

<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');

?>