<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

if(!isset($_SESSION['AUID'])){
  echo"<script>
  alert('로그인을 해주세요');
  location.href='login.php'
  </script>";
}

?>




<div class="container d-flex gap-3">
  <?php
    if(!isset($_SESSION['AUID'])){
  ?>
    <a href="login.php">로그인</a>
  <?php
    }else{
  ?>
    <div class="login.php">안녕하세요 <?= $_SESSION['AUNAME'] ?> 관리자님</div>
    <a href="logout.php">로그아웃</a>
  <?php
    }
  ?>
  
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>