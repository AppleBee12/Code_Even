<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');


//print_r($_POST);
//Array ( [uid] => 1 [board_type] => C [post_id] => 12 [contents] => 댓글 )

$uid = $_POST['uid'];
$board_type = $_POST['board_type'];
$post_id = $_POST['post_id'];
$contents = nl2br($_POST['contents']);


$sql = "INSERT INTO post_comment (uid, board_type, post_id, contents) 
        VALUES ('$uid', '$board_type', '$post_id', '$contents')";

$result = $mysqli->query($sql);
//echo $sql;

// 글을 작성한 게시판, 글의 정보에 댓글 갯수 +1 만들기
if ($result) {
  $table_name = '';
  if ($board_type === 'C') {
    $table_name = 'counsel'; // 상담 게시판
  } elseif ($board_type === 'B') {
    $table_name = 'blog'; // 블로그 게시판
  } elseif ($board_type === 'T') {
    $table_name = 'teamproject'; // 팀 프로젝트 게시판
  }

  if ($table_name) {
    $sql_update_comments = "UPDATE $table_name SET comments = comments + 1 WHERE post_id = ?";
    $stmt_update = $mysqli->prepare($sql_update_comments);
    $stmt_update->bind_param("i", $post_id);
    $stmt_update->execute();
  }

  echo
  "<script>
        if (confirm('댓글을 등록하시겠습니까?')){
        
          alert('등록이 완료되었습니다.');
          location.href='" . ($board_type === 'C' ? 'counsel.php' : ($board_type === 'B' ? 'blog.php' : 'teamproject.php')) . "';
        
      }else{
        alert('취소되었습니다.');
        history.back();
      } 
    </script>";
} else {
  echo
  "<script>
      alert('댓글 등록이 실패했습니다! 다시 시도해주세요!');
      history.back();
    </script>";
}

//$result->close();


?>