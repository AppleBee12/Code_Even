<?php
$title = "팀 프로젝트 수정 ";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2><?=$title?></h2>
  <div class="content_bar">
    <h3>글 수정하기</h3>
  </div>

  <form action="">
    <table class="table info_table">
    <colgroup>
        <col class="col-width-160">
        <col class="col-width-516">
        <col class="col-width-160">
        <col class="col-width-516">
      </colgroup>
      <tbody>
        <?php
        $post_id = $_GET['post_id'] ?? null;

        if ($post_id) {
          // Prepared Statement로 SQL 작성
          $stmt = $mysqli->prepare("
          SELECT t.*, u.usernick 
          FROM teamproject t 
          JOIN user u ON t.uid = u.uid 
          WHERE t.post_id = ?
      ");
      $stmt->bind_param('s', $post_id); // s= string 타입

          // 쿼리 실행
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result && $row = $result->fetch_assoc()) {
            // $row에서 데이터를 가져와서 input 태그에 출력
        ?>
            <tr>
              <th scope="row">
                <label for="titles">글 제목 <b>*</b></label>
              </th>
              <td>
                <input type="text" id="titles" name="titles" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $row['titles'] ?>">
              </td>
              <th scope="row">상태 <b>*</b></th>
              <td class="d-flex gap-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="status_ing" value="모집중" <?= ($row['status'] === '모집중') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="status_ing">
                    모집중 
                  </label>
                </div>
                <div class="form-check">
                  <input class=" form-check-input" type="radio" name="status" id="status_complete" value="모집완료"<?= ($row['status'] === '모집완료') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="status_complete">
                    모집 완료
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <label for="usernick">닉네임</label>
              </th>
              <td>
                <input type="text" id="usernick" name="usernick" class="form-control"  value="<?= $row['usernick'] ?>" disabled readonly>
              </td>
              <th scope="row">
                <label for="regdate">작성일</label>
              </th>
              <td colspan="3">
                <input type="date" id="regdate" name="date" class="form-control w_512" value="<?= date('Y-m-d',strtotime($row['regdate'])) ?>" disabled readonly>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <label for="start_date">시작 예정일 <b>*</b></label>
              </th>
              <td>
                <input type="date" id="start_date" name="start_date" class="form-control" value="<?= $row['start_date'] ?>">
              </td>
              <th scope="row">진행 방식 <b>*</b></th>
              <td class="d-flex gap-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="mode" id="mode_on" value="온라인" <?= ($row['mode'] === '온라인') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="status">
                    온라인 
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="mode" id="mode_onoff" value="온/오프라인" <?= ($row['mode'] === '온/오프라인') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="status">
                  온/오프라인 
                  </label>
                </div>
                <div class="form-check">
                  <input class=" form-check-input" type="radio" name="mode" id="mode_off" value="오프라인"<?= ($row['mode'] === '오프라인') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="status">
                  오프라인
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <label for="dev_env">개발 환경<b>*</b></label>
              </th>
              <td>
                <input type="text" id="dev_env" name="dev_env" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $row['dev_env'] ?>">
              </td>
              <th scope="row">예상 기간<b>*</b></th>
              <td class="d-flex gap-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="durations" id="durations_short" value="단기(1~2개월)" <?= ($row['durations'] === '단기(1~2개월)') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="status">
                    단기(1~2개월) 
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="durations" id="durations_mid" value="중기(3~6개월)" <?= ($row['durations'] === '중기(3~6개월)') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="status">
                    중기(3~6개월)
                    </label>
                  </div>
                  <div class="form-check">
                    <input class=" form-check-input" type="radio" name="durations" id="durations_long" value="장기(6개월이상)"<?= ($row['durations'] === '장기(6개월이상)') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="status">
                    장기(6개월이상)
                    </label>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <label for="contact_url" class="form-label">지원 방법<b>*</b></label>
              </th>
              <td>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3">https://</span>
                  <input type="text" class="form-control" id="contact_url" aria-describedby="basic-addon3 basic-addon4"
                  value="<?= $row['contact_url'] ?>">
                </div>
              </td>
              <th scope="row">모집 분야 <b>*</b></th>
              <td class="d-flex gap-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="" id="status" value="0" <?= ($row['status'] === '모집중') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="status">
                    모집중 
                  </label>
                </div>
                <div class="form-check">
                  <input class=" form-check-input" type="checkbox" name="" id="status" value="1"<?= ($row['status'] === '모집완료') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="status">
                    모집 완료
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">글 내용 <b>*</b></th>
              <td colspan="5" class="editor">
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
  </form>
  <div class="d-flex justify-content-end gap-2">
    <a href="javascript:history.back();"><button class="btn btn-outline-danger">취소</button></a>
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/counsel.php"><button class="btn btn-outline-secondary">수정</button></a>
  </div>
</div>



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>