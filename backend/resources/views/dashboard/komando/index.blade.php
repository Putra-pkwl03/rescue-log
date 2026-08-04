
@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Dashboard Posko Komando</h1>
    <p class="text-base text-gray-700 mt-2">Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Berikut adalah ringkasan operasional dan komando darurat terkini.</p>
</div>

<!-- Statistik Utama (Diperbesar & Kontras Tinggi) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1: Pengajuan Masuk -->
    <div class="bg-white p-6 rounded-xl shadow-md border-2 border-red-100 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-bold text-red-700 uppercase tracking-wider">Pengajuan Masuk</h3>
            <p class="text-4xl font-extrabold text-red-600 mt-2">{{ $totalPengajuanMasuk ?? 0 }}</p>
            <p class="text-sm text-gray-600 mt-1">Menunggu keputusan komando</p>
        </div>
        <div class="bg-red-200 p-4 rounded-full">
            <svg class="w-8 h-8 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
    </div>

    <!-- Card 2: Distribusi Berjalan -->
    <div class="bg-white p-6 rounded-xl shadow-md border-2 border-blue-100 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-bold text-blue-700 uppercase tracking-wider">Distribusi Berjalan</h3>
            <p class="text-4xl font-extrabold text-blue-600 mt-2">{{ $totalDistribusiBerjalan ?? 0 }}</p>
            <p class="text-sm text-gray-600 mt-1">Armada di dalam perjalanan</p>
        </div>
        <div class="bg-blue-200 p-4 rounded-full">
            <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
        </div>
    </div>

    <!-- Card 3: Ringkasan Stok Kritis -->
    <div class="bg-white p-6 rounded-xl shadow-md border-2 border-yellow-100 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-bold text-yellow-700 uppercase tracking-wider">Stok Logistik Kritis</h3>
            <p class="text-4xl font-extrabold text-yellow-600 mt-2">{{ $totalStokKritis ?? 0 }}</p>
            <p class="text-sm text-gray-600 mt-1">Perlu pengajuan ke BPBD</p>
        </div>
        <div class="bg-yellow-200 p-4 rounded-full">
            <svg class="w-8 h-8 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
    </div>

    <!-- Card 4: Pos Kecil Terdaftar -->
    <div class="bg-white p-6 rounded-xl shadow-md border-2 border-green-100 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-bold text-green-700 uppercase tracking-wider">Posko Kecil Terdaftar</h3>
            <p class="text-4xl font-extrabold text-green-600 mt-2">{{ $totalPoskoKecil ?? 0 }}</p>
            <p class="text-sm text-gray-600 mt-1">Titik aktif di bawah komando</p>
        </div>
        <div class="bg-green-200 p-4 rounded-full">
            <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </div>
    </div>
</div>

<!-- Pintasan Menu (Tombol Diperbesar & Ramah Pengguna Senior) -->
<div class="mb-8">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Pintasan Menu Utama</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Menu 1: Data Logistik -->
        <a href="{{ route('komando.logistik.index') }}" class="bg-white p-6 rounded-xl shadow-md border-2 border-gray-200 hover:shadow-lg hover:border-red-400 transition flex flex-col items-start group">
            <div class="bg-red-100 p-4 rounded-full mb-4 group-hover:bg-red-200 transition">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <p class="text-lg font-bold text-gray-900">Data Logistik</p>
            <p class="text-sm text-gray-600 mt-2">Tinjau & putuskan pengajuan dari Posko Kecil, lihat prediksi ML</p>
        </a>

        <!-- Menu 2: Distribusi Logistik -->
        <a href="{{ route('komando.distribusi.index') }}" class="bg-white p-6 rounded-xl shadow-md border-2 border-gray-200 hover:shadow-lg hover:border-blue-400 transition flex flex-col items-start group">
            <div class="bg-blue-100 p-4 rounded-full mb-4 group-hover:bg-blue-200 transition">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <p class="text-lg font-bold text-gray-900">Distribusi Logistik</p>
            <p class="text-sm text-gray-600 mt-2">Atur armada & rute pengiriman ke Posko Kecil</p>
        </a>

        <!-- Menu 3: Pengajuan Kebutuhan -->
        <a href="{{ route('komando.pengajuan.index') }}" class="bg-white p-6 rounded-xl shadow-md border-2 border-gray-200 hover:shadow-lg hover:border-orange-400 transition flex flex-col items-start group">
            <div class="bg-orange-100 p-4 rounded-full mb-4 group-hover:bg-orange-200 transition">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <p class="text-lg font-bold text-gray-900">Pengajuan Kebutuhan</p>
            <p class="text-sm text-gray-600 mt-2">Ajukan tambahan stok ke BPBD saat kebutuhan gabungan belum tercukupi</p>
        </a>

        <!-- Menu 4: Pendataan Pos Kecil -->
        <a href="{{ route('komando.posko-kecil.index') }}" class="bg-white p-6 rounded-xl shadow-md border-2 border-gray-200 hover:shadow-lg hover:border-green-400 transition flex flex-col items-start group">
            <div class="bg-green-100 p-4 rounded-full mb-4 group-hover:bg-green-200 transition">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6-4a4 4 0 11-4-4"></path></svg>
            </div>
            <p class="text-lg font-bold text-gray-900">Pendataan Pos Kecil</p>
            <p class="text-sm text-gray-600 mt-2">Daftarkan titik Posko Kecil baru & buat kode undangan</p>
        </a>
    </div>
</div>

<!-- Area Informasi Cepat (Log Aktivitas) -->
<div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
    <h2 class="text-xl font-bold text-gray-900 border-b pb-3 mb-4">Aktivitas & Log Terbaru</h2>
    <ul class="space-y-4">
        @forelse($aktivitasTerbaru ?? [] as $aktivitas)
        <li class="flex items-start">
            <span class="w-3 h-3 bg-{{ $aktivitas->warna ?? 'gray' }}-500 rounded-full mt-2 mr-4 shrink-0"></span>
            <div>
                <p class="text-base font-semibold text-gray-900">{{ $aktivitas->judul }}</p>
                <p class="text-base text-gray-700">{{ $aktivitas->deskripsi }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $aktivitas->waktu }}</p>
            </div>
        </li>
        @empty
        <li class="flex items-start">
            <span class="w-3 h-3 bg-red-500 rounded-full mt-2 mr-4 shrink-0"></span>
            <div>
                <p class="text-base font-semibold text-gray-900">Pengajuan Baru Masuk</p>
                <p class="text-base text-gray-700">Posko Kecil Banjir Bandang mengajukan tambahan logistik air bersih.</p>
                <p class="text-xs text-gray-500 mt-1">Baru saja</p>
            </div>
        </li>
        <li class="flex items-start">
            <span class="w-3 h-3 bg-blue-500 rounded-full mt-2 mr-4 shrink-0"></span>
            <div>
                <p class="text-base font-semibold text-gray-900">Distribusi Diperbarui</p>
                <p class="text-base text-gray-700">Armada menuju Posko Kecil Tanah Longsor telah tiba di lokasi.</p>
                <p class="text-xs text-gray-500 mt-1">1 jam yang lalu</p>
            </div>
        </li>
        <li class="flex items-start">
            <span class="w-3 h-3 bg-yellow-500 rounded-full mt-2 mr-4 shrink-0"></span>
            <div>
                <p class="text-base font-semibold text-gray-900">Stok Menipis</p>
                <p class="text-base text-gray-700">Stok Terpal di gudang Posko Komando tersisa kurang dari batas aman.</p>
                <p class="text-xs text-gray-500 mt-1">2 jam yang lalu</p>
            </div>
        </li>
        <li class="flex items-start">
            <span class="w-3 h-3 bg-green-500 rounded-full mt-2 mr-4 shrink-0"></span>
            <div>
                <p class="text-base font-semibold text-gray-900">Posko Kecil Baru Terdaftar</p>
                <p class="text-base text-gray-700">Posko Kecil Kelurahan Sukamaju resmi didaftarkan dan siap digunakan.</p>
                <p class="text-xs text-gray-500 mt-1">3 jam yang lalu</p>
            </div>
        </li>
        @endforelse
    </ul>
</div>
@endsection