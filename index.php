<?php
$chart_js = "<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

if(!isset($_SESSION['AUID'])){
  echo"<script>
  alert('로그인을 해주세요');
  location.href='admin/login/login.php';
  </script>";
}
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
  <div>
    <canvas id="current_six_returns" width="648" height="632"></canvas>
  </div>
 </div>
  
</div>

<script>
  const ctx = document.getElementById('current_six_returns');
  const cateDatas = [250, 390, 580, 610, 910, 783]

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['6월', '7월', '8월', '9월', '10월', '11월'],
      datasets: [{
        label: '(만원)',
        data: cateDatas,
        borderColor: '#D25353',
        borderWidth: 200,
        options: {
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
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>