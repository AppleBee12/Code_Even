<?php
$title = '고민상담';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');

// URL에서 post_id 가져오기
$post_id = $_GET['post_id'] ?? null;

if ($post_id) {
  // Prepared Statement로 SQL 작성
  $stmt = $mysqli->prepare("
                            SELECT c.*, u.usernick 
                            FROM counsel c 
                            JOIN user u ON c.uid = u.uid 
                            WHERE c.post_id = ?
                          ");
  $stmt->bind_param('s', $post_id); // 's'는 string 타입  
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
      <?php

      // 쿼리 실행
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result && $row = $result->fetch_assoc()) {
        // $row에서 데이터를 가져와서 input 태그에 출력
      ?>
        <form action="counsel_edit_ok.php" id="counselEdit" method="POST">
          <input type="hidden" name="uid" value="<?= $_SESSION['UID'] ?>">
          <input type="hidden" name="contents" id="counsel_content">
          <input type="hidden" name="likes" value="<?= $row['likes'] ?>">
          <input type="hidden" name="comments" value="<?= $row['comments'] ?>">
          <input type="hidden" name="hits" value="<?= $row['hits'] ?>">
          <table class="table info_table">
            <colgroup>
              <col class="col-width-160">
              <col class="col-width-516">
              <col class="col-width-160">
              <col class="col-width-516">
            </colgroup>
            <tbody>

              <input type="hidden" name="post_id" value="<?= $post_id ?>">
              <tr>
                <th scope="row">
                  <label for="titles">글 제목 <b>*</b></label>
                </th>
                <td>
                  <input type="text" id="titles" name="titles" class="form-control" placeholder="입력 필수 값 입니다."
                    value="<?= $row['titles'] ?>">
                </td>
                <th scope="row">상태 <b>*</b></th>
                <td class="d-flex gap-3">
                  <div class="form-check d-flex align-items-center radio">
                    <input class="form-check-input" type="radio" name="status" id="status" value="0" <?= ($row['status'] === 0) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="status">
                      미해결
                    </label>
                  </div>
                  <div class="form-check d-flex align-items-center radio">
                    <input class=" form-check-input" type="radio" name="status" id="status" value="1"
                      <?= ($row['status'] === 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="status">
                      해결
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  <label for="usernick">닉네임</label>
                </th>
                <td>
                  <input type="text" id="usernick" name="usernick" class="form-control" value="<?= $row['usernick'] ?>"
                    disabled readonly>
                </td>
                <th scope="row">
                  <label for="regdate">작성일</label>
                </th>
                <td>
                  <input type="date" id="regdate" name="date" class="form-control w_512"
                    value="<?= date('Y-m-d', strtotime($row['regdate'])) ?>" disabled readonly>
                </td>
              </tr>
              <tr>
                <th scope="row">글 내용 <b>*</b></th>
                <td colspan="3" class="editor">
                  <div id="summernote"><?= $row['contents'] ?></div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-outline-danger" onClick="cancle()">취소</button>
            <button class="btn btn-outline-secondary">수정</button>
          </div>
        </form>
    <?php
      } else {
        echo "해당 게시글을 찾을 수 없습니다.";
      }

      $stmt->close();
    } else {
      echo "잘못된 요청입니다.";
    }
    ?>
    </div>
  </div>


  <script>
    function cancle() {
      if (confirm('취소하시겠습니까?')) {
        history.back(); //formdata가 넘어감, type:button 으로 해결
      }
    }
  </script>

  <!-- 썸머노트 -->
  <script>
    // 폼 제출 시 Summernote 내용 hidden으로 넘기기
    $('#counselEdit').on('submit', function() {
      var counselContent = $('#summernote').summernote('code'); // Summernote 에디터에서 HTML 코드 가져오기
      $('#counsel_content').val(counselContent); // 숨겨진 input에 설정
    });
  </script>

  <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
  ?>