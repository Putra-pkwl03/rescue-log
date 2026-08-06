@extends('layouts.app')

@push('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #mapBencana {
            width: 100% !important;
            min-height: 420px !important;
            height: 420px !important;
            z-index: 1;
        }
    </style>
@endpush

@section('content')
<div class="space-y-6">

    <!-- Flash Notification -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800">&times;</button>
        </div>
    @endif

    <!-- 1. Header & Stat Cards -->
    @include('components.admin.bencana.stats')

    <!-- 2. Main Grid (Peta & Deteksi Otomatis) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- Peta Sebaran -->
        <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 flex flex-col">
            @include('components.admin.bencana.map')
        </div>

        <!-- Deteksi Otomatis (Pending) -->
        <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 flex flex-col">
            @include('components.admin.bencana.pending-list')
        </div>
    </div>

    <!-- 3. Tabel Operasi Aktif -->
    @include('components.admin.bencana.active-table')

    <!-- 4. Tabel Riwayat Selesai -->
    @include('components.admin.bencana.completed-table')

</div>

<!-- 5. Modal Validasi -->
@include('components.admin.bencana.validation-modal')

@endsection

@push('scripts')
    @include('components.admin.bencana.scripts')
@endpush