<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //table명 summer_images
    //pk! imgid
    //넘어오는 게시판 종류에 대한 값 혹은 관련정보에 따라 카테고리를 특정짓기!
    //카테고리 번호cateid (0=noitce, 1=student_qna, 3....... )
    //현재 작성되는 글 번호pid
    //이미지 경로src
    $uploadDir = '/code_even/admin/upload/summer_images/'; // 이미지 저장 경로
    $fileName = uniqid() . '_' . basename($_FILES['file']['name']);
    $uploadFilePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
        echo json_encode([
            'status' => 'success',
            'imageUrl' => '/uploads/' . $fileName, // 브라우저에서 접근 가능한 경로
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => '이미지 업로드 실패',
        ]);
    }
}
?>
