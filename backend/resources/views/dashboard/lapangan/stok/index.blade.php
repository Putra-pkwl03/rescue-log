@extends('layouts.app-lapangan')

@section('content')
<div class="space-y-6">

    <!-- PAGE HEADER COMPONENT -->
    <x-sub-posko.page-header 
        title="Status Distribusi & Stok Logistik" 
        description="Pantau status pengiriman dari Posko Komando serta ketersediaan stok barang di pos lapangan">
        
        <a href="{{ route('lapangan.pengajuan.create') }}" class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition shadow-sm gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Pengajuan Baru
        </a>
    </x-sub-posko.page-header>

    <!-- ALERT SUCCESS NOTIFICATION -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold">&times;</button>
        </div>
    @endif

    <!-- TABEL STATUS PENGIRIMAN COMPONENT -->
    <x-sub-posko.distribusi.status-pengiriman-table :pengirimans="$pengirimans" />

    <!-- TABEL INVENTARIS STOK COMPONENT -->
    <x-sub-posko.distribusi.inventaris-stok-table :stoks="$stoks" />

</div>

<!-- MODAL POPUP COMPONENTS -->
<x-sub-posko.distribusi.detail-modal />
<x-sub-posko.distribusi.confirm-modal />

<!-- JAVASCRIPT LOGIC -->
<script>
    let activeConfirmRoute = '';

    function openDetailModal(kode, routeUrl, items, status, catatan) {
        document.getElementById('modalKodePengajuan').innerText = kode;
        activeConfirmRoute = routeUrl;
        
        const catatanContainer = document.getElementById('modalCatatanContainer');
        if (catatan && catatan.trim() !== '') {
            document.getElementById('modalCatatanText').innerText = catatan;
            catatanContainer.classList.remove('hidden');
        } else {
            catatanContainer.classList.add('hidden');
        }

        const tbody = document.getElementById('modalTableBody');
        tbody.innerHTML = '';

        if (items.length > 0) {
            items.forEach(item => {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-gray-50/80';
                tr.innerHTML = `
                    <td class="py-2.5 px-3 font-bold text-gray-900">${item.nama}</td>
                    <td class="py-2.5 px-3 text-gray-500">${item.kategori}</td>
                    <td class="py-2.5 px-3 text-right font-semibold text-blue-600">${item.jumlah}</td>
                `;
                tbody.appendChild(tr);
            });
        } else {
            tbody.innerHTML = `<tr><td colspan="3" class="py-4 text-center text-gray-400 italic">Rincian item tidak tersedia</td></tr>`;
        }

        const btnConfirm = document.getElementById('btnOpenConfirmModal');
        if (routeUrl) {
            btnConfirm.classList.remove('hidden');
        } else {
            btnConfirm.classList.add('hidden');
        }

        document.getElementById('detailLogistikModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailLogistikModal').classList.add('hidden');
    }

    function showConfirmModal() {
        if (!activeConfirmRoute) return;
        document.getElementById('modalConfirmForm').action = activeConfirmRoute;
        document.getElementById('customConfirmModal').classList.remove('hidden');
    }

    function closeConfirmModal() {
        document.getElementById('customConfirmModal').classList.add('hidden');
    }
</script>
@endsection