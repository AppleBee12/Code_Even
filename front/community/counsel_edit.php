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
  <table class="table info_table">
        <colgroup>
          <col class="col-width-160">
          <col class="col-width-516">
          <col class="col-width-160">
          <col class="col-width-516">
        </colgroup>
        <tbody>
          <?php

          // 쿼리 실행
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result && $row = $result->fetch_assoc()) {
            // $row에서 데이터를 가져와서 input 태그에 출력
          ?>
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
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="status" value="0" <?= ($row['status'] === 0) ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="status">
                    미해결
                  </label>
                </div>
                <div class="form-check">
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
        <?php
          } else {
            echo "해당 게시글을 찾을 수 없습니다.";
          }

          $stmt->close();
          } else {
            echo "잘못된 요청입니다.";
          }


        ?>
        </tbody>
      </table>
  </div>


</div>





<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>

