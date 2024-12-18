<?php
$title = '고민상담';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');

// URL에서 post_id 가져오기
$post_id = $_GET['post_id'] ?? null;

// 댓글 가져오기: board_type 결정
$board_type = '';
if ($_SERVER['PHP_SELF'] == '/counsel_detail.php') {
    $board_type = 'C';
} else if ($_SERVER['PHP_SELF'] == '/teamproject_detail.php') {
    $board_type = 'T';
} else if ($_SERVER['PHP_SELF'] == '/blog_detail.php') {
    $board_type = 'B';
}

// 작성된 글 가져오기
if ($post_id) {
    // 게시글 정보 가져오기 쿼리
    $stmt = $mysqli->prepare("
                              SELECT c.*, u.usernick 
                              FROM counsel c 
                              JOIN user u ON c.uid = u.uid 
                              WHERE c.post_id = ?
                            ");
    $stmt->bind_param('i', $post_id); // post_id는 숫자로 처리
    $stmt->execute();
    $result_post = $stmt->get_result();

    // 댓글 가져오기 쿼리
    $query_comment = "
                      SELECT pc.*, 
                      IFNULL(u.usernick, u.username) AS display_name  
                      FROM post_comment pc
                      JOIN user u 
                      ON pc.uid = u.uid
                      WHERE pc.board_type = ? 
                      AND pc.post_id = ? 
                      ORDER BY pc.regdate ASC
                    ";
    $p_com = $mysqli->prepare($query_comment);
    $p_com->bind_param("si", $board_type, $post_id); // board_type: 문자열, post_id: 숫자
}
?>


<div class="container">
  <div class="community_title d-flex flex-column gap-5">
    <h3 class="headt3">고민상담</h3>
    <div class="d-flex justify-content-center align-items-center">
      <div class="content d-flex flex-column gap-3 mx-auto">
        <div class="title">
          <div class="headt3">이야기를 나누고 토론해보세요</div>
          <div class="headt6">최신IT정보부터 커리어 고민까지 궁금한 점을 자유롭게 이야기하세요.</div>
        </div>
      </div>
    </div>
  </div>

  <div class="community_contents_wrapper">
    <table class="table info_table">
      <colgroup>
        <col class="col-1">
        <col class="col-5">
        <col class="col-1">
        <col class="col-5">
      </colgroup>
      <tbody>
        <?php

        // 쿼리 실행
        $stmt->execute();
        $result_post = $stmt->get_result();

        if ($result_post && $row = $result_post->fetch_assoc()) {
          // $row에서 데이터를 가져와서 input 태그에 출력
        ?>
        <tr>
          <th scope="row">
            글 번호
          </th>
          <td>
            <?= $post_id ?>
          </td>
          <th>
            작성일
          </th>
          <td>
            <?= date('Y-m-d', strtotime($row['regdate'])) ?>
          </td>
        </tr>

        <tr>
          <th scope="row">
            닉네임
          </th>
          <td>
            <?= $row['usernick'] ?>
          </td>
          <th>
            상태
          </th>
          <td class="d-flex gap-3">
            <div class="status">
              <?= ($row['status'] === 0) ? '미해결' : '해결' ?>
            </div>
          </td>
        </tr>

        <tr>
          <th scope="row">
            제목
          </th>
          <td colspan="3">
            <?= $row['titles'] ?>
          </td>
        </tr>

        <tr>
          <th scope="row">
            글 내용
          </th>
          <td colspan="3">
            <?= $row['contents'] ?>
          </td>
        </tr>
        <?php
          } else {
            echo "해당 게시글을 찾을 수 없습니다.";
          }
          $stmt->close();
        ?>
      </tbody>
    </table>
    <div class="text-end">
      <button class="btn btn-secondary button"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/counsel.php"><i class="bi bi-box-arrow-up-left"> </i> 목록으로 돌아가기</a></button>
    </div>
  </div>
  <?php
    $p_com->execute();
    $result_comment = $p_com->get_result();

    if ($result_comment->num_rows > 0) {
      while ($row_comment = $result_comment->fetch_assoc()) {
   ?>
  <div class="row">
    <div class="col-11 text-end comment_write">    
      <div class="comment_title">
        <img src="../images/profile.png" alt="이븐학생 프로필 사진">
        <div>
          <p><?=$row_comment['display_name']?></p>
          <p><?=$row_comment['regdate']?></p>
        </div>
      </div>
      <div class="comment_text">
        <?=$row_comment['contents']?>
      </div>        
    </div>
  </div>
  <?php
        }
      } else {
        echo "<p>첫 댓글을 남겨보세요!</p>";
      }
      $p_com->close();
      ?>


</div>





<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>

