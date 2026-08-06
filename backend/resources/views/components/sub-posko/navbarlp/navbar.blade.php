@props(['user' => auth()->user()])

<nav class="bg-blue-700 text-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            
            <div class="flex items-center space-x-3">
                <div class="bg-white text-blue-700 p-2 rounded-lg font-bold text-lg">
                    🚑 RESCUE LOG
                </div>
                <span class="font-semibold text-lg hidden sm:inline">Posko Lapangan</span>
            </div>

            <div class="hidden md:flex space-x-4">
                <a href="{{ route('lapangan.dashboard') }}" class="bg-blue-800 px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600 transition">
                    Dashboard
                </a>
                <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600 transition">
                    Peta Lokasi
                </a>
                <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600 transition">
                    Laporan Masuk
                </a>
                <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600 transition">
                    Dokumentasi
                </a>
            </div>

            <div class="flex items-center space-x-3">
                <span class="text-sm font-medium hidden md:inline">
                    {{ $user->name ?? 'Petugas Lapangan' }}
                </span>
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>