<?php
$title = '팀 프로젝트';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

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


<div class="container teamprj_wrapper teamproject_wrapper">
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
  </div>

  <div class="community_contents_wrapper">
    <form action="teamproject_write_ok.php" id="teamprojectWrite" method="POST">
      <input type="hidden" name="uid" value="<?= $_SESSION['UID'] ?>">
      <input type="hidden" name="contents" id="teamproject_content">
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
              <label for="titles">글 제목 <b>*</b></label>
            </th>
            <td colspan="3">
              <input type="text" id="titles" name="titles" class="form-control" placeholder="제목을 입력해주세요.">
            </td>
          </tr>

          <tr>
            <th scope="row">
              <label for="start_date">시작 예정일 <b>*</b></label>
            </th>
            <td>
              <input type="date" id="start_date" name="start_date" class="form-control w_512">
            </td>
            <th scope="row">
              <label for="mode">진행 방식 <b>*</b></label>
            </th>
            <td class="d-flex gap-3">
              <div class="form-check d-flex align-items-center radio">
                <input class="form-check-input" type="radio" name="mode" id="mode" value="온라인" checked>
                <label class="form-check-label" for="mode">
                  온라인
                </label>
              </div>
              <div class="form-check d-flex align-items-center radio">
                <input class=" form-check-input" type="radio" name="mode" id="mode" value="온/오프라인">
                <label class="form-check-label" for="mode">
                온/오프라인
                </label>
              </div>
              <div class="form-check d-flex align-items-center radio">
                <input class=" form-check-input" type="radio" name="mode" id="mode" value="오프라인">
                <label class="form-check-label" for="mode">
                오프라인
                </label>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

