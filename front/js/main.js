/* modal창*/ 


  $(document).ready(function() {
    const cookieName = 'hideCookieModal'; // 쿠키 이름
  const cookieValue = 'true'; // 쿠키 값
  const cookieExpireDays = 1; // 쿠키 유지 기간 (1일)

  // 쿠키 확인 함수
  function getCookie(name) {
      const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
  return null;
    }

  // 쿠키 설정 함수
  function setCookie(name, value, days) {
      const date = new Date();
  date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
  document.cookie = `${name}=${value}; expires=${date.toUTCString()}; path=/`;
    }

  // "오늘 하루 안 보기" 클릭 이벤트
  $('#cookieCloseBtn').on('click', function() {
      if ($('#check').is(':checked')) {
    // 체크박스가 체크된 경우 쿠키 설정
    setCookie(cookieName, cookieValue, cookieExpireDays);
      }
  // 모달 닫기
  $('#cookieModal').fadeOut();
    });

  // 페이지 로드 시 쿠키 확인
  if (!getCookie(cookieName)) {
    $('#cookieModal').fadeIn(); // 쿠키가 없으면 모달 표시
    }
  });



/* sec01 시작 */
const progressCircle = document.querySelector(".autoplay-progress svg");
const progressContent = document.querySelector(".autoplay-progress span");
let swiper = new Swiper('.sec01_swiper', {
  loop: true,
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false
  },

  pagination: {
    el: '.swiper-pagination',
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  on: {
    autoplayTimeLeft(s, time, progress) {
      progressCircle.style.setProperty("--progress", 1 - progress);
      progressContent.textContent = `${Math.ceil(time / 800)}s`;
    }
  }

});


/* sec01 끝 */
/* sec02 시작 */


/* sec02 끝 */
/* sec03 시작 */


/* sec03 끝 */
/* sec04 시작 */


/* sec04 끝 */
/* sec05 시작 */


/* sec05 끝 */
/* sec06 시작 */


/* sec06 끝 */
/* sec07 시작 */


/* sec07 끝 */
/* sec08 시작 */


/* sec08 끝 */
