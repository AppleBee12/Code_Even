  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.8"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.12"></script>
<script src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/js/summernote-bs5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"
integrity="sha256-5slxYrL5Ct3mhMAp/dgnb5JSnTYMtkr4dHby34N10qw=" crossorigin="anonymous"></script>
<!-- 채널톡 스크립트 -->
<script>
  (function(){var w=window;if(w.ChannelIO){return w.console.error("ChannelIO script included twice.");}var ch=function(){ch.c(arguments);};ch.q=[];ch.c=function(args){ch.q.push(args);};w.ChannelIO=ch;function l(){if(w.ChannelIOInitialized){return;}w.ChannelIOInitialized=true;var s=document.createElement("script");s.type="text/javascript";s.async=true;s.src="https://cdn.channel.io/plugin/ch-plugin-web.js";var x=document.getElementsByTagName("script")[0];if(x.parentNode){x.parentNode.insertBefore(s,x);}}if(document.readyState==="complete"){l();}else{w.addEventListener("DOMContentLoaded",l);w.addEventListener("load",l);}})();
</script>
<script>
// 익명 유저
//   ChannelIO('boot', {
//   "pluginKey": "23e59de2-88b7-423f-b4f9-d7027ffa37f0" // fill your plugin key
// });

//멤버 유저
ChannelIO('boot', {
  "pluginKey": "23e59de2-88b7-423f-b4f9-d7027ffa37f0", // fill your plugin key
  "memberId": <?= $_SESSION['UID']?>, // fill user's member id
  "profile": { // fill user's profile
    "name": <?=$_SESSION['AUNAME'] ?>, // fill user's name
    "mobileNumber": <?= $_SESSION['NUM']?>, // fill user's mobile number
    "landlineNumber": <?= $_SESSION['NUM']?>, // fill user's landline number
    "CUSTOM_VALUE_1": "VALUE_1", // custom property
    "CUSTOM_VALUE_2": "VALUE_2" // custom property
  }
});
</script>

<!-- language pack -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/lang/summernote-ko-KR.min.js"
integrity="sha256-y2bkXLA0VKwUx5hwbBKnaboRThcu7YOFyuYarJbCnoQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<!-- common -->
<script src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/js/common.js"></script>
<!--  jqueryui_js -->
<?php
if (isset($jqueryui_js)) {
    echo $jqueryui_js;
  }
?>

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

