<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Logistik - SiGap BPBD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased text-gray-800 flex h-screen overflow-hidden">

    <!-- 1. PANGGIL SIDEBAR DISINI -->
    @include('layouts.sidebar')

    <!-- 2. CONTAINER KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Top Navbar (Profil Petugas & Hamburger) -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 z-30 shrink-0">
            <button class="p-2 text-gray-500 hover:text-gray-700 rounded-lg focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

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

        <!-- Area Isi Konten (Dashboard, Tabel, dll) -->
        <main class="flex-1 overflow-y-auto p-8 bg-[#f8fafc]">
            @yield('content')
        </main>
    </div>

</body>
</html>