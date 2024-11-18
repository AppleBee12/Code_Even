<?php

function fileUpload($file) {
    // 파일 크기 검사 (10MB 이하)
    if($file['size'] > 10240000) {
        echo "
        <script>
            alert('10MB이하만 첨부할 수 있습니다.');
            history.back();
        </script>
        ";
        return false;
    }
  
    // 파일 포맷 검사 (이미지 파일만 허용)
    if(strpos($file['type'], 'image') === false) {
        echo "
        <script>
            alert('이미지만 첨부할 수 있습니다.');
            history.back();
        </script>
        ";
        return false;
    }
  
    // 현재 파일 상위 디렉토리 이름 가져오기
    $parentDirName = basename(dirname(__DIR__));
  
    // 공통 파일 업로드 경로 설정
    $base_dir = $_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/upload/';
    $save_dir = $base_dir . $parentDirName; // 상위 디렉토리 이름을 추가
  
    // 디렉토리가 존재하지 않을 경우 생성
    if (!is_dir($save_dir)) {
        mkdir($save_dir, 0777, true); // 하위 디렉토리를 재귀적으로 생성
    }
  
    $filename = $file['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION); // 파일 확장자 추출
    $newFileName = date('YmdHis').substr(rand(), 0, 6); // 새로운 파일명 생성
    $savefile = $newFileName . '.' . $ext; // 저장될 파일명
  
    // 파일 이동
    if(move_uploaded_file($file['tmp_name'], $save_dir . '/' . $savefile)) {
        return '/code_even/admin/upload/' . $parentDirName . '/' . $savefile; // 성공 시 경로 반환
    } else {
        return false; // 실패 시 false 반환
    }
  }
  

?>


