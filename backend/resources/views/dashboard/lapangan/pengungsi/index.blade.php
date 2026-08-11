@extends('layouts.app-lapangan')

@section('content')
<div class="w-full px-4 sm:px-6 lg:px-8 mx-auto space-y-6 pb-10">

    <!-- Header & Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
        
        <!-- Sisi Kiri: Tombol Kembali & Judul -->
        <div class="flex items-center gap-4">
            <!-- Tombol Kembali -->
            <x-sub-posko.page-header title="Pendataan Pengungsi"
                description="Kelola data kategori khusus pengungsi di pos lapangan.">
            </x-sub-posko.page-header>
        </div>

        <!-- Sisi Kanan: Tombol Simpan -->
        <div class="flex items-center">
            <!-- Tombol Simpan Terhubung ke Form via atribut form="form-pendataan" -->
            <button type="submit" form="form-pendataan" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Simpan Data
            </button>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm mt-4">
        <form id="form-pendataan" action="{{ route('lapangan.pengungsi.store') }}" method="POST">
            @csrf

            <!-- 1. Informasi Dasar -->
            <div class="p-6 md:p-8 border-b border-gray-100">
                
                <!-- Box Tanggal Otomatis -->
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50/50 flex flex-col justify-center">
                        <div class="flex items-center text-sm text-gray-600 mb-1.5">
                            <svg class="w-4 h-4 mr-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Tanggal Pendataan
                        </div>
                        <div class="font-semibold text-gray-900 mb-1.5">{{ now()->format('d/m/Y H:i') }} WIB</div>
                        <div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                Otomatis
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Rincian Kategori Khusus -->
            <div class="p-6 md:p-8 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-blue-700 mb-5"> Rincian Kategori Khusus</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Total Pengungsi <span class="text-red-500">*</span></label>
                        <input type="number" name="total_pengungsi" placeholder="Masukkan angka" min="0" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Anak Balita (0-5 th) <span class="text-red-500">*</span></label>
                        <input type="number" name="balita" placeholder="Masukkan angka" min="0" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Dewasa (18-59 th) <span class="text-red-500">*</span></label>
                        <input type="number" name="dewasa" placeholder="Masukkan angka" min="0" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Ibu Hamil <span class="text-red-500">*</span></label>
                        <input type="number" name="ibu_hamil" placeholder="Masukkan angka" min="0" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Lansia (&ge; 60 th) <span class="text-red-500">*</span></label>
                        <input type="number" name="lansia" placeholder="Masukkan angka" min="0" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Disabilitas <span class="text-red-500">*</span></label>
                        <input type="number" name="disabilitas" placeholder="Masukkan angka" min="0" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition" required>
                    </div>
                </div>
            </div>

            <!-- 3. Kondisi & Fasilitas -->
            <div class="p-6 md:p-8">
                <h2 class="text-lg font-semibold text-blue-700 mb-5"> Kondisi & Fasilitas</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Dropdown Tipe Tempat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tipe Tempat <span class="text-red-500">*</span></label>
                        <select name="tipe_tempat" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition bg-white" required>
                            <option value="">Pilih tipe tempat</option>
                            <option value="Balai Desa">Balai Desa</option>
                            <option value="Masjid/Tempat Ibadah">Masjid/Tempat Ibadah</option>
                            <option value="Sekolah">Sekolah</option>
                            <option value="Tenda/Lapangan">Tenda/Lapangan</option>
                        </select>
                    </div>

                    <!-- Dropdown Akses Air -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Akses Air <span class="text-red-500">*</span></label>
                        <select name="akses_air" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition bg-white" required>
                            <option value="">Pilih akses air</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Terbatas">Terbatas</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                    </div>

                    <!-- Dropdown Akses Jalan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Akses Jalan <span class="text-red-500">*</span></label>
                        <select name="akses_jalan" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition bg-white" required>
                            <option value="">Pilih akses jalan</option>
                            <option value="Mobil/Truk Bisa Masuk">Mobil/Truk Bisa Masuk</option>
                            <option value="Hanya Motor">Hanya Motor</option>
                            <option value="Harus Jalan Kaki">Harus Jalan Kaki</option>
                        </select>
                    </div>
                    
                    <!-- Dropdown Lama Pengungsian -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Lama Pengungsian (Hari) <span class="text-red-500">*</span></label>
                        <select name="lama_pengungsian" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition bg-white" required>
                            <option value="">Pilih lama pengungsian</option>
                            @for ($i = 1; $i <= 14; $i++)
                                <option value="{{ $i }}">{{ $i }} Hari</option>
                            @endfor
                        </select>
                    </div>

                    <!-- BMKG Suhu -->
                    <div class="bg-blue-50 rounded-lg p-4 flex items-start border border-blue-100">
                        <div class="bg-blue-100 p-2 rounded-lg text-blue-600 mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Suhu (°C)</div>
                            <div class="text-xl font-bold text-blue-800">28.5</div>
                            <div class="text-xs text-gray-500 mt-1">Diambil otomatis dari BMKG</div>
                        </div>
                    </div>

                    <!-- BMKG Cuaca -->
                    <div class="bg-blue-50 rounded-lg p-4 flex items-start border border-blue-100">
                        <div class="bg-blue-100 p-2 rounded-lg text-blue-600 mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Cuaca</div>
                            <div class="text-lg font-bold text-blue-800 leading-tight">Hujan Deras</div>
                            <div class="text-xs text-gray-500 mt-1">Diambil otomatis dari BMKG</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Alert Information -->
    <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-4 flex items-center text-sm text-blue-800 mt-6">
        <svg class="w-5 h-5 mr-3 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Suhu dan cuaca diambil otomatis dari sumber data BMKG sesuai lokasi pos lapangan Anda.
    </div>

</div>
@endsection