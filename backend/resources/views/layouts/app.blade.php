<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Logistik - SiGap BPBD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

            <!-- Profil User Kanan Atas -->
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-sky-500 text-white font-bold text-xs flex items-center justify-center shadow-sm">
                    PK
                </div>
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-gray-800 leading-tight">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-gray-500 capitalize">{{ str_replace('_', ' ', auth()->user()->role) }}</p>
                </div>
            </div>
        </header>

        <!-- 4. AREA KONTEN HALAMAN -->
        <main class="flex-1 overflow-y-auto p-8 bg-[#f8fafc]">e
            @yield('content')
        </main>
    </div>
@stack('scripts')
</body>
</html>