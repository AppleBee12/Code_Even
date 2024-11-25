<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/code_even/admin/inc/img_upload_func.php');

    $tcid = $_POST['tcid'];

    /* ---------------- 이미지 업로드 변수 정의 --------------------- */
    $thumbnail = $_FILES['tc_thumbnail'] ?? '';
    $tc_userid = $_POST['tc_userid'];
    $tc_name = $_POST['tc_name'];
    $tc_url = $_POST['tc_url'] ?? '';
    $tc_userphone = $_POST['tc_userphone'];
    $tc_email = $_POST['tc_email'];
    $tc_cate = $_POST['tc_cate'];
    $tc_ok = $_POST['tc_ok'];
    $isnew = $_POST['isnew'] ?? 0;
    $isrecom = $_POST['isrecom'] ?? 0;
    $tc_intro = rawurldecode($_POST['tc_intro']);

    /* ---------------- 이미지 업로드 함수 호출 로직 시작 --------------------- */
    // 상위 디렉토리 이름 가져오기 (예: 'teacher')
    $callingFileDir = basename(dirname(__FILE__));

    // 기존 이미지 경로 가져오기 (기존에 업로드된 파일 지우기 위해서 불러옴)
    $sql = "SELECT tc_thumbnail FROM teachers WHERE tcid = $tcid";
    $result = $mysqli->query($sql);
    $existingThumbnail = '';
    if ($result && $row = $result->fetch_assoc()) {
        $existingThumbnail = $row['tc_thumbnail'];
    }

    $thumbnailPath = ''; // 초기화 추가 (썸네일 변경 안 하는 경우)

    if (isset($_FILES['tc_thumbnail']) && $_FILES['tc_thumbnail']['error'] == UPLOAD_ERR_OK) {
        // 기존 파일이 있으면 삭제
        if (!empty($existingThumbnail)) {
            $fullPath = $_SERVER['DOCUMENT_ROOT'] . $existingThumbnail;
            deleteFile($fullPath); // 파일 삭제 함수 호출
        }

        // 새로운 파일 업로드
        $uploadResult = fileUpload($_FILES['tc_thumbnail'], $callingFileDir);
        if ($uploadResult) {
            $thumbnailPath = $uploadResult; // 성공적으로 업로드된 경로
        } else {
            echo "<script>
                alert('파일 첨부할 수 없습니다.');
                history.back();
            </script>";
            exit;
        }
    }
    /* ---------------- 이미지 업로드 함수 호출 끝 --------------------- */

    // 썸네일의 값이 없고
    $sql = "UPDATE teachers SET 
        tc_name = '$tc_name',
        tc_url = '$tc_url',
        tc_userphone = '$tc_userphone',
        tc_email = '$tc_email',
        tc_cate = '$tc_cate',
        tc_ok = $tc_ok,
        isnew = $isnew,
        isrecom = $isrecom,
        tc_intro = '$tc_intro'";

    /* ---------------- 이미지 업로드 업데이트 sql --------------------- */
    // thumbnail 값이 존재할 때만 thumbnail 컬럼을 업데이트
    if ($thumbnailPath) {
        $sql .= ", tc_thumbnail = '$thumbnailPath'";
    }
    /* ---------------- 이미지 업로드 업데이트 sql 끝 --------------------- */

    $sql .= " WHERE tcid = $tcid";

    //print_r($sql);

    $result = $mysqli->query($sql); // teachers 테이블에 강사정보 업데이트


    if ($result) {
        // tc_ok 값에 따라 user_level 값을 설정
        if ($tc_ok == 1) {
            $new_user_level = 10; // tc_ok가 1일 때 user_level은 10
        } elseif ($tc_ok == -1 || $tc_ok == 0) {
            $new_user_level = 1; // tc_ok가 -1이거나 0일 때 user_level은 1
        }
        // user_level 업데이트 쿼리 실행
        if (isset($new_user_level)) {
            $user_sql = "UPDATE user SET user_level = $new_user_level WHERE userid = '$tc_userid'";
            $mysqli->query($user_sql);
        }
        //print_r($result);

        echo "
        <script>
            alert('강사정보 수정 완료');
            location.href = 'teacher_list.php';
        </script>
        ";
    } else {
        echo "Error: " . $mysqli->error;

    }

$mysqli->close();

?>
