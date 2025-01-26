<?php
$title = '블로그';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

// URL에서 post_id 가져오기
$post_id = $_GET['post_id'] ?? null;

// 댓글 가져오기: board_type 결정
$board_type = '';
if (strpos($_SERVER['PHP_SELF'], 'counsel_detail.php') !== false) {
  $board_type = 'C'; //strpos, 조건을 '같은 php값이 포함되어있으면' 으로 변경
} else if (strpos($_SERVER['PHP_SELF'], 'teamproject_detail.php') !== false) {
  $board_type = 'T';
} else if (strpos($_SERVER['PHP_SELF'], 'blog_detail.php') !== false) {
  $board_type = 'B';
}

// 작성된 글 가져오기
if ($post_id) {
  // 게시글 정보 가져오기 쿼리
  $stmt = $mysqli->prepare("
                              SELECT b.*, u.usernick 
                              FROM blog b 
                              JOIN user u ON b.uid = u.uid 
                              WHERE b.post_id = ?
                            ");
  $stmt->bind_param('i', $post_id); // post_id는 숫자로 처리


  // 댓글 가져오기 쿼리
  $query_comment = "
                      SELECT pc.*, 
                      IFNULL(u.usernick, u.username) AS display_name  
                      FROM post_comment pc
                      JOIN user u 
                      ON pc.uid = u.uid
                      WHERE pc.board_type = ? 
                      AND pc.post_id = ? 
                      ORDER BY pc.commid ASC
                    ";
  $p_com = $mysqli->prepare($query_comment);
  $p_com->bind_param("si", $board_type, $post_id); // board_type: 문자열, post_id: 숫자
}

// 조회수 체크 쿼리
$hit = "hit$post_id";

if (!isset($_SESSION[$hit]) || $_SESSION[$hit] < strtotime('today')) {
  $hitSql = "UPDATE counsel SET hits = hits + 1 WHERE post_id = $post_id;";
  $mysqli->query($hitSql);

  $_SESSION[$hit] = time();
}

?>