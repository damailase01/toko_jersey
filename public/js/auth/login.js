// auth.js - Combined JavaScript for login and register functionality
document.addEventListener('DOMContentLoaded', function() {
    // Password Toggle Functionality
    const setupPasswordToggles = () => {
        const toggles = document.querySelectorAll('.toggle-password');
        
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                // Toggle type between password and text
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                // Toggle icon
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    };

    // Form Validation
    const setupFormValidation = () => {
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = this.querySelector('input[name="email"]').value;
                const password = this.querySelector('input[name="password"]').value;
                
                let isValid = true;
                let errorMessage = '';

                // Email validation
                if (!isValidEmail(email)) {
                    isValid = false;
                    errorMessage += 'Please enter a valid email address\n';
                }

                // Password validation
                if (password.length < 6) {
                    isValid = false;
                    errorMessage += 'Password must be at least 6 characters long\n';
                }

                if (isValid) {
                    this.submit();
                } else {
                    showError(errorMessage);
                }
            });
        }

        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const firstName = this.querySelector('input[name="first_name"]').value;
                const lastName = this.querySelector('input[name="last_name"]').value;
                const email = this.querySelector('input[name="email"]').value;
                const phone = this.querySelector('input[name="phone"]').value;
                const password = this.querySelector('input[name="password"]').value;
                const confirmPassword = this.querySelector('input[name="password_confirmation"]').value;
                const terms = this.querySelector('input[name="terms"]').checked;

                let isValid = true;
                let errorMessage = '';

                // Name validation
                if (firstName.length < 2 || lastName.length < 2) {
                    isValid = false;
                    errorMessage += 'First and last name must be at least 2 characters long\n';
                }

                // Email validation
                if (!isValidEmail(email)) {
                    isValid = false;
                    errorMessage += 'Please enter a valid email address\n';
                }

                // Phone validation
                if (!isValidPhone(phone)) {
                    isValid = false;
                    errorMessage += 'Please enter a valid phone number\n';
                }

                // Password validation
                if (password.length < 6) {
                    isValid = false;
                    errorMessage += 'Password must be at least 6 characters long\n';
                }

                if (password !== confirmPassword) {
                    isValid = false;
                    errorMessage += 'Passwords do not match\n';
                }

                // Terms validation
                if (!terms) {
                    isValid = false;
                    errorMessage += 'You must agree to the Terms & Conditions\n';
                }

                if (isValid) {
                    this.submit();
                } else {
                    showError(errorMessage);
                }
            });
        }
    };

    // Input Animation
    const setupInputAnimations = () => {
        const inputs = document.querySelectorAll('.input-field input');
        
        inputs.forEach(input => {
            // Add focus effect
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            // Remove focus effect if input is empty
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });

            // Initialize with 'focused' class if input has value
            if (input.value) {
                input.parentElement.classList.add('focused');
            }
        });
    };

    // Social Login Buttons
    const setupSocialButtons = () => {
        const googleBtn = document.querySelector('.social-button.google');
        const facebookBtn = document.querySelector('.social-button.facebook');

        if (googleBtn) {
            googleBtn.addEventListener('click', function() {
                // Add Google login functionality here
                console.log('Google login clicked');
            });
        }

        if (facebookBtn) {
            facebookBtn.addEventListener('click', function() {
                // Add Facebook login functionality here
                console.log('Facebook login clicked');
            });
        }
    };

    // Utility Functions
    const isValidEmail = (email) => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    };

    const isValidPhone = (phone) => {
        const phoneRegex = /^[\d\s+-]{10,}$/;
        return phoneRegex.test(phone);
    };

    const showError = (message) => {
        // You can customize this to show errors in your preferred way
        alert(message);
    };

    // Form Reset Handler
    const setupFormReset = () => {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('reset', function() {
                setTimeout(() => {
                    const inputs = this.querySelectorAll('input');
                    inputs.forEach(input => {
                        input.parentElement.classList.remove('focused');
                    });
                }, 0);
            });
        });
    };

    // Initialize all functionality
    const init = () => {
        setupPasswordToggles();
        setupFormValidation();
        setupInputAnimations();
        setupSocialButtons();
        setupFormReset();
    };

    // Run initialization
    init();
});