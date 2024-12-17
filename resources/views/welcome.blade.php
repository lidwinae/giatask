<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>GiaTask</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/startingpage.css') }}">
    <link rel="icon" href="{{ asset('images/icon2.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body style="background-color: white;">
    <nav class="navbar">
    <div class="container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <ul class="navbar-nav">
            <li><a href="#about-us">About Us</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <li><a href="#support">Support</a></li>
        </ul>
        <div class="navbar-actions">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-Masuk"><b>Home</b></a>
                @else
                    <a href="{{ route('login') }}" class="btn-Masuk"><b>Login/Daftar</b></a>
                @endauth
            @endif
        </div>
    </div>
</nav>

    <!-- Section 1: About Us -->
    <section id="about-us" style="padding: 0; background-color: #fff; text-align: center;">
        <div class="container-about-us">
            <!-- Elemen Welcome (Kolom Kiri-Kanan) -->
            <div class="welcome">
                <div class="welcome-text">
                    <span>#1 Kelola Aktivitas Anda</span>
                    <h1>Selamat Datang <br> di Web GiaTask</h1>
                    <p>Kendalikan Waktu, Wujudkan target</p>
                </div>
                <div class="welcome-image">
                    <img src="{{ asset('images/buku.png') }}" alt="Gambar Buku">
                </div>
            </div>
    
            <!-- Elemen Background (Teks Selamat Datang) -->
            <div class="background">
                <div class="Fitur">
                    <h1> Berbagi Fitur Produk</h1>
                    <p> Semua yang Anda butuhkan untuk membantu meningkatkan produktivitas, mengelola waktu <br> dengan lebih efisien, memastikan setiap tugas terorganisir. Jadikan produktivitas Anda lebih optimal.</p>
                    <br>
                </div>
    
                <div class="kotak">
                    <!-- Kotak 1 -->
                    <div class="kotak-item">
                        <img src="{{ asset('images/icon1.png') }}" alt="Icon 1" class="kotak-icon">
                        <h3><strong>Kolaborasi Tanpa Batas</strong></h3>
                        <p>Nikmati manajemen tugas yang jelas untuk memastikan setiap langkah berjalan mulus.</p>
                    </div>
                    <!-- Kotak 2 -->
                    <div class="kotak-item">
                        <img src="{{ asset('images/icon2.png') }}" alt="Icon 2" class="kotak-icon">
                        <h3><strong>Solusi Lengkap </strong></h3>
                        <p>Kelola semuanya, dalam satu platform intuitif yang dirancang untuk tingkatkan produktivitas.</p>
                    </div>
                    <!-- Kotak 3 -->
                    <div class="kotak-item">
                        <img src="{{ asset('images/icon3.png') }}" alt="Icon 3" class="kotak-icon">
                        <h3><strong>Alur Kerja yang Mudah</strong></h3>
                        <p>Kelola semua tugas dalam satu platform intuitif yang dirancang dengan cara yang paling sesuai</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Section 2: Products -->
    <section id="products" style="padding: 50px; background-color: #fff; text-align: center;">
        <div class="container-products">
            <h1>Nantikan Peningkatan Terbaru untuk <br> Meningkatkan Produktivitas Anda</h1>
            <p>
                GiaTask berkembang untuk memberikan pengalaman terbaik dalam pengelolaan proyek dan waktu. <br>
                Berikut adalah sekilas fitur yang disediakan dalam GiaTask:
            </p>
            <div class="fitur-items">
                <span class="fitur-item">Jadwal Harian</span>
                <span class="fitur-item">Pengelolaan Tugas Berulang</span>
                <span class="fitur-item">Notifikasi Pintar</span>
                <span class="fitur-item">Kalender Pribadi</span>
                <span class="fitur-item">Progres Aktivitas Pribadi</span>
                <span class="fitur-item">Mode Offline</span>
                <span class="fitur-item">Riwayat Aktivitas</span>
                <span class="fitur-item">Judul Project</span>
                <span class="fitur-item">Target untuk Kegiatan Pribadi</span>
            </div>
        </div>
    </section>
    

    <!-- Section 3: Contact -->
    <section id="contact" style="padding: 50px; 
    background: linear-gradient(to bottom, #ffffff, #78A8F0); text-align: center;">
        <div class="container-contact">
            <div class="faq-container">
                <!-- FAQ Title -->
                <div class="faq-title">
                    <h1>Frequently Asked Questions</h1>
                    <p>Pertanyaan Lainnya? <a href="#contact" style="text-decoration: underline; color: #007bff;">Contact Us</a></p>
                </div>
                    <!-- FAQ List -->
                    <div class="faq-list">
                        <div class="accordion">
                            <div class="accordion-header">
                            <b>Apa itu GiaTask?</b> <span class="icon">+</span>
                            </div>
                            <div class="accordion-content">
                            <p>Aplikasi untuk manajemen tugas dan waktu. GiaTask hadir sebagai solusi untuk membantu berbagai lapisan masyarakat dalam mengingat, mencatat, serta mengorganisir tugas berjangka pengguna.</p>
                        </div>
                    </div>

                    <div class="faq-list">
                        <div class="accordion">
                            <div class="accordion-header">
                            <b>Apa fitur utama GiaTask?</b> <span class="icon">+</span>
                            </div>
                            <div class="accordion-content">
                            <p>Tambah tugas, lihat daftar tugas, tandai tugas selesai, edit tugas, hapus tugas, pengingat.</p>
                        </div>
                    </div>

                    <script>
                    // Seleksi semua elemen header accordion
                    const accordionHeaders = document.querySelectorAll('.accordion-header');

                    accordionHeaders.forEach(header => {
                        header.addEventListener('click', () => {
                        // Toggle class "open" pada header yang diklik
                        header.classList.toggle('open');

                        // Toggle display konten terkait
                        const content = header.nextElementSibling;
                        if (content.style.display === 'block') {
                            content.style.display = 'none';
                        } else {
                            content.style.display = 'block';
                        }
                        });
                    });
                    </script>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Section 4: Contact -->
    <footer class="support">
        <div class="container">
            <!-- Logo dan Kontak -->
            <div class="support-column">
                <img
                    src="{{ asset('images/logobiru.png') }}"
                    alt="logo"
                    width="200"
                />
                <p style="padding-left: 30px;" class="contact-title">Contact Us:</p>
                <p style="padding-left: 30px;" class="contact-info">085 339 456 828</p>
            </div>

            <!-- Informasi Perusahaan -->
            <div class="support-column">
                <h3 class="column-title">Company</h3>
                <ul>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#products">Produk</a></li>
                    <li><a href="#support">Dukungan</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </div>

            <!-- Navigasi Cepat -->
            <div class="support-column">
                <h3 class="column-title">Navigasi Cepat</h3>
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="#contact">Hubungi Kami</a></li>
                    <li><a href="#privacy">Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p><b>&copy; 2024 GiaTask. All Rights Reserved.</b></p>
        </div>
    </footer>
</body>
</html>