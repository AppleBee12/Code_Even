  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.8"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.12"></script>
<script src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/js/summernote-bs5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"
integrity="sha256-5slxYrL5Ct3mhMAp/dgnb5JSnTYMtkr4dHby34N10qw=" crossorigin="anonymous"></script>

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
  $deletePath = 'http://localhost/code_even/admin/inc/delete_images.php';
?>

<script>
  let target = $('#summernote');
  target.summernote({
    placeholder: '내용을 입력해주세요.',
    tabsize: 2,
    height: 160,
    lang: 'ko-KR',
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['view', ['codeview', 'help']],
        ['insert', ['picture', 'link', 'video']]
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

var getUploadPath = "<?= $getUploadPath ?>";
var deletePath = "<?= $deletePath ?>";

function handleImageDeletion(contents) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(contents, 'text/html');

    // 에디터에 남아있는 이미지 src 수집
    const remainingImages = Array.from(doc.querySelectorAll('img')).map(img => img.src);

    // 서버에 업로드된 이미지 목록 요청
    fetch(getUploadPath, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' },
    })
    .then(response => response.json())
    .then(uploadedImages => {
        // const imagesToDelete = uploadedImages.filter(img => !remainingImages.includes(img));
        let imagesToDelete = [];
          if (uploadedImages.length > 0) {
              imagesToDelete = uploadedImages.filter(img => !remainingImages.includes(img));
        }

        // 삭제할 이미지가 있으면 서버에 요청
        if (imagesToDelete.length > 0) {
            fetch(deletePath, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ images: imagesToDelete }),
            })
            .then(response => response.json())
            .then(data => console.log('이미지 삭제 완료:', data))
            .catch(error => console.error('이미지 삭제 실패:', error));
        }
    });
}

</script>

</body>
</html>

