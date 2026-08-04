<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RESCUE-LOG - BPBD')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
    </style>
</head>

<body class="bg-[#f4f7fb] min-h-screen antialiased text-slate-800 flex overflow-hidden">

 <!-- SIDEBAR POS KOMANDO -->
<aside id="main-sidebar" class="w-64 bg-gradient-to-t from-blue-950 via-indigo-900 to-blue-700 flex flex-col transition-all duration-300 relative z-50 shrink-0">
    <div class="h-20 flex items-center px-4 border-b border-slate-700/50">
        <div class="flex items-center gap-3 shrink-0">
            <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-blue-500 border border-slate-700">
                <i data-lucide="shield-check" class="w-6 h-6"></i>
            </div>
            <div id="logo-text" class="flex flex-col transition-opacity duration-300 whitespace-nowrap">
                <span class="text-white font-bold text-lg leading-tight">POSKO KOMANDO</span>
                <span class="text-slate-400 text-xs tracking-wider">SISTEM LOGISTIK</span>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-3 py-6 space-y-6 overflow-y-auto overflow-x-hidden custom-scrollbar">
        <div>
            <p class="text-xs font-semibold text-slate-500 mb-3 px-3 tracking-wider">MENU UTAMA</p>
            <div class="space-y-1.5">
                <a href="{{ route('komando.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('komando.dashboard') ? 'bg-orange-600 text-white shadow-lg font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>
                    <span class="menu-text whitespace-nowrap text-sm overflow-hidden">Dashboard</span>
                </a>

                <a href="{{ route('komando.logistik.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('komando.logistik*') ? 'bg-orange-600 text-white shadow-lg font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="package" class="w-5 h-5 shrink-0"></i>
                    <span class="menu-text whitespace-nowrap text-sm overflow-hidden">Data Logistik</span>
                </a>

                <a href="{{ route('komando.distribusi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('komando.distribusi*') ? 'bg-orange-600 text-white shadow-lg font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="truck" class="w-5 h-5 shrink-0"></i>
                    <span class="menu-text whitespace-nowrap text-sm overflow-hidden">Distribusi Logistik</span>
                </a>

                <a href="{{ route('komando.pengajuan.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('komando.pengajuan*') ? 'bg-orange-600 text-white shadow-lg font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="zap" class="w-5 h-5 shrink-0"></i>
                    <span class="menu-text whitespace-nowrap text-sm overflow-hidden">Pengajuan Kebutuhan</span>
                </a>

                <a href="{{ route('komando.posko-kecil.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('komando.posko-kecil*') ? 'bg-orange-600 text-white shadow-lg font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="users" class="w-5 h-5 shrink-0"></i>
                    <span class="menu-text whitespace-nowrap text-sm overflow-hidden">Pendataan Pos Kecil</span>
                </a>
            </div>
        </div>
    </nav>
</aside>

    <!-- KONTEN UTAMA & HEADER -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6 shrink-0 z-40">
            <div class="flex items-center gap-4">
                <!-- Tombol Toggle Sidebar -->
                <button id="toggle-btn"
                    class="p-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-colors focus:outline-none">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Bagian Profil & Dropdown Logout -->
            <div class="flex items-center gap-6" x-data="{ open: false }">
                <div class="relative">
                    <button @click="open = !open"
                        class="flex items-center gap-3 border-l border-slate-200 pl-6 focus:outline-none group">
                        <img src="https://ui-avatars.com/api/?name=Petugas+Komando&background=0D8ABC&color=fff"
                            alt="Profile" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                        <div class="hidden md:block text-left text-sm">
                            <p class="font-bold text-slate-800">Petugas Komando</p>
                            <p class="text-xs text-slate-500">Posko Komando</p>
                        </div>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-500 transition-transform duration-200"
                            :class="{ 'rotate-180': open }"></i>
                    </button>

                    <!-- Dropdown Menu Logout -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50"
                        style="display: none;">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Keluar (Logout)
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- AREA KONTEN UTAMA DINAMIS -->
        <div class="flex-1 overflow-y-auto p-6 lg:p-8">
            @yield('content')
        </div>
    </main>

    <!-- Script Inisialisasi Icon & Toggle Sidebar -->
    <script>
        lucide.createIcons();

        // Script opsional untuk tombol minimize/collapse sidebar
        const toggleBtn = document.getElementById('toggle-btn');
        const mainSidebar = document.getElementById('main-sidebar');
        const logoText = document.getElementById('logo-text');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                mainSidebar.classList.toggle('w-64');
                mainSidebar.classList.toggle('w-20');
                if (logoText) {
                    logoText.classList.toggle('hidden');
                }
            });
        }
    </script>
</body>

</html>
