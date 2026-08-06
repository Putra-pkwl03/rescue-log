@extends('layouts.app-lapangan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header dengan Komponen Page Header (Tombol kembali diarahkan ke index pengungsi) -->
    <x-sub-posko.page-header 
        title="Tambah Data Pendataan Pengungsi (KK)" 
        description="Masukkan informasi Kartu Keluarga dan kategori khusus untuk dasar perhitungan logistik."
        :backUrl="route('lapangan.pengungsi.index')">
    </x-sub-posko.page-header>

    <!-- Form Kartu Utama -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('lapangan.pengungsi.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Informasi Utama KK -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kepala Keluarga (KK)</label>
                    <input type="text" name="nama_kk" placeholder="Contoh: Bapak Ahmad Zaelani" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-sm outline-none transition" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" name="nik" placeholder="16 digit NIK" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-sm outline-none transition" required>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Asal Desa / Dusun</label>
                    <input type="text" name="asal_desa" placeholder="Contoh: Dusun Sukamaju RT 02/01" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-sm outline-none transition" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Total Jumlah Anggota Keluarga (Jiwa)</label>
                    <input type="number" name="jumlah_jiwa" placeholder="Contoh: 5" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-sm outline-none transition" required>
                </div>
            </div>

            <!-- Garis Pemisah -->
            <hr class="border-gray-200 my-4">

            <!-- Kategori Khusus (Input Penting untuk Logistik & Sistem) -->
            <div>
                <h3 class="text-base font-bold text-gray-800 mb-1">Rincian Kategori Khusus Anggota Keluarga</h3>
                <p class="text-xs text-gray-500 mb-4">Masukkan jumlah anggota berdasarkan kelompok rentan (diisi 0 jika tidak ada).</p>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Balita (0-5 Tahun)</label>
                        <input type="number" name="balita" value="0" min="0" class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 text-sm outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Lansia (>60 Tahun)</label>
                        <input type="number" name="lansia" value="0" min="0" class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 text-sm outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Ibu Hamil / Menyusui</label>
                        <input type="number" name="ibu_hamil" value="0" min="0" class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 text-sm outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Disabilitas / Khusus</label>
                        <input type="number" name="disabilitas" value="0" min="0" class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 text-sm outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi Form -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('lapangan.pengungsi.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium shadow-sm transition">
                    Simpan Data KK
                </button>
            </div>
        </form>
    </div>

</div>
@endsection