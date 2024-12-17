<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GiaTask') }}</title>
        <link rel="icon" href="{{ asset('images/icon2.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        <style>
        /* Sidebar styles */
        .sidebar {
            background-color: #A0D3E8; /* Biru Pastel */
            width: 250px;
            height: 100vh;
            position: fixed; /* Sidebar tetap di sisi kiri */
            top: 0;
            left: 0;
            padding-top: 60px; /* Memberi ruang untuk navbar */
            padding-left: 20px;
            z-index: 1; /* Sidebar berada di bawah navbar */
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
            background-color: #72B7D4;
        }

        .sidebar a.active {
            background-color: #4C8DAF; /* Warna aktif lebih gelap */
            font-size: 18px; /* Membesarkan ukuran font saat aktif */
            font-weight: bold;
        }

        /* Main Content */
        .content {
            margin-left: 260px; /* Memberi ruang untuk sidebar */
            padding: 20px;
        }
        </style>

    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
