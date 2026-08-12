@extends('layouts.app')

@section('content')
    <!-- Header Page -->
       <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Permintaan Kebutuhan Logistik</h1>
            <p class="text-base text-gray-600 mt-1">Verifikasi dan proses pengajuan pasokan logistik yang masuk dari Posko Komando.</p>
        </div>
    </div>

    <!-- Flash Alert Messages -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-sm rounded-r-lg shadow-sm w-full">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 text-sm rounded-r-lg shadow-sm w-full">
            {{ session('error') }}
        </div>
    @endif

    <!-- 1. Stats Cards Component -->
    @include('components.admin.permintaan.stats-cards')

    <!-- 2. Filter Bar Component -->
    @include('components.admin.permintaan.filter-bar')

    <!-- 3. Table List Component -->
    @include('components.admin.permintaan.table-list')

<!-- 4. Modal Detail & Action Component -->
@include('components.admin.permintaan.modal-detail')

@endsection