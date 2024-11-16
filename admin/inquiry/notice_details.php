<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

$ntid = $_GET['ntid'];
$sql = "SELECT notice.*, user.username, user.userid FROM notice JOIN user ON notice.uid = user.uid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();

?>

<div class="container">
  <h2>문의게시판 관리</h2>
  <div class="content_bar">
    <h3>전체 공지사항 수정</h3>
  </div>

  <form action="notice_write_ok.php" method="POST" enctype="multipart/form-data">
    <table class="table details_table">
      <colgroup>
        <col style="width:160px">
        <col style="width:516px">
      </colgroup>
      <thead class="thead-hidden">
        <tr>
          <th scope="col">구분</th>
          <th scope="col">내용</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">이름(아이디)</th>
          <td><?=$data->username;?>(<?=$data->userid;?>)</td>
          <th scope="row">상태 <b>*</b></th>
          <td class="d-flex gap-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="emailCheck" id="flexRadioDisabled" 
                <?= ($data->status === 'on') ? 'checked' : ''; ?>
              >
              <label class="form-check-label" for="flexRadioDisabled">
                노출
              </label>
            </div>
            <div class="form-check">
              <input class=" form-check-input" type="radio" name="emailCheck" id="flexRadioDisabled"
                <?= ($data->status === 'off') ? 'checked' : ''; ?>
              >
              <label class="form-check-label" for="flexRadioCheckedDisabled">
                숨김
              </label>
            </div>
          </td>
        </tr>
        <tr class="none">
          <th scope="row">제목 <b>*</b></th>
          <td colspan="3">
            <div>
              <input type="text" name="title" class="form-control w-75" id="title" placeholder="제목을 입력해주세요." value="<?=$data->title;?>">
            </div>
          </td>
        </tr>
        <tr class="none">
          <td colspan="3">
            <div>
              <textarea name="content" id="content" class="form-control" ><?=$data->content;?></textarea>
            </div>
          </td>
        </tr>
        <tr class="none">
          <th scope="row">파일 등록 <b>*</b></th>
          <td>
            <input type="file" class="form-control" id="inputGroupFile02" class="w-50">
          </td>
        </tr>
      </tbody>
    </table>
    <div class="custom-hr"></div>
    <div class="d-flex justify-content-end gap-2">
      <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice.php" type="button"
        class="btn btn-outline-danger">취소</a>
      <a href="" type="submit" class="btn btn-secondary">등록</a>
    </div>
  </form>

</div>

</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>