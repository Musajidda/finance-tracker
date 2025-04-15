



window.addEventListener('scroll', () => {
  document.querySelectorAll('.fade-in, .testimonial').forEach(section => {
    if (section.getBoundingClientRect().top < window.innerHeight - 100) {
      section.classList.add('show');
    }
  });
});
