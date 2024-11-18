<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// 임시 저장 또는 최종 저장 처리
if (isset($_POST['draft_save']) || isset($_POST['final_save'])) {
    // 폼에서 데이터 가져오기
    $cate1 = $_POST['cate1'];  // 대분류 코드
    $cate2 = $_POST['cate2'];  // 중분류 코드
    $cate3 = $_POST['cate3'];  // 소분류 코드
    $title = $_POST['title'];  // 강좌 제목
    $name = $_POST['name'];    // 강사 이름
    $price = str_replace(',', '', $_POST['price']);  // 가격에 있는 ',' 제거
    $period = $_POST['period'];  // 강좌 기간
    $isrecipe = isset($_POST['isrecipe']) ? 1 : 0;  // 레시피 여부
    $isgeneral = isset($_POST['isgeneral']) ? 1 : 0;  // 일반 강좌 여부

    // 이미지 처리 (이미지 파일이 있는 경우 업로드)
    if ($_FILES['image']['error'] == 0) {
        $uploadDir = 'uploads/images/';
        $imagePath = $uploadDir . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $imagePath = '';  // 이미지 업로드 실패 시 빈 문자열 처리
        }
    } else {
        $imagePath = '';  // 이미지가 없으면 빈 문자열 처리
    }

    // 임시 저장 또는 최종 등록에 따른 쿼리
    if (isset($_POST['draft_save'])) {
        $state = 0;  // 임시 저장은 state를 0으로 설정
    } else {
        $state = 1;  // 최종 등록은 state를 1로 설정
    }

    // 카테고리 코드에 해당하는 이름을 JOIN으로 조회
    // 카테고리 코드를 사용하여 카테고리 이름을 가져옵니다.
    $sql = "
        SELECT 
            cate1.code AS cate1_code,
            cate2.code AS cate2_code,
            cate3.code AS cate3_code
        FROM 
            category AS cate1
            LEFT JOIN category AS cate2 ON cate2.pcode = cate1.code
            LEFT JOIN category AS cate3 ON cate3.pcode = cate2.code
        WHERE 
            cate1.code = ? AND cate2.code = ? AND cate3.code = ?
    ";

    if ($stmt = $mysqli->prepare($sql)) {
        // 데이터 바인딩
        $stmt->bind_param("sss", $cate1, $cate2, $cate3);
        $stmt->execute();
        $stmt->bind_result($cate1_code, $cate2_code, $cate3_code);

        // 카테고리 정보를 가져오기
        if ($stmt->fetch()) {
            // 카테고리 코드만 삽입
            // 쿼리 실행 후, 결과를 해제합니다.
            $stmt->free_result();  // fetch 후 결과를 해제하여 다른 쿼리가 실행될 수 있게 함.

            // 강좌 데이터를 저장하는 쿼리 작성
            $insertSql = "
                INSERT INTO lecture 
                (cate1, cate2, cate3, title, name, price, period, isrecipe, isgeneral, image, date, state, approval) 
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, '대기')
            ";

            // 새로운 준비된 쿼리로 강좌 정보 저장
            if ($insertStmt = $mysqli->prepare($insertSql)) {
                // 데이터 바인딩
                $insertStmt->bind_param("iiiisssiiis", 
                    $cate1_code,   // 대분류 코드
                    $cate2_code,   // 중분류 코드
                    $cate3_code,   // 소분류 코드
                    $title,        // 강좌 제목
                    $name,         // 강사 이름
                    $price,        // 가격
                    $period,       // 강좌 기간
                    $isrecipe,     // 레시피 여부 (0 또는 1)
                    $isgeneral,    // 일반 강좌 여부 (0 또는 1)
                    $imagePath,    // 이미지 경로
                    $state         // 강좌 상태 (0: 임시, 1: 최종)
                );

                // 쿼리 실행 후 결과 확인
                if ($insertStmt->execute()) {
                    echo "<script>alert('강좌가 저장되었습니다.');</script>";
                    echo "<script>location.href='lecture_list.php';</script>";
                } else {
                    echo "<script>alert('저장에 실패했습니다: " . $insertStmt->error . "');</script>";
                }

                // 쿼리 닫기
                $insertStmt->close();
            } else {
                echo "<script>alert('강좌 삽입 쿼리 준비에 실패했습니다: " . $mysqli->error . "');</script>";
            }
        } else {
            echo "<script>alert('카테고리 정보를 가져오는 데 실패했습니다.');</script>";
        }

        // 쿼리 닫기
        $stmt->close();
    } else {
        echo "<script>alert('카테고리 정보 조회 쿼리 실행에 실패했습니다.');</script>";
    }
}
?>
