@extends('layouts.app-lapangan')

@section('content')
    <!-- Teks Selamat Datang (Tanpa Card & Tanpa Tombol) -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang di Posko Lapangan</h1>
        <p class="text-gray-600 text-sm mt-1">Pantau lokasi kejadian, dokumentasi, dan status bantuan terkini.</p>
    </div>

    <!-- 4 Card Statistik di Atas -->
    @include('components.sub-posko.navbarlp.stats-cards')

    <!-- 4 Card Menu Interaktif di Bawah -->
    @include('components.sub-posko.navbarlp.action-cards')

    <div class="space-y-6">
        @if (view()->exists('components.sub-posko.alert'))
            <x-sub-posko.alert :sub-posko="$subPosko" />
        @else
            <div class="bg-amber-50 border border-amber-200 p-4 rounded-lg">
                <h3 class="font-bold text-amber-800 text-sm">⚠️ Status Darurat</h3>
                <p class="text-xs text-amber-700 mt-1">Petugas lapangan harap selalu memperbarui koordinat lokasi terkini.
                </p>
            </div>
        @endif

        @if (view()->exists('components.sub-posko.detail.documentation'))
            <x-sub-posko.detail.documentation :sub-posko="$subPosko" />
        @else
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h2 class="font-semibold text-lg text-gray-700">Dokumentasi Terkini</h2>
                <p class="text-sm text-gray-500 mt-2">Belum ada foto dokumentasi yang diunggah.</p>
            </div>
        @endif
    </div>

    </div>
@endsection
