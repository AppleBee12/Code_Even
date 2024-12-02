<?php
echo "
<script>
  if (confirm('정보 수정을 취소 하시겠습니까?')) {
      alert('수정이 취소되었습니다.');
      location.href = '/code_even/admin/index.php';
  } else {
   alert('수정 페이지로 돌아갑니다.');    
  history.back();  
  }
</script>";
?>