@extends('layouts.app-lapangan')

@section('content')
<div class="w-full px-4 sm:px-6 lg:px-8 mx-auto space-y-6 pb-10">

    <!-- Header & Submit -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
        <div>
            <x-sub-posko.page-header title="Pengajuan Kebutuhan Logistik"
                description="Angka kebutuhan di bawah dikalkulasi otomatis oleh Machine Learning AI berdasarkan data pendataan posko Anda.">
            </x-sub-posko.page-header>
        </div>
        <div class="mt-4 sm:mt-0 flex gap-3">
            <button type="submit" form="form-pengajuan" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 transition shadow-sm cursor-pointer">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Kirim Pengajuan
            </button>
        </div>
    </div>

    <!-- Info Pendataan & AI Recommendation Banner -->
    <div class="bg-gradient-to-r from-blue-900 to-indigo-800 rounded-xl p-6 text-white shadow-md">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center px-6 py-1 rounded-full text-lg font-semibold bg-yellow-500/30 text-white border border-yellow-400/30 mb-2">
                    <svg class="w-4 h-4 mr-1.5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3.005 3.005 0 013.75-2.906z"/>
                    </svg>
                    Data Acuan AI Posko
                </div>
                <h2 class="text-xl font-bold">Total {{ $pendataan->total_pengungsi ?? 0 }} Pengungsi</h2>
                <p class="text-xs text-blue-200 mt-1">
                    Balita: {{ $pendataan->balita ?? 0 }} | Lansia: {{ $pendataan->lansia ?? 0 }} | Ibu Hamil: {{ $pendataan->ibu_hamil ?? 0 }} | Disabilitas: {{ $pendataan->disabilitas ?? 0 }} | Tempat: {{ $pendataan->tipe_tempat ?? '-' }}
                </p>
            </div>
            <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-lg border border-white/10 text-right">
                <div class="text-xs text-blue-200">Kondisi BMKG</div>
                <div class="font-bold text-sm">{{ $pendataan->cuaca ?? '-' }} ({{ $pendataan->suhu_celcius ?? 0 }}°C)</div>
            </div>
        </div>
    </div>

    <!-- Form Input Pengajuan Logistik -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 md:p-8">
        <form id="form-pengajuan" action="{{ route('lapangan.pengajuan.store') }}" method="POST">
            @csrf

            <h3 class="text-base font-semibold text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Item Kebutuhan Logistik (Dapat Disesuaikan)
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                <!-- Beras -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Beras (KG)</label>
                    <input type="number" step="0.01" name="beras_kg" value="{{ round($estimasi['beras_kg'] ?? 0, 1) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['beras_kg'] ?? 0, 1) }} kg</span>
                </div>

                <!-- Air Minum -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Air Minum (Dus)</label>
                    <input type="number" name="air_minum_dus" value="{{ round($estimasi['air_minum_dus'] ?? 0) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['air_minum_dus'] ?? 0) }} Dus</span>
                </div>

                <!-- Makanan Kaleng -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Makanan Kaleng (Pack)</label>
                    <input type="number" name="makanan_kaleng_pack" value="{{ round($estimasi['makanan_kaleng_pack'] ?? 0) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['makanan_kaleng_pack'] ?? 0) }} Pack</span>
                </div>

                <!-- Makanan Bayi -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Makanan Bayi (Pack)</label>
                    <input type="number" name="makanan_bayi_pack" value="{{ round($estimasi['makanan_bayi_pack'] ?? 0) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['makanan_bayi_pack'] ?? 0) }} Pack</span>
                </div>

                <!-- Minyak Goreng -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Minyak Goreng (Liter)</label>
                    <input type="number" step="0.1" name="minyak_goreng_liter" value="{{ round($estimasi['minyak_goreng_liter'] ?? 0, 1) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['minyak_goreng_liter'] ?? 0, 1) }} L</span>
                </div>

                <!-- Popok Bayi -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Popok Bayi (Pcs)</label>
                    <input type="number" name="popok_bayi_pcs" value="{{ round($estimasi['popok_bayi_pcs'] ?? 0) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['popok_bayi_pcs'] ?? 0) }} Pcs</span>
                </div>

                <!-- Popok Dewasa -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Popok Dewasa (Pcs)</label>
                    <input type="number" name="popok_dewasa_pcs" value="{{ round($estimasi['popok_dewasa_pcs'] ?? 0) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['popok_dewasa_pcs'] ?? 0) }} Pcs</span>
                </div>

                <!-- Pembalut Wanita -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Pembalut Wanita (Pack)</label>
                    <input type="number" name="pembalut_wanita_pack" value="{{ round($estimasi['pembalut_wanita_pack'] ?? 0) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['pembalut_wanita_pack'] ?? 0) }} Pack</span>
                </div>

                <!-- Hygiene Kit -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Hygiene Kit (Paket)</label>
                    <input type="number" name="hygiene_kit_paket" value="{{ round($estimasi['hygiene_kit_paket'] ?? 0) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['hygiene_kit_paket'] ?? 0) }} Paket</span>
                </div>

                <!-- Selimut -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Selimut (Pcs)</label>
                    <input type="number" name="selimut_pcs" value="{{ round($estimasi['selimut_pcs'] ?? 0) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['selimut_pcs'] ?? 0) }} Pcs</span>
                </div>

                <!-- Matras / Terpal -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Matras / Terpal (Pcs)</label>
                    <input type="number" name="matras_terpal_pcs" value="{{ round($estimasi['matras_terpal_pcs'] ?? 0) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['matras_terpal_pcs'] ?? 0) }} Pcs</span>
                </div>

                <!-- Obat P3K -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 hover:border-blue-300 transition">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Obat P3K (Paket)</label>
                    <input type="number" name="obat_p3k_paket" value="{{ round($estimasi['obat_p3k_paket'] ?? 0) }}" class="w-full px-3 py-2 rounded-md border border-gray-300 font-bold text-gray-800 text-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <span class="text-[11px] text-blue-600 mt-1 block">Rekomendasi AI: {{ round($estimasi['obat_p3k_paket'] ?? 0) }} Paket</span>
                </div>

            </div>

            <!-- Catatan Tambahan -->
            <div class="mt-8 pt-6 border-t border-gray-100">
                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan Posko (Opsional)</label>
                <textarea name="catatan_posko" rows="3" placeholder="Tuliskan catatan khusus atau alasan jika ada penyesuaian angka di atas..." class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
            </div>
        </form>
    </div>

</div>

<!-- CDN SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- NOTIFIKASI SWEETALERT2 INTEGRATED -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#DC2626',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'px-5 py-2.5 rounded-xl font-bold text-sm'
                }
            });
        @endif

        @if(session('warning'))
            Swal.fire({
                title: 'Perhatian',
                text: "{{ session('warning') }}",
                icon: 'warning',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#D97706',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'px-5 py-2.5 rounded-xl font-bold text-sm'
                }
            });
        @endif
    });
</script>
@endsection