<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/code_even/admin/inc/img_upload_func.php');

//input 값 지정
// print_r($_POST);


$uid = $_POST['uid'];
$titles =$_POST['titles'];
$thumbnails =$_FILES['thumbnails'];
$contents =rawurldecode($_POST['contents']);
//print_r($thumbnails);

/* ---------------- 이미지 업로드 함수 호출 로직 시작 --------------------- */
    // 상위 디렉토리 이름 가져오기 (예: 'teacher')
    $callingFileDir = basename(dirname(__FILE__));

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


$sql = "INSERT INTO blog (uid,titles,thumbnails,contents)
        VALUES ($uid, '$titles','$thumbnailPath','$contents')";

$result = $mysqli->query($sql);
// echo $sql;

if ($result === TRUE) {
  echo "<script>
            alert('글쓰기 완료되었습니다.');
            location.href = '/code_even/admin/community/blog.php';
         </script>";
  exit;
  } else {
  echo "Error: " . $sql . "<br>" . $result->error;
}


$result->close();


?>
