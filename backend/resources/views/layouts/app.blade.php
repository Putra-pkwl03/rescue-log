<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Logistik - SiGap BPBD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
   
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body x-data="{ sidebarOpen: true }" class="bg-slate-50 font-sans antialiased text-gray-800 flex h-screen overflow-hidden">

    <!-- 1. SIDEBAR -->
    @include('layouts.sidebar')

    <!-- 2. CONTAINER KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- 3. NAVBAR -->
        @include('layouts.navbar')

        <!-- 4. AREA KONTEN HALAMAN -->
        <main class="flex-1 overflow-y-auto p-8 bg-[#f8fafc]">
            @yield('content')
        </main>
    </div>

@stack('scripts')
</body>
</html>