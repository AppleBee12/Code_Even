</div>

<?php
  $sql = "SELECT * FROM company_info WHERE comid = 1";
  $result = $mysqli->query($sql);
  $cidata = $result->fetch_object();
?>
<footer>
  <div class="container all_p">
    <div class="footer-logo d-flex justify-content-between mb-5">
        <!-- <img src="admin/images/txt_logo_white.png" alt="footer_logo">   -->
        <div>
          <h2 class="logo"><a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/index.php">CODE EVEN</a></h2>
        </div>
      <div>
        <div class="tc_borderline">
          <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/signup/tc_applyform.php">강사 신청하러 가기
            <!-- <i class="fa-solid fa-arrow-up-right-from-square"></i> -->
          </a>
        </div>
      </div>
    </div>
    <div class="d-flex mb-5 footer_border ">
      <div class="row mb-5">
        <p>회사명 : <?= $cidata->company ?> | 회사대표명 : <?= $cidata->ceo_name ?></p>
        <p>주소 : <?= $cidata->address_one ?></p>
        <p>사업자등록번호 : <?= $cidata->bussiness_registration_num ?> | 통신판매업번호 : <?= $cidata->commerce_registration_num ?></p>
        <p>코드이븐 고객센터 | <?= $cidata->email ?> </p>
        <p>고객센터 전화번호 | <?= $cidata->tax_manager_phone ?></p>
      </div>
      <div class=" col-7 d-flex g_ml justify-content-end mb-5">
        <div class="menu_list">
          <div class="list_title"><a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/index.php">코드이븐</a></div>
          <ul class="menu_sublist p-0">
            <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/what_recipe/what_recipe.php">레시피 강좌</a></li>
            <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/community/blog.php">블로그</a></li>
            <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/community/teamproject.php">팀 프로젝트</a></li>
          </ul>
        </div>
        <div class="menu_list">
          <div class="list_title">강좌</div>
          <ul class="menu_sublist">
            <li>카테고리별 강좌</li>
            <li>나의 수업</li>
            <li>이수증 발급</li>
          </ul>
        </div>
        <div class="menu_list">
          <div class="list_title">결제서비스</div>
          <ul class="menu_sublist">
            <li>장바구니</li>
            <li>찜한 상품</li>
            <li>결제 내역</li>
          </ul>
        </div>
        <div class="menu_list">
          <div class="list_title">코드이븐고객센터</div>
          <ul class="menu_sublist">
            <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/service/notice.php">공지사항</a></li>
            <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/service/faq.php">FAQ</a></li>
            <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/code_even/front/mypage/mypage_qna.php">내 문의글</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-between">
      <div class="footer-policy d-flex">
        <p><a href="">개인정보 정책</a></p>
        <p>&nbsp;|&nbsp;</p>
        <p><a href="">이용 약관</a></p>
      </div>
      <div>
        <p>CODE EVEN LMS ©2024 All Rights Reserved.</p>
      </div>
    </div>
  </div>
</footer>

<div id="topButton" class="top-button d-none">
  <i class="bi bi-chevron-up"></i>
</div>

<!-- 공통 js -->

<!-- <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.12"></script> -->
<script src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/js/summernote-bs5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/lang/summernote-ko-KR.min.js"
  integrity="sha256-y2bkXLA0VKwUx5hwbBKnaboRThcu7YOFyuYarJbCnoQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"
  integrity="sha256-5slxYrL5Ct3mhMAp/dgnb5JSnTYMtkr4dHby34N10qw=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<script src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/js/common.js"></script>
<script src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/js/jquery.number.min.js"></script>
<script>
  $('.number').number( true );
</script>

<!-- 개인 js -->
<?php
if (isset($main_js)) {
  echo $main_js;
}
if (isset($chart_js)) {
  echo $chart_js;
}
if (isset($mypage_main_js)) {
  echo $mypage_main_js;
}
if (isset($what_recipe_js)) {
  echo $what_recipe_js;
}
if (isset($service_js)) {
  echo $service_js;
}
if (isset($wishlist_js)) {
  echo $wishlist_js;
}

?>


<!-- 채널톡 스크립트 
<script>
  (function() {
    var w = window;
    if (w.ChannelIO) {
      return w.console.error("ChannelIO script included twice.");
    }
    var ch = function() {
      ch.c(arguments);
    };
    ch.q = [];
    ch.c = function(args) {
      ch.q.push(args);
    };
    w.ChannelIO = ch;

    function l() {
      if (w.ChannelIOInitialized) {
        return;
      }
      w.ChannelIOInitialized = true;
      var s = document.createElement("script");
      s.type = "text/javascript";
      s.async = true;
      s.src = "https://cdn.channel.io/plugin/ch-plugin-web.js";
      var x = document.getElementsByTagName("script")[0];
      if (x.parentNode) {
        x.parentNode.insertBefore(s, x);
      }
    }
    if (document.readyState === "complete") {
      l();
    } else {
      w.addEventListener("DOMContentLoaded", l);
      w.addEventListener("load", l);
    }
  })();

  // 익명 유저
  //   ChannelIO('boot', {
  //   "pluginKey": "23e59de2-88b7-423f-b4f9-d7027ffa37f0" // fill your plugin key
  // });

  //멤버 유저
  ChannelIO('boot', {
    "pluginKey": "23e59de2-88b7-423f-b4f9-d7027ffa37f0", // fill your plugin key
    "memberId": <?= $_SESSION['UID'] ?>, // fill user's member id
    "profile": { // fill user's profile
      "name": <?= $_SESSION['AUNAME'] ?>, // fill user's name
      //"mobileNumber": <?= $_SESSION['NUM'] ?>, // fill user's mobile number
      //"landlineNumber": <?= $_SESSION['NUM'] ?>, // fill user's landline number
      "CUSTOM_VALUE_1": "VALUE_1", // custom property
      "CUSTOM_VALUE_2": "VALUE_2" // custom property
    }
  });
</script>
-->


<!-- 썸머노트 -->
<script>
  let target = $('#summernote');
  target.summernote({
    placeholder: '내용을 입력해주세요.',
    tabsize: 2,
    // height: 160,
    lang: 'ko-KR',
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture']],
      ['view', ['codeview', 'help']]

    ]
  });
</script>

</body>

</html>