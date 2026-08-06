@extends('layouts.app')

@section('content')
<div x-data="{ openModal: false }">
    <!-- Header Halaman -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Dashboard Utama</h1>
        <p class="text-gray-600 text-sm mt-1">
            Selamat datang kembali, <strong class="text-gray-900">{{ auth()->user()->name }}</strong>. Berikut adalah ringkasan operasional BPBD terkini.
        </p>
    </div>

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
            <div>
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Bencana Aktif</h3>
                <p class="text-3xl font-black text-red-600 mt-1.5">2</p>
            </div>
            <div class="bg-red-50 p-3 rounded-xl border border-red-100 shrink-0">
                <svg class="w-6 h-6 text-red-600" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
            <div>
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Permintaan Kebutuhan</h3>
                <p class="text-3xl font-black text-orange-500 mt-1.5">15</p>
            </div>
            <div class="bg-orange-50 p-3 rounded-xl border border-orange-100 shrink-0">
                <svg class="w-6 h-6 text-orange-500" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 022 2h2a2 2 0 022-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
            <div>
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Stok Logistik Kritis</h3>
                <p class="text-3xl font-black text-amber-500 mt-1.5">8</p>
            </div>
            <div class="bg-amber-50 p-3 rounded-xl border border-amber-100 shrink-0">
                <svg class="w-6 h-6 text-amber-500" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
            <div>
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Distribusi Berjalan</h3>
                <p class="text-3xl font-black text-blue-600 mt-1.5">4</p>
            </div>
            <div class="bg-blue-50 p-3 rounded-xl border border-blue-100 shrink-0">
                <svg class="w-6 h-6 text-blue-600" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Status Posko Utama -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-4">
            <h2 class="text-base font-bold text-gray-800">Status Posko Komando Utama</h2>
        </div>

        @if(!$posko)
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-slate-50 p-4 rounded-xl border border-slate-200/60">
                <div class="flex items-center gap-3">
                    <span class="text-amber-500 text-xl">⚠️</span>
                    <p class="text-sm font-medium text-gray-600">Belum ada Posko Komando yang terdaftar saat ini.</p>
                </div>
                <button type="button" @click="openModal = true" 
                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm cursor-pointer">
                    + Daftarkan Posko Komando
                </button>
            </div>
        @else
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="font-bold text-lg text-gray-800">{{ $posko->nama_posko }}</h3>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-xs text-gray-500 font-medium">Status Operasional:</span>
                        @if($posko->status === 'aktif')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                ● Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                ● Nonaktif
                            </span>
                        @endif
                    </div>

                    @if(isset($bencanaAktif) && $bencanaAktif)
                        <p class="text-sm text-gray-600 mt-2">
                            Menangani Kasus: <strong class="text-gray-800">{{ $bencanaAktif->jenis_bencana }}</strong>
                        </p>
                    @endif
                </div>

                @if($posko->status === 'terdaftar_nonaktif' || $posko->status === 'nonaktif')
                    @if(Route::has('admin.posko.aktifkan'))
                        <!-- Form Pengaktifan Posko -->
                        <form id="form-aktifkan-posko" action="{{ route('admin.posko.aktifkan', $posko->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="button" 
                                    onclick="konfirmasiAktifkanPosko()"
                                    class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm cursor-pointer">
                                Aktifkan Posko
                            </button>
                        </form>
                    @endif
                @elseif(isset($bencanaAktif) && $bencanaAktif)
                    @if(Route::has('admin.bencana.finish'))
                        <!-- Form Penonaktifan Posko -->
                        <form id="form-selesaikan-posko" action="{{ route('admin.bencana.finish', $posko->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="button" 
                                    onclick="konfirmasiSelesaikanPosko()"
                                    class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-sm cursor-pointer">
                                Nonaktifkan Posko
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        @endif
    </div>

    <!-- Area Log Aktivitas -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-base font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Aktivitas & Log Terbaru</h2>
        <ul class="space-y-4">
            <li class="flex items-start gap-3">
                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full mt-1.5 shrink-0"></span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Distribusi Selesai</p>
                    <p class="text-xs text-gray-600 mt-0.5">Tim Lapangan A telah mendistribusikan logistik untuk Posko Banjir Bandang.</p>
                    <p class="text-[11px] text-gray-400 mt-1">Baru saja</p>
                </div>
            </li>
        </ul>
    </div>

    <!-- PANGGIL KOMPONEN MODAL DI SINI -->
    @include('components.admin.modal-posko')
</div>
@endsection

{{-- Script SweetAlert2 Konfirmasi --}}
@push('scripts')
<script>
    // Konfirmasi SweetAlert2 saat mengaktifkan Posko
    function konfirmasiAktifkanPosko() {
        Swal.fire({
            title: 'Aktifkan Posko Komando?',
            text: "Posko akan dihubungkan dengan kejadian bencana aktif untuk memulai tanggap darurat.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#059669', // Emerald 600
            cancelButtonColor: '#6b7280',  // Gray 500
            confirmButtonText: 'Ya, Aktifkan!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'px-4 py-2 rounded-xl text-sm font-semibold',
                cancelButton: 'px-4 py-2 rounded-xl text-sm font-semibold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-aktifkan-posko').submit();
            }
        });
    }

    // Konfirmasi SweetAlert2 saat menonaktifkan/menyelesaikan Posko
    function konfirmasiSelesaikanPosko() {
        Swal.fire({
            title: 'Selesaikan Operasi Posko?',
            text: "Status posko akan menjadi nonaktif dan penanganan bencana dinyatakan selesai.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626', // Red 600
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Selesaikan',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'px-4 py-2 rounded-xl text-sm font-semibold',
                cancelButton: 'px-4 py-2 rounded-xl text-sm font-semibold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-selesaikan-posko').submit();
            }
        });
    }
</script>
@endpush