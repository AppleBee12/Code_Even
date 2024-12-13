<?php
    //이미지 파일 업로드 함수
    function fileUpload($file, $callingFileDir) {
        // 파일 크기 검사 (10MB 이하)
        if ($file['size'] > 10240000) {
            echo "
            <script>
                alert('10MB이하만 첨부할 수 있습니다.');
                history.back();
            </script>
            ";
            return false;
        }

        // 파일 포맷 검사 (이미지 파일만 허용)
        if (strpos($file['type'], 'image') === false) {
            echo "
            <script>
                alert('이미지만 첨부할 수 있습니다.');
                history.back();
            </script>
            ";
            return false;
        }

        // 업로드 경로 설정
        $base_dir = $_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/upload/' . $callingFileDir;

        // 디렉토리가 존재하지 않으면 생성
        if (!is_dir($base_dir)) {
            mkdir($base_dir, 0777, true);
        }

        $filename = $file['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION); // 파일 확장자 추출
        $newFileName = date('YmdHis') . substr(rand(), 0, 6); // 새로운 파일명 생성
        $savefile = $newFileName . '.' . $ext; // 저장될 파일명

        // 파일 이동
        if (move_uploaded_file($file['tmp_name'], $base_dir . '/' . $savefile)) {
            return '/code_even/admin/upload/' . $callingFileDir . '/' . $savefile; // 성공 시 경로 반환
        } else {
            return false; // 실패 시 false 반환
        }
    }

    //기존 이미지파일 삭제 함수
    function deleteFile($filePath) {
        if (file_exists($filePath)) {
            unlink($filePath); // 파일 삭제
            return true;
        }
        return false;
    }

?>


