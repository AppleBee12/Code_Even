<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uid = $_SESSION['UID'];
  
  // 데이터 유효성 검증
  $totalAmount = isset($_POST['total_amount']) ? intval($_POST['total_amount']) : 0;
  $discountAmount = isset($_POST['discount_amount']) ? intval($_POST['discount_amount']) : 0;
  $finalAmount = isset($_POST['final_amount']) ? intval($_POST['final_amount']) : 0;
  $payMethod = $_POST['selected_payment'] ?? null;
  $receiver = $_POST['receiver_name'] ?? null;
  $receiverPhone = $_POST['receiver_contact'] ?? null;
  $zipcode = $_POST['post_code'] ?? null;
  $addrLine1 = $_POST['addr_line1'] ?? null;
  $addrLine2 = $_POST['addr_line2'] ?? null;
  $addrLine3 = $_POST['addr_line3'] ?? null;
  $cartItems = isset($_POST['cart_items']) ? json_decode($_POST['cart_items'], true) : [];

  if (!$totalAmount || !$finalAmount || empty($cartItems)) {
    echo "<script>alert('잘못된 요청입니다.'); window.history.back();</script>";
    exit;
  }

  // 대표 강좌 제목 설정
  $lecTitle = $cartItems[0]['lectureTitle']; // 첫 번째 강좌의 제목 사용

  $mysqli->begin_transaction(); // 트랜잭션 시작

  try {
    // orders 테이블에 데이터 삽입
    $orderSql = "INSERT INTO orders (uid, total_amount, discount_amount, final_amount, order_title, pay_method, pay_status, receiver, receiver_phone, zipcode, addr_line1, addr_line2, addr_line3) 
                 VALUES (?, ?, ?, ?, ?, ?, 0, ?, ?, ?, ?, ?, ?);";
    $stmt = $mysqli->prepare($orderSql);
    $stmt->bind_param("iiisssssssss", $uid, $totalAmount, $discountAmount, $finalAmount, $lecTitle, $payMethod, $receiver, $receiverPhone, $zipcode, $addrLine1, $addrLine2, $addrLine3);
    $stmt->execute();
    $orderId = $stmt->insert_id; // 생성된 주문 ID 가져오기

    // order_details 및 class_data 테이블에 데이터 삽입
    foreach ($cartItems as $item) {
      $leid = $item['leid']; 
      $lecTitle = $item['lectureTitle'];
      $lecPrice = intval($item['lecturePrice']);
      $boid = $item['book']['boid'] ?? null; // 교재 ID (없을 수 있음)
      $boTitle = $item['book']['name'] ?? null; // 교재명
      $boPrice = intval($item['book']['price'] ?? 0); // 교재 가격 (없을 경우 0)

      // order_details 데이터 삽입
      $detailSql = "INSERT INTO 
      order_details (odid, leid, lec_title, lec_price, boid, bo_title, bo_price, pay_status)
            VALUES (
                $orderId,
                $leid,
                '" . $mysqli->real_escape_string($lecTitle) . "',
                $lecPrice,
                " . ($boid !== null ? $boid : "NULL") . ",
                '" . ($boTitle !== null ? $mysqli->real_escape_string($boTitle) : "") . "',
                $boPrice,
                0
            );
        ";
      $mysqli->query($detailSql);

      // class_data 데이터 삽입
      $classSql = "INSERT INTO class_data (uid, leid) VALUES (?, ?);";
      $stmt = $mysqli->prepare($classSql);
      $stmt->bind_param("ii", $uid, $leid);
      $stmt->execute();
    }

    $mysqli->commit(); // 트랜잭션 커밋

    // 결제 성공 메시지 및 리디렉션
    echo "<script>
    alert('결제가 완료되었습니다! 나의 수업 페이지로 이동합니다.');
    window.location.href = 'http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/mypage/mypage_lecture.php';
    </script>";
    exit;

  } catch (Exception $e) {
    $mysqli->rollback(); // 트랜잭션 롤백
    // 상세 오류 메시지 출력
    echo "<script>
      alert('결제 처리 중 오류가 발생했습니다: " . addslashes($e->getMessage()) . "');
      window.history.back();
    </script>";
    exit;
  } finally {
    if (isset($stmt)) {
      $stmt->close();
    }
    $mysqli->close();
  }
} else {
  echo "<script>alert('잘못된 요청입니다.'); window.history.back();</script>";
  exit;
}
