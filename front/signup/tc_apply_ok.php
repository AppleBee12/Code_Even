<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/CODE_EVEN/admin/inc/dbcon.php');

// 로그인 여부 확인
if (!isset($_SESSION['AUID'])) {
    echo "<script>
        alert('로그인이 필요합니다.');
        location.href='/CODE_EVEN/admin/login/login.php';
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 세션에서 로그인된 사용자 정보 가져오기
    $uid = $_SESSION['AUID'];
    // 사용자 정보 가져오기
    $user_sql = "SELECT uid, userid, username, userphonenum, useremail FROM user WHERE userid = '$uid'";
    $user_result = $mysqli->query($user_sql);

    if ($user_result && $user_result->num_rows > 0) {
        $user_data = $user_result->fetch_object();
    } else {
        echo "<script>
            alert('사용자 정보를 찾을 수 없습니다.');
            history.back();
        </script>";
        exit;
    }

    // 강사 중복 신청 확인
    $check_sql = "SELECT tcid FROM teachers WHERE uid = '{$user_data->uid}'";
    $check_result = $mysqli->query($check_sql);

    if ($check_result && $check_result->num_rows > 0) {
        echo "<script>
            alert('이미 강사신청이 완료된 회원입니다.');
            location.href = '../../index.php';
        </script>";
        exit;
    }


    // POST 값 가져오기
    $tc_url = $mysqli->real_escape_string($_POST['tc_url']);
    $tc_intro = $mysqli->real_escape_string($_POST['tc_intro']);
    $category = isset($_POST['category']) ? intval($_POST['category']) : null;

    if (!$category) {
        echo "<script>
            alert('희망 분야를 선택해주세요.');
            history.back();
        </script>";
        exit;
    }

    // teachers 테이블에 데이터 삽입
    $insert_sql = "INSERT INTO teachers (
        uid,
        cgid,
        tc_userid,
        tc_name,
        tc_userphone,
        tc_email,
        tc_cate,
        tc_url,
        tc_intro,
        tc_ok
    ) VALUES (
        '{$user_data->uid}',
        '$category',
        '{$user_data->userid}',
        '{$user_data->username}',
        '{$user_data->userphonenum}',
        '{$user_data->useremail}',
        '$category',
        '$tc_url',
        '$tc_intro',
        0
    )";

    if ($mysqli->query($insert_sql)) {
        echo "<script>
            alert('강사 신청이 완료되었습니다.');
            location.href = '../../index.php';
        </script>";
    } else {
        echo "<script>
            alert('신청 중 문제가 발생했습니다. 다시 시도해주세요.');
            history.back();
        </script>";
    }
}


?>
