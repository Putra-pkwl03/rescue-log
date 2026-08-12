@extends('layouts.app')

@section('content')
<div x-data="{ 
    modalTambah: false, 
    modalEdit: false, 
    modalKirim: false,
    editData: { id: '', nama_barang: '', kategori: '', jumlah: 0, satuan: '', keterangan: '' },
    
    // State Form Kirim Logistik Multi-Item
    kirimForm: {
        posko_id: '',
        keterangan: '',
        items: [{ stok_inventaris_id: '', jumlah_dikirim: 1, maks_stok: 0 }]
    },

    addKirimItem() {
        this.kirimForm.items.push({ stok_inventaris_id: '', jumlah_dikirim: 1, maks_stok: 0 });
    },
    removeKirimItem(index) {
        if (this.kirimForm.items.length > 1) {
            this.kirimForm.items.splice(index, 1);
        }
    },
    updateMaksStok(index, e) {
        const selectedOption = e.target.options[e.target.selectedIndex];
        const stok = parseInt(selectedOption.getAttribute('data-stok') || 0);
        this.kirimForm.items[index].maks_stok = stok;
        if (this.kirimForm.items[index].jumlah_dikirim > stok) {
            this.kirimForm.items[index].jumlah_dikirim = stok > 0 ? 1 : 0;
        }
    }
}">

    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen Stok Inventaris (BPBD)</h1>
            <p class="text-base text-gray-600 mt-1">Kelola dan pantau seluruh ketersediaan logistik dan peralatan bantuan bencana secara real-time.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <button @click="modalKirim = true" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-amber-600 hover:bg-amber-700 shadow-md transition cursor-pointer">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Kirim Barang ke Posko
            </button>

            <button @click="modalTambah = true" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-blue-700 hover:bg-blue-800 shadow-md transition cursor-pointer">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Stok Barang
            </button>
        </div>
    </div>

    <x-admin.inventaris.stats-cards :stokInventaris="$stokInventaris" />

    <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden mb-8">
        <x-admin.inventaris.action-bar />
        <x-admin.inventaris.table :stokInventaris="$stokInventaris" />
    </div>

    <x-admin.inventaris.modal-add />
    <x-admin.inventaris.modal-edit />
    <x-admin.inventaris.modal-kirim :stokInventaris="$stokInventaris" :poskoKomando="$poskoKomando" />

</div>
@endsection