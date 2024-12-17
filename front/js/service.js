const tabItems = document.querySelectorAll('.faq_tab .cate');
const faqLists = document.querySelectorAll('.faq_content .list-group');
const accordionItems = document.querySelectorAll('.accordion-item');

// 탭 메뉴 클릭 이벤트
tabItems.forEach((tab) => {
  tab.addEventListener('click', function () {
    const selectedCategory = this.getAttribute('data-tab');

    // 모든 탭 비활성화
    tabItems.forEach((item) => item.classList.remove('active'));
    this.classList.add('active'); // 선택된 탭 활성화

    // 모든 FAQ 리스트 숨기기
    faqLists.forEach((list) => {
      if (list.getAttribute('data-category') === selectedCategory) {
        list.classList.add('active');
      } else {
        list.classList.remove('active');
      }
    });
  });
});