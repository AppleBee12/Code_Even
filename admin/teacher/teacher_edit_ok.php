<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

  $tcid = $_POST['tcid'];


  $thumbnail = $_FILES['tc_thumbnail'] ?? '';
  $tc_name = $_POST['tc_name'];
  $tc_url = $_POST['tc_url'] ?? '';
  $tc_userid = $_POST['tc_userid'];
  $tc_bank = $_POST['tc_bank'] ?? '';
  $tc_userphone = $_POST['tc_userphone'];
  $tc_account = $_POST['tc_account'] ?? '';
  $tc_email = $_POST['tc_email'];
  $tc_cate = $_POST['tc_cate'];
  $tc_ok = $_POST['tc_ok'];
  $isnew = $_POST['isnew'] ?? 0;
  $isrecom = $_POST['isrecom'] ?? 0;
  $tc_intro = rawurldecode($_POST['tc_intro']);

  //썸네일 변경 되었다면
  if(isset($_FILES['tc_thumbnail']) && $_FILES['tc_thumbnail']['error'] == UPLOAD_ERR_OK){
    //파일 사이즈 검사
    if($thumbnail['size'] > 10240000 ){
    echo "
      <script>
        alert('10MB이하만 첨부할 수 있습니다.');
        history.back();
      </script>
    ";
    }
    
    //파일 포멧 검사
    if(strpos($thumbnail['type'], 'image') === false){
      echo "
      <script>
        alert('이미지만 첨부할 수 있습니다.');
        history.back();
      </script>
    ";
    }
  
    //파일 업로드
    $save_dir = $_SERVER['DOCUMENT_ROOT'].'/CODE_EVEN/admin/upload/tc_thumb/';
    $filename = $thumbnail['name']; //insta.jpg
    $ext = pathinfo($filename,PATHINFO_EXTENSION); //파일명의 확장자를 추출, jpg
    $newFileName = date('YmdHis').substr(rand(), 0, 6);//202410091717123456
    $savefile = $newFileName.'.'.$ext;//202410091717123456.jpg
    
    if(move_uploaded_file($thumbnail['tmp_name'], $save_dir.$savefile)){
      $thumbnail = '/CODE_EVEN/admin/upload/tc_thumb/'.$savefile;  
    } else{
      echo "<script>
        alert('이미지를 첨부할 수 없습니다.');
      </script>";
    }
  }



  //썸네일의 값이 없고
  $sql = "UPDATE teachers SET 
    tc_name = '$tc_name',
    tc_url = '$tc_url',
    tc_userid = '$tc_userid',
    tc_bank = '$tc_bank',
    tc_userphone = '$tc_userphone',
    tc_account = '$tc_account',
    tc_email = '$tc_email',
    tc_cate = '$tc_cate',
    tc_ok = $tc_ok,
    isnew = $isnew,
    isrecom = $isrecom";

  // thumbnail 값이 존재할 때만 thumbnail 컬럼을 업데이트

  if (isset($_FILES['tc_thumbnail']) && $_FILES['tc_thumbnail']['error'] == UPLOAD_ERR_OK)  {
    $sql .= ", tc_thumbnail = '$thumbnail'";
  }

  $sql .= " WHERE tcid = $tcid";
  $result = $mysqli->query($sql); //teachers테이블에 강사정보 입력(생성)

  if($result){ 
    echo "
      <script>
        alert('강사정보 수정 완료');
        location.href = 'teacher_list.php';
      </script>
    ";
  }else {
    echo "Error: " . $mysqli->error;
  }

$mysqli->close();

?>