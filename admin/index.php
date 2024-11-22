<?php

$chart_js = "<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>";
$host = $_SERVER['HTTP_HOST'];
$main_js = "<script src=\"http://$host/code_even/admin/js/main.js\"></script>";

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

//오늘 방문자 수와 6개월 방문자 수 계산

$dataFile =$_SERVER['DOCUMENT_ROOT'] . '/code_even/inc/visit_data.json';
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

$monthlyData = [];
foreach ($data as $date => $count) {
    $month = substr($date, 0, 7);
    if (!isset($monthlyData[$month])) {
        $monthlyData[$month] = 0;
    }
    $monthlyData[$month] += $count;
}

// 최신날짜부터 오름차순sort 내림차순krsort
//sort($monthlyData);
$latestMonths = array_slice(array_keys($monthlyData), 0, -6); //최신 6개월 만 array
$latestCounts = array_slice(array_values($monthlyData), 0, -6);//최신 방문자 수 만 array

?>
<div class="container">
  <?php 
  // print_r($dataFile );
  // print_r($data);
  print_r($monthlyData);
print_r($latestMonths);
print_r($latestCounts); ?>
  <div class="top_wrapper d-flex justify-content-between">
    <div>
      <h3>11월 수익</h3>
      <p>7,123,000<span class="top_text"> 원</span></p>
    </div>
    <div>
      <h3>직전달 대비 수익률</h3>
      <p>3%</p>
    </div>
    <div>
      <h3>과정 개설 현황</h3>
      <p><span class="top_text">대기 </span>12 <span class="top_text">/ 개설 </span>1,234</p>
    </div>
    <div>
      <h3>판매 강좌수</h3>
      <p>1,234<span class="top_text"> 개</span></p>
    </div>
    <div>
      <h3>오늘 접속자 수</h3>
      <p>53<span class="top_text"> 명</span></p>
    </div>
  </div>
  <div class="bottom_wrapper d-flex justify-content-between">
    <div class="bott_left d-flex flex-column justify-content-between ">
      <h3>최근 6개월 수익률</h3>
      <canvas id="current_six_returns" width="550" height="500"></canvas>
    </div>
    <div class="bott_right d-flex flex-column justify-content-between">
      <div class="sellcost_best_table">
        <div class="d-flex justify-content-between">
          <h3>판매 금액 BEST 강좌</h3>
          <p class="month">11월 현황</p>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">순위</div>
          <div class="p-2 col-5 sst">강좌 명</div>
          <div class="p-2 col-2 sst">강사 명</div>
          <div class="p-2 col-3 sst">판매 금액</div>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">매출 1위</div>
          <div class="p-2 col-5 text-truncate">[HTML]홈페이지 기본 메뉴부터 투명한 메뉴, 방향전환까지 완벽 마스터</div>
          <div class="p-2 col-2">김동주</div>
          <div class="p-2 col-3">812,345 <span>원</span></div>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">매출 2위</div>
          <div class="p-2 col-5 text-truncate">입문자도 실무에서 바로 써먹는 PHP 기초부터 시니어까지</div>
          <div class="p-2 col-2">김동주</div>
          <div class="p-2 col-3">712,345<span>원</span></div>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">매출 3위</div>
          <div class="p-2 col-5 text-truncate">REACT 커리어를 갈아끼워드립니다</div>
          <div class="p-2 col-2">김동주</div>
          <div class="p-2 col-3">612,345<span>원</span></div>
        </div>
      </div>
      <div class="d-flex justify-content-between">
        <div>
          <div class="d-flex justify-content-between">
            <h3>신규 가입자 현황</h3>
            <p class="month">11월 현황</p>
          </div>
          <p>5,412<span class="top_text"> 명</span></p>
          <canvas id="current_six_news" width="400" height="250"></canvas>
        </div>
        <div>
          <div class="d-flex justify-content-between">
            <h3>카테고리별 매출 금액</h3>
            <p class="month">11월 현황</p>
          </div>
          <p>7,123,000<span class="top_text"> 원</span></p>
          <canvas id="cate_one_return" width="250" height="250"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>
<script>


const lineCtx = document.getElementById('current_six_news').getContext('2d');
    const lineChart = new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: ['6월', '7월', '8월', '9월', '10월', '11월'],
        datasets: [{
          label: '신규 가입자 수',
          data: [2000, 2800, 3200, 3800, 4000, 3765],
          borderColor: '#D25353',
          backgroundColor: '#c93333',
          borderWidth: 1,
          fill: false,
          pointRadius: 3
        }, {
          label: '방문자',
          data: <?=$latestCounts?>,
          borderColor: '#7987FF',
          backgroundColor: '#5e62f1',
          borderWidth: 1,
          fill: false,
          pointRadius: 3
        }],
      },
        options: {
          scales: {
            x: {
              beginAtZero: true
            },
            y: {
              beginAtZero: true
            }
          }
        }
      })


</script>
<?php
$host = $_SERVER['HTTP_HOST'];


include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>