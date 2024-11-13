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
 
  
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>