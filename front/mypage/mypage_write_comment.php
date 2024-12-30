<?php
$title = '마이페이지-내가 쓴 글';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/mypage_header.php');


//print_r($_SESSION['UID']);
$current_uid = isset($_SESSION['UID']) ? (int)$_SESSION['UID'] : 0;

//내가 쓴 글
$sql = "SELECT 'counsel' AS source, post_id, status, titles, contents, regdate
        FROM counsel
        WHERE uid = ?
        UNION ALL
        SELECT 'teamproject' AS source, post_id, status, titles, contents, regdate
        FROM teamproject
        WHERE uid = ?
        ORDER BY regdate DESC
      ";

$postData = $mysqli->prepare($sql);
$postData->bind_param("ii", $current_uid, $current_uid);



//내가 쓴 댓글
$sql = "SELECT commid, uid, board_type, post_id, contents, regdate
        FROM post_comment
        WHERE uid = ?
        ORDER BY commid ASC
      ";

$postcomment = $mysqli->prepare($sql);
$postcomment->bind_param("i", $current_uid);

?>
<!--탭 메뉴 시작-->
<nav>
  <div class="mypage_tap_wrapper nav nav-underline headt6" id="nav-tab" role="tablist">
    <button class="mypage_tap nav-link active" id="nav-myLecTab1-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab1" role="tab" aria-controls="nav-myLecTab1" aria-selected="true">내가 쓴 글</button>
    <button class="mypage_tap nav-link" id="nav-myLecTab2-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab2" role="tab" aria-controls="nav-myLecTab2" aria-selected="false">내가 쓴 댓글</button>
  </div>
</nav>
<!--탭 메뉴 끝-->
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">내가 쓴 글</p>
    </div>
    <!--제목 끝-->
    <div class="list_content">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">번호</th>
              <th scope="col">게시판 종류</th>
              <th scope="col">제목</th>
              <th scope="col">내용</th>
              <th scope="col">상태</th>
              <th scope="col">등록일</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $postData->execute();
            $result = $postData->get_result();

            if ($result->num_rows > 0) {
              // 번호 초기화
              $counter = 1;
              while ($row = $result->fetch_assoc()) {
                $sourceText = htmlspecialchars($row['source']);
                $postSource = ($sourceText === 'counsel') ? '고민상담' : ($sourceText === 'teamproject' ? '팀 프로젝트' : '');
            ?>
                <tr>
                  <th><?= $counter; ?></th>
                  <td><?= $postSource; ?></td>

                  <!-- 제목에 링크 추가 -->
                  <td class="post_title">
                    <?php if ($postSource == '고민상담') { ?>
                      <a class='underline' href='http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/community/counsel_detail.php?post_id=<?= $row['post_id']; ?>'>
                        <?= htmlspecialchars($row['titles']); ?>
                      </a>
                    <?php } else if ($postSource == '팀 프로젝트') { ?>
                      <a class='underline' href='http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/community/teamproject_detail.php?post_id=<?= $row['post_id']; ?>'>
                        <?= htmlspecialchars($row['titles']); ?>
                      </a>
                    <?php } ?>
                  </td>

                  <!-- 글 내용에 링크 추가 -->
                  <td class="post_contents">
                    <?php if ($postSource == '고민상담') { ?>
                      <a class='underline' href='http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/community/counsel_detail.php?post_id=<?= $row['post_id']; ?>'>
                        <?= ($row['contents']); ?>
                      </a>
                    <?php } else if ($postSource == '팀 프로젝트') { ?>
                      <a class='underline' href='http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/community/teamproject_detail.php?post_id=<?= $row['post_id']; ?>'>
                        <?= ($row['contents']); ?>
                      </a>
                    <?php } ?>
                  </td>

                  <!-- 상태 표시 -->
                  <td><?= $row['status'] == 0 ? '미완료' : '완료'; ?></td>

                  <!-- 등록일 및 삭제 링크 -->
                  <td>
                    <?= ($row['regdate']); ?>
                  </td>
                </tr>
            <?php
                $counter++;
              }
            } else {
              echo "<tr><td colspan='5'>내가 작성한 글이 없습니다!</td></tr>";
              $postData->close();
            }
            ?>
          </tbody>
        </table>
    </div>
  </div>
  <div class="tab-pane fade" id="nav-myLecTab2" role="tabpanel" aria-labelledby="nav-myLecTab2-tab"><!-- 탭메뉴2//탭이 없으면 삭제하세용-->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">내가 쓴 댓글</p>
    </div>
    <!--제목 끝-->
    <div class="list_content">
        <div class="d-flex justify-content-between align-items-center">
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">번호</th>
              <th scope="col">게시판 종류</th>
              <th scope="col">댓글 내용</th>
              <th scope="col">등록일</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // 쿼리 실행
              $postcomment->execute();
              $result = $postcomment->get_result();

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $counter = 1;
                  // board_type을 '고민상담', '블로그', '팀 프로젝트'로 변환
                  $boardType = '';
                  switch ($row['board_type']) {
                    case 'C':
                      $boardType = '고민상담';
                      break;
                    case 'B':
                      $boardType = '블로그';
                      break;
                    case 'T':
                      $boardType = '팀 프로젝트';
                      break;
                  }
              ?>
                  <tr>
                    <th><?= $counter; ?></th>
                    <td><?= $boardType; ?></td>
                    <?php
                    if ($boardType == '고민상담') {
                      echo "<td><a class='underline' href='http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/community/counsel_detail.php?post_id=" . $row['post_id'] . "'>" . ($row['contents']) . "</a></td>";
                    } else if ($boardType == '블로그') {
                      echo "<td><a class='underline' href='http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/community/blog_detail.php?post_id=" . $row['post_id'] . "'>" . ($row['contents']) . "</a></td>";
                    } else if ($boardType == '팀 프로젝트') {
                      echo "<td><a class='underline' href='http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/community/teamproject_detail.php?post_id=" . $row['post_id'] . "'>" . ($row['contents']) . "</a></td>";
                    }
                    ?>
                    <td><?= ($row['regdate']); ?></td>

                <?php
                  $counter++;
                }
              } else {
              echo "<td>내가 작성한 댓글이 없습니다!</td>";
                ?>

                  </tr>
                <?php
                $postcomment->close();
              }
                ?>
          </tbody>
        </table>
    </div>

  </div><!-- 탭메뉴2 끝-->
</div>


</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</div>
</div>
</div>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>