<?php
$title = "수강생 질문";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

// JavaScript에서 확인을 받은 경우에만 sqid를 받아와서 삭제를 실행
if (isset($_GET['sqid']) && isset($_GET['confirm']) && $_GET['confirm'] == "true") {
    $sqid = intval($_GET['sqid']);
    $sql = "DELETE FROM student_qna WHERE sqid = $sqid";
    $result = $mysqli->query($sql);

    if ($result) {
        echo 
        "<script>
            alert('삭제가 완료되었습니다.');
            location.href = 'student_question.php?delete=true';
        </script>";
    } else {
        echo 
        "<script>
            alert('글 삭제 실패');
            history.back();
        </script>";
    }
} else {
    echo 
    "<script>
        if (confirm('글을 삭제하시겠습니까?')) {
            location.href = '?sqid=" . $_GET['sqid'] . "&confirm=true';
        } else {
            alert('삭제가 취소되었습니다.');
            location.href = 'student_question.php';
        }
    </script>";
}
?>
