// customer-orders.js
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to clicked button and corresponding content
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Payment timer countdown
    function updateTimer() {
        const timerElements = document.querySelectorAll('.payment-timer');
        
        timerElements.forEach(timer => {
            let timeLeft = timer.getAttribute('data-time') || 24*60*60; // 24 hours in seconds
            
            if (timeLeft > 0) {
                timeLeft--;
                timer.setAttribute('data-time', timeLeft);
                
                const hours = Math.floor(timeLeft / 3600);
                const minutes = Math.floor((timeLeft % 3600) / 60);
                const seconds = timeLeft % 60;
                
                timer.textContent = `Sisa waktu pembayaran: ${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            } else {
                timer.textContent = 'Waktu pembayaran habis';
                timer.style.color = 'var(--danger-color)';
            }
        });
    }

    // Update timer every second
    setInterval(updateTimer, 1000);
    updateTimer(); // Initial update

    // Initialize order counts
    function updateOrderCounts() {
        const counts = {
            unpaid: document.querySelectorAll('#unpaid .order-card').length,
            pending: document.querySelectorAll('#pending .order-card').length,
            process: document.querySelectorAll('#process .order-card').length,
            success: document.querySelectorAll('#success .order-card').length
        };

        // Update count badges
        for (const [status, count] of Object.entries(counts)) {
            const badge = document.querySelector(`[data-tab="${status}"] .count`);
            if (badge) badge.textContent = count;

            // Show empty state if no orders
            const tabContent = document.getElementById(status);
            if (count === 0 && tabContent) {
                const emptyState = `
                    <div class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <h3>Tidak ada pesanan</h3>
                        <p>Anda belum memiliki pesanan dalam status ini</p>
                        <button class="btn btn-primary">Mulai Belanja</button>
                    </div>
                `;
                tabContent.innerHTML = emptyState;
            }
        }
    }

    // Initialize counts
    updateOrderCounts();
});