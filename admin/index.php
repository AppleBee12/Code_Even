<?php
$chart_js = "<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');
?>

<div class="container">
 <div class="top_wrapper d-flex justify-content-between">
    <div><h3>10월 수익</h3> <p>7,123,000<span class="top_text"> 원</span></p></div>
    <div><h3>직전달 대비 수익률</h3><p>3%</p></div>
    <div><h3>과정 개설 현황</h3><p><span class="top_text">대기 </span>12 <span class="top_text">/ 개설 </span>1,234</p></div>
    <div><h3>판매 강좌수</h3><p>1,234<span class="top_text"> 개</span></p></div>
    <div><h3>오늘 접속자 수</h3><p>53<span class="top_text"> 명</span></p></div>
 </div>
 <div class="bottom_wrapper d-flex justify-content-between">
  <div class="bott_left">
    <canvas id="current_six_returns" width="600" height="550"></canvas>
  </div>
  <div class="bott_right">
    <div class="sellcost_best_table">

    </div>
    <div>
    <canvas id="current_six_news" width="356" height="312"></canvas>
    <canvas id="current_six_news" width="356" height="312"></canvas>
    </div>
  </div>
 </div>
  
</div>

<script>
  const barchart = document.getElementById('current_six_returns');
  const cateDatas = [250, 390, 580, 610, 910, 783]

  new Chart(barchart, {
    type: 'bar',
    data: {
      labels: ['6월', '7월', '8월', '9월', '10월', '11월'],
      datasets: [{
        label: '(만원)',
        data: cateDatas,
        borderColor: '#D25353',
        backgroundColor: '#c93333',
        borderWidth: 1,
        options: {
         title: {
            display: true,
            text: '최근 6개월 수익률'
          },
        plugins: {
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    font: {
                      size: 12
                    }
                }
            }
        }
    }
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<script>
  const linechart = document.getElementById('current_six_news');
  const cateDatas_new = [2000,2800,3200,3800,4000,4765,5500];
  const cateDatas_visit = [8000,6700,6900,8500,9215,7265];
  const data = {
  labels: generateLabels(),
  datasets: [
    {
      label: 'Dataset',
      data: generateData(),
      borderColor: Utils.CHART_COLORS.red,
      backgroundColor: Utils.transparentize(Utils.CHART_COLORS.red),
      fill: false
    }
  ]
};

const config = {
  type: 'line',
  data: data,
  options: {
    plugins: {
      filler: {
        propagate: false,
      },
      title: {
        display: true,
        text: (ctx) => 'Fill: ' + ctx.chart.data.datasets[0].fill
      }
    },
    interaction: {
      intersect: false,
    }
  },
};

</script>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>