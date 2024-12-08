document.addEventListener("DOMContentLoaded", function () {

  //오늘 날짜 중 달 데이터만 추출하기 .this-month에 넣어줌

  let now = new Date(); 
  let month = now.getMonth() + 1; // 월 데이터는 0부터 시작
  let formattedMonth = month + "월"; // 월 추가해서 문자열 전환시킴

  for (let el of document.querySelectorAll('.this-month')) {
   el.textContent = formattedMonth;
}


  // 평균 평점

const ratingStar = document.getElementById("rating_star");
const stars = ratingStar.querySelectorAll("li");

const updateStars = (rating) => {
  stars.forEach((star) => {
    const value = parseFloat(star.getAttribute("data-value"));
    const icon = star.querySelector("i");
    star.className = "";

    if (value <= Math.floor(rating)) {
      // 꽉 찬 별
      star.classList.add("full");
      icon.className = "bi bi-star-fill";
    } else if (value === Math.ceil(rating) && !Number.isInteger(rating)) {
      // 반만 찬 별
      star.classList.add("half");
      icon.className = "bi bi-star-half";
    } else {
      // 비어 있는 별
      star.classList.add("empty");
      icon.className = "bi bi-star";
    }
  });
};

const initialRating = parseFloat(ratingStar.getAttribute("data-rating"));
updateStars(initialRating);



    const barCtx = document.getElementById('current_six_returns');
    const cateDatas = [250, 390, 580, 610, 692, 712]
    let labels = []
  
    for (let i = 5; i >= 0; i--){
      let calMonth = month - i;
      if (calMonth <= 0){
        calMonth += 12;
      }
      labels.push(`${calMonth}월`);
    }
    console.log(labels);
  
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
        labels: labels,
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
          data: [8000, 6700, 6900, 8500, 9215, 7265],
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

