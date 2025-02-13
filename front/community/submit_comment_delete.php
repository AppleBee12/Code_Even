<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

//print_r($_POST);
//Array ( [commid] => 8 )

$commid = $_POST['commid'];
$uid = $_POST['uid'];
$board_type = $_POST['board_type'];
$post_id = $_POST['post_id'];

$sql = "DELETE FROM post_comment 
        WHERE commid = ? AND uid = ?";

if ($stmt = $mysqli->prepare($sql)) {
  $stmt->bind_param("ii", $commid, $uid);

// 글을 작성한 게시판, 글의 정보에 댓글 갯수 -1 만들기
if ($stmt->execute()) {
  $table_name = '';
  if ($board_type === 'C') {
    $table_name = 'counsel'; // 상담 게시판
  } elseif ($board_type === 'B') {
    $table_name = 'blog'; // 블로그 게시판
  } elseif ($board_type === 'T') {
    $table_name = 'teamproject'; // 팀 프로젝트 게시판
  }

  if ($table_name) {
    $sql_update_comments = "UPDATE $table_name SET comments = comments - 1 WHERE post_id = ?";
    $stmt_update = $mysqli->prepare($sql_update_comments);
    $stmt_update->bind_param("i", $post_id);
    $stmt_update->execute();
  }

            // 응답 성공 메시지
            echo json_encode(['success' => true, 'message' => '댓글이 삭제되었습니다.']);
        } else {
            // 오류 메시지
            echo json_encode(['success' => false, 'message' => '댓글 삭제에 실패했습니다.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => '쿼리 준비 실패']);
    }



$mysqli->close();
?>