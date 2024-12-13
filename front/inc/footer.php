</div>

<footer>
  <div class="container all_p">
    <div class="footer-logo d-flex justify-content-between mb-5">
        <!-- <img src="admin/images/txt_logo_white.png" alt="footer_logo">   -->
        <div>
          <h2 class="logo"><a href="">CODE EVEN</a></h2>
        </div>
      <div>
        <div class="tc_borderline">
          <a href="tc_applyform.php">강사 신청하러 가기
            <!-- <i class="fa-solid fa-arrow-up-right-from-square"></i> -->
          </a>
        </div>
      </div>
    </div>
    <div class="d-flex mb-5 footer_border ">
      <div class="row mb-5">
        <p>회사명 : (주) 디제이컴퍼니 | 회사대표명 : 김동주</p>
        <p>주소 : 03192 서울 종로구 수표로 96 드림팰리스</p>
        <p>사업자등록번호 : 192-01-23456 | 통신판매업번호 : 2024-서울종로-1234</p>
        <p>코드이븐 고객센터 | code_even@gmail.com | 고객센터 전화번호 : 02-1234-5678</p>
      </div>
      <div class=" col-7 d-flex g_ml justify-content-end mb-5">
        <div class="menu_list">
          <div class="list_title">코드이븐</div>
          <ul class="menu_sublist p-0">
            <li>레시피 강좌</li>
            <li>블로그</li>
            <li>팀 프로젝트</li>
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
            <li>공지사항</li>
            <li>FAQ</li>
            <li>내 문의글</li>
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

<!-- 공통 js -->

<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.12"></script>
<script src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/js/summernote-bs5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/lang/summernote-ko-KR.min.js"
  integrity="sha256-y2bkXLA0VKwUx5hwbBKnaboRThcu7YOFyuYarJbCnoQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"
  integrity="sha256-5slxYrL5Ct3mhMAp/dgnb5JSnTYMtkr4dHby34N10qw=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<script src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/js/common.js"></script>

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
?>


<!-- 채널톡 스크립트 -->
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