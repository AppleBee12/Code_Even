<?php
  $title = '마이페이지-찜한 강좌';
  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

  // 현재 사용자 ID 가져오기
  $uid = $_SESSION['UID'] ?? 0; // 로그인하지 않은 경우 0 설정

  if ($uid > 0) {
      // 찜한 강좌 가져오기
      $sql = "SELECT l.* 
          FROM wishlist w
          JOIN lecture l ON w.leid = l.leid
          WHERE w.uid = $uid
          ORDER BY w.regdate DESC
      ";
      $result = $mysqli->query($sql);

      // 결과를 객체 배열에 저장
      $lecture_sql = [];
      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_object()) {
              $lecture_sql[] = $row;
          }
      }
  } else {
      $lecture_sql = [];
  }
?>


<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">찜한 강좌</p>
    </div>
    <!--제목 끝-->
  </div>
</div>


<h3>찜한강좌</h3>


</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>