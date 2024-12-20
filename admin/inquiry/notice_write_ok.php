<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/page_summernote_insert.php');

// print_r($_POST);
$username = $_POST['username'];
$userid = $_POST['userid'];
$title = $_POST['title'];
$content = $_POST['content'];
$fix = $_POST['fix'];
$table_name = 'notice';

// ** 세션에서 이미지 URL 가져오기 **
$imageUrl = isset($_SESSION['imageUrl']) ? $_SESSION['imageUrl'] : [];

$notice_sql = "
    INSERT INTO notice (uid, title, content, fix)
    SELECT uid, '$title', '$content', '$fix'  
    FROM user
    WHERE username = '$username' AND userid = '$userid'
";

$user_result = $mysqli->query($notice_sql);

// ** 최근 실행된 INSERT 쿼리의 자동증가 ID값 가져오기 (summer_images에 넣기위함) **
$create_id = $mysqli->insert_id;

// ** 이미지 삽입 처리 함수 호출 **
$image_result = insertSummerImages($mysqli, $table_name, $create_id, $imageUrl);

if ($user_result === true && $image_result === true) {

    unset($_SESSION['imageUrl']);

    echo
    "<script>
      if(confirm('글을 등록하시겠습니까?')){
      alert('등록이 완료되었습니다.');
      location.href='notice.php';
    }else{
      alert('취소되었습니다.');
      location.href='notice.php';
    } 
  </script>";
} else {
    echo
        "<script>
    alert('글쓰기 실패');
    history.back();
  </script>";
}

?>