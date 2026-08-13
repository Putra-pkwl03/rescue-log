@extends('layouts.app')

@section('title', 'Data Logistik & Pengajuan')

@section('content')
<!-- JUDUL & PENJELASAN HALAMAN -->
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Data Logistik & Pengajuan</h1>
    <p class="text-base text-gray-700 mt-2">Kelola, pantau, dan konfirmasi pengajuan kebutuhan logistik dari posko-posko lapangan.</p>
</div>

{{-- 2. Pesan Eror Tangkapan Exception (session('error')) --}}
@if (session('error'))
    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl shadow-xs flex items-center gap-3">
        <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center shrink-0 text-rose-600">
            <i data-lucide="alert-circle" class="w-5 h-5"></i>
        </div>
        <div class="flex-1 text-sm font-medium">
            {{ session('error') }}
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 p-1">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
@endif

{{-- 3. Pesan Eror Validasi Form ($errors) --}}
@if ($errors->any())
    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl shadow-xs">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center shrink-0 text-rose-600">
                <i data-lucide="alert-triangle" class="w-5 h-5"></i>
            </div>
            <h4 class="text-sm font-bold">Gagal Memproses Data! Harap periksa input berikut:</h4>
        </div>
        <ul class="list-disc pl-11 text-xs space-y-1 text-rose-700 font-medium">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- BANNER AI PREDIKSI STOK LOGISTIK -->
<div class="relative overflow-hidden bg-linear-to-r from-blue-700 via-indigo-700 to-blue-800 rounded-2xl p-6 text-white shadow-xl flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-6">
    <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>

    <div class="flex items-start gap-4 z-10">
        <div class="w-12 h-12 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center shrink-0 text-amber-300">
            <i data-lucide="cpu" class="w-6 h-6"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold tracking-tight">AI Prediksi Stok Logistik <span class="text-xs bg-amber-400 text-slate-900 px-2 py-0.5 rounded-md uppercase font-extrabold ml-2">Aktif</span></h2>
            <p class="text-blue-100 text-sm leading-relaxed max-w-3xl mt-1">
                Sistem Machine Learning memantau tren pengajuan dari seluruh posko lapangan secara real-time untuk memastikan akurasi distribusi logistik bantuan bencana.
            </p>
        </div>
    </div>
</div>

<!-- 4 KOTAK STATISTIK RINGKASAN DATA -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 my-6">
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Total Pengajuan</p>
            <h3 class="text-3xl font-bold text-slate-900">{{ $pengajuans->total() }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100">
            <i data-lucide="box" class="w-6 h-6"></i>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Disetujui</p>
            <h3 class="text-3xl font-bold text-slate-900">{{ $pengajuans->whereIn('status', ['disetujui', 'disetujui_sebagian', 'dalam_pengiriman', 'selesai'])->count() }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100">
            <i data-lucide="check-circle-2" class="w-6 h-6"></i>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Menunggu ACC</p>
            <h3 class="text-3xl font-bold text-slate-900">{{ $pengajuans->where('status', 'pending')->count() }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100">
            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Ditolak</p>
            <h3 class="text-3xl font-bold text-slate-900">{{ $pengajuans->where('status', 'ditolak')->count() }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center border border-rose-100">
            <i data-lucide="x-circle" class="w-6 h-6"></i>
        </div>
    </div>
</div>

<!-- FILTER & PENCARIAN -->
<form method="GET" action="{{ route('komando.logistik.index') }}" class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex flex-wrap items-center justify-between gap-4 my-6">
    <div class="flex flex-wrap items-center gap-3 flex-1">
        <div class="relative min-w-70 flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor pengajuan atau posko..." class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <select name="status" class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-600 focus:outline-none cursor-pointer">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui Full</option>
            <option value="disetujui_sebagian" {{ request('status') == 'disetujui_sebagian' ? 'selected' : '' }}>Disetujui Sebagian</option>
            <option value="dalam_pengiriman" {{ request('status') == 'dalam_pengiriman' ? 'selected' : '' }}>Dalam Pengiriman</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </div>

    <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer">
        <i data-lucide="filter" class="w-4 h-4"></i>
        Filter Data
    </button>
</form>

<!-- TABEL DATA PENGAJUAN -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-600 text-xs font-semibold uppercase tracking-wider border-b border-slate-200">
                    <th class="py-4 px-6">No. Pengajuan</th>
                    <th class="py-4 px-6">Posko Lapangan</th>
                    <th class="py-4 px-6">Waktu Pengajuan</th>
                    <th class="py-4 px-6">Status</th>
                    <th class="py-4 px-6">Ringkasan Kebutuhan</th>
                    <th class="py-4 px-6 text-right">Aksi Konfirmasi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                @forelse($pengajuans as $item)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-4 px-6 font-bold text-slate-900">
                            {{ $item->kode_pengajuan }}
                        </td>

                        <td class="py-4 px-6">
                            <div class="font-semibold text-slate-900">{{ $item->user->name ?? 'Posko Lapangan' }}</div>
                            <div class="text-xs text-slate-500">{{ $item->user->email ?? '-' }}</div>
                        </td>

                        <td class="py-4 px-6">
                            <div class="font-medium">{{ $item->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-slate-500">{{ $item->created_at->format('H:i') }} WIB</div>
                        </td>

                        <td class="py-4 px-6">
                            @if($item->status == 'pending')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200 rounded-full">
                                    <i data-lucide="clock" class="w-3.5 h-3.5"></i> Menunggu ACC
                                </span>
                            @elseif($item->status == 'disetujui')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full">
                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i> Disetujui Full
                                </span>
                            @elseif($item->status == 'disetujui_sebagian')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 rounded-full">
                                    <i data-lucide="pie-chart" class="w-3.5 h-3.5"></i> Sebagian
                                </span>
                            @elseif($item->status == 'dalam_pengiriman')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-full">
                                    <i data-lucide="truck" class="w-3.5 h-3.5"></i> Pengiriman
                                </span>
                            @elseif($item->status == 'selesai')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-teal-50 text-teal-700 border border-teal-200 rounded-full">
                                    <i data-lucide="check-check" class="w-3.5 h-3.5"></i> Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200 rounded-full">
                                    <i data-lucide="x-circle" class="w-3.5 h-3.5"></i> Ditolak
                                </span>
                            @endif
                        </td>

                        <td class="py-4 px-6">
                            <div class="flex flex-wrap gap-1.5 text-xs">
                                @if($item->beras_kg > 0)
                                    <span class="bg-slate-100 border border-slate-200 text-slate-700 px-2 py-1 rounded-md font-medium">Beras: {{ $item->beras_kg }} kg</span>
                                @endif
                                @if($item->air_minum_dus > 0)
                                    <span class="bg-slate-100 border border-slate-200 text-slate-700 px-2 py-1 rounded-md font-medium">Air: {{ $item->air_minum_dus }} Dus</span>
                                @endif
                                @if($item->makanan_kaleng_pack > 0)
                                    <span class="bg-slate-100 border border-slate-200 text-slate-700 px-2 py-1 rounded-md font-medium font-semibold">Mkn Kaleng: {{ $item->makanan_kaleng_pack }} Pk</span>
                                @endif
                                <button onclick="openDetailModal(
                                    '{{ $item->kode_pengajuan }}', 
                                    '{{ $item->user->name ?? 'Posko Lapangan' }}', 
                                    '{{ $item->created_at->format('d M Y, H:i') }} WIB', 
                                    '{{ $item->beras_kg ?? 0 }}', 
                                    '{{ $item->makanan_kaleng_pack ?? 0 }}',
                                    '{{ $item->makanan_bayi_pack ?? 0 }}',
                                    '{{ $item->minyak_goreng_liter ?? 0 }}',
                                    '{{ $item->air_minum_dus ?? 0 }}',
                                    '{{ $item->popok_bayi_pcs ?? 0 }}',
                                    '{{ $item->popok_dewasa_pcs ?? 0 }}',
                                    '{{ $item->pembalut_wanita_pack ?? 0 }}',
                                    '{{ $item->hygiene_kit_paket ?? 0 }}',
                                    '{{ $item->selimut_pcs ?? 0 }}',
                                    '{{ $item->matras_terpal_pcs ?? 0 }}',
                                    '{{ $item->obat_p3k_paket ?? 0 }}',
                                    '{{ $item->catatan_posko ?? '-' }}'
                                )" class="text-blue-600 hover:text-blue-800 font-bold px-1.5 py-1 text-xs inline-flex items-center gap-0.5 cursor-pointer">
                                    Detail <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </td>

                        <!-- AKSI ALUR 2-TAHAP -->
                        <td class="py-4 px-6 text-right">
                            {{-- TAHAP 1: Menunggu ACC --}}
                            @if($item->status == 'pending')
                                <button type="button" 
                                    onclick="openActionModal(
                                        '{{ $item->id }}', 
                                        '{{ $item->kode_pengajuan }}', 
                                        '{{ $item->user->name ?? 'Posko Lapangan' }}',
                                        '{{ route('komando.logistik.approve', $item->id) }}',
                                        '{{ route('komando.logistik.reject', $item->id) }}',
                                        {{ json_encode($item) }}
                                    )" 
                                    class="px-3.5 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-200 rounded-xl text-xs font-semibold inline-flex items-center gap-1.5 transition-colors shadow-sm cursor-pointer">
                                    <i data-lucide="settings" class="w-3.5 h-3.5"></i>
                                    <span>Proses Aksi</span>
                                </button>

                            {{-- TAHAP 2: Sudah ACC & Belum Ada Pengiriman --}}
                            @elseif(($item->status == 'disetujui' || $item->status == 'disetujui_sebagian') && !$item->pengiriman)
                                <button type="button"
                                    onclick="openScheduleModal(
                                        '{{ $item->id }}',
                                        '{{ $item->kode_pengajuan }}',
                                        '{{ $item->user->name ?? 'Posko Lapangan' }}'
                                    )"
                                    class="px-3.5 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-bold inline-flex items-center gap-1.5 transition-colors shadow-sm cursor-pointer animate-pulse">
                                    <i data-lucide="truck" class="w-3.5 h-3.5"></i>
                                    <span>Kirim Sekarang</span>
                                </button>

                            {{-- TAHAP 3: Armada Sudah Dalam Perjalanan atau Selesai --}}
                            @elseif($item->status == 'dalam_pengiriman' || $item->pengiriman)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium text-emerald-700 bg-emerald-50 rounded-lg border border-emerald-200">
                                    <i data-lucide="check" class="w-3.5 h-3.5"></i> Dalam Pengiriman
                                </span>
                            @elseif($item->status == 'selesai')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium text-teal-700 bg-teal-50 rounded-lg border border-teal-200">
                                    <i data-lucide="check-check" class="w-3.5 h-3.5"></i> Selesai
                                </span>

                            {{-- Pengajuan Ditolak --}}
                            @else
                                <span class="text-xs text-slate-400 italic">Pengajuan Ditolak</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 px-6 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center space-y-2">
                                <i data-lucide="inbox" class="w-10 h-10 text-slate-300"></i>
                                <p class="text-sm font-medium">Belum ada data pengajuan logistik dari posko lapangan.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-200 bg-slate-50">
        {{ $pengajuans->links() }}
    </div>
</div>

<!-- MEMANGGIL KOMPONEN MODAL -->
<x-komando.logistik.action-modal />
<x-komando.logistik.partial-modal />
<x-komando.logistik.detail-modal />
<x-komando.logistik.schedule-modal :armadas="$armadas ?? []" />

<!-- SCRIPT PENGENDALI MODAL -->
<script>
    let activeItemData = null;

    // --- MODAL PROSES AKSI TERPUSAT (TAHAP 1) ---
    function openActionModal(id, kode, poskoNama, approveUrl, rejectUrl, itemData) {
        activeItemData = itemData;

        const modal = document.getElementById('actionModal');
        document.getElementById('actionModalSubtitle').innerText = `No: ${kode} (${poskoNama})`;

        document.getElementById('formApproveFull').action = approveUrl;
        document.getElementById('formReject').action = rejectUrl;

        modal.classList.remove('hidden');
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function closeActionModal() {
        document.getElementById('actionModal').classList.add('hidden');
    }

    function switchToPartialModal() {
        closeActionModal();
        if (activeItemData) {
            openPartialModal(activeItemData);
        }
    }

    // --- MODAL SETUJUI SEBAGIAN ---
    function openPartialModal(item) {
        const modal = document.getElementById('partialModal');
        const form = document.getElementById('partialForm');
        const subTitle = document.getElementById('modalSubTitle');
        
        form.action = `/komando/logistik/${item.id}/approve-partial`;
        subTitle.innerText = `Nomor Pengajuan: ${item.kode_pengajuan}`;
        
        if(document.getElementById('part_beras_kg')) document.getElementById('part_beras_kg').value = item.beras_kg || 0;
        if(document.getElementById('part_makanan_kaleng_pack')) document.getElementById('part_makanan_kaleng_pack').value = item.makanan_kaleng_pack || 0;
        if(document.getElementById('part_makanan_bayi_pack')) document.getElementById('part_makanan_bayi_pack').value = item.makanan_bayi_pack || 0;
        if(document.getElementById('part_minyak_goreng_liter')) document.getElementById('part_minyak_goreng_liter').value = item.minyak_goreng_liter || 0;
        if(document.getElementById('part_air_minum_dus')) document.getElementById('part_air_minum_dus').value = item.air_minum_dus || 0;
        if(document.getElementById('part_popok_bayi_pcs')) document.getElementById('part_popok_bayi_pcs').value = item.popok_bayi_pcs || 0;
        if(document.getElementById('part_popok_dewasa_pcs')) document.getElementById('part_popok_dewasa_pcs').value = item.popok_dewasa_pcs || 0;
        if(document.getElementById('part_pembalut_wanita_pack')) document.getElementById('part_pembalut_wanita_pack').value = item.pembalut_wanita_pack || 0;
        if(document.getElementById('part_hygiene_kit_paket')) document.getElementById('part_hygiene_kit_paket').value = item.hygiene_kit_paket || 0;
        if(document.getElementById('part_selimut_pcs')) document.getElementById('part_selimut_pcs').value = item.selimut_pcs || 0;
        if(document.getElementById('part_matras_terpal_pcs')) document.getElementById('part_matras_terpal_pcs').value = item.matras_terpal_pcs || 0;
        if(document.getElementById('part_obat_p3k_paket')) document.getElementById('part_obat_p3k_paket').value = item.obat_p3k_paket || 0;

        modal.classList.remove('hidden');
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function closePartialModal() {
        document.getElementById('partialModal').classList.add('hidden');
    }

    // --- MODAL PENJADWALAN ARMADA (TAHAP 2) ---
    function openScheduleModal(pengajuanId, kodePengajuan, poskoNama) {
        document.getElementById('schedule_pengajuan_id').value = pengajuanId;
        document.getElementById('scheduleModalSubtitle').innerText = `Pengajuan: ${kodePengajuan} (${poskoNama})`;
        
        document.getElementById('scheduleModal').classList.remove('hidden');
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function closeScheduleModal() {
        document.getElementById('scheduleModal').classList.add('hidden');
    }

    // --- MODAL DETAIL PENGAJUAN ---
    function openDetailModal(kode, posko, waktu, beras, mknKaleng, mknBayi, minyak, air, popokBayi, popokDewasa, pembalut, hygiene, selimut, matras, obat, catatan) {
        const modal = document.getElementById('detailModal');
        
        document.getElementById('detailKodePengajuan').innerText = `No. Pengajuan: ${kode}`;
        document.getElementById('detailPoskoNama').innerText = posko;
        document.getElementById('detailWaktu').innerText = waktu;

        const tbody = document.getElementById('detailTabelBarang');
        tbody.innerHTML = `
            <tr><td class="p-2.5">Beras</td><td class="p-2.5 text-right font-bold text-slate-900">${beras} Kg</td></tr>
            <tr><td class="p-2.5">Makanan Kaleng</td><td class="p-2.5 text-right font-bold text-slate-900">${mknKaleng} Pack</td></tr>
            <tr><td class="p-2.5">Makanan Bayi</td><td class="p-2.5 text-right font-bold text-slate-900">${mknBayi} Pack</td></tr>
            <tr><td class="p-2.5">Minyak Goreng</td><td class="p-2.5 text-right font-bold text-slate-900">${minyak} Liter</td></tr>
            <tr><td class="p-2.5">Air Minum</td><td class="p-2.5 text-right font-bold text-slate-900">${air} Dus</td></tr>
            <tr><td class="p-2.5">Popok Bayi</td><td class="p-2.5 text-right font-bold text-slate-900">${popokBayi} Pcs</td></tr>
            <tr><td class="p-2.5">Popok Dewasa</td><td class="p-2.5 text-right font-bold text-slate-900">${popokDewasa} Pcs</td></tr>
            <tr><td class="p-2.5">Pembalut Wanita</td><td class="p-2.5 text-right font-bold text-slate-900">${pembalut} Pack</td></tr>
            <tr><td class="p-2.5">Hygiene Kit</td><td class="p-2.5 text-right font-bold text-slate-900">${hygiene} Paket</td></tr>
            <tr><td class="p-2.5">Selimut</td><td class="p-2.5 text-right font-bold text-slate-900">${selimut} Pcs</td></tr>
            <tr><td class="p-2.5">Matras / Terpal</td><td class="p-2.5 text-right font-bold text-slate-900">${matras} Pcs</td></tr>
            <tr><td class="p-2.5">Obat P3K</td><td class="p-2.5 text-right font-bold text-slate-900">${obat} Paket</td></tr>
        `;

        if(catatan && catatan !== '-') {
            tbody.innerHTML += `
                <tr class="bg-slate-50"><td colspan="2" class="p-2.5 text-xs text-slate-600">
                    <span class="font-bold text-slate-800">Catatan Posko:</span> ${catatan}
                </td></tr>
            `;
        }

        modal.classList.remove('hidden');
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection