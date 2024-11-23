document.addEventListener("DOMContentLoaded", function () {

    const barCtx = document.getElementById('current_six_returns');
    const cateDatas = [250, 390, 580, 610, 692, 712]
    let now = new Date();
    let month = now.getMonth() + 1;
    let labels = []
  
    for (let i = 5; i >= 0; i--){
      let calMonth = month - i;
      if (calMonth <= 0){
        calMonth += 12;
      }
      labels.push(`${calMonth}월`);
    }
    //console.log(labels); array 0:6월 1:7월, 2:8월 ....
  
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

