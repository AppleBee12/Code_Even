<?php
$title = "관리자 매뉴얼";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$uid = $_SESSION['UID'];
// $sql = "SELECT * FROM manual_contents";
// $result = $mysqli->query($sql);
// $data = $result->fetch_object();

$mnid = ($level == 100) ? 1 : (($level == 10) ? 20 : null);
$type = ($level == 100) ? '관리자' : (($level == 10) ? '강사' : null); // 원하는 type


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
    AND mc.type = 'img' -- 이미지 타입만 선택
GROUP BY 
    mc.conid
HAVING 
    mc.mcid = MIN(mc.mcid) -- mcid가 가장 작은 항목 선택
";
$result = $mysqli->query($sql);

$rows = []; // 결과를 저장할 배열
if ($result) {
  while ($row = $result->fetch_assoc()) {
    if ($row['type'] === 'img') { // 이미지 타입만 저장
      $rows[] = $row;
    }
  }
}

// echo '<pre>';
//   print_r($rows); // 출력 결과 확인
//   echo '</pre>';

// while ($row = $result->fetch_assoc()) {
//   echo '<pre>';
//   print_r($row); // 출력 결과 확인
//   echo '</pre>';
// }

$menu_admin = ['대시보드', '카테고리 관리','강좌 관리','교재 관리','전체 회원관리','강사 관리','수강생 관리','결제/배송 관리', '쿠폰 관리','매출/통계 관리','문의 게시판 관리','커뮤니티 관리','상점 관리','프로필관리'];
$menu_teacher = ['대시보드', '카테고리 관리'];
$menu_items = ($level == 100) ? $menu_admin : $menu_teacher;

// print_r($menu_items)

?>

<h2><?= $title ?></h2>
<div class="container card">
  <section class="card-body">
    <div>
      <p class="d-flex justify-content-between"><span>관리자님 환영합니다!</span><span>최종 업데이트:2024-11-24</span></p>
      <p>이 매뉴얼에서 관리자 사이트에서 사용하는 Dashboard와 각 카테고리에 대한 시스템 관리에 관한 내용을 확인할 수 있습니다.</p>
      <p>아래 목차에서 궁금하신 영역을 클릭하셔서 자세한 설명을 확인하세요.<br />
        추가로 궁금하신 부분은 아래 연락처로 문의 주시면 순차적으로 답변드리겠습니다.</p>

      <h3>E-Mail 문의</h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">통합 고객센터 : codeeven@even.co.kr</li>
          <li class="breadcrumb-item active" aria-current="page">렌트 기간 연장 : codeeven@even.co.kr</li>
          <li class="breadcrumb-item active" aria-current="page">기능 개발 담당 : codeeven@even.co.kr</li>
        </ul>
      </nav>
    </div>
  </section>

  <div class="content_bar">
    <h3>목차</h3>
  </div>
  <div class="d-flex justify-content-between orderedlist">
    <ol>
      <li><a href="">대시보드</a></li>
      <li><a href="">카테고리 관리</a></li>
      <li><a href="">강좌 관리</a>
        <ol>
          <li><a href="">강좌 등록 관리</a></li>
          <li><a href="">퀴즈/시험 관리</a></li>
        </ol>
      </li>
      <li><a href="">교재 관리</a>
        <ol>
          <li><a href="">교재 등록</a></li>
          <li><a href="">교재 관리</a></li>
        </ol>
      </li>
    </ol>
    <ol>
      <li><a href="">전체 회원관리</a></li>
      <li><a href="">강사 관리</a></li>
      <li><a href="">수강생 관리</a>
        <ol>
          <li><a href="">수강생 목록</a></li>
          <li><a href="">수강생 질문</a></li>
          <li><a href="">이메일 발송</a></li>
          <li><a href="">수강 후기</a></li>
        </ol>
      </li>
    </ol>
    <ol>
      <li><a href="">매출/통계 관리</a>
        <ol>
          <li><a href="">월별 매출 통계</a></li>
          <li><a href="">강좌 매출 통계</a></li>
          <li><a href="">교재 매출 통계</a></li>
        </ol>
      </li>
      <li><a href="">문의 게시판 관리</a>
        <ol>
          <li><a href="">전체 공지사항</a></li>
          <li><a href="">FAQ</a></li>
          <li><a href="">1:1문의</a></li>
        </ol>
      </li>
    </ol>
    <ol>
      <li><a href="">커뮤니티 관리</a>
        <ol>
          <li><a href="">고민 상담</a></li>
          <li><a href="">팀 프로젝트</a></li>
          <li><a href="">블로그</a></li>
        </ol>
      </li>
      <li><a href="">관리자 매뉴얼</a></li>
      <li><a href="">상점 관리</a></li>
    </ol>
  </div>

  <div>
    <ul class="d-flex gap-3 mt-5 manual_ul">
      <?php
      if (!empty($rows)) {
        foreach ($rows as $content) {
          $menu_title = $menu_items[$content['conid'] - 1] ?? '메뉴 없음';

      ?>
      <li>
        <div class="card" style="width: 20rem;">
          <a href="">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <h3 class="card-title"><?= $content['conid'] ?>. <?= $menu_title ?></h3>
                <i class="bi bi-mouse2"></i>
              </div>
            </div>
            <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $content['image']; ?>" alt="이미지" class="card-img-top">
          </a>
        </div>
      </li>
      <?php
        }
      } else {
        echo "<tr><td colspan='10'>검색 결과가 없습니다.</td></tr>";
      }
      ?>
    </ul>
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