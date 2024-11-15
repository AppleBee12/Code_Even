document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('nav > ul > li').forEach(menu => {
      const link = menu.getAttribute('data-link');
      
      if (link === currentPage) {
          menu.classList.add('active');
          const dropdownMenu = menu.querySelector('.dropdown-menu');
          if (dropdownMenu) {
              dropdownMenu.classList.add('show');
          }
      }
  });
});