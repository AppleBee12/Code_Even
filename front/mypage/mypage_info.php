<?php
$title = '마이페이지-강좌보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/mypage_main.js\"></script>";
?>
<!--탭 메뉴 시작-->
  <div class="mypage_tap_wrapper headt5">
    <div class="mypage_tap nav-link active">기본 정보 수정</div>
  </div>
<!--탭 메뉴 끝-->
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <div class="my_info_wrapper"><!-- 탭메뉴1내용 -->
      <div class="my_info">
        <div class="header_grade2">개인정보</div>
        <div class="d-flex info_wrapper align-items-center">
          <div class="col-1">
            <label for="userid" class="form-label align-self-center">아이디</label>
          </div>
          <div class="col-6 user_info">
            <input type="text" class="form-control" id="userid" name="userid" value="<?= $user_data->userid; ?>" disabled readonly>
          </div>
          <div class="col-3 color_gray mx-3">
            <span class="subtitle2">* 아이디는 수정할 수 없습니다.</span>
          </div>
        </div>
        <div class="d-flex info_wrapper align-items-center">
          <div class="col-1">
            <label for="usernick" class="form-label align-self-center">닉네임</label>
          </div>
          <div class="col-6 user_info">
            <input type="text" class="form-control" id="usernick" name="usernick" value="<?= $user_data->usernick; ?>" disabled readonly>
          </div>
          <div class="col-3 color_gray mx-3">
            <span class="subtitle2">* 아이디는 수정할 수 없습니다.</span>
          </div>
        </div>
      </div>
    </div><!-- 탭메뉴1내용 끝-->
  </div><!-- 탭메뉴1 끝 -->
</div>
</div>
</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>