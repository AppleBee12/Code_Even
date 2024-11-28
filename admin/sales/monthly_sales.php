<?php
  $title = "월별매출통계";
  //$jqueryui_css = " <link rel=\"stylesheet\" href=\"https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css\">";
  $chart_js = "<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>";
  //$jqueryui_js = "<script src=\"https://code.jquery.com/ui/1.14.1/jquery-ui.js\"></script>";

  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

  $logged_in_user_level = $_SESSION['AULEVEL']; // 세션에서 사용자 레벨 가져오기
  $logged_in_user_uid = $_SESSION['UID']; // 세션에서 사용자 UID 가져오기

  // 기본 WHERE 절
  $where_clause = "WHERE o.pay_status = 0";

  // 강사 계정인 경우 본인 데이터만 조회
  if ($logged_in_user_level == 10) { 
      $where_clause .= " AND od.tc_uid = " . intval($logged_in_user_uid);
  }

  // SQL 쿼리
  $sql = "SELECT 
      DATE_FORMAT(o.order_date, '%Y-%m') AS data_year_month,
      COUNT(DISTINCT o.odid) AS order_count,
      COUNT(DISTINCT r.reid) AS re_count,
      SUM(o.total_amount) AS total_order_amount,
      SUM(o.discount_amount) AS total_discount,
      SUM(o.final_amount) AS net_order_amount,
      COALESCE(SUM(r.re_amount), 0) AS total_refund_amount,
      SUM(o.final_amount) - COALESCE(SUM(r.re_amount), 0) AS final_sales_amount
  FROM 
      orders o
  LEFT JOIN 
      order_details od ON o.odid = od.odid
  LEFT JOIN 
      refunds r ON od.oddtid = r.oddtid
  $where_clause
  GROUP BY 
      DATE_FORMAT(o.order_date, '%Y-%m')
  ";

  // 쿼리 실행
  $result = $mysqli->query($sql);
  $salesData = [];
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $salesData[] = $row;
          //년월저장
          //$yearMonth = explode('-', $row['data_year_month']); // '2023-01'을 '-'로 분리하여 배열로 저장
      }
  }

  // Chart.js 데이터 준비
  $labels = [];
  $netSales = [];
  foreach ($salesData as $row) {
      $labels[] = $row['data_year_month'];
      $netSales[] = $row['final_sales_amount'];
  }
  // PHP에서 JSON 형식으로 변환해 JavaScript에 전달
  $labelsJson = json_encode($labels);
  $netSalesJson = json_encode($netSales);

?>

<div class="container">
  <h2 class="page_title">월별매출통계</h2>
  <div class="shadow-lg p-5 mb-5 bg-body-tertiary rounded chart_bg">
    <canvas id="myLineChart" width="800" height="500"></canvas>
  </div>
  
   <!-- 
  <form action="" id="search_form" class="row justify-content-end">
    <div class="col-lg-2 d-flex gap-3">
     <input class="form-control" type="text" id="datepicker"></p>
      <input class="form-control" type="month" id="month">
      <input class="form-control" type="month" id="month">
      <button type="button" class="btn btn-secondary">
        <i class="bi bi-search"></i>
      </button>
    </div>
    <div class="col-lg-3">
    <div class="input-group mb-3">
     <input type="text" class="form-control" placeholder="분류 선택 또는 검색어를 입력해주세요" aria-label="Recipient's username" aria-describedby="basic-addon2">
  
      </div>
    </div>
  </form>
  -->

  <div class="col-lg-3 my-4">
    <span>통계기간 : 2023년 12월 - 2024년 11월 </span>
  </div>
  <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">번호</th>
        <th scope="col">날짜</th>
        <th scope="col">주문금액 / 건수</th>
        <th scope="col">할인액 / 건수</th>
        <th scope="col">환불금액 / 건수</th>
        <th scope="col">총매출금액</th>
      </tr>
    </thead>
    <tbody>
      <tbody>
        <?php

        $total_order_amount = 0;
        $total_order_count = 0;
        $total_discount = 0;
        $total_refund_amount = 0;
        $total_final_sales = 0;

          foreach ($salesData as $index => $row) {

            // 각 행마다 'data_year_month' 값을 기반으로 분리하여 사용
        $yearMonth = explode('-', $row['data_year_month']); // '2023-01'을 '-'로 분리하여 배열로 저장
              echo "<tr>";
              echo "<th scope='row'>" . ($index + 1) . "</th>";
              echo "<td>" . $yearMonth[0] . "년 " . intval($yearMonth[1]) . "월</td>"; // 2023년 1월 형식으로 출력
              echo "<td>" . number_format($row['total_order_amount']) . "원 / " . $row['order_count'] . "건</td>";
              echo "<td>" . number_format($row['total_discount']) . "원 / " . $row['order_count'] . "건</td>";
              echo "<td>" . number_format($row['total_refund_amount']) . "원 / " . $row['re_count'] . "건</td>";
              echo "<td>" . number_format($row['final_sales_amount']) . "원</td>";
              echo "</tr>";

              // 합계 계산
              $total_order_amount += $row['total_order_amount'];
              $total_order_count += $row['order_count'];
              $total_discount += $row['total_discount'];
              $total_refund_amount += $row['total_refund_amount'];
              $total_final_sales += $row['final_sales_amount'];
          }

          // 합계 행 출력
          echo "<tr>";
          echo "<th scope='row'>합계</th>";
          echo "<td></td>"; // 빈 칸
          echo "<td>" . number_format($total_order_amount) . "원 / " . $total_order_count . "건</td>";
          echo "<td>" . number_format($total_discount) . "원 / " . $total_order_count . "건</td>";
          echo "<td>" . number_format($total_refund_amount) . "원 / " . $total_order_count . "건</td>";
          echo "<td>" . number_format($total_final_sales) . "원</td>";
          echo "</tr>";
        ?>
      </tbody>
  </table>
  <!-- //table -->  
</div>

<script>
    const ctx = document.getElementById('myLineChart').getContext('2d');
    const myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo $labelsJson; ?>, // PHP에서 생성된 JSON 데이터 사용
            datasets: [{
                label: '월별 총매출',
                data: <?php echo $netSalesJson; ?>,
                borderColor: 'rgba(231, 105, 105, 1)',
                backgroundColor: 'rgba(231, 105, 105, 0.2)',
                borderWidth: 2,
                fill: true,
                pointBackgroundColor: 'rgba(231, 105, 105, .9)',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: false,
                    suggestedMax: 5000
                }
            },
            elements: {
                line: {
                    tension: 0.4
                }
            }
        }
    });

</script>
<script>
$(document).ready(function(){               
    $.datepicker.setDefaults({
    closeText: "닫기",
    currentText: "오늘",
    prevText: '이전 달',
    nextText: '다음 달',
    monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
    monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
    dayNames: ['일', '월', '화', '수', '목', '금', '토'],
    dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
    dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
    weekHeader: "주",
    yearSuffix: '년'
    });    
 });
</script>

<script>
  

  $( function() {
    $( "#datepicker" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );


</script>





<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>