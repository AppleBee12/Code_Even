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

<?php
  $uploadPath = 'http://localhost/code_even/admin/inc/upload_image.php';
  $getUploadPath = 'http://localhost/code_even/admin/inc/get_uploaded_images.php';
  $delete_images = 'http://localhost/code_even/admin/inc/summer_inner_del.php';
?>

<script>
  var delete_images = "<?= $delete_images ?>";

  let target = $('#summernote');
target.summernote({
  placeholder: '내용을 입력해주세요.',
  tabsize: 2,
  lang: 'ko-KR',
  toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'underline', 'clear']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link', 'picture']],
    ['view', ['codeview', 'help']]
  ],
  callbacks: {
    onImageUpload: function(files) {
      // 글이 먼저 등록된 후 이미지 업로드를 수행
      for (let file of files) {
        uploadImage(file);
      }
    },
    onMediaDelete: function(target) {
      // 삭제된 이미지의 src 경로를 가져옴
      let imageUrl = target[0].src;

      // 서버에 이미지 삭제 요청
      $.ajax({
        url: delete_images, // 이미지 삭제 처리 파일
        type: 'POST',
        data: { url: imageUrl }, // 이미지 경로 전달
        success: function(response) {
          console.log('이미지 삭제 성공:', response);
        },
        error: function(xhr, status, error) {
          console.error('이미지 삭제 실패:', error);
          alert('이미지 삭제에 실패했습니다.');
        }
      });
    }
    
  }
});

var uploadPath = "<?= $uploadPath ?>";
var getUploadPath = "<?= $getUploadPath ?>";

// 글 등록 후 이미지 업로드
function uploadImage(file) {
  const formData = new FormData();
  formData.append('file', file);

  // 글 등록 완료 후 이미지를 업로드하기 위한 AJAX 호출
  $.ajax({
    url: uploadPath, // 이미지 업로드 PHP 파일
    method: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(data) {
      const response = JSON.parse(data);
      if (response.status === 'success') {
        // 이미지 업로드 성공 시 에디터에 이미지 삽입
        $('#summernote').summernote('insertImage', response.imageUrl);
      } else {
        console.error('이미지 업로드 실패:', response.message);
      }
    },
    error: function(xhr, status, error) {
      console.error('에러 발생:', error);
    }
  });
}
</script>

</body>
</html>

