<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Pos Lapangan') }}</title>

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js untuk Dropdown Navbar & Indikator Sinyal PWA -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Stack Stylesheets khusus dari halaman/komponen (seperti Leaflet CSS) -->
    @stack('styles')
</head>

<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col">

    <!-- Memanggil Navbar Khusus Pos Lapangan -->
    @include('layouts.navbar-lapangan')

    <!-- Konten Utama Halaman Lapangan -->
    <main class="grow">
        <div class="w-full px-6 lg:px-10 py-6">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Alur Pos Komando & Pos Lapangan.
    </footer>

    <!-- Stack Scripts khusus dari halaman/komponen (seperti Leaflet JS & Map Init) -->
    @stack('scripts')

</body>

</html>