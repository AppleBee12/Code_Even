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

  $uploadPath = 'http://localhost/code_even/admin/inc/upload_image.php';
  $getUploadPath = 'http://localhost/code_even/admin/inc/get_uploaded_images.php';
  $delete_images = 'http://localhost/code_even/admin/inc/get_uploaded_images.php';
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

        ],
      callbacks: {
        onImageUpload: function(files) {
          for (let file of files) {
            uploadImage(file);
          }
        },
        onChange: function(contents) {
            handleImageDeletion(contents);
        }
      }
  });

// 이미지 업로드 함수

var uploadPath = "<?= $uploadPath ?>";
var getUploadPath = "<?= $getUploadPath ?>";
var delete_images = "<?= $delete_images ?>";

function uploadImage(file) {
    const formData = new FormData();
    formData.append('file', file);

    fetch(uploadPath, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // 업로드 성공 시 에디터에 이미지 삽입
            $('#summernote').summernote('insertImage', data.imageUrl);
        } else {
            console.error('이미지 업로드 실패:', data.message);
        }
    })
    .catch(error => console.error('에러 발생:', error));
}


// 이미지 삭제 함수
function handleImageDeletion(contents) {
  const parser = new DOMParser();
  const doc = parser.parseFromString(contents, 'text/html');

  // 에디터에 이미지가 포함되어 있는지 확인
  const remainingImages = Array.from(doc.querySelectorAll('img')).map(img => img.src);

  // 이미지가 하나 이상 있을 경우에만 진행
  if (remainingImages.length > 0) {
      // 서버에 업로드된 이미지 목록 요청
      fetch(getUploadPath, {
          method: 'GET',
          headers: { 'Content-Type': 'application/json' },
      })
      .then(response => response.json())
      .then(uploadedImages => {
          // 서버에서 받은 데이터의 타입 확인
          console.log(uploadedImages); // 데이터를 콘솔에 출력해 확인

          // uploadedImages가 배열이 아니면 배열로 변환
          if (!Array.isArray(uploadedImages)) {
              uploadedImages = [uploadedImages]; // 단일 이미지일 경우 배열로 감싸기
          }

          // 이미지가 하나일 경우와 여러 개일 경우 분기 처리
          let imagesToDelete = [];
          if (remainingImages.length === 1) {
              // 이미지가 하나일 경우
              if (!uploadedImages.includes(remainingImages[0])) {
                  imagesToDelete = [remainingImages[0]];
              }
          } else {
              // 이미지가 여러 개일 경우
              imagesToDelete = uploadedImages.filter(img => !remainingImages.includes(img));
          }

          // 삭제할 이미지가 있으면 서버에 요청
          if (imagesToDelete.length > 0) {
              fetch(delete_images, {
                  method: 'POST',
                  headers: { 'Content-Type': 'application/json' },
                  body: JSON.stringify({ images: imagesToDelete }),
              })
              .then(response => response.json())
              .then(data => console.log(imagesToDelete.length === 1 ? '이미지 하나 삭제 완료' : '여러 이미지 삭제 완료', data))
              .catch(error => console.error('이미지 삭제 실패:', error));
          }
      })
      .catch(error => console.error('이미지 목록 요청 실패:', error));
  }
}


</script>

</body>
</html>

