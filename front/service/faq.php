<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');

$sql = "SELECT category FROM faq";
$result = $mysqli->query($sql);

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
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;

  // 카테고리 저장
  if (!in_array($data->category, $categories)) {
    $categories[] = $data->category;
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
          <form action="#" class="d-flex align-items-center">
            <button type="submit"><i class="bi bi-search"></i></button type="submit">
            <label for="faqSearch" class="visually-hidden">FAQ 검색창</label>
            <input type="search" class="form-control" id="faqSearch" placeholder="검색어를 입력해주세요">
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="faq_content">
    <ul class="d-flex justify-content-center faq_tab">
      <?php
        foreach ($categories as $index => $cate) {
          $categoryName = $categoryNames[$cate] ?? '알 수 없음';
          $activeClass = ($index === 0) ? 'active' : '';
      ?>
      <li class="nav_list <?= $activeClass; ?>">
        <span><?= htmlspecialchars($categoryName); ?></span>
      </li>
      <?php
        }
      ?>
    </ul>
    <p class="hide">“검색어” 관련 공지사항 검색 결과가 총 <em>1</em>건 있습니다.</p>

    <div class="accordion list-group" id="faq_accordion">
      <div class="accordion-item">
        <h5 class="accordion-header">
          <button class="accordion-button collapsed headt6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            강의는 어떻게 수강하나요?
          </button>
        </h5>
        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#faq_accordion">
          <div class="accordion-body headt6">강의를 수강하려면, 회원 가입 후 로그인하고 원하는 강의를 선택하여 수강 신청을 하시면 됩니다.</div>
        </div>
      </div>
      <div class="accordion-item">
        <h5 class="accordion-header">
          <button class="accordion-button collapsed headt6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            강의는 어떻게 수강하나요?
          </button>
        </h5>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faq_accordion">
          <div class="accordion-body headt6">강의를 수강하려면, 회원 가입 후 로그인하고 원하는 강의를 선택하여 수강 신청을 하시면 됩니다.</div>
        </div>
      </div>
      <div class="accordion-item">
        <h5 class="accordion-header">
          <button class="accordion-button collapsed headt6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
            Accordion Item #3
          </button>
        </h5>
        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#faq_accordion">
          <div class="accordion-body headt6">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
        </div>
      </div>
    </div>
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
    <button class="headt6">1:1문의하기</button>
  </div>

  <div class="myQna">
    <h2 class="headt3">나의 문의내역</h2>
    <table class="table list_table">
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
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td>X</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<script>
const tabs = document.querySelectorAll(".faq_content ul li");
tabs.forEach(tab => {
  tab.addEventListener("click", function () {
    tabs.forEach(t => t.classList.remove("active"));
    this.classList.add("active");
    // 연결된 콘텐츠 활성화
    const target = this.getAttribute("data-tab");
    document.getElementById(target).classList.add("active");
  });
});
</script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');?>