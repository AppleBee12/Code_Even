<?php
$title = "관리자 매뉴얼";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$uid = $_SESSION['UID'];
// $sql = "SELECT * FROM manual_contents";
// $result = $mysqli->query($sql);
// $data = $result->fetch_object();

$mnid = ($level == 100) ? 1 : (($level == 10) ? 20 : null);
$type = ($level == 100) ? '관리자' : (($level == 10) ? '강사' : null);; // 원하는 type

$sql = "
SELECT *
FROM 
    manual AS m
LEFT JOIN 
    manual_contents AS mc
ON 
    m.mnid = mc.mnnid
WHERE 
    m.mnid = $mnid  
";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
  // echo '<pre>';
  // print_r($row); // 출력 결과 확인
  // echo '</pre>';
}


?>

<div class="container card">
  <section class="card-body">
    <h2><?php $title ?></h2>
    <div>
      <p class="d-flex justify-content-between"><span>관리자님 환영합니다!</span><span>최종 업데이트:2024-11-24</span></p>
      <p>이 매뉴얼에서 관리자 사이트에서 사용하는 Dashboard와 각 카테고리에 대한 시스템 관리에 관한 내용을 확인할 수 있습니다.</p>
      <p>아래 목차에서 궁금하신 영역을 클릭하셔서 자세한 설명을 확인하세요.<br />
        추가로 궁금하신 부분은 아래 연락처로 문의 주시면 신속히 답변드리겠습니다.</p>

      <h3>E-Mail 문의</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">통합 고객센터 : codeeven@even.co.kr</li>
          <li class="breadcrumb-item active" aria-current="page">렌트 기간 연장 : codeeven@even.co.kr</li>
          <li class="breadcrumb-item active" aria-current="page">기능 개발 담당 : codeeven@even.co.kr</li>
        </ol>
      </nav>
  </section>

  <div class="content_bar">
    <h3>목차</h3>
  </div>
  <div>
    <ul>
      <li>대시보드
      </li>
      <li>카테고리 관리</li>
      <li>강좌 관리</li>
      <li>퀴즈/시험 관리</li>
      <li>교재 관리</li>
      <li>교재 등록</li>
      <li>교재 관리</li>
    </ul>
  </div>
</div>

<ul class="d-flex gap-3 mt-5">
  <li>
    <div class="card" style="width: 20rem;">
      <a href="">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">1. 대시보드</h3>
            <i class="bi bi-mouse2"></i>
          </div>
        </div>
        <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/upload/manual/manual1_1_dashboard.png" class="card-img-top" alt="첫번째 홈페이지의 처음 대시보드">
        <!-- <img src="<?php echo ($row['type'] === 'img') ? 'http://' . $_SERVER['HTTP_HOST'] . $row['image'] : ''; ?>" alt="이미지"> -->
      </a>
    </div>
  </li>

  <li>
    <div class="card" style="width: 20rem;">
      <a href="">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">2. 카테고리 관리</h3>
            <i class="bi bi-mouse2"></i>
          </div>
        </div>
        <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/upload/manual/manual2_1_category.png" class="card-img-top" alt="강좌의 카테고리를 정할 수 있는 카테고리 메뉴 매뉴얼">
      </a>
    </div>
  </li>
  <li>
    <div class="card" style="width: 20rem;">
      <a href="">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">3. 강좌 관리</h3>
            <i class="bi bi-mouse2"></i>
          </div>
        </div>
        <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/upload/manual/manual3_1_lecture.png" class="card-img-top" alt="판매할 강좌를 등록하고 수정할 수 있는 강좌 메뉴 매뉴얼">
      </a>
    </div>
  </li>
  <li>
    <div class="card" style="width: 20rem;">
      <a href="">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">4. 교재 관리</h3>
            <i class="bi bi-mouse2"></i>
          </div>
        </div>
        <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/upload/manual/manual4_1_book.png" class="card-img-top" alt="판매할 교재를 등록하고 수정할 수 있는 교재 메뉴 매뉴얼">
      </a>
    </div>
  </li>
</ul>


<div class="d-flex justify-content-end gap-2">
  <a href="javascript:history.back();"><button class="btn btn-outline-danger">취소</button></a>
  <button class="btn btn-secondary">등록</button>
</div>
</div>


<script>
  // 썸네일
  let thumbnail = $('#thumbnails');
  thumbnail.on('change', (e) => {
    let file = e.target.files[0];

    const reader = new FileReader();
    reader.onloadend = (e) => {
      let attachment = e.target.result;
      if (attachment) {
        let target = $('#thumbnail_preview');
        target.attr('src', attachment)
      }
    }
    reader.readAsDataURL(file);
  });

  //에디터
  $('#blog_save').submit(function(e) {
    //e.preventDefault();
    var markup = target.summernote('code');
    let content = encodeURIComponent(markup);
    $('#contents').val(markup);
  });
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>