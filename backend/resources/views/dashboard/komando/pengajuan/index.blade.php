@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Pengajuan Kebutuhan Logistik</h1>
        <p class="text-xs text-slate-500 mt-1">Ajukan pasokan logistik ke BPBD jika stok Posko Komando tidak mencukupi permintaan Posko Lapangan.</p>
    </div>

    <!-- Alert Success / Error Flash Message -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-sm rounded-r-lg shadow-sm w-full">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 text-sm rounded-r-lg shadow-sm w-full">
            {{ session('error') }}
        </div>
    @endif

    <!-- 1. Component Statistik Cards -->
    @include('components.sub-posko.pengajuan.stats-cards')

    <!-- 2. Component Filter Bar & Button Create -->
    @include('components.sub-posko.pengajuan.filter-bar')

    <!-- 3. Component Table List Pengajuan -->
    @include('components.sub-posko.pengajuan.table-list')

    <!-- 4. Component Modal Form Pengajuan Baru -->
    @include('components.sub-posko.pengajuan.modal-create')

    <!-- 5. Component Modal Detail Respon BPBD -->
    @include('components.sub-posko.pengajuan.modal-detail')
@endsection