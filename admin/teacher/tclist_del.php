<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

// delarr 배열 데이터 가져오기
$delarr = isset($_POST['delarr']) ? $_POST['delarr'] : null;

if (!$delarr || !is_array($delarr)) {
    echo "<script>alert('삭제할 강사 정보가 없습니다.'); location.href = 'teacher_list.php';</script>";
    exit;
}

// 트랜잭션 시작
$mysqli->begin_transaction();

try {
    foreach ($delarr as $tcid) {
        $tcid = intval($tcid); // 정수로 변환하여 SQL Injection 방지

        // teachers 테이블에서 tcid에 해당하는 uid와 썸네일 가져오기
        $teacher_sql = "SELECT uid, tc_thumbnail FROM teachers WHERE tcid = ?";
        $stmt = $mysqli->prepare($teacher_sql);
        $stmt->bind_param("i", $tcid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $teacher_data = $result->fetch_object();
            $uid = $teacher_data->uid;
            $thumbnail = $teacher_data->tc_thumbnail;

            // 썸네일 파일 삭제
            if ($thumbnail && file_exists($_SERVER['DOCUMENT_ROOT'] . $thumbnail)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $thumbnail);
            }

            // teachers 테이블에서 데이터 삭제
            $delete_sql = "DELETE FROM teachers WHERE tcid = ?";
            $stmt = $mysqli->prepare($delete_sql);
            $stmt->bind_param("i", $tcid);
            $stmt->execute();

            // user 테이블에서 user_level 값 업데이트
            $update_sql = "UPDATE user SET user_level = 1 WHERE uid = ? AND user_level = 10";
            $stmt = $mysqli->prepare($update_sql);
            $stmt->bind_param("i", $uid);
            $stmt->execute();
        }
    }

    // 트랜잭션 커밋
    $mysqli->commit();

    echo "<script>alert('선택된 강사 정보 삭제 완료'); location.href = 'teacher_list.php';</script>";
} catch (Exception $e) {
    // 트랜잭션 롤백
    $mysqli->rollback();
    echo "<script>alert('오류 발생: " . $e->getMessage() . "'); history.back();</script>";
}

// 데이터베이스 연결 종료
$mysqli->close();
?>
