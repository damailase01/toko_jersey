// header.js
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.header');
    const mobileToggle = document.querySelector('.mobile-toggle');
    const navMenu = document.querySelector('.nav-menu');
    let lastScroll = 0;

    // Scroll Effect
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    });

    // Mobile Menu Toggle
    mobileToggle.addEventListener('click', () => {
        mobileToggle.classList.toggle('active');
        navMenu.classList.toggle('active');
        
        const spans = mobileToggle.querySelectorAll('span');
        if (mobileToggle.classList.contains('active')) {
            spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
            spans[1].style.opacity = '0';
            spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
        } else {
            spans[0].style.transform = 'none';
            spans[1].style.opacity = '1';
            spans[2].style.transform = 'none';
        }
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
            navMenu.classList.remove('active');
            mobileToggle.classList.remove('active');
            const spans = mobileToggle.querySelectorAll('span');
            spans.forEach(span => {
                span.style.transform = 'none';
                span.style.opacity = '1';
            });
        }
    });

    // Search input animation
    const searchInput = document.querySelector('.search input');
    if (searchInput) {
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.style.transform = 'translateY(-2px)';
        });

        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.style.transform = 'none';
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.querySelector(".mobile-toggle");
    const navMenu = document.querySelector(".nav-menu");

    toggleButton.addEventListener("click", () => {
        navMenu.classList.toggle("active");
    });

    // Opsional: Tutup menu saat salah satu item diklik
    navMenu.addEventListener("click", (event) => {
        if (event.target.tagName === "A") {
            navMenu.classList.remove("active");
        }
    });
});
