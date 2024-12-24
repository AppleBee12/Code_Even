<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');
$service_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/service.js\"></script>";

$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE faq.title LIKE '%$keywords%' OR faq.content LIKE '%$keywords%'";
}

$faq_sql = "SELECT * FROM faq $where_clause";
$faq_result = $mysqli->query($faq_sql);

$dataArr = [];
$categories = [];
$categoryNames = [
  1 => '결제/환불',
  2 => '강의',
  3 => '쿠폰',
  4 => '가입/탈퇴',
  5 => '기타',
  6 => '수료',
  7 => '정산',
  8 => '강사',
];
while ($data = $faq_result->fetch_object()) {
  $dataArr[] = $data;

  // 카테고리 저장
  if (!in_array($data->category, $categories)) {
    $categories[] = $data->category;
  }
}

$question_sql = "SELECT admin_question.*, user.uid, admin_answer.aaid 
                FROM admin_question 
                JOIN user ON admin_question.uid = user.uid 
                LEFT JOIN admin_answer ON admin_question.aqid = admin_answer.aqid 
                WHERE user.userid = '" . (isset($_SESSION['AUID']) ? $_SESSION['AUID'] : '') . "'";
$question_result = $mysqli->query($question_sql);
while ($qdata = $question_result->fetch_object()) {
  $qdataArr[] = $qdata;

  // 카테고리 저장
  if (!in_array($qdata->category, $categories)) {
    $categories[] = $qdata->category;
  }
}

?>
<div class="container">
  <ul class="d-flex justify-content-center service_tab">
    <li class="nav_list_active">
      <a class="nav_item" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/service/faq.php">FAQ</a>
    </li>
    <li class="nav_list">
      <a class="nav_item" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/service/notice.php">공지사항</a>
    </li>
  </ul>

  <div class="service_title">
    <h2 class="headt2">FAQ</h2>
    <div class="d-flex justify-content-center">
      <div class="content">
        <div class="title">
          <h3 class="headt3">궁금한 사항이 있으신가요?</h3>
          <h4 class="headt6">자주 질문하는 내용은 FAQ에 정리되어 있으니 참고해주세요.</h4>
        </div>
        <div class="search">
          <form method="GET" class="d-flex align-items-center">
            <button type="submit"><i class="bi bi-search"></i></button type="submit">
            <input type="text" class="form-control" placeholder="검색어를 입력해주세요" name="keywords"
            value="<?= htmlspecialchars($keywords); ?>">
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="faq_content">
    <?php if (!$keywords): ?>
      <ul class="d-flex justify-content-center faq_tab">
        <?php
        foreach ($categories as $index => $cate) {
          $categoryName = $categoryNames[$cate] ?? '알 수 없음';
          $activeClass = ($index === 0) ? 'active' : '';
        ?>
          <li class="nav_list cate <?= $activeClass; ?>" data-tab="<?=$cate?>">
            <span><?= htmlspecialchars($categoryName); ?></span>
          </li>
        <?php
        }
        ?>
      </ul>
    <?php endif; ?>

    <?php if ($keywords): ?>
    <p>“<?= htmlspecialchars($keywords); ?>” 관련 FAQ 검색 결과가 총 <em><?= count($dataArr); ?></em>건 있습니다.</p>
    <?php endif; ?>

    <?php
      foreach ($categories as $index => $cate) {
    ?>
    <div class="accordion list-group <?= ($index === 0) ? 'active' : ''; ?>" id="faq_accordion<?= $cate;?>" data-category="<?= $cate;?>">
      <?php
        foreach ($dataArr as $data) {
          if ($data->category == $cate) {
      ?>
      <div class="accordion-item">
        <h5 class="accordion-header">
          <button 
            class="accordion-button collapsed headt6" 
            type="button" data-bs-toggle="collapse" 
            data-bs-target="#collapse_<?= $data->fqid; ?>" 
            aria-expanded="false" 
            aria-controls="collapse_<?= $data->fqid; ?>"
          >
            <?= $data->title; ?>
          </button>
        </h5>
        <div id="collapse_<?= $data->fqid; ?>" class="accordion-collapse collapse" data-bs-parent="#faq_accordion<?= $cate;?>">
          <div class="accordion-body headt6"><?= $data->content; ?></div>
        </div>
      </div>
      <?php
        }
      }
      ?>
    </div>
    <?php
      }
    ?>
  </div>


  <div class="qna_more d-flex align-items-center justify-content-between">
    <div class="box d-flex align-items-center gap-4">
      <div class="circle">
        <i class="bi bi-pencil-square"></i>
      </div>
      <div class="description">
        <p class="headt6">원하는 답변을 찾지 못하셨나요?</p>
        <span>궁금한 질문은 1:1 문의를 이용해보세요.</span>
      </div>
    </div>
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna.php" class="headt6">1:1문의하기</a>
  </div>

  <div class="myQna">
    <h2 class="headt3">나의 문의내역</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">등록일</th>
          <th scope="col">문의 분류</th>
          <th scope="col">제목</th>
          <th scope="col">상태</th>
          <th scope="col">삭제</th>
        </tr>
      </thead>
      <tbody>
      <?php
        // 세션에 AUID가 있으면 질문 데이터를 출력
        if (isset($_SESSION['AUID']) && !empty($_SESSION['AUID'])) {
          foreach ($qdataArr as $question) {
            $categoryName = $categoryNames[$question->category] ?? '알 수 없음';
      ?>
        <tr>
          <th scope="row"><?=$question->regdate;?></th>
          <td><?= htmlspecialchars($categoryName); ?></td>
          <td><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna_question_details.php?aqid=<?= $question->aqid; ?>" class="title"><?=$question->qtitle;?></a></td>
          <td><?= $question->aqid ? "답변완료" : "답변대기"; ?></td>
          <td>
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/service/qna_delete.php?aqid=<?= $question->aqid; ?>" class="delete">
              <i class="bi bi-trash-fill"></i>
            </a>
          </td>
        </tr>
        <?php
              }
            } else {
            echo '<tr><td colspan="5" class="text-center">로그인이 필요합니다.</td></tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');?>