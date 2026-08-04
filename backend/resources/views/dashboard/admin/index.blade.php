@extends('layouts.master')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Utama</h1>
    <p class="text-gray-600 mt-2">Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Berikut adalah ringkasan informasi operasional BPBD terkini.</p>
</div>

<!-- Statistik Utama -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1 -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Bencana Aktif</h3>
            <p class="text-3xl font-bold text-red-600 mt-1">2</p>
        </div>
        <div class="bg-red-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Permintaan Kebutuhan</h3>
            <p class="text-3xl font-bold text-orange-500 mt-1">15</p>
        </div>
        <div class="bg-orange-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Stok Logistik Kritis</h3>
            <p class="text-3xl font-bold text-yellow-500 mt-1">8</p>
        </div>
        <div class="bg-yellow-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Distribusi Berjalan</h3>
            <p class="text-3xl font-bold text-blue-600 mt-1">4</p>
        </div>
        <div class="bg-blue-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
        </div>
    </div>
</div>

<!-- Area Informasi Cepat -->
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
    <h2 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">Aktivitas & Log Terbaru</h2>
    <ul class="space-y-4">
        <li class="flex items-start">
            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 shrink-0"></span>
            <div>
                <p class="text-sm font-medium text-gray-800">Distribusi Selesai</p>
                <p class="text-sm text-gray-600">Tim Lapangan A telah mendistribusikan logistik untuk Posko Banjir Bandang.</p>
                <p class="text-xs text-gray-400 mt-1">Baru saja</p>
            </div>
        </li>
        <li class="flex items-start">
            <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 shrink-0"></span>
            <div>
                <p class="text-sm font-medium text-gray-800">Peringatan Sistem</p>
                <p class="text-sm text-gray-600">Stok Beras Premium di Gudang Utama tersisa kurang dari 50 Karung.</p>
                <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
            </div>
        </li>
        <li class="flex items-start">
            <span class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3 shrink-0"></span>
            <div>
                <p class="text-sm font-medium text-gray-800">Pos Komando Baru</p>
                <p class="text-sm text-gray-600">Pos Komando Bencana Tanah Longsor resmi diaktifkan oleh Admin.</p>
                <p class="text-xs text-gray-400 mt-1">3 jam yang lalu</p>
            </div>
        </li>
    </ul>
</div>
@endsection