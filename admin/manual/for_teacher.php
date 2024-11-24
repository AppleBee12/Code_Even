<?php
$title = "강사 매뉴얼";
$host = $_SERVER['HTTP_HOST'];
$manual_js = "<script src=\"http://$host/code_even/admin/js/manual.js\"></script>";
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

$menu_admin = ['대시보드', '카테고리 관리', '강좌 관리', '교재 관리', '전체 회원관리', '강사 관리', '수강생 관리', '결제/배송 관리', '쿠폰 관리', '매출/통계 관리', '문의 게시판 관리', '커뮤니티 관리', '상점 관리', '프로필관리'];
$menu_teacher = ['대시보드', '강좌 관리', '교재 관리', '수강생 관리', '매출통계 관리', '문의 게시판 관리'];
$menu_items = ($level == 100) ? $menu_admin : $menu_teacher;

// print_r($menu_items)

?>

<h2><?= $title ?></h2>
<div class="container manual-wrap">
  <div class="manual-body">
    <div>
      <p class="d-flex justify-content-between"><span>선생님 환영합니다!</span><span>최종 업데이트:2024-11-24</span></p>
      <p>이 매뉴얼에서 code even 사이트에서 사용하는 Dashboard와 각 카테고리에 대한 시스템 관리에 관한 내용을 확인할 수 있습니다.</p>
      <p class="pb-5 border-bottom">아래 목차에서 궁금하신 영역을 클릭하셔서 자세한 설명을 확인하세요.<br />
        추가로 궁금하신 부분은 아래로 문의 주시면 순차적으로 답변드리겠습니다.</p>

      <h3>1:1 문의</h3>
      <div class="email-ask mt-3" aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">통합 고객센터 : codeeven@even.co.kr</li>
          <li class="breadcrumb-item active" aria-current="page">
          관리자에게 문의 남기기 : 
            <a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/admin/inquiry/admin_qna.php" class="underline">
            1:1문의 바로가기
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="content_bar">
    <h3>목차</h3>
  </div>
  <div class="d-flex justify-content-around gap-3 orderedlist">
    <ol class="list-group list-group-flush first-ol ol-list col-sm-2">
      <li class="list-group-item"><a href="#li-1">1. 대시보드</a></li>
      <li class="list-group-item"><a href="#li-2">2. 강좌 관리</a>
        <ol>
          <li><a href="#li-2">a. 강좌 목록</a></li>
          <li><a href="#li-2">b. 강좌 등록</a></li>
          <li><a href="#li-2">c. 퀴즈/시험 목록</a></li>
          <li><a href="#li-2">d. 퀴즈/시험 등록</a></li>
          <li><a href="#li-2">e. 퀴즈/시험 결과 관리</a></li>
        </ol>
      </li>
      <li class="list-group-item"><a href="#li-3">3. 교재 관리</a>
        <ol>
          <li><a href="#li-3">a. 교재 목록</a></li>
          <li><a href="#li-3">b. 교재 등록</a></li>
        </ol>
      </li>
    </ol>
    <ol class="list-group list-group-flush second-ol ol-list col-sm-2">
      <li class="list-group-item"><a href="#li-5">5. 전체 회원관리</a></li>
      <li class="list-group-item"><a href="#li-6">6. 강사 관리</a></li>
      <li class="list-group-item"><a href="#li-7">7. 수강생 관리</a>
        <ol>
          <li><a href="#li-7">a. 수강생 목록</a></li>
          <li><a href="#li-7">b. 수강생 질문</a></li>
          <li><a href="#li-7">c. 이메일 발송</a></li>
          <li><a href="#li-7">d. 수강 후기</a></li>
        </ol>
      </li>
    </ol>
    <ol class="list-group list-group-flush third-ol ol-list col-sm-2">
      <li class="list-group-item"><a href="#li-8">8. 결제/배송 관리</a>
        <ol>
          <li><a href="#li-8">a. 주문/결제 목록</a></li>
          <li><a href="#li-8">b. 교재 배송관리</a></li>
          <li><a href="#li-8">c. 환불 관리</a></li>
        </ol>
      </li>
      <li class="list-group-item"><a href="#li-9">9. 쿠폰 관리</a></li>
      <li class="list-group-item"><a href="#li-10">10. 매출/통계 관리</a>
        <ol>
          <li><a href="#li-10">a. 월별 매출 통계</a></li>
          <li><a href="#li-10">b. 강좌 매출 통계</a></li>
          <li><a href="#li-10">c. 교재 매출 통계</a></li>
        </ol>
      </li>
    </ol>
    <ol class="list-group list-group-flush fourth-ol ol-list col-sm-2">
      <li class="list-group-item"><a href="#li-11">11. 문의 게시판 관리</a>
        <ol>
          <li><a href="#li-11">a. 전체 공지사항</a></li>
          <li><a href="#li-11">b. FAQ</a></li>
          <li><a href="#li-11">c. 1:1문의</a></li>
        </ol>
      </li>
      <li class="list-group-item"><a href="#li-12">12. 커뮤니티 관리</a>
        <ol>
          <li><a href="#li-12">a. 고민 상담</a></li>
          <li><a href="#li-12">b. 팀 프로젝트</a></li>
          <li><a href="#li-12">c. 블로그</a></li>
        </ol>
      </li>
      <li class="list-group-item"><a href="#li-13">13. 상점 관리</a></li>
      <li class="list-group-item"><a href="#li-14">14. 프로필 관리</a></li>
    </ol>
  </div>

  <div class="content_bar">
    <h3><?= $title ?></h3>
  </div>
  <div>
    <form action="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/manual/manual_contents.php' ?>">
    <ul class="d-flex gap-3 mt-5 manual_ul">
      <?php
      if (!empty($rows)) {
        foreach ($rows as $content) {
          $menu_title = $menu_items[$content['conid'] - 1] ?? '메뉴 없음';

      ?>
      <li>
        <div class="card" style="width: 20rem;" id="li-<?= $content['conid'] ?>">
          <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/manual/manual_contents.php' ?>">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <h3 class="card-title"><?= $content['conid'] ?>. <?= $menu_title ?></h3>
                <i class="bi bi-mouse2"></i>
              </div>
            </div>
            <img src="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/upload/manual/' . $content['image']; ?>" alt="이미지" class="card-img-top">
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
    </form>
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