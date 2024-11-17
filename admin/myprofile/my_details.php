<?php
$title = "관리자";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2>내 프로필 수정</h2>
  <div class="content_bar">
    <h3>관리자 상세정보</h3>
  </div>

  <form action="">
  <div class="upload mt-5 mb-3">
    <img src="https://picsum.photos/200" width = 100 height = 100 alt="">
    <div class="round">
      <input type="file">
      <i class="bi bi-camera-fill"></i>
    </div>
  </div>
  <p class="text-center mb-5">프로필 이미지</p>

  <table class="table w-100 info_table">
    <colgroup>
      <col width="160">  
      <col width="516">  
      <col width="160">
      <col width="516">  
    </colgroup>
    <tbody>
    <?php
        $user_id = $_SESSION['AUID'];
        $sql = "SELECT uid, username, userphonenum, userid, useremail FROM user WHERE userid = '$user_id'";
        $result = $mysqli->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
          ?>

      <tr>
        <th scope="row"> 
          <label for="username">이름 <b>*</b></label> </th>
        <td>
          <input type="text" id="username" name="username" class="form-control" placeholder="입력 필수 값 입니다." value="<?=$row['username']?>">
        </td>
        <th scope="row">
          <label for="contact">연락처 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="contact" name="userphonenum" class="form-control" placeholder="입력 필수 값 입니다." value="<?=$row['userphonenum']?>" >
      </tr>
      <tr>
        <th scope="row">
          <label for="userid">아이디 <b>*</b></label>
        </th>
        <td>
          <input type="text" id="userid" name="userid" class="form-control" placeholder="입력 필수 값 입니다." value="<?=$row['userid']?>" disabled readonly>
        </td>
        <th scope="row">
          <label for="email">이메일 <b>*</b></label>
        </th>
        <td colspan="3">
          <input type="email" id="email" name="useremail" class="form-control w_512" placeholder="입력 필수 값 입니다." value="<?=$row['useremail']?>">
        </td>
      </tr>   
      
        <?php
        }else{
          
          echo 
          "<tr>
              <td colspan=\"4\">
               사용자 정보를 불러 올 수 없습니다.
              </td>
          </tr>";
        }
        ?>  
    </tbody>
  </table>
  </form>
  <p>* 상점 정보에 대한 수정은 좌측 하단 "상점 관리"에서 가능합니다. </p>

  <div class="d-flex justify-content-end gap-2">
    <a href="javascript:history.back();" type="button" class="btn btn-outline-danger">취소</a>
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/index.php" type="button" class="btn btn-outline-secondary">수정</a>
  </div>
</div>



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>