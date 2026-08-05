<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Lapangan - Rescue Log' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col font-sans antialiased">

    <x-sub-posko.navbarlp.navbar />

    <main class="flex-grow container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-auto py-4 text-center text-xs text-gray-500">
        &copy; {{ date('Y') }} Rescue Log - Posko Lapangan. All rights reserved.
    </footer>

    @stack('scripts')
</body>
</html>