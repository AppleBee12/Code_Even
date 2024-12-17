<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

if (isset($_POST['url'])) {
    // 1. 클라이언트에서 받은 이미지 URL
    $fileUrl = $_POST['url'];

    // 2. 서버의 업로드 폴더 경로
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/upload/summernote/';

    // 3. URL에서 파일 경로를 추출 (절대 URL -> 상대 경로)
    $filePath = parse_url($fileUrl, PHP_URL_PATH); // URL에서 경로만 추출
    $filePath = $_SERVER['DOCUMENT_ROOT'] . $filePath; // 서버의 절대 경로로 변환

    // 4. 보안 검증: 파일이 업로드 폴더 내에 있는지 확인
    if (strpos($filePath, $uploadDir) !== 0 || !file_exists($filePath)) {
        http_response_code(400);
        echo "잘못된 경로 또는 파일이 존재하지 않습니다.";
        exit;
    }

    // 5. 파일 삭제 처리
    if (unlink($filePath)) {
        echo "이미지 삭제 성공";
    } else {
        http_response_code(500);
        echo "이미지 삭제 실패";
    }
} else {
    http_response_code(400);
    echo "요청 데이터가 잘못되었습니다.";
}
?>
