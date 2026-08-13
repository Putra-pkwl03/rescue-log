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

    <!-- TABEL STATUS PENGIRIMAN COMPONENT -->
    <x-sub-posko.distribusi.status-pengiriman-table :pengirimans="$pengirimans" />

    <!-- TABEL INVENTARIS STOK COMPONENT -->
    <x-sub-posko.distribusi.inventaris-stok-table :stoks="$stoks" />

</div>

<!-- MODAL POPUP COMPONENTS -->
<x-sub-posko.distribusi.detail-modal />


<!-- FORM HIDDEN UNTUK EKSEKUSI KONFIRMASI TERIMA SEGERA -->
<form id="directConfirmForm" method="POST" class="hidden">
    @csrf
</form>

<!-- CDN SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // 1. NOTIFIKASI TOAST SWEETALERT2 (POJOK KANAN ATAS)
    document.addEventListener('DOMContentLoaded', function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end', // Pojok Kanan Atas
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            customClass: {
                popup: 'rounded-xl shadow-lg border border-slate-100'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        @if(session('error'))

            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        @endif

        @if(session('warning'))

            Toast.fire({
                icon: 'warning',
                title: "{{ session('warning') }}"
            });
        @endif
    });


    // 2. FUNGSI JAVASCRIPT MODAL & EKSEKUSI TERIMA LANGSUNG SELESAI
    let activeConfirmRoute = '';

    function openDetailModal(kode, routeUrl, items, status, catatan) {
        const modalKode = document.getElementById('modalKodePengajuan');
        if (modalKode) modalKode.innerText = kode;
        
        activeConfirmRoute = routeUrl;
        
        const catatanContainer = document.getElementById('modalCatatanContainer');
        if (catatanContainer) {
            if (catatan && catatan.trim() !== '') {
                document.getElementById('modalCatatanText').innerText = catatan;
                catatanContainer.classList.remove('hidden');
            } else {
                catatanContainer.classList.add('hidden');
            }
        }

        const tbody = document.getElementById('modalTableBody');
        if (tbody) {
            tbody.innerHTML = '';


            if (items && items.length > 0) {
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
        }

        // Atur Tombol Terima Sekarang di Modal Detail
        const btnConfirm = document.getElementById('btnOpenConfirmModal');
        if (btnConfirm) {
            if (routeUrl && status !== 'selesai') {
                btnConfirm.classList.remove('hidden');
                // Ubah onclick agar LANGSUNG memproses submit tanpa buka modal konfirmasi lagi
                btnConfirm.setAttribute('onclick', 'submitTerimaLangsung()');
            } else {
                btnConfirm.classList.add('hidden');
            }
        }

        const modalDetail = document.getElementById('detailLogistikModal');
        if (modalDetail) modalDetail.classList.remove('hidden');
    }

    function closeDetailModal() {
        const modalDetail = document.getElementById('detailLogistikModal');
        if (modalDetail) modalDetail.classList.add('hidden');
    }

    // FUNGSI EKSEKUSI SEGERA KETIKA TOMBOL TERIMA DIKLIK
    function submitTerimaLangsung() {
        if (!activeConfirmRoute) return;

        const form = document.getElementById('directConfirmForm');
        form.action = activeConfirmRoute;
        form.submit(); // Langsung kirim form ke controller
    }
</script>
@endsection