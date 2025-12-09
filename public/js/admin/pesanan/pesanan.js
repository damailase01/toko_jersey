// orders.js
document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua tombol tab dan konten tab
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    // Tambahkan event listener untuk setiap tombol tab
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Hapus kelas active dari semua tombol dan konten
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Tambahkan kelas active ke tombol yang diklik
            this.classList.add('active');

            // Tampilkan konten tab yang sesuai
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
});