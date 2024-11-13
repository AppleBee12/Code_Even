<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

if(!isset($_SESSION['AUID'])){
  echo"<script>
  alert('로그인을 해주세요');
  location.href='admin/login/login.php';
  </script>";
}

?>

<!-- localhost/Code_Even/admin/login/login.php -->


<div class="container ">
  <?php
    if(!isset($_SESSION['AUID'])){
  ?>
    <a href="admin/login/login.php">로그인</a>
  <?php
    }else{
  ?>
    <div><?= $_SESSION['AUNAME'] ?> 관리자님 <br>환영합니다. </div>
    <!-- <a href="logout.php">로그아웃</a> -->


    <ul class="nav nav-pills">
    <li class="nav-item">
    <a class="nav-link" href="#"><img src="images/sb_logo.png" alt="" width="50"></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"></a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="admin/login/logout.php">로그아웃</a></li>
      <li><a class="dropdown-item" href="#">Another action</a></li>
      <li><a class="dropdown-item" href="#">Something else here</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Separated link</a></li>
    </ul>
  </li>
  
</ul>


  <?php
    }
  ?>
  
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>