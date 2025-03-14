<?php
$title = '마이페이지-문의글보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/mypage_header.php');

// 수강 문의
$classQna_sql = "SELECT student_qna.*, class_data.*, lecture.*, user.*, teacher_qna.asid 
        FROM student_qna 
        LEFT JOIN teacher_qna ON student_qna.sqid = teacher_qna.sqid 
        JOIN class_data ON student_qna.cdid = class_data.cdid
        JOIN lecture ON class_data.leid = lecture.leid
        JOIN user ON class_data.uid = user.uid 
        WHERE user.uid = '" . (isset($_SESSION['UID']) ? $_SESSION['UID'] : '') . "' 
        ORDER BY student_qna.sqid DESC";

$result = $mysqli->query($classQna_sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}



// 서비스문의
$question_sql = "SELECT admin_question.*, user.uid, admin_answer.aaid 
                FROM admin_question 
                JOIN user ON admin_question.uid = user.uid 
                LEFT JOIN admin_answer ON admin_question.aqid = admin_answer.aqid 
                WHERE user.userid = '" . (isset($_SESSION['AUID']) ? $_SESSION['AUID'] : '') . "' 
                ORDER BY admin_question.aqid DESC";
$question_result = $mysqli->query($question_sql);

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

while ($qdata = $question_result->fetch_object()) {
  $qdataArr[] = $qdata;
}
?>
<!--탭 메뉴 시작-->
<nav>
  <div class="mypage_tap_wrapper nav nav-underline headt6" id="nav-tab" role="tablist">
    <button class="mypage_tap nav-link active" id="nav-myLecTab1-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab1" data-tab="lecture" role="tab" aria-controls="nav-myLecTab1" aria-selected="true">강의 문의</button>
    <button class="mypage_tap nav-link" id="nav-myLecTab2-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab2" data-tab="service" role="tab" aria-controls="nav-myLecTab2" aria-selected="false">서비스 문의</button>
  </div>
</nav>
<!--탭 메뉴 끝-->
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">나의 문의 내역</p>
    </div>
    <!--제목 끝-->
    <div class="list_content">
      <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_class_qna_question.php">
        <div class="d-flex justify-content-between align-items-center">
          <p>총 <?= count($dataArr); ?>건</p>
          <button type="submit">1:1 문의하기</button>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">등록일</th>
              <th scope="col">강좌명</th>
              <th scope="col">제목</th>
              <th scope="col">상태</th>
              <th scope="col">삭제</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($dataArr as $data){
            ?>
            <tr>
              <th><?= $data-> regdate; ?></th>
              <td><?= $data-> title; ?></td>
              <td><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_class_qna_question_details.php?sqid=<?= $data->sqid; ?>" class="underline"><?= $data-> qtitle; ?></a></td>
              <td><?= $data->asid ? "답변완료" : "답변대기"; ?></td>
              <td><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_class_qna_delete.php?sqid=<?= $data->sqid; ?>">X</a></td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
      </form>
    </div>  
  </div>
  <div class="tab-pane fade" id="nav-myLecTab2" role="tabpanel" aria-labelledby="nav-myLecTab2-tab"><!-- 탭메뉴2//탭이 없으면 삭제하세용-->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">나의 문의 내역</p>
    </div>
    <!--제목 끝-->  
    <div class="list_content">
      <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna_question.php">
        <div class="d-flex justify-content-between align-items-center">
          <p>총 <?= count($qdataArr); ?>건</p>
          <button type="submit">1:1 문의하기</button>
        </div>
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
              foreach($qdataArr as $question) {
                $categoryName = $categoryNames[$question->category] ?? '알 수 없음';
            ?>
            <tr>
              <th><?=$question->regdate;?></th>
              <td><?=$categoryName;?></td>
              <td>
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/mypage/mypage_qna_question_details.php?aqid=<?=$question->aqid;?>" class="underline"><?=$question->qtitle;?></a>
              </td>
              <td><?= $question->aqid ? "답변완료" : "답변대기"; ?></td>
              <td><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/service/qna_delete.php?aqid=<?= $question->aqid; ?>">X</a></td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
      </form>
    </div>

  </div><!-- 탭메뉴2 끝-->
</div>


</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</div>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>