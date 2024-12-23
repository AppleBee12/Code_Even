<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

$aqid = $_POST['aqid'];
$acontent = $_POST['acontent'];

if (isset($_GET['confirm']) && $_GET['confirm'] == "true") {
    $admin_qna_sql = "
        INSERT INTO admin_answer (aqid, acontent)
        SELECT aqid, '$acontent'
        FROM admin_question
        WHERE aqid = $aqid
    ";

    $admin_qna_result = $mysqli->query($admin_qna_sql);

    if ($admin_qna_result === true) {
        echo 
        "<script>
            alert('등록이 완료되었습니다.');
            location.href = 'admin_qna.php';
        </script>";
    } else {
        echo 
        "<script>
            alert('글쓰기 실패');
            history.back();
        </script>";
    }
} else {
    echo 
    "<script>
        if (confirm('글을 등록하시겠습니까?')) {
            location.href = '?aqid=" . $_POST['aqid'] . "&acontent=" . urlencode($_POST['acontent']) . "&confirm=true';
        } else {
            alert('등록이 취소되었습니다.');
            location.href = 'admin_qna.php';
        }
    </script>";
}
?>
