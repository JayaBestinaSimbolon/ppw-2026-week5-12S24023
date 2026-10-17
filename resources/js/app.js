// SIPUS-Del — JavaScript
document.addEventListener('DOMContentLoaded', () => {
    // Mobile navbar toggle
    const toggle = document.getElementById('navToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    if (toggle && mobileMenu) {
        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            mobileMenu.classList.toggle('open');
        });

        // Close menu on outside click
        document.addEventListener('click', (e) => {
            if (!toggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('open');
            }
        });
    }

    // Auto-dismiss flash alerts after 5 seconds
    const alerts = document.querySelectorAll('.sipus-alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 400);
        }, 5000);
    });

    // Otomatis sinkronisasi form tambah/edit buku:
    // Buku Pelajaran -> Lantai 1, Skripsi -> Lantai 2
    const jenisKoleksiSelect = document.getElementById('jenis_koleksi');
    const lantaiSelect = document.getElementById('lantai');
    const lantaiNotice = document.getElementById('lantai_notice');

    if (jenisKoleksiSelect && lantaiSelect) {
        jenisKoleksiSelect.addEventListener('change', () => {
            const val = jenisKoleksiSelect.value;
            if (val === 'Buku Pelajaran') {
                lantaiSelect.value = '1';
                if (lantaiNotice) lantaiNotice.textContent = 'Aturan: Buku Pelajaran otomatis ditempatkan di Lantai 1.';
            } else if (val === 'Skripsi') {
                lantaiSelect.value = '2';
                if (lantaiNotice) lantaiNotice.textContent = 'Aturan: Koleksi Skripsi otomatis ditempatkan di Lantai 2.';
            }
        });
    }
});
