@extends('layouts.guest')

@section('title', 'Login - Sistem Penanganan Bencana BPBD')

@section('content')
<!-- Dikunci dengan md:h-screen dan md:overflow-hidden untuk mencegah scrollbar saat berganti tab -->
<div class="min-h-screen md:h-screen w-full flex flex-col md:flex-row overflow-x-hidden md:overflow-hidden">
    
    <!-- SISI KIRI: Hero Section (Biru Navy + Overlay + Informasi BPBD) -->
    <div class="hidden md:flex md:w-1/2 lg:w-7/12 relative bg-slate-900 justify-between flex-col p-12 overflow-hidden">
        <!-- Background Image dengan Overlay Biru Navy -->
        <div class="absolute inset-0 z-0 opacity-40 bg-cover bg-center" 
            style="background-image: url('{{ asset('img/login.png.png') }}');">
        </div>
        <div class="absolute inset-0 bg-linear-to-br from-blue-950/90 via-slate-900/95 to-slate-950/90 z-0"></div>

        <!-- Header Brand (Logo BPBD + Nama Instansi) -->
        <div class="relative z-10 flex items-center space-x-4">
            <!-- Segitiga Logo BPBD (Orange & Blue) -->
            <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center shadow-lg border-2 border-orange-400">
                <div class="w-0 h-0 border-l-10 border-l-transparent border-r-10 border-r-transparent border-b-18 border-b-blue-900"></div>
            </div>
            <div>
                <h2 class="text-white font-bold text-lg tracking-wider leading-none">BPBD</h2>
                <p class="text-amber-400 text-xs font-semibold tracking-widest mt-0.5">RESCUE-LOG</p>
            </div>
        </div>

        <!-- Body Hero (Judul & Fitur Utama) -->
        <div class="relative z-10 my-auto py-12 max-w-xl">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight mb-4">
                Sistem Penanganan Bencana
            </h1>
            <p class="text-slate-300 text-base leading-relaxed mb-10">
                Kelola informasi bencana, posko pengungsian, stok logistik, dan distribusi bantuan secara terintegrasi dan real-time.
            </p>

            <!-- 3 Poin Keunggulan -->
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-white/10 backdrop-blur-md rounded-xl text-amber-400 border border-white/10">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold text-base">Cepat</h4>
                        <p class="text-slate-400 text-sm">Respon cepat dalam penanganan darurat bencana.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-white/10 backdrop-blur-md rounded-xl text-amber-400 border border-white/10">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold text-base">Terkoordinasi</h4>
                        <p class="text-slate-400 text-sm">Koordinasi terstruktur antara Posko Komando dan Posko Lapangan.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-white/10 backdrop-blur-md rounded-xl text-amber-400 border border-white/10">
                        <i data-lucide="box" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold text-base">Terintegrasi</h4>
                        <p class="text-slate-400 text-sm">Data pengungsi dan penyaluran logistik terkelola dengan akurat.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Hero -->
        <div class="relative z-10 text-xs text-slate-400 border-t border-white/10 pt-4">
            &copy; 2026 BPBD - RESCUE-LOG System
        </div>
    </div>

    <!-- SISI KANAN: Form Login -->
    <div class="w-full md:w-1/2 lg:w-5/12 bg-slate-50 flex items-center justify-center p-6 lg:p-12 overflow-y-auto">
        <!-- Inisialisasi Alpine.js: Otomatis ke tab Sub Posko jika ada input / error kode_sub_posko -->
        <div x-data="{ isSubPosko: {{ old('kode_sub_posko') || $errors->has('kode_sub_posko') ? 'true' : 'false' }} }" class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-slate-100 my-auto">
            
            <!-- Header Form -->
            <div class="text-center mb-8">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner">
                    <i data-lucide="lock" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">Selamat Datang</h3>
                <p class="text-slate-500 text-sm mt-1" x-text="isSubPosko ? 'Masukkan kode sub posko untuk mengakses RESCUE-LOG' : 'Silakan masuk untuk mengakses RESCUE-LOG'"></p>
            </div>

            <!-- Alert Notifikasi -->
            @if(session('success'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl flex items-center space-x-2">
                    <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-700 text-sm rounded-xl flex items-center space-x-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input Email (HANYA tampil saat mode Posko Komando) -->
                <div x-show="!isSubPosko" x-cloak>
                    <label for="email" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">Username / Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                            :required="!isSubPosko" :disabled="isSubPosko" autofocus
                            class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            placeholder="Masukkan email petugas">
                    </div>
                </div>

                <!-- Input Password (HANYA tampil saat mode Posko Komando) -->
                <div x-show="!isSubPosko" x-cloak>
                    <label for="password" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="key-round" class="w-5 h-5"></i>
                        </div>
                        <input type="password" name="password" id="password" 
                            :required="!isSubPosko" :disabled="isSubPosko"
                            class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            placeholder="Masukkan password">
                    </div>
                </div>

                <!-- Input Kode Sub Posko (HANYA tampil saat mode Sub Posko) -->
                <div x-show="isSubPosko" class="space-y-2" x-cloak>
                    <label for="kode_sub_posko" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">Kode Sub Posko</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="qr-code" class="w-5 h-5"></i>
                        </div>
                        <input type="text" name="kode_sub_posko" id="kode_sub_posko" value="{{ old('kode_sub_posko') }}"
                            :required="isSubPosko" :disabled="!isSubPosko"
                            class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            placeholder="Masukkan kode sub posko (contoh: PSK-5JIQN)">
                    </div>
                </div>

                <!-- Remember Me & Forgot Pass (HANYA tampil saat mode Posko Komando) -->
                <div x-show="!isSubPosko" class="flex items-center justify-between text-sm" x-cloak>
                    <label class="flex items-center text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                        <span class="ml-2 text-xs font-medium">Ingat saya</span>
                    </label>
                    <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Lupa password?</a>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" 
                    class="w-full py-3 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-xl shadow-lg shadow-blue-700/30 flex items-center justify-center space-x-2 transition duration-200">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span>Masuk</span>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6 text-center">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
                <span class="relative bg-white px-3 text-xs text-slate-400 uppercase tracking-wider">Tipe Akses Posko</span>
            </div>

            <!-- Card Pilihan Posko -->
            <div class="grid grid-cols-2 gap-3">
                <!-- Posko Komando Button -->
                <button type="button" @click="isSubPosko = false"
                    :class="!isSubPosko ? 'ring-2 ring-amber-500 bg-amber-100/70 border-amber-300' : 'bg-amber-50/60 border-amber-200/80'"
                    class="p-3 border rounded-xl text-center cursor-pointer transition-all duration-200 focus:outline-none">
                    <div class="w-8 h-8 bg-amber-500 text-white rounded-lg flex items-center justify-center mx-auto mb-1.5 shadow-sm">
                        <i data-lucide="building-2" class="w-4 h-4"></i>
                    </div>
                    <span class="block text-xs font-bold text-amber-900">Posko Komando & Admin BPBD</span>
                    <span class="block text-[10px] text-amber-700 mt-0.5">Akses Induk BPBD</span>
                </button>

                <!-- Sub Posko Button -->
                <button type="button" @click="isSubPosko = true"
                    :class="isSubPosko ? 'ring-2 ring-emerald-500 bg-emerald-100/70 border-emerald-300' : 'bg-emerald-50/60 border-emerald-200/80'"
                    class="p-3 border rounded-xl text-center cursor-pointer transition-all duration-200 focus:outline-none">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-lg flex items-center justify-center mx-auto mb-1.5 shadow-sm">
                        <i data-lucide="tent" class="w-4 h-4"></i>
                    </div>
                    <span class="block text-xs font-bold text-emerald-900">Sub Posko</span>
                    <span class="block text-[10px] text-emerald-700 mt-0.5">Akses Lapangan</span>
                </button>
            </div>

        </div>
    </div>

</div>
@endsection