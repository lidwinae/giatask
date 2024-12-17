<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-size: 27px; margin-left: 30px;">
            {{ __('GiaTaskMail') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                        </p><br>
                    @endif
                    @if (session('error'))
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 3000)"
                            style="background-color:rgb(237, 212, 212); color:rgb(87, 21, 21);
                            padding: 10px; border: 1px solidrgb(230, 195, 195); border-radius: 5px;
                            margin-bottom: 5px; margin-right: 20px;"
                        >
                            {{ session('error') }}
                        </p><br>
                    @endif
                    {{ __("Kirim informasi tugas Anda ke email") }}
                    <br><br>
                    <form action="{{ route('kirim.pesan') }}" method="POST">
                        @csrf
                        <!-- To -->
                        <div class="flex items-center space-x-4">
                            <label for="to" class="block font-medium text-sm text-gray-700" style="width: 35%; text-align: left;">Email Tujuan</label>
                            <input id="to" name="to" type="email" class="mt-1 block w-full rounded-sm" required />
                            @error('to')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <button type="button" onclick="fillEmail()"
                            style="background-color: #3F8CDF; color: white; border: none; width: 15%;
                            margin-left: 1%; border-radius: 8px; font-size: 15px; padding: 8px 8px">Email Saya</button>
                        </div>
                        <br>
                        <!-- Subject -->
                        <div class="flex items-center space-x-4">
                            <label for="subject" class="block font-medium text-sm text-gray-700" style="width: 30%; text-align: left;">Subject / Judul Email Anda</label>
                            <input id="subject" name="subject" type="text" class="mt-1 block w-full rounded-sm" required />
                            @error('subject')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <!-- Pesan -->
                        <div class="flex items-center space-x-4">
                            <label for="message" class="block font-medium text-sm text-gray-700" style="width: 30%; text-align: left;">Pesan</label>
                            <textarea id="message" name="message" rows="11" class="mt-1 block w-full rounded-sm"
                            placeholder="Tulis pesan Anda di sini..." required></textarea>
                            @error('message')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <!-- Tambahkan info tugas pada pesan -->
                        <div class="flex justify-between items-center">
                        <div class="flex items-center" style="width: 50%;">
                        <label for="tugas" class="block font-medium text-sm text-gray-700"
                        style="width: 40%; margin-right: 6%; text-align: left; font-size: 16px;">
                        Pilih dan tambahkan info tugas ke pesan Anda:</label>
                        <select id="tugas" name="tugas_id" style="width: 50%;">
                            <option value=""></option>
                            @foreach ($tugasList as $tugas)
                                <option value="{{ $tugas->id_tugas }}"
                                data-nomor="{{ $tugas->nomor }}"
                                data-judul="{{ $tugas->judul }}"
                                data-deskripsi="{{ $tugas->deskripsi }}"
                                data-prioritas="{{ $tugas->prioritas }}"
                                data-status="{{ $tugas->status }}"
                                data-tenggat="{{ $tugas->tanggal_tenggat }}"
                                data-kategori="{{ $tugas->nama_kategori }}">
                                {{ $tugas->nomor }}. {{ $tugas->judul }}</option>
                            @endforeach
                        </select>
                        <!-- Button Kirim Email -->
                        </div>
                            <button type="submit" style="background-color: #3F8CDF; color: white; border: none; width: 14%;
                            margin-left: 1%; border-radius: 8px; font-size: 20px; padding: 8px 4px"><b>Kirim Email</b></button>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fillEmail() {
            // Mengambil input email dan mengisi dengan email pengguna
            document.getElementById('to').value = "{{ Auth::user()->email }}";
        }
    </script>
    <script>
    // Event listener untuk dropdown
    document.getElementById('tugas').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];

        var nomor = selectedOption.getAttribute('data-nomor');
        var judul = selectedOption.getAttribute('data-judul');
        var deskripsi = selectedOption.getAttribute('data-deskripsi');
        var prioritas = selectedOption.getAttribute('data-prioritas');
        var status = selectedOption.getAttribute('data-status');
        var tenggat = selectedOption.getAttribute('data-tenggat');
        var kategori = selectedOption.getAttribute('data-kategori');

        var sembunyi = "--Tugas GiaTask--\n"
            + "Nomor: " + nomor + "\n"
            + "Judul: " + judul + "\n"
            + "Deskripsi: " + deskripsi + "\n"
            + "Prioritas: " + prioritas + "\n"
            + "Status: " + status + "\n"
            + "Tanggal Tenggat: " + tenggat + "\n"
            + "Kategori: " + kategori + "\n"
            + "\nPesan Anda: \n";
        
        document.getElementById('message').value = sembunyi;
    });
</script>
</x-app-layout>