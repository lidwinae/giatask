<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - GiaTask</title>
    <link rel="stylesheet" href="{{ asset('css/daftar.css') }}">
    <link rel="icon" href="{{ asset('images/icon2.png') }}" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="register-box">
                <div class="logo-placeholder">
                    <img src="{{ asset('images/logobiru.png') }}" alt="logo" width="150">
                </div>
                <h1>Daftar Akun</h1>
                <p>Daftarkan akun Anda sekarang</p>
                <br>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Email -->
                    <div class="input-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full"
                            type="email" placeholder="Masukkan email"
                            name="email" :value="old('email')"
                            required autocomplete="off" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Nama -->
                    <div class="input-group">
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" class="block mt-1 w-full"
                            type="text" placeholder="Masukkan nama"
                            name="name" :value="old('name')"
                            required autocomplete="off" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                    <x-input-label for="password" :value="__('Kata Sandi')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                            type="password" placeholder="Masukkan kata sandi"
                            name="password"
                            required autocomplete="off" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="input-group">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password" placeholder="Konfirmasi kata sandi"
                            name="password_confirmation"
                            required autocomplete="off" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <br>
                    <button type="submit" class="btn-submit">Daftar</button>
                </form>
            </div>
        </div>
        
        <div class="right-section">
            <div class="logo-placeholder">
                <img src="{{ asset('images/gambar1.png') }}" alt="gambar" width="100%">
            </div>
        </div>
    </div>
</body>
</html>