<?php
echo "
<script>
  if (confirm('프로필 수정을 취소 하시겠습니까?')) {
      location.href='/code_even/admin/index.php';
  } else {
      history.back();
  }
</script>";
?>