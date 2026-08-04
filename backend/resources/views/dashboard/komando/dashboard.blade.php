@extends('layouts.app')

@section('title', 'Dashboard Posko Komando - SiGap BPBD')

@section('content')
<div class="space-y-6">
    <!-- Header Sambutan -->
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Dashboard Posko Komando</h1>
        <p class="text-slate-600 text-sm">Selamat datang, <span class="font-semibold text-slate-800">Koordinator Komando</span>. Berikut adalah ringkasan operasional dan komando darurat terkini.</p>
    </div>

    <!-- 4 Card Statistik Utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Pengajuan Masuk -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-red-600 uppercase tracking-wider mb-1">PENGATURAN / PENGAJUAN MASUK</p>
                    <h3 class="text-3xl font-black text-slate-900">0</h3>
                    <p class="text-xs text-slate-500 mt-1">Menunggu keputusan komando</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                    <i data-lucide="clipboard-list" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <!-- Card 2: Distribusi Berjalan -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">DISTRIBUSI BERJALAN</p>
                    <h3 class="text-3xl font-black text-slate-900">0</h3>
                    <p class="text-xs text-slate-500 mt-1">Armada di dalam perjalanan</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <i data-lucide="repeat" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <!-- Card 3: Stok Logistik Kritis -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-amber-600 uppercase tracking-wider mb-1">STOK LOGISTIK KRITIS</p>
                    <h3 class="text-3xl font-black text-slate-900">0</h3>
                    <p class="text-xs text-slate-500 mt-1">Perlu pengajuan ke BPBD</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <i data-lucide="package" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <!-- Card 4: Posko Kecil Terdaftar -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-1">POSKO KECIL TERDAFTAR</p>
                    <h3 class="text-3xl font-black text-slate-900">0</h3>
                    <p class="text-xs text-slate-500 mt-1">Titik aktif di bawah komando</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <i data-lucide="map-pin" class="w-6 h-6"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Pintasan Menu Utama -->
    <div>
        <h2 class="text-lg font-bold text-slate-900 mb-4">Pintasan Menu Utama</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Shortcut 1: Data Logistik -->
            <a href="{{ route('komando.logistik') }}" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-blue-200 transition-all group flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">Data Logistik</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Tinjau & putuskan pengajuan dari Posko Kecil, lihat prediksi ML.</p>
                </div>
            </a>

            <!-- Shortcut 2: Distribusi Logistik -->
            <a href="#" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-blue-200 transition-all group flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="map-pin" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">Distribusi Logistik</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Atur armada & rute pengiriman ke Posko Kecil.</p>
                </div>
            </a>

            <!-- Shortcut 3: Pengajuan Kebutuhan -->
            <a href="#" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-blue-200 transition-all group flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="zap" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">Pengajuan Kebutuhan</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Ajukan tambahan stok ke BPBD saat kebutuhan gabungan belum tercukupi.</p>
                </div>
            </a>

            <!-- Shortcut 4: Pendataan Pos Kecil -->
            <a href="#" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-blue-200 transition-all group flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">Pendataan Pos Kecil</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Daftarkan titik Posko Kecil baru & buat kode undangan.</p>
                </div>
            </a>

        </div>
    </div>

    <!-- Aktivitas & Log Terbaru -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900 mb-4">Aktivitas & Log Terbaru</h2>
        <div class="text-center py-8 text-slate-400 text-sm border border-dashed border-slate-200 rounded-xl">
            Belum ada aktivitas atau log terbaru saat ini.
        </div>
    </div>
</div>

<!-- Render ulang icon Lucide khusus untuk konten dinamis ini -->
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
@endsection