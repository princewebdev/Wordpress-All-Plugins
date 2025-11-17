document.addEventListener('DOMContentLoaded', () => {
    const skybt_button = document.getElementById('toTop');
    if (!skybt_button) return; // Stop if button not found

    // Set initial visibility
    skybt_button.style.display = (window.scrollY > 300) ? 'block' : 'none';

    // Show/hide on scroll
    window.addEventListener('scroll', () => {
        skybt_button.style.display = (window.scrollY > 300) ? 'block' : 'none';
    });

    // Smooth scroll to top
    skybt_button.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
