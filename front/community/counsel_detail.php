<?php
$title = '고민상담';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');

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
                              SELECT c.*, u.usernick 
                              FROM counsel c 
                              JOIN user u ON c.uid = u.uid 
                              WHERE c.post_id = ?
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


<div class="container counsel_detail_wrapper">
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
        <col class="col-7">
        <col class="col-1">
        <col class="col-1">
        <col class="col-1">
        <col class="col-1">
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
              상태
            </th>
            <td class="d-flex gap-3">
              <div class="status">
                <?= ($row['status'] === 0) ? '<span class="badge text-bg-light">미해결</span>' : '<span class="badge text-bg-success">해결</span>' ?>
              </div>
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
              조회수
            </th>
            <td>
              <?= $row['hits'] ?>
            </td>
            <th>
              좋아요
            </th>
            <td>
              <?= $row['likes'] ?> <a href="" class="likes"><i class="bi bi-hand-thumbs-up"></i></a>
            </td>
          </tr>

          <tr>
            <th scope="row">
              제목
            </th>
            <td colspan="5">
              <?= $row['titles'] ?>
            </td>
          </tr>

          <tr>
            <th scope="row">
              글 내용
            </th>
            <td colspan="5">
              <?= $row['contents'] ?>
            </td>
          </tr>
        <?php
        } else {
          echo "해당 게시글을 찾을 수 없습니다.";
        }

        ?>
      </tbody>
    </table>
    <div class="">
      <div class="d-flex justify-content-end gap-2">

        <?php
        if (isset($_SESSION['UID'])) {
          $logged_in_uid = $_SESSION['UID'];
        } else {
          $logged_in_uid = null;
        }

        if ($logged_in_uid == $row['uid']) {
        ?>
          <button class="btn btn-outline-secondary" onClick="window.location.href='http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/counsel_edit.php?post_id=<?= $post_id ?>'">수정</button>
          <button type="button" class="btn btn-danger" onClick="window.location.href='http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/counsel_delete.php?post_id=<?= $post_id ?>'">삭제</button>
        <?php
        }
        $stmt->close();
        ?>

        <button class="btn btn-secondary button"><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/counsel.php"><i class="bi bi-box-arrow-up-left"> </i> 목록으로 돌아가기</a></button>
      </div>
    </div>
  </div>

  <div class="row comment_wrapper">

    <!-- 있는 댓글 출력하기-->
    <?php
    $p_com->execute();
    $result_comment = $p_com->get_result();

    if ($result_comment->num_rows > 0) {
      while ($row_comment = $result_comment->fetch_assoc()) {
    ?>
        <div class="comment_write col-11">
          <div class="comment_title d-flex">
            <img src="../images/profile.png" alt="이븐학생 프로필 사진">
            <div class="d-flex flex-column justify-content-evenly">
              <p class="headt6"><?= $row_comment['display_name'] ?></p>
              <p><?= $row_comment['regdate'] ?></p>
            </div>
          </div>
          <div class="comment_text">
            <?= $row_comment['contents'] ?>
          </div>
        </div>
    <?php
      }
    } else {
      echo "<p class=\"col-11\">첫 댓글을 남겨보세요!</p>";
    }
    $p_com->close();
    ?>

    <!-- 댓글 쓰기-->
    <div class="submit_comment_wrapper col-11">
      <form action="submit_comment.php" method="POST" id="counselCommentForm">
        <div>
          <input type="hidden" name="uid" value="<?= $_SESSION['UID']; ?>">
          <input type="hidden" name="board_type" value="<?= $board_type; ?>">
          <input type="hidden" name="post_id" value="<?= $post_id; ?>">
          <p>댓글</p>
          <div class="submit_comments">
            <div>
              <label for="contents floatingTextarea2"></label>
              <textarea type="text" id="contents floatingTextarea2" name="contents" class="form-control" placeholder="댓글을 남겨보세요."></textarea>
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-outline-danger" onClick="cancle()">취소</button>
            <button class="btn btn-secondary">등록</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<script>
  function cancle() {
    if (confirm('취소하시겠습니까?')) {
      history.back(); //formdata가 넘어감, type:button 으로 해결
    }
  }
</script>



<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>