<?php
$title = '블로그';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');
$community_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/community.js\"></script>";

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



<div class="container counsel_detail_wrapper">
  <div class="community_title d-flex flex-column gap-5">
  <h3 class="headt3"><?= $title ?></h3>
    <div class="d-flex justify-content-center align-items-center">
      <div class="content d-flex flex-column gap-3 mx-auto">
        <div class="title">
        <div class="headt3">IT분야의 이슈와 코드이븐의 소식을 만나보세요</div>
        <div class="headt6">새로운 IT컨텐츠를 소개하고, 코드이븐만의 컨텐츠와 소식을 공유하는 공간입니다.</div>
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
              작성일
            </th>
            <td colspan="3">
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
            <td colspan="5" class="">
              <img src="http://<?= $_SERVER['HTTP_HOST']; ?><?= $row['thumbnails'] ?>" alt="<?= $row['titles'] ?>">
              <br>
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
    <div class="btn_wrapper">
      <div class="d-flex justify-content-end gap-2">

        <?php
        if (isset($_SESSION['UID'])) {
          $logged_in_uid = $_SESSION['UID'];
        } else {
          $logged_in_uid = null;
        }

        if ($logged_in_uid == $row['uid']) {
        ?>
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/blog_edit.php?post_id=<?= $post_id ?>" class="btn btn-outline-secondary">수정</a>
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/blog_delete.php?post_id=<?= $post_id ?>" class="btn btn-danger">삭제</a>
    
        <?php
        }
        $stmt->close();
        ?>
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/blog.php" class="btn btn-secondary button"><i class="bi bi-box-arrow-up-left"> </i> 목록으로 돌아가기</a>
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
    <!-- 작성된 댓글 표시-->
    <div class="comment_write col-11">
      <div class="comment_title d-flex">
        <img src="../images/profile.png" alt="이븐학생 프로필 사진">
        <div class="d-flex flex-column justify-content-evenly">
          <p class="headt6"><?= $row_comment['display_name'] ?></p>
          <p><?= $row_comment['regdate'] ?></p>
        </div>
      </div>
      <div class="comment_text">
        <?= nl2br(htmlspecialchars($row_comment['contents'])); ?>
      </div>

      <!-- 숨겨진 댓글 수정 폼 -->
      <form action="submit_comment_edit.php" method="POST" class="comment-edit-form mt-4" style="display:none;">
        <input type="hidden" name="uid" value="<?= $_SESSION['UID']; ?>">
        <input type="hidden" name="board_type" value="<?= $board_type; ?>">
        <input type="hidden" name="post_id" value="<?= $post_id; ?>">
        <input type="hidden" name="commid" value="<?= htmlspecialchars($row_comment['commid']); ?>">

        <label for="edit-contents"></label>
        <textarea id="edit-contents" name="edit-contents" class="form-control edit-contents"><?= htmlspecialchars($row_comment['contents']); ?></textarea>
        <div class="d-flex justify-content-end gap-2 mt-3">
          <button type="button" class="btn btn-outline-danger cancel-edit">취소</button>
          <button class="btn btn-secondary save-comment">저장</button>
        </div>

      </form>


      <div class="modify-btn d-flex justify-content-end gap-2">
        <?php
          if (isset($_SESSION['UID'])) {
            $logged_in_uid = $_SESSION['UID'];
          } else {
            $logged_in_uid = null;
          }

          if ($logged_in_uid == $row_comment['uid']) {
        ?>
        <div class="btn btn-outline-secondary comment-modify">수정</div>
        <div class="btn btn-danger comment-delete">삭제</div>
        <?php
        }
        ?>
      </div>
    </div>
    <!-- 작성된 댓글이 없다면-->
    <?php
      }
    } else {
      echo "<p class=\"col-11\">첫 댓글을 남겨보세요!</p>";
    }
    $p_com->close();
    ?>
    <!-- 댓글 쓰기-->
    <div class="submit_comment_wrapper col-11">
      <?php if (isset($_SESSION['UID'])): ?>
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
      <?php else: ?>
        <!-- 사용자가 로그인하지 않은 경우 -->
        <div>
            <div data-bs-toggle="modal" data-bs-target="#exampleModaltest" data-bs-whatever="@mdo">
              <p>댓글</p>
              <div class="submit_comments mt-2">
                <p id="notLoginContents"><span class="under_line">로그인</span> 후에 댓글을 남길 수 있습니다!</p>
              </div>
            </div>
          </div>
        <?php endif; ?>

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



<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>