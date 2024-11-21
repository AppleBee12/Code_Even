<?php
  $title = "주문상세정보";
  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

  $odid = $_GET['odid'];  

  $sql = "SELECT 
    o.*,  
    u.userid AS user_id, 
    u.username AS user_name, 
    od.oddtid AS oddtid,
    od.product_type AS product_type,
    od.product_title AS product_title,
    od.cnt AS cnt,
    od.pay_status AS order_detail_status,
    od.price AS price
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
?>

<div class="container">
  <h2>주문결제상세</h2>
  <div class="content_bar">
    <h3>주문상세목록</h3>
  </div>
  <table class="table list_table">
    <thead>
        <tr>
            <th scope="col">순번</th>
            <th scope="col">주문상세번호</th>
            <th scope="col">구분</th>
            <th scope="col">강의명/교재명</th>
            <th scope="col">수량</th>
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
          $type = ($data->product_type == 1) ? "강좌" : "교재";

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
              <td>{$type}</td>
              <td>{$data->product_title}</td>
              <td>{$data->cnt}</td>
              <td>" . number_format($data->price) . "</td>
              <td>" . number_format($data->discount_amount) . "</td>
              <td>환불액</td>
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
            <th scope="row">이름 <b>*</b></th>
            <td>
                <?= htmlspecialchars($firstData->user_name); // 사용자 이름 ?>
            </td>
            <th scope="row">아이디</th>
            <td>
                <?= htmlspecialchars($firstData->user_id); // 사용자 아이디 ?>
            </td>
        </tr>
        <tr>
            <th scope="row">결제일 <b>*</b></th>
            <td>
                <?= htmlspecialchars($firstData->order_date); // 결제일 ?>
            </td>
            <th scope="row">주문명</th>
            <td>
                <?= htmlspecialchars($firstData->order_title); // 주문명 ?>
            </td>
        </tr>
        <tr>
            <th scope="row">결제금액</th>
            <td colspan="3">
                <?= number_format($firstData->final_amount); // 결제 금액 ?> 원
            </td>
        </tr>
        <tr>
            <th scope="row">결제방법</th>
            <td colspan="3">
                <?= isset($pay_methods[$firstData->pay_method]) ? $pay_methods[$firstData->pay_method] : "알 수 없음"; // 결제방법 출력 ?>
            </td>
        </tr>
        <?php
    } else {
        echo "<tr><td colspan='4'>결제 정보가 없습니다.</td></tr>";
    }
    ?>
</tbody>

   

    <!--
    <?php
          if(isset($dataArr)){
            foreach($dataArr as $item){
        ?> 
      <tr>
        <th scope="row">이름 <b>*</b></th>
        <td>
          125
        </td>
        <th scope="row">아이디</th>
        <td>
          nany
        </td>
      </tr>
      <tr>
        <th scope="row">결제일 <b>*</b></th>
        <td>
          2024/10/29
        </td>
        <th scope="row">이름</th>
        <td>
          홍나니
        </td>
      </tr>
      <tr>
        <th scope="row">주문명</th>
        <td colspan="3">
        기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습) 외 1건
        </td>
      </tr>
      <tr>
        <th scope="row">결제금액</th>
        <td colspan="3">
          102,000 원
        </td>
      </tr>
      <tr>
        <th scope="row">결제방법</th>
        <td colspan="3">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked disabled>
            <label class="form-check-label" for="inlineRadio1">신용카드</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" disabled>
            <label class="form-check-label" for="inlineRadio2">무통장입금</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
            <label class="form-check-label" for="inlineRadio3">실시간 계좌이체</label>
          </div>
        </td>
      </tr>
      <?php
            }
          }
        ?>   
    </tbody>
      -->
  </table>

  
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
        <td>
          홍나니
        </td>
        <th scope="row">연락처</th>
        <td>
          010-1234-5678
        </td>
      </tr>
      <tr>
        <th scope="row">수령주소</th>
        <td colspan="3">
          03192
        </td>
      </tr>
      <tr>
        <th scope="row"></th>
        <td colspan="3">
        서울 종로구 수표로 96
        </td>
      </tr>
      <tr>
        <th scope="row"></th>
        <td colspan="3">
          401호
        </td>
      </tr>

      <tr>
        <td colspan="4">
            <hr>
        </td>
      </tr>
      
    </tbody>
  </table>
  <div class="d-flex justify-content-end gap-2">
    <a href="teacher_list.php" type="button" class="btn btn-outline-secondary">목록</a>
  </div>
</div>



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>