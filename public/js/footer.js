// Social Media Icons Hover Effect
const socialIcons = document.querySelectorAll('.social-icons i');
socialIcons.forEach(icon => {
    icon.addEventListener('mouseenter', () => {
        icon.style.transform = 'scale(1.2)';
    });
    
    icon.addEventListener('mouseleave', () => {
        icon.style.transform = 'scale(1)';
    });
});

// Footer Links Click Animation
const footerLinks = document.querySelectorAll('.footer-section a');
footerLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        // Add ripple effect
        const ripple = document.createElement('span');
        ripple.classList.add('ripple');
        link.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 1000);
    });
});

// Dynamic Copyright Year
const copyrightYear = document.querySelector('.footer-bottom p');
if (copyrightYear) {
    copyrightYear.innerHTML = `&copy; ${new Date().getFullYear()} Fashion Store. All rights reserved.`;
}