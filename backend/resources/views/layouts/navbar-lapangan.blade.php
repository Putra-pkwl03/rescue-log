<nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="w-full px-6 lg:px-10">
        <div class="flex justify-between h-16">
            
            <!-- Bagian Kiri: Logo Projek -->
            <div class="flex items-center">
                <a href="#" class="flex items-center space-x-3">
                    <!-- Pastikan file logo Anda berada di folder public/images/logo.png -->
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Projek" class="h-10 w-auto object-contain">
                    <span class="font-bold text-gray-800 text-lg tracking-wide hidden sm:inline-block">Pos Lapangan</span>
                </a>
            </div>

            <!-- Bagian Kanan: Profil Admin & Dropdown Logout -->
            <div class="flex items-center" x-data="{ open: false }">
                <div class="relative">
                    
                    <!-- Tombol Profil & Icon 'v' -->
                    <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none py-1.5 px-3 rounded-lg hover:bg-gray-100 transition">
                        <!-- Foto Admin Lapangan (Simpan di public/images/admin.png) -->
                        <img src="{{ asset('images/admin.png') }}" alt="Foto Admin" class="h-9 w-9 rounded-full object-cover border border-gray-300 shadow-sm">
                        
                        <!-- Nama Lengkap Admin -->
                        <span class="text-sm font-semibold text-gray-700 hidden md:block">
                            {{ Auth::user()->name ?? 'Nama Admin Lapangan' }}
                        </span>
                        
                        <!-- Icon 'v' (Chevron Down) yang berputar saat diklik -->
                        <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Menu Dropdown Logout -->
                    <div x-show="open" 
                         @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-100" 
                         x-transition:enter-start="transform opacity-0 scale-95" 
                         x-transition:enter-start="transform opacity-100 scale-100" 
                         x-transition:leave="transition ease-in duration-75" 
                         x-transition:leave-start="transform opacity-100 scale-100" 
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1 border border-gray-100 z-50"
                         style="display: none;">
                        
                        <!-- Form Logout Laravel -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 flex items-center space-x-2 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Keluar (Logout)</span>
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</nav>