<?php
$title = "관리자 매뉴얼";
$host = $_SERVER['HTTP_HOST'];
$manual_js = "<script src=\"http://$host/code_even/admin/js/manual.js\"></script>";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$uid = $_SESSION['UID'];

$mnid = ($level == 100) ? 1 : (($level == 10) ? 20 : null);
$type = ($level == 100) ? '관리자' : (($level == 10) ? '강사' : null); 
// 원하는 type


$sql = "SELECT *
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

$menu_admin = ['대시보드', '카테고리 관리', '강좌 관리', '교재 관리', '전체 회원관리', '강사 관리', '수강생 관리', '결제/배송 관리', '쿠폰 관리', '매출/통계 관리', '문의 게시판 관리', '커뮤니티 관리', '상점 관리', '프로필관리'];
$menu_teacher = ['대시보드', '강좌 관리', '교재 관리', '수강생 관리', '매출통계 관리', '문의 게시판 관리'];
$menu_items = ($level == 100) ? $menu_admin : $menu_teacher;

?>

<h2><?= $title ?></h2>
<div class="container manual-wrap">
  <div class="manual-body">
    <div>
      <p class="d-flex justify-content-between"><span>관리자님 환영합니다!</span><span>최종 업데이트:2025-02-06</span></p>
      <p>이 매뉴얼에서 code even 관리자 사이트에서 사용하는 Dashboard와 각 카테고리에 대한 시스템 관리에 관한 내용을 확인할 수 있습니다.</p>
      <p class="pb-5 border-bottom">아래 목차에서 궁금하신 영역을 클릭하셔서 자세한 설명을 확인하세요.<br />
        추가로 궁금하신 부분은 아래로 문의 주시면 순차적으로 답변드리겠습니다.</p>

      <h3>E-Mail 문의</h3>
      <div class="email-ask mt-3" aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">통합 고객센터 : codeeven@even.co.kr</li>
          <li class="breadcrumb-item active" aria-current="page">렌트 기간 연장 : codeeven@even.co.kr</li>
          <li class="breadcrumb-item active" aria-current="page">기능 개발 담당 : codeeven@even.co.kr</li>
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
      <li class="list-group-item"><a href="#li-2">2. 카테고리 관리</a></li>
      <li class="list-group-item"><a href="#li-3">3. 강좌 관리</a>
        <ol>
          <li><a href="#li-3">a. 강좌 등록 관리</a></li>
          <li><a href="#li-3">b. 퀴즈/시험 관리</a></li>
        </ol>
      </li>
      <li class="list-group-item"><a href="#li-4">4. 교재 관리</a>
        <ol>
          <li><a href="#li-4">a. 교재 등록</a></li>
          <li><a href="#li-4">b. 교재 관리</a></li>
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
          <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/manual/manual_contents.php?mnnid=' . $content['mnnid'] . '&conid=' . $content['conid']; ?>">

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
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>