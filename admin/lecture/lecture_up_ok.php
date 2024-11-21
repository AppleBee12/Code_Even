<?php

session_start(); // 세션 시작
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 현재 로그인된 사용자 ID 확인
if (!isset($_SESSION['AUID']) || !isset($_SESSION['AUNAME'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='../login/login.php';</script>";
    exit;
}

$session_userid = $_SESSION['AUID']; // 세션에서 AUID 가져오기

// 사용자 정보 가져오기
$sql_user = "SELECT uid, username FROM user WHERE userid = '$session_userid'";
$result_user = $mysqli->query($sql_user);
if ($result_user->num_rows === 1) {
    $user = $result_user->fetch_assoc();
    $uid = $user['uid'];
    $username = $user['username'];
} else {
    echo "<script>alert('사용자 정보를 불러오는데 실패했습니다.');</script>";
    exit;
}

// 강좌 데이터 저장 처리

  $cate1 = $_POST['cate1'] ?? null;
  $cate2 = $_POST['cate2'] ?? null;
  $cate3 = $_POST['cate3'] ?? null;
  $title = $_POST['title'] ?? null;
  $price = $_POST['price'];
  $period = $_POST['period'] ?? 30;
  $isrecipe = $_POST['isrecipe'] ?? 0;
  $isgeneral = $_POST['isgeneral'] ?? 1;
  $image = $_FILES['image']??'';;
  $state = ($_POST['action'] === 'draft_save') ? 0 : 1;
  $approval = $_POST['approval'] ?? 0;

  
  
  // 이미지 업로드 처리
  if (isset($_FILES['#image']) && $_FILES['#image']['error'] == UPLOAD_ERR_OK){
    //파일 사이즈 검사
    if($image['size'] > 10240000 ){
    echo "
      <script>
        alert('10MB이하만 첨부할 수 있습니다.');
        history.back();
      </script>
    ";
  }
    
  //파일 포멧 검사
  // 이미지 여부 판단 이미지가 아니라고 한다면
  if(strpos($image['type'], 'image') === false){
    echo "
    <script>
      alert('이미지만 첨부할 수 있습니다.');
      history.back();
    </script>
  ";
  }
    
  //파일 업로드
  $save_dir = $_SERVER['DOCUMENT_ROOT'].'/Code_Even/admin/upload/lecture/';
  $filename = $image['name']; //insta.jpg
  $ext = pathinfo($filename,PATHINFO_EXTENSION); //파일명의 확장자를 추출, jpg
  $newFileName = date('YmdHis').substr(rand(), 0, 6);//202410091717123456
  $savefile = $newFileName.'.'.$ext;//202410091717123456.jpg
  
  if(move_uploaded_file($image['tmp_name'], $save_dir.$savefile)){
    $image = '/Code_Even/admin/upload/lecture'.$savefile;  
  } else{
    echo "<script>
      alert('이미지를 첨부할 수 없습니다.');
    </script>";
  }
  }

  // 데이터 저장
  $sql = "
  INSERT INTO lecture (lecid, cate1, cate2, cate3, title, name, price, period, isrecipe, isgeneral, image, date, state) 
  VALUES ('$uid', '$cate1', '$cate2', '$cate3', '$title', '$username', $price, $period, '$isrecipe', '$isgeneral', '$imagePath', NOW(), $state)
  ";

  if ($mysqli->query($sql)) {
  echo json_encode(['success' => true, 'message' => '강좌가 성공적으로 저장되었습니다.']);
  } else {
  echo json_encode(['success' => false, 'message' => '강좌 저장 실패: ' . $mysqli->error]);
  }
  ?>
  

?>
