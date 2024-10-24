document.getElementById('sidebarCollapse').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    // Toggle class 'active' untuk sidebar dan konten
    sidebar.classList.toggle('active');
    content.classList.toggle('active');

    // Jika sidebar aktif, periksa jika dalam mode mobile dan ubah konten untuk menyesuaikan
    if (window.innerWidth <= 768) {
        if (sidebar.classList.contains('active')) {
            content.style.marginLeft = "0"; // Konten penuh di layar mobile saat sidebar aktif
        } else {
            content.style.marginLeft = "10%"; // Konten bergeser di layar mobile saat sidebar tertutup
        }
    }
});

// Event listener untuk mendeteksi perubahan ukuran jendela
window.addEventListener('resize', function () {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (window.innerWidth > 768 && !sidebar.classList.contains('active')) {
        content.style.marginLeft = "calc(100% - 50px)"; // Kembali ke tampilan desktop saat diperbesar
    } else if (window.innerWidth <= 768 && sidebar.classList.contains('active')) {
        content.style.marginLeft = "0"; // Menyesuaikan konten saat sidebar aktif di mobile
    } else {
        content.style.marginLeft = "0"; // Konten penuh saat sidebar tertutup di mobile
    }
});


