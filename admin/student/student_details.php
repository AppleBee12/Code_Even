<?php
$title = "수강생 관리";
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');
?>

<style>
  .content_bar {
    background: var(--bk50);
    border: 1px solid var(--bk200);
    width: 1400px; height: 48px; border-radius: 8px;
    line-height: 48px; padding-left: 24px;
  }

  .modal_table {
    display: flex;
    flex-direction: row;
    width: 100%;
    border-collapse: collapse;
    tr {
      display: flex;
      flex-direction: column;
    }
  }
</style>

<div class="container">
  <h2>수강생 관리</h2>
  <div class="content_bar">
    <h3>수강생 상세정보</h3>
  </div>
  <table class="modal_table table">
    <thead>
      <tr>
        <th>이름</th>
        <th>아이디</th>
        <th>휴대전화</th>
        <th>이메일</th>
        <th>이메일 수신 여부</th>
      </tr>
      <tr>
        <th>가입일</th>
        <th>마지막 접속일</th>
        <th>상태 </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>홍길동</td>
        <td>hong1234</td>
        <td>010-1234-6589</td>
        <td>exampla1111@example.com</td>
        <td></td>
      </tr>
      <tr>
        <td>2024/10/10 13:14:15</td>
        <td>2024/10/10 13:14:15</td>
        <td></td>
      </tr>
    </tbody>
  </table>
  <div class="content_bar">
    <h3>수강 정보</h3>
  </div>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>