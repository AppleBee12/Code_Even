document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const targetId = this.getAttribute('href').slice(1); // Get ID from href
    const targetElement = document.getElementById(targetId);

    if (targetElement) {
      // Smooth scroll to the target element
      targetElement.scrollIntoView({ behavior: 'smooth', block: 'center' });

      // Add the highlight class
      targetElement.classList.add('highlighted');

      // Remove the highlight class after 1 second
      setTimeout(() => {
        targetElement.classList.remove('highlighted');
      }, 3000);
    }
  });
});