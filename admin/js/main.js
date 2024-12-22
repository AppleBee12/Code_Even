document.addEventListener("DOMContentLoaded", function () {

  // main index 차트
  // 최근 6개월 수익률
  const chartData = document.getElementById('chartData');
  const latestMonthNames = JSON.parse(chartData.dataset.monthNames);
  const latestCounts = JSON.parse(chartData.dataset.counts);

  // console.log(latestMonthNames);
  // console.log(latestCounts);

    const barCtx = document.getElementById('current_six_returns');
    const cateDatas = [250, 390, 580, 610, 692, 712]
    let labels = latestMonthNames
  
    //console.log(labels); //array 0:6월 1:7월, 2:8월 ....
  

    const barchart = new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: '(만원)',
          data: cateDatas,
          borderColor: '#D25353',
          backgroundColor: '#c93333',
          borderWidth: 1,
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

  console.log(latestCounts)
  // 신규가입자 현황
    const lineCtx = document.getElementById('current_six_news').getContext('2d');
    const lineChart = new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: '신규 가입자 수',
          data: [2000, 2800, 3200, 3800, 4000, 3265],
          borderColor: '#D25353',
          backgroundColor: '#c93333',
          borderWidth: 1,
          fill: false,
          pointRadius: 3
        }, {
          label: '방문자',
          data: latestCounts,
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




  
  
    const doughnutCtx = document.getElementById('cate_one_return');
    const doughnutChart = new Chart(doughnutCtx, {
      type: 'doughnut',
      data: {
        labels: ['웹 개발', '클라우드DB', '보안 네트워크'],
        datasets: [{
          label: '카테고리',
          data: [3561500, 2493050, 1068450],
          borderColor: ['#D25353'],
          backgroundColor: ['#c93333', '#E76969', '#E8A9A9'],
          borderWidth: 1,
          fill: false,
          pointRadius: 3
        }],
        options: {
          scales: {
            x: {
              beginAtZero: true
            },
            y: {
              beginAtZero: true
            },
            title: {
              align: 'start'
            }
          }
        }
      }
    });
  
  });

