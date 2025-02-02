<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/code_even/admin/inc/img_upload_func.php');

print_r($_POST);

if (!isset($_POST['post_id']) || !is_numeric($_POST['post_id'])) {
    echo "<script>
            alert('잘못된 접근입니다.');
            history.back();
         </script>";
    exit;
}

$post_id = intval($_POST['post_id']); 
$titles = $_POST['titles'];
$content = rawurldecode($_POST['content']);

//썸네일 처리
$thumbnailPath = null;
if (!empty($_FILES['thumbnails']['name'])) {

    //상위 디렉토리 이름 가져오기(예: 'blog')
    $callingFileDir = basename(dirname(__FILE__));

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


$sql = "UPDATE blog SET 
                titles = '$titles',
                contents = '$content'";
 
//만일 섬네일이 있으면 sql에 추가
 if (!empty($thumbnailPath)) {
    $sql .= ", thumbnails = '$thumbnailPath'";
}

//WHERE 절 추가
$sql .= " WHERE post_id = '$post_id'"; 
$result = $mysqli->query($sql);

//echo $sql;

if ($result === TRUE) {
  echo "<script>
            alert('수정이 완료되었습니다.');
            location.href = '/code_even/admin/community/blog.php';
         </script>";
  exit;
  } else {
  echo "Error: " . $sql . "<br>" . $result->error;
}


?>  