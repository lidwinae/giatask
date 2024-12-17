<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="margin-left: 30px;">
            {{ __('Pengaturan') }}
        </h2>
        @if (session('success'))
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 3000)"
                style="background-color: #D4EDDA; color: #155724;
                padding: 10px; border: 1px solid #C3E6CB; border-radius: 5px;
                margin-bottom: 5px; margin-right: 20px;"
            >
                {{ session('success') }}
            </p>
        @endif
        @if (session('info'))
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 3000)"
                style="background-color:rgb(200, 200, 200); color:rgb(0, 0, 0);
                padding: 10px; border: 1px solid rgb(152, 152, 152); border-radius: 5px;
                margin-bottom: 5px; margin-right: 20px;"
            >
                {{ session('info') }}
            </p>
        @endif
    </div>
    </x-slot>

<div class="py-12">
<div class="container mx-auto" style="border-radius: 8px; padding: 20px;">
<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Lihat Daftar Kategori Anda
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        @yield('kategori')
      </div>
    </div>
  </div>
  <br>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Lihat Riwayat Email
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        @yield('email')
      </div>
    </div>
  </div>
  <br>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Lihat Riwayat Pencarian
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        @yield('pencarian')
      </div>
    </div>
  </div>
</div>
</div>
</div>

    <script>
        // Menangani ketika tombol Edit diklik
        const modal = document.getElementById('exampleModal');
        modal.addEventListener('show.bs.modal', function (event) {
        // Ambil tombol yang memicu modal
        const button = event.relatedTarget;
        
        // Ambil data dari tombol
        const id = button.getAttribute('data-id');
        const namaKategori = button.getAttribute('data-nama_kategori');

        // Masukkan data ke dalam modal
        const modalTitle = modal.querySelector('.modal-title');
        const form = modal.querySelector('form');
        form.action = '/wina/' + id;  // Update URL dengan ID tugas

        modal.querySelector('#nama_kategori').value = namaKategori;
        });
    </script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</x-app-layout>