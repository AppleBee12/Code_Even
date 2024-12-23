<?php
  $title = "주문상세정보";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

  $odid = $_GET['odid'];  

  $sql = "SELECT 
    o.*,  
    u.userid AS user_id, 
    u.username AS user_name, 
    od.oddtid AS oddtid,
    od.lec_title AS lec_title,
    od.pay_status AS order_detail_status,
    od.lec_price AS lec_price,
    r.re_amount AS refund_price
  FROM  
    orders o
  LEFT JOIN 
    user u 
  ON 
    o.uid = u.uid  
  LEFT JOIN 
    order_details od
  ON 
    o.odid = od.odid
  LEFT JOIN 
    refunds r
  ON 
    o.odid = r.odid
  WHERE 
    o.odid = $odid
  ORDER BY 
    od.oddtid ASC
  ";


  $result = $mysqli->query($sql); //쿼리 실행 결과
  // 배열 초기화
  $dataArr = [];

  // 결과를 배열에 저장
  if ($result->num_rows > 0) {
      while ($data = $result->fetch_object()) {
          $dataArr[] = $data; // 결과를 배열에 추가
      }

    } else {
      echo "데이터가 없습니다.";
    }
    //print_r($dataArr);
?>

<div class="container">
  <h2>주문결제상세</h2>
  <div class="content_bar">
    <h3>주문상세목록</h3>
  </div>
  <h4 class="odid_name">주문번호 : <?= $odid; ?></h4>
  <table class="table list_table">
    <thead>
        <tr>
            <th scope="col">번호</th>
            <th scope="col">항목번호</th>
            <th scope="col">강의명/교재명</th>
            <th scope="col">청구금액</th>
            <th scope="col">할인액</th>
            <th scope="col">환불액</th>
            <th scope="col">결제금액</th>
            <th scope="col">상태</th>
        </tr>
    </thead>
    <tbody>
      <?php
      $index = 1;
      foreach ($dataArr as $data) {
          // 구분 값 변환
          // $type = ($data->product_type == 1) ? "강좌" : "교재";

          // 상태 값 변환
          if ($data->order_detail_status == 0) {
              $status = "결제완료";
          } elseif ($data->order_detail_status == -1) {
              $status = "환불";
          } elseif ($data->order_detail_status == 1) {
              $status = "취소";
          } else {
              $status = "알 수 없음"; // 예외 처리
          }

          // HTML 출력
          echo "
          <tr>
              <th scope='row'>{$index}</th>
              <td>{$data->oddtid}</td>
              <td>{$data->lec_title}</td>
              <td>" . number_format($data->lec_price) . "</td>
              <td>" . number_format($data->discount_amount) . "</td>
              <td>". number_format($data->refund_price) . "</td>
              <td>" . number_format($data->final_amount) . "</td>
              <td>{$status}</td>
          </tr>";
          $index++;
        }
      ?>
      </tbody>
    </table>


  <div class="content_bar">
    <h3>결제 정보</h3>
  </div>
  <table class="table w-100 info_table">
    <colgroup>
    <col class="col-width-160">
    <col class="col-width-516">
    <col class="col-width-160">
    <col class="col-width-516"> 
    </colgroup>
    <tbody>
    <?php
    // 결제 정보는 주문 번호(`odid`) 기준으로 한 번만 출력하기 위해 첫 번째 데이터만 사용
    if (!empty($dataArr)) {
        // 첫 번째 데이터 가져오기
        $item_count = count($dataArr);
        $firstData = $dataArr[0];
        // 결제 방법 배열 정의
        $pay_methods = [
            1 => "신용카드",
            2 => "간편결제",
            3 => "가상계좌",
            4 => "휴대폰결제",
            5 => "실시간계좌이체"
        ];
        ?>
        <tr> 
            <th scope="row">아이디</th>
            <td>
                <?= htmlspecialchars($firstData->user_id); ?>
            </td>
            <th scope="row">결제일 <b>*</b></th>
            <td>
                <?= htmlspecialchars($firstData->order_date); ?>
            </td>
        </tr>
        <tr>
          <th scope="row">이름 <b>*</b></th>
          <td colspan="3">
              <?= htmlspecialchars($firstData->user_name);  ?>
          </td>   
        </tr>
        <tr>
          <th scope="row">주문명</th>
          <td colspan="3">
            <?= htmlspecialchars($firstData->order_title) . ($item_count > 1 ? " 외 " . ($item_count - 1) . "건" : ""); ?>
          </td>
        </tr>
        <tr>
            <th scope="row">결제금액</th>
            <td colspan="3">
                <?= number_format($firstData->final_amount); ?> 원
            </td>
        </tr>
        
        <tr>
            <th scope="row">결제방법</th>
            <td colspan="3">
                <?= isset($pay_methods[$firstData->pay_method]) ? $pay_methods[$firstData->pay_method] : "알 수 없음"; ?>
            </td>
        </tr>
        <?php
    } else {
        echo "<tr><td colspan='4'>결제 정보가 없습니다.</td></tr>";
    }
    ?>
</tbody>
  </table>

  <?php
// 수령 정보 확인
if (!empty($firstData->receiver)) { ?>
  <div class="content_bar">
    <h3>수령 정보</h3>
  </div>
  <table class="table w-100 info_table">
    <colgroup>
    <col class="col-width-160">
    <col class="col-width-516">
    <col class="col-width-160">
    <col class="col-width-516">
    </colgroup>
    <tbody>
    <tr>
                <th scope="row">수령인</th>
                <td><?= htmlspecialchars($firstData->receiver); ?></td>
                <th scope="row">연락처</th>
                <td><?= htmlspecialchars($firstData->receiver_phone); ?></td>
            </tr>
            <tr>
                <th scope="row">수령주소</th>
                <td colspan="3">
                    <?= htmlspecialchars($firstData->zipcode); ?>
                </td>
            </tr>
      <tr>
    <th scope="row"></th>
    <td colspan="3"><?= !empty($firstData->addr_line1) ? htmlspecialchars($firstData->addr_line1) : ''; ?></td>
      </tr>
      <tr>
          <th scope="row"></th>
          <td colspan="3"><?= !empty($firstData->addr_line2) ? htmlspecialchars($firstData->addr_line2) : ''; ?></td>
      </tr>
      <tr>
          <th scope="row"></th>
          <td colspan="3"><?= !empty($firstData->addr_line3) ? htmlspecialchars($firstData->addr_line3) : ''; ?></td>
      </tr>
      
    </tbody>
  </table>
  <?php } ?>
  <div class="d-flex justify-content-end gap-2">
    <a href="orders_list.php" role="button" class="btn btn-outline-secondary">목록</a>
  </div>
</div>



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>