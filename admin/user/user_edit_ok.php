<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/code_even/admin/inc/img_upload_func.php');

    $uid = $_POST['uid'];

    $username = $_POST['username'];
    $userpw = $_POST['userpw'] ?? '';
    $user_level = $_POST['user_level'];
    $user_status = $_POST['user_status'];
    $usernick = $_POST['usernick'];
    $post_code = isset($_POST['post_code']) && $_POST['post_code'] !== '' ? $_POST['post_code'] : 'NULL';
    $addr_line1 = $_POST['addr_line1'] ?? '';
    $addr_line2 = $_POST['addr_line2'] ?? '';
    $addr_line3 = $_POST['addr_line3'] ?? '';
    $userphonenum = $_POST['userphonenum'];
    $useremail = $_POST['useremail'];
    $email_ok = $_POST['email_ok'] ?? 0;



    $sql = "UPDATE user SET 
        username = '$username',
        user_level = $user_level,
        user_status = $user_status,
        usernick = '$usernick',
        post_code = $post_code,
        addr_line1 = '$addr_line1',
        addr_line2 = '$addr_line2',
        addr_line3 = '$addr_line3',
        userphonenum = '$userphonenum',
        useremail = '$useremail',
        email_ok = $email_ok";

    // 비밀번호가 입력된 경우 암호화하여 업데이트
    if (!empty($userpw)) {
        $hashedPw = hash('sha512', $userpw);
        $sql .= ", userpw = '$hashedPw'";
    }

    $sql .= " WHERE uid = $uid";
    $result = $mysqli->query($sql); 

    if ($result) {
        echo "
            <script>
                alert('회원정보 수정완료');
                location.href = 'user_list.php';
            </script>
        ";
    } else {
        echo "Error: " . $mysqli->error;
    }

    $mysqli->close();
?>
