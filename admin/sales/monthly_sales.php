<?php
$title = "월별매출통계";
$chart_js = "<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // SQL 쿼리
  $sql = "
      SELECT 
          DATE_FORMAT(o.order_date, '%Y-%m') AS month,
          COUNT(DISTINCT o.odid) AS order_count,
          SUM(o.total_amount) AS total_order_amount,
          SUM(o.discount_amount) AS total_discount,
          SUM(o.final_amount) AS net_order_amount,
          COALESCE(SUM(r.amount), 0) AS total_refund_amount,
          SUM(o.final_amount) - COALESCE(SUM(r.amount), 0) AS net_sales
      FROM 
          orders o
      LEFT JOIN 
          order_items oi ON o.odid = oi.order_id
      LEFT JOIN 
          refunds r ON oi.order_item_id = r.order_item_id
      WHERE 
          o.pay_status = 1
      GROUP BY 
          DATE_FORMAT(o.order_date, '%Y-%m');
  ";

  $stmt = $pdo->query($sql);
  $salesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Chart.js 데이터 준비
  $labels = [];
  $netSales = [];
  foreach ($salesData as $row) {
      $labels[] = $row['month'];
      $netSales[] = $row['net_sales'];
  }

} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

?>
<style>
  .bg-body-tertiary {
    --bs-bg-opacity: 1;
    background-color: #FDFDFD !important;
}
</style>

<div class="container">
  <h2 class="page_title">월별매출통계</h2>
  <div class="shadow-lg p-5 mb-5 bg-body-tertiary rounded chart_bg">
    <canvas id="myLineChart" width="800" height="500"></canvas>
  </div>
  <form action="" id="search_form" class="row justify-content-end">
    <div class="col-lg-3">
      <input type="date" class="form-control" />
    </div>
    <div class="col-lg-3">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="분류 선택 또는 검색어를 입력해주세요" aria-label="Recipient's username" aria-describedby="basic-addon2">
      <button type="button" class="btn btn-secondary">
        <i class="bi bi-search"></i>
      </button>
      </div>
    </div>
  </form>

  <form action="">
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
        <tr>
          <th scope="row">1</th>
          <td><a href="teacher_details.php">2023 1월</td>
          <td><a href="teacher_details.php">9,999원 / 10건</td>
          <td><a href="teacher_details.php">9,999원 / 10건</td>
          <td><a href="teacher_details.php">9,999원 / 10건</td>
          <td><a href="teacher_details.php">119,999원</td>
        </tr>  
        <tr>
          <th scope="row">1</th>
          <td><a href="teacher_details.php">2023 2월</td>
          <td><a href="teacher_details.php">9,999원 / 10건</td>
          <td><a href="teacher_details.php">9,999원 / 10건</td>
          <td><a href="teacher_details.php">9,999원 / 10건</td>
          <td><a href="teacher_details.php">119,999원</td>
        </tr>  
    
    </table>
    <!-- //table -->
    <button type="button" class="btn btn-outline-secondary ms-auto d-block">일괄수정</button>
  </form>



  <div class="list_pagination" aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
      <li class="page-item">
        <a class="page-link" href="" aria-label="Previous">
          <i class="bi bi-chevron-left"></i>
        </a>
      </li>
      <li class="page-item active"><a class="page-link" href="">1</a></li>
      <li class="page-item"><a class="page-link" href="">2</a></li>
      <li class="page-item"><a class="page-link" href="">3</a></li>
      <li class="page-item">
        <a class="page-link" href="" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </a>
      </li>
    </ul>
  </div>
   <!-- //Pagination -->
</div>

<script>
 const ctx = document.getElementById('myLineChart').getContext('2d');
        const myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                datasets: [{
                    label: '데이터',
                    data: [1500, 1800, 2200, 2600, 3500, 3000, 4000, 3500, 2500, 2700, 4500, 4000],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2,
                    fill: true, 
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)', // 포인트 색상
                    pointRadius: 5 // 포인트 크기 설정
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
                        tension: 0.4 // 곡선의 부드러움 조정
                    }
                }
            }
        });


</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>