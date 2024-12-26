<?php
$title = '마이페이지-찜한 강좌';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/mypage_header.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/wishlist.js\"></script>";

if (isset($_SESSION['UID'])) {
  $uid = (int)$_SESSION['UID']; // 로그인한 사용자의 UID

  // 찜한 강좌 ID 목록 가져오기
  $wishlist_sql = "SELECT leid FROM wishlist WHERE uid = $uid";
  $wishlist_result = $mysqli->query($wishlist_sql);
  $wishlist = [];

  if ($wishlist_result && $wishlist_result->num_rows > 0) {
      while ($row = $wishlist_result->fetch_assoc()) {
          $wishlist[] = (int)$row['leid'];
      }
  }

  // 찜한 강좌 가져오기
  $sql = "SELECT 
      l.*
      FROM wishlist w
      JOIN lecture l ON w.leid = l.leid
      WHERE w.uid = $uid
      ORDER BY w.regdate DESC
  ";
  $result = $mysqli->query($sql);

  // 결과를 객체 배열에 저장
  $wish_lecture_sql = [];
  if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_object()) {
          $wish_lecture_sql[] = $row;
      }
  }
} else {
  $uid = 'NULL'; // 로그인하지 않은 경우 UID는 NULL
  $wishlist = []; // 빈 배열
  $wish_lecture_sql = [];
}
?>

<div>
  <!--제목 시작-->
  <div class="mypage_title_wrapper">
    <p class="mypage_title headt5">찜한 강좌</p>
  </div>
  <div>
    <div class="pt-2">
        <!-- 강좌 리스트 출력 시작-->
        <div class="row w-100">
        <?php if (empty($wish_lecture_sql)) { ?>
        <!-- 찜한 강좌가 없을 경우 -->
        <div>
          <p class="text-center mt-5">&#128064;</p>
          <p class="text-center my-5">찜한 강좌가 없습니다. 원하는 강좌를 찾아보세요!</p>
          <div class="text-center">
          <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_list.php" class="empty_link">강좌 보러가기</i>
          </a>
        </div>
        </div>
        <?php } else { ?>
        <!-- 찜한 강좌 있을 경우-->
        <?php foreach ($wish_lecture_sql as $item) { ?>
            <div class="col-4 mb-3">
              <div class="lecture_box">
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_view.php?leid=<?= $item->leid; ?>">
                  <div class="image_box">
                    <img src="<?= $item->image; ?>" alt="강좌 이미지" />
                  </div>
                  <div class="lecture_info">
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
                        <span class="custom_tt">5.0</span>
                      </div>
                    </div>
                    <!-- 중 시작 -->
                    <div>
                      <p class="custom_tt"><?= $item->title; ?></p>
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
                      <!-- 빈 하트 -->
                      <i class="bi bi-heart heart-icon <?= in_array($item->leid, $wishlist) ? 'd-none' : ''; ?>" data-leid="<?= $item->leid; ?>"></i>
                      <!-- 채워진 하트 -->
                      <i class="bi bi-heart-fill heart-icon-filled <?= in_array($item->leid, $wishlist) ? '' : 'd-none'; ?>" data-leid="<?= $item->leid; ?>"></i>
                      <i class="bi bi-cart-plus"></i>
                    </div>
                  </div>
                  <!-- 하 끝 -->
                </div>
              </div>
              <!-- //lecture_box -->          
            </div>
            <?php
          }
        }
        ?>
      </div>
    <!-- 강좌 리스트 출력 끝 -->
      
    </div>
  </div>

  <!--제목 끝-->
</div>


</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</div>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>