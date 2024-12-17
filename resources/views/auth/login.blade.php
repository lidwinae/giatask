<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GiaTask</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" href="{{ asset('images/icon2.png') }}" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="login-box">
                <div class="logo-placeholder">
                    <img
                    src="{{ asset('images/logobiru.png') }}"
                    alt="logo"
                    width="200"
                    />
                </div>
                <h1>Masuk Akun</h1>
                <p>Masuk ke akun anda</p>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <!-- Email Address -->
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="Masukkan email" required>
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
                    </div>
                    <button type="submit" class="btn-submit">
                    {{ __('Log in') }}
                    </button>
                </form>
                <p class="register-link">Belum punya akun? <a href="/register">Daftar akun</a></p>
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