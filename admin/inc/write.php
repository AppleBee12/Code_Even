<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <script>
    $('#summernote').summernote({
    height: 300, // 에디터 높이
    callbacks: {
        onImageUpload: function(files) {
            uploadImage(files[0]);
        },
        onChange: function(contents) {
            handleImageDeletion(contents);
        }
    }
});

// 이미지 업로드 함수
function uploadImage(file) {
    const formData = new FormData();
    formData.append('file', file);

    fetch('/upload_image.php', {
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

    // 에디터에 남아있는 이미지 src 수집
    const remainingImages = Array.from(doc.querySelectorAll('img')).map(img => img.src);

    // 서버에 업로드된 이미지 목록 요청
    fetch('/get_uploaded_images.php', {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' },
    })
    .then(response => response.json())
    .then(uploadedImages => {
        const imagesToDelete = uploadedImages.filter(img => !remainingImages.includes(img));

        // 삭제할 이미지가 있으면 서버에 요청
        if (imagesToDelete.length > 0) {
            fetch('/delete_images.php', {
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