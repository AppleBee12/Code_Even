<?php
$title = '고민상담';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');

$uid = $_SESSION['UID'];

$sql = "SELECT uid, usernick 
        FROM user 
        WHERE uid = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $uid);  // "i"는 정수 타입
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();

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
    <form action="counsel_write_ok.php" id="counselWrite" method="POST">
      <input type="hidden" name="uid" value="<?= $_SESSION['UID'] ?>">
      <input type="hidden" name="contents" id="counsel_content">
      <table class="table info_table">
        <colgroup>
          <col class="col-width-160">
          <col class="col-width-516">
          <col class="col-width-160">
          <col class="col-width-516">
        </colgroup>

        <tbody>
          <tr>
            <th scope="row">
              <label for="titles">글 제목 <b>*</b></label>
            </th>
            <td>
              <input type="text" id="titles" name="titles" class="form-control" placeholder="제목을 입력해주세요.">
            </td>
            <th scope="row">상태 <b>*</b></th>
            <td class="d-flex gap-3">
              <div class="form-check d-flex align-items-center radio">
                <input class="form-check-input" type="radio" name="status" id="status" value="0" checked>
                <label class="form-check-label" for="status">
                  미해결
                </label>
              </div>
              <div class="form-check d-flex align-items-center radio">
                <input class=" form-check-input" type="radio" name="status" id="status" value="1">
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
              <input type="text" id="usernick" name="usernick" class="form-control" value="<?= $row['usernick']; ?>" disabled>
            </td>
            <th scope="row">
              <label for="regdate">작성일</label>
            </th>
            <td>
              <input type="date" id="regdate" name="date" class="form-control w_512" value="<?= $today = date("Y-m-d"); ?>" disabled readonly>
            </td>
          </tr>
          <tr>
            <th scope="row">글 내용 <b>*</b></th>
            <td colspan="3" class="editor">
              <div id="summernote"></div>
            </td>
          </tr>
        </tbody>

      </table>
      <div class="d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-outline-danger" onClick="cancle()">취소</button>
        <button class="btn btn-secondary">등록</button>
      </div>
    </form>
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
  // 폼 제출 시 Summernote 내용 hidden으로 넘기기
  $('#counselWrite').on('submit', function() {
    var counselContent = $('#summernote').summernote('code'); // Summernote 에디터에서 HTML 코드 가져오기
    $('#counsel_content').val(counselContent); // 숨겨진 input에 설정
  });
</script>





<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>