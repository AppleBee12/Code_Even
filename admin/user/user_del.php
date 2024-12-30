<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

    $uid = $_GET['uid'];
    if (!isset($uid)) {
        echo "<script> alert('회원정보가 없습니다.'); location.href = 'user_list.php'; </script>";
        exit;
    }

    // 회원 구분 확인
    $user_check_sql = "SELECT user_level FROM user WHERE uid = $uid";
    $user_check_result = $mysqli->query($user_check_sql);
    if ($user_check_result && $user_check_result->num_rows > 0) {
        $user_data = $user_check_result->fetch_assoc();
        $user_level = $user_data['user_level'];

        // 회원 구분이 강사 (user_level = 10)인 경우 teachers 테이블에서 uid와 일치하는 데이터 삭제
        if ($user_level == 10) {
            $teacher_del_sql = "DELETE FROM teachers WHERE uid = $uid";
            $teacher_del_result = $mysqli->query($teacher_del_sql);

            if (!$teacher_del_result) {
                echo "<script> alert('강사 정보 삭제 중 오류가 발생했습니다.'); location.href = 'user_list.php'; </script>";
                exit;
            }
        }
    }

    // user 테이블에서 회원 삭제
    $user_del_sql = "DELETE FROM user WHERE uid = $uid";
    $user_del_result = $mysqli->query($user_del_sql);

    if ($user_del_result) {
        echo "<script>
            alert('회원정보 삭제완료');
            location.href = 'user_list.php';
        </script>";
    } else {
        echo "<script>
            alert('회원정보 삭제 중 오류가 발생했습니다.');
            location.href = 'user_list.php';
        </script>";
    }

    $mysqli->close();
?>
