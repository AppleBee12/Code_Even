<?php
$title = '팀 프로젝트';
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
                              SELECT t.*, u.usernick 
                              FROM teamproject t 
                              JOIN user u ON t.uid = u.uid 
                              WHERE t.post_id = ?
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


<div class="container teamprj_wrapper teamproject_detail_wrapper">
  <div class="community_title d-flex flex-column gap-5">
    <h3 class="headt3"><?= $title ?></h3>
    <div class="d-flex justify-content-center align-items-center">
      <div class="content d-flex flex-column gap-3 mx-auto">
        <div class="title">
          <div class="headt3">프로젝트 팀원을 모집해보세요</div>
          <div class="headt6">차근차근 쌓아나가는 협업 노하우, 이븐인들과 같이 성장해보세요!</div>
        </div>
      </div>
    </div>

    <div class="community_contents_wrapper">
      <?php

      // 쿼리 실행
      $stmt->execute();
      $result_post = $stmt->get_result();

      if ($result_post && $row = $result_post->fetch_assoc()) {
        // $row에서 데이터를 가져와서 출력
      ?>
        <ul>
          <li class="teamprj_content">
            <div class="row">
              <div class="teamprj_txt d-flex flex-column justify-content-between col-9n8">
                <div class="teaprj_title">
                  <p class="subtitle2">프로젝트 시작예정일: <?= $row['start_date'] ?></p>
                  <p class="headt5 d-inline-block text-truncate"><?= $post_id ?>. <?= $row['titles'] ?></p>
                </div>
                <?php
                // 모집분야(비트플래그 방식)-> txt로 변경하기

                $roles = $row['roles']; // teamproject 테이블에서 roles 값 가져오기

                $rolesMap = [
                  '기획자' => 1,      // 2^0
                  '디자이너' => 2,    // 2^1
                  '프론트엔드' => 4,  // 2^2
                  '백엔드' => 8,      // 2^3
                  '기타' => 16,     // 2^4
                ];

                $selectedRoles = [];
                foreach ($rolesMap as $roleName => $roleValue) {
                  if (($roles & $roleValue) === $roleValue) {
                    $selectedRoles[] = $roleName;
                  }
                }
                ?>
                <p>모집분야: <?= implode(', ', $selectedRoles); ?></p>
                <div class="dev_env d-flex">
                  <p>
                    <?php
                    $devEnvArray = explode(',', $row['dev_env']);
                    $imageTags = [];
                    foreach ($devEnvArray as $env) {
                      $env = trim($env); // 공백 제거
                      $imageTags[] = "<img class='icon' src='../images/icons/{$env}.png' alt='{$env}'>";
                    }
                    echo implode(' ', $imageTags);
                    //android angular AWS CSS3 docker figma firebase git googlecloud HTML5
                    //ios javascript j-query laravel mongodb oracle python react swift 
                    //typescript vue wordpress
                    ?>
                  </p>
                </div>
              </div>
              <div class="teamprj_btn col-2n2 d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between">
                  <p><i class="bi bi-eye"></i> <?= $row['hits'] ?></p>
                  <p><i class="bi bi-chat-dots"></i> <?= $row['comments'] ?></p>
                  <p><i class="bi bi-hand-thumbs-up"></i> <?= $row['likes'] ?></p>
                </div>
                <p class="d-flex justify-content-between"><span>진행 방식</span> <span><?= $row['mode'] ?></span></p>
                <p class="d-flex justify-content-between"><span>예상 기간</span> <span><?= $row['durations'] ?></span></p>
                <p class="d-flex justify-content-between"><span>작성자</span> <span><?= $row['usernick'] ?></span></p>
                <div class="d-flex justify-content-between mt-2">
                  <p>
                    <?= $row['status'] == '모집중' ?
                      '<button class="btn btn-danger">모집 중</button>'
                      : '<button class="btn btn-secondary">모집 완료</button>' ?>
                  </p>
                  <?php
                  $host = $_SERVER['HTTP_HOST'];
                  $share_link = "'http://' . $host . '/code_even/front/community/teamproject_detail.php?post_id=' . $post_id;" ?>
                  <button class="btn btn-outline-secondary" onclick="copyLink(e)">
                    <i class="bi bi-share"></i> 공유하기
                  </button>
                </div>
              </div>
            </div>
          </li>
        </ul>

        <table class="table info_table">
          <colgroup>
            <col class="col-1">
            <col class="col-5">
            <col class="col-1">
            <col class="col-5">
          </colgroup>
          <tbody>
            <tr>
              <th scope="row">
                닉네임
              </th>
              <td>
                <?= $row['usernick'] ?>
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
                글 제목
              </th>
              <td colspan="3">
                <?= $row['titles'] ?>
              </td>
            </tr>

            <tr>
              <th scope="row">
                시작 예정일
              </th>
              <td>
                <?= $row['start_date'] ?>
              </td>
              <th>
                진행 방식
              </th>
              <td>
                <?= $row['mode'] ?>
              </td>
            </tr>

            <tr>
              <th scope="row">
                개발 환경
              </th>
              <td>
                <?= $row['dev_env'] ?>
              </td>
              <th scope="row">
                예상 기간
              </th>
              <td>
                <?= $row['durations'] ?>
              </td>
            </tr>

            <tr>
              <th scope="row">
                지원 방법
              </th>
              <td>
                <?= $row['contact_url'] ?>
              </td>
              <th scope="row">
                모집 분야
              </th>
              <td>
                <?= implode(', ', $selectedRoles); ?>
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

          </tbody>
        </table>
      <?php
      } else {
        echo "해당 게시글을 찾을 수 없습니다.";
      }
      ?>


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
          <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/teamproject_edit.php?post_id=<?= $post_id ?>"  class="btn btn-outline-secondary">수정</a>
          <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/teamproject_delete.php?post_id=<?= $post_id ?>" class="btn btn-danger">삭제</a>

          <?php
          }
          $stmt->close();
          ?>

          <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/community/teamproject.php" class="btn btn-secondary button"><i class="bi bi-box-arrow-up-left"> </i> 목록으로 돌아가기</a>
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
</div>



  <script>
    function cancle() {
      if (confirm('취소하시겠습니까?')) {
        history.back(); //formdata가 넘어감, type:button 으로 해결
      }
    }
  </script>

  <script>
    function copyLink(e) {
      e.preventDefault();
      const link = "<?= $share_link; ?>";
      navigator.clipboard.writeText(link)
        .then(() => {
          alert("링크가 복사되었습니다!");
        })
        .catch(err => {
          console.error("링크 복사에 실패했습니다.", err);
        });
    }
  </script>

  <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
  ?>