<x-app-layout>
    <x-slot name="header">
        @push('kepala')
        <style>
        .overlay {
            display: none; 
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 1000;
        }
        .sidebar-modal {
            position: fixed;
            top: 0;
            right: -100%; 
            width: 300px;
            height: 100%;
            background-color: white;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.3);
            transition: right 0.3s ease; 
            z-index: 1001;
            padding: 20px;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 50px;
            cursor: pointer;
        }
        .open-btn {
            color: black;
            background-color: white; /* Tambahkan background agar terlihat lebih jelas */
            border: 1px solidrgb(255, 255, 255); /* Garis border opsional */
            cursor: pointer;
            border-radius: 5px;
            padding: 10px 20px; /* Padding untuk ukuran button */
            transition: all 0.3s ease; /* Transisi agar efek smooth */
        }

        .open-btn:hover {
            background-color:rgb(226, 240, 255); /* Warna background saat hover */
            color: black; /* Warna teks saat hover */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Efek bayangan untuk menambahkan dimensi */
            transform: scale(1.05); /* Sedikit perbesar button saat dihover */
        }
	    .sidebar a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .sidebar a:hover {
            background-color: rgb(222, 240, 255);
        }
        .sidebar a.active {
            background-color: rgb(160, 212, 255); /* Warna aktif lebih gelap */
            font-size: 18px; /* Membesarkan ukuran font saat aktif */
            font-weight: bold;
        }
    </style>

        @endpush

        <div class="flex items-center justify-between">
            <div class="flex item-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-size: 32px; margin-left:20px; margin-right: 20px;">
                <b>{{ __('List Tugas') }}</b>
            </h2>
            <!-- Berlangsung -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('berlangsung')" :active="request()->routeIs('berlangsung')" style="color: black; font-size: 15px;"
                    class="text-black text-lg pb-3 border-b-2 hover:border-black"
                    style="font-family: 'Poppins', sans-serif; text-transform: uppercase; font-weight: normal;">
                    {{ __('Berlangsung') }}
                    </x-nav-link>
            </div>
            <!-- Terlewat -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('terlewat')" :active="request()->routeIs('terlewat')" style="color: black; font-size: 15px;"
                    class="text-black text-lg pb-3 border-b-2 hover:border-black"
                    style="font-family: 'Poppins', sans-serif; text-transform: uppercase; font-weight: normal;">
                    {{ __('Terlewat') }}
                    </x-nav-link>
            </div>
            <!-- Selesai -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('selesai')" :active="request()->routeIs('selesai')" style="color: black; font-size: 15px;"
                    class="text-black text-lg pb-3 border-b-2 hover:border-black"
                    style="font-family: 'Poppins', sans-serif; text-transform: uppercase; font-weight: normal;">
                    {{ __('Selesai') }}
                    </x-nav-link>
            </div>
            </div>
            <div style="margin-right: 20px;">
            <button id="openSidebar" class="open-btn"><i class="fas fa-angle-double-left" style="margin-right: 10px;"></i><b>Filter / Urutkan</b></button>
            </div>
        </div>
    </x-slot>

    <div id="overlay" class="overlay"></div>

    <!-- Sidebar yang seperti modal -->
    <div id="sidebarModal" class="sidebar-modal">
        <span class="close-btn" id="closeSidebar">&times;</span>
        <img src="{{ asset('images/logobiru.png') }}" alt="logo"width="150"/>
        <br><p style="margin-left: 10px; font-size: 20px;"><b>Filter / Urutkan</b></p>
        <p style="margin-left: 10px">tugas belum selesai:</p><br>
        <div class="sidebar">
            <a href="{{ route('prio') }}" class="{{ Route::currentRouteName() == 'prio' ? 'active' : '' }}">Prioritas Tinggi ke Rendah</a>
            <a href="{{ route('nomor') }}" class="{{ Route::currentRouteName() == 'nomor' ? 'active' : '' }}">Nomor</a>
            <a href="{{ route('judul') }}" class="{{ Route::currentRouteName() == 'judul' ? 'active' : '' }}">Judul</a>
            <a href="{{ route('desk') }}" class="{{ Route::currentRouteName() == 'desk' ? 'active' : '' }}">Deskripsi</a>
            <a href="{{ route('kate') }}" class="{{ Route::currentRouteName() == 'kate' ? 'active' : '' }}">Kategori</a>
        </div>
    </div>

    <!-- Lidwina Eleonora Dora / 235150707111019 -->

    @yield('content')

    <script>
        // Menangani ketika tombol Edit diklik
        const modal = document.getElementById('exampleModal');
        modal.addEventListener('show.bs.modal', function (event) {
        // Ambil tombol yang memicu modal
        const button = event.relatedTarget;
        
        // Ambil data dari tombol
        const idTugas = button.getAttribute('data-id');
        const nomor = button.getAttribute('data-nomor');
        const judul = button.getAttribute('data-judul');
        const deskripsi = button.getAttribute('data-deskripsi');
        const prioritas = button.getAttribute('data-prioritas');
        const status = button.getAttribute('data-status');
        const tanggalTenggat = button.getAttribute('data-tanggal_tenggat');
        const kategoriTugas = button.getAttribute('data-kategori_tugas');

        // Masukkan data ke dalam modal
        const modalTitle = modal.querySelector('.modal-title');
        const form = modal.querySelector('form');
        form.action = '/lidwina/' + idTugas;  // Update URL dengan ID tugas

        modal.querySelector('#nomor').value = nomor;
        modal.querySelector('#judul').value = judul;
        modal.querySelector('#deskripsi').value = deskripsi;
        modal.querySelector('#prioritas').value = prioritas;
        modal.querySelector('#status').value = status;
        modal.querySelector('#tanggal_tenggat').value = tanggalTenggat;
        modal.querySelector('#kategori_tugas').value = kategoriTugas;
        });
    </script>

<script>
    // Ambil elemen
    const openSidebarBtn = document.getElementById('openSidebar');
    const closeSidebarBtn = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');
    const sidebarModal = document.getElementById('sidebarModal');
    const sidebarLinks = document.querySelectorAll('.sidebar a');

    // Fungsi untuk membuka sidebar
    function openSidebar() {
        overlay.style.display = 'block';
        sidebarModal.style.right = '0';
        localStorage.setItem('sidebarOpen', 'true'); // Simpan status ke localStorage
    }

    // Fungsi untuk menutup sidebar
    function closeSidebar() {
        overlay.style.display = 'none';
        sidebarModal.style.right = '-100%';
        localStorage.setItem('sidebarOpen', 'false'); // Simpan status ke localStorage
    }

    // Tambahkan event listener untuk membuka dan menutup sidebar
    if (openSidebarBtn) {
        openSidebarBtn.addEventListener('click', openSidebar);
    }
    if (closeSidebarBtn) {
        closeSidebarBtn.addEventListener('click', closeSidebar);
    }
    overlay.addEventListener('click', closeSidebar);

    // Cek status sidebar dari localStorage saat halaman dimuat
    window.addEventListener('DOMContentLoaded', () => {
        const isSidebarOpen = localStorage.getItem('sidebarOpen') === 'true';
        if (isSidebarOpen) {
            openSidebar();
        }

        // Aktifkan link yang sesuai dengan halaman yang sedang dikunjungi
        const currentPage = window.location.href; // Ambil URL saat ini
        sidebarLinks.forEach(link => {
            if (link.href === currentPage) {
                link.classList.add('active'); // Tambahkan class 'active' pada link yang relevan
            } else {
                link.classList.remove('active'); // Hapus class 'active' dari link lainnya
            }
        });
    });

    // Tambahkan logika untuk active link
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            sidebarLinks.forEach(link => link.classList.remove('active')); // Hapus class active dari semua link
            link.classList.add('active'); // Tambahkan class active ke link yang diklik
            localStorage.setItem('activeLink', link.href); // Simpan link aktif ke localStorage
        });
    });
</script>


    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>