const skybt_button = document.getElementById('toTop');

// Show button when user scrolls down a bit
window.addEventListener('scroll', () => {
    skybt_button.style.display = (window.scrollY > 300) ? 'block' : 'none';
});

// Smooth scroll to top when clicked
skybt_button.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});