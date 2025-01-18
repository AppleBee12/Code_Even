<?php
$title = '팀 프로젝트';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';
//키워드 검색
if ($keywords) {
  $where_clause = "WHERE teamproject.titles LIKE '%$keywords%' OR teamproject.contents LIKE '%$keywords%' OR teamproject.mode LIKE '%$keywords%' OR teamproject.dev_env LIKE '%$keywords%'  OR teamproject.roles LIKE '%$keywords%' OR user.usernick LIKE '%$keywords%' ";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM teamproject JOIN user ON teamproject.uid = user.uid $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

// 페이지네이션
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$list = 10;
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

$sql = "SELECT teamproject.*, user.uid, user.usernick 
        FROM teamproject 
        JOIN user ON teamproject.uid = user.uid 
        $where_clause 
        ORDER BY teamproject.post_id DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}
?>

<div class="container teamprj_wrapper teamproject_wrapper">
  <div class="community_title d-flex flex-column gap-5">
    <h3 class="headt3"><?= $title ?></h3>
    <div class="d-flex justify-content-center align-items-center">
      <div class="content d-flex flex-column gap-3 mx-auto">
        <div class="title">
          <div class="headt3">프로젝트 팀원을 모집해보세요</div>
          <div class="headt6">차근차근 쌓아나가는 협업 노하우, 이븐인들과 같이 성장해보세요!</div>
        </div>
        <!-- //키워드 검색 -->
        <div class="search">
          <form method="GET" class="d-flex align-items-center">
            <button type="button"><i class="bi bi-search"></i></button>
            <input type="text" class="form-control" placeholder="검색어를 입력해주세요" name="keywords" value="<?= htmlspecialchars($keywords); ?>">
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="community_contents_wrapper">
    <div class="keybtn_container row d-flex justify-content-between align-items-center">
      <p class="keywords col-11">
        <?php if ($keywords): ?>
          “<?= htmlspecialchars($keywords); ?>” 관련 <?= $title ?> 검색 결과가 총 <em><?= count($dataArr); ?></em>건 있습니다.
        <?php endif; ?>
      </p>

      <?php if (isset($_SESSION['UID'])): ?>
        <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/community/teamproject_write.php" class="btn btn-danger mb-4 col-1"><i class="bi bi-pencil-fill"></i> 글쓰기
        </a>
      <?php else: ?>
        <!-- 사용자가 로그인하지 않은 경우 -->
        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModaltest" data-bs-whatever="@mdo" class="btn btn-danger mb-4 col-1"><i class="bi bi-pencil-fill"></i> 글쓰기</a>
      <?php endif; ?>

    </div>
    <ul class="d-flex flex-column justify-content-center">
      <?php
      if ($dataArr) {
        foreach ($dataArr as $teamprj) {
      ?>
          <li class="teamprj_content">
            <div>
              <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/community/teamproject_detail.php?post_id=<?= $teamprj->post_id ?>" class="row">
                <div class="teamprj_txt d-flex flex-column justify-content-between col-9n8">
                  <div class="teaprj_title">
                    <p class="subtitle2">프로젝트 시작예정일: <?= $teamprj->start_date ?></p>
                    <p class="headt5 d-inline-block text-truncate"><?= $teamprj->post_id ?>. <?= $teamprj->titles ?></p>
                  </div>
                  <?php
                  // 모집분야(비트플래그 방식)-> txt로 변경하기

                  $roles = $teamprj->roles; // teamproject 테이블에서 roles 값 가져오기

                  $rolesMap = [
                    '기획자' => 1,      // 2^0
                    '디자이너' => 2,    // 2^1
                    '프론트엔드' => 4,  // 2^2
                    '백엔드' => 8,      // 2^3
                    '기타' => 16,     // 2^4
                  ];

                  $selectedRoles = [];
                  foreach ($rolesMap as $roleName => $roleValue) {
                    if (($roles & $roleValue) === $roleValue) {
                      $selectedRoles[] = $roleName;
                    }
                  }
                  ?>
                  <p>모집분야: <?= implode(', ', $selectedRoles); ?></p>
                  <div class="dev_env d-flex">
                    <p>
                      <?php
                      $devEnvArray = explode(',', $teamprj->dev_env);
                      $imageTags = [];
                      foreach ($devEnvArray as $env) {
                        $env = trim($env); // 공백 제거
                        $imageTags[] = "<img class='icon' src='../images/icons/{$env}.png' alt='{$env}' >";
                      }
                      echo implode(' ', $imageTags);
                      //android angular AWS CSS3 docker figma firebase git googlecloud HTML5
                      //ios javascript j-query laravel mongodb oracle python react swift 
                      //typescript vue wordpress
                      ?>
                    </p>
                  </div>
                </div>
                <div class="teamprj_btn col-2n2 d-flex flex-column justify-content-between">
                  <div class="d-flex justify-content-between">
                    <p><i class="bi bi-eye"></i> <?= $teamprj->hits ?></p>
                    <p><i class="bi bi-chat-dots"></i> <?= $teamprj->comments ?></p>
                    <p><i class="bi bi-hand-thumbs-up"></i> <?= $teamprj->likes ?></p>
                  </div>
                  <p class="d-flex justify-content-between"><span>진행 방식</span> <span><?= $teamprj->mode ?></span></p>
                  <p class="d-flex justify-content-between"><span>예상 기간</span> <span><?= $teamprj->durations ?></span></p>
                  <p class="d-flex justify-content-between"><span>작성자</span> <span><?= $teamprj->usernick ?></span></p>
                  <div class="d-flex justify-content-between mt-2">
                    
                      <?= $teamprj->status == '모집중' ?
                        '<div class="btn btn-danger">모집 중</div>'
                        : '<div class="btn btn-secondary">모집 완료</div>' ?>
                    
                    <?php
                    $host = $_SERVER['HTTP_HOST'];
                    $share_link = "'http://' . $host . '/code_even/front/community/teamproject_detail.php?post_id=' . $teamprj->post_id;" ?>
                    <div class="btn btn-outline-secondary">
                      <!-- onclick="copyLink(e)" -->
                      살펴보기
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </li>
      <?php
        }
      } else {
        echo "<li>검색 결과가 없습니다.</li>";
      }
      ?>
    </ul>

    <!-- //Pagination -->
    <div class="list_pagination mt-5">
      <ul class="pagination d-flex justify-content-center">
        <?php
        $previous = $block_start - $block_ct;
        if ($previous < 1) $previous = 1;
        if ($block_num > 1) {
        ?>
          <li class="page-item">
            <a class="page-link" href="teamproject.php?page=<?= $previous; ?>" aria-label="Previous">
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
          <li class="page-item <?= $active; ?>"><a class="page-link" href="teamproject.php?page=<?= $i; ?>"><?= $i; ?></a></li>
        <?php
        }
        $next = $block_end + 1;
        if ($total_block > $block_num) {
        ?>
          <li class="page-item">
            <a class="page-link" href="teamproject.php?page=<?= $next; ?>" aria-label="Next">
              <i class="bi bi-chevron-right"></i>
            </a>
          </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
</div>

<script>
  function copyLink(e) {

    e.preventDefault();
    const link = "<?= $share_link; ?>";
    navigator.clipboard.writeText(link)
      .then(() => {
        alert("링크가 복사되었습니다!");
      })
      .catch(err => {
        console.error("링크 복사에 실패했습니다.", err);
      });
  }
</script>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>