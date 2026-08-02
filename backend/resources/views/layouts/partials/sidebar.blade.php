<aside class="w-64 bg-gray-900 text-white flex flex-col md:flex">
    <div class="h-16 flex items-center justify-center border-b border-gray-800">
        <h2 class="text-2xl font-bold text-blue-400">SiGap BPBD</h2>
    </div>
    
    <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
        <!-- Menu Global -->
        <a href="/" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard Utama</a>
        
        <hr class="border-gray-700 my-4">

        {{-- ================= MENU ADMIN ================= --}}
        @if(auth::user()->role === 'admin')
            <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 mt-4">Menu Admin</div>
            
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700">Dashboard Admin</a>
            <a href="{{ route('admin.bencana') }}" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">Manajemen Bencana</a>
            <a href="{{ route('admin.permintaan') }}" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">Permintaan Kebutuhan</a>
            <a href="{{ route('admin.inventaris') }}" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">Inventaris & Prediksi</a>
            <a href="{{ route('admin.distribusi') }}" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">Distribusi</a>
            <a href="{{ route('admin.laporan') }}" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">Laporan</a>
        
        {{-- ================= MENU KOMANDO ================= --}}
        @elseif(auth::user()->role === 'komando')
            <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 mt-4">Menu Komando</div>
            <a href="{{ route('komando.dashboard') }}" class="block px-4 py-2 text-sm font-semibold rounded-lg bg-blue-600 text-white">Dashboard Komando</a>
            <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">Lapor Bencana</a>
            <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">Request Logistik</a>
        
        {{-- ================= MENU LAPANGAN ================= --}}
        @elseif(auth::user()->role === 'lapangan')
            <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 mt-4">Menu Lapangan</div>
            <a href="{{ route('lapangan.dashboard') }}" class="block px-4 py-2 text-sm font-semibold rounded-lg bg-blue-600 text-white">Dashboard Lapangan</a>
            <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">Tugas Distribusi</a>
            <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">Update Status</a>
        @endif
    </nav>
</aside>