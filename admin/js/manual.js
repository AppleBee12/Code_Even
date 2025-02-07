document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      //a의 href 기본설정위치로 스크롤되는 것을 방지
      e.preventDefault();
      const targetId = this.getAttribute('href').slice(1); // Get ID from href
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        //스크롤 위치를 타겟을 화면의 정중앙에 오도록 설정
        targetElement.scrollIntoView({block: 'center'});

        // 클래스 highlight 추가
        targetElement.classList.add('highlighted');

        // 애니메이션 종료 후 클래스 highlight 제거 (이벤트는 한번만 실행토록 설정)
        targetElement.addEventListener('animationend', () => {
          targetElement.classList.remove('highlighted');
        }, { once: true });
      }
    });
  });
});