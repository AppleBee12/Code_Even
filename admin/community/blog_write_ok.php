<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/code_even/admin/inc/img_upload_func.php');

//input 값 지정
print_r($_POST);


$userid = $_POST['userid'];
$titles =$_POST['titles'];
$thumnails =$_FILES['thumnails'];
$contents =rawurldecode($_POST['contents']);
echo ($contents);
print_r($thumnails);

/* ---------------- 이미지 업로드 함수 호출 로직 시작 --------------------- */
    // 상위 디렉토리 이름 가져오기 (예: 'teacher')
    $callingFileDir = basename(dirname(__FILE__));


    $thumbnailPath = ''; // 초기화 추가 (썸네일 변경 안 하는 경우)

    if (isset($_FILES['thumbnails']) && $_FILES['thumbnails']['error'] == UPLOAD_ERR_OK) {
        // 새로운 파일 업로드
        $uploadResult = fileUpload($_FILES['thumbnails'], $callingFileDir);
        if ($uploadResult) {
            $thumbnailPath = $uploadResult; // 성공적으로 업로드된 경로
        } else {
            echo "<script>
                alert('파일 첨부할 수 없습니다.');
                history.back();
            </script>";
            exit;
        }
    }
    /* ---------------- 이미지 업로드 함수 호출 끝 --------------------- */

   /* ---------------- 이미지 업로드 업데이트 sql --------------------- */
    // thumbnail 값이 존재할 때만 thumbnail 컬럼을 업데이트
    if ($thumbnailPath) {
      $sql .= ", thumbnails = '$thumbnailPath'";
  }
  /* ---------------- 이미지 업로드 업데이트 sql 끝 --------------------- */


$sql = "INSERT INTO blog (uid,titles,thumnails,contents)
        VALUES ('{$userid}','{$titles}','{$thumnails}','{$contents}')
";

if ($conn->query($sql) === TRUE) {
  echo "<script>
  alert('글쓰기 완료되었습니다.');
  location.href = 'http://' . '$_SERVER['HTTP_HOST']' . '/code_even/admin/community/blog.php';
  </script>";
  exit;
  } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();


?>
