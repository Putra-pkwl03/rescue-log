@extends('layouts.app-lapangan')

@section('content')
    <div class="space-y-6">

        <!-- Header Halaman & Tombol Aksi -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <x-sub-posko.page-header title="Pendataan Pengungsi (KK)"
                description="Kelola data Kartu Keluarga dan kategori khusus pengungsi di pos lapangan.">
            </x-sub-posko.page-header>

            <!-- Tombol Tambah Data KK Baru -->
            <a href="#"
                class="inline-flex items-center justify-center bg-purple-600 hover:bg-purple-700 text-white font-medium px-4 py-2.5 rounded-xl text-sm shadow-sm transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                + Tambah Data KK
            </a>
        </div>

        <!-- Ringkasan Statistik Cepat di Halaman Pengungsi -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex items-center space-x-4">
                <div class="p-3 rounded-xl bg-purple-50 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Kepala Keluarga</p>
                    <h4 class="text-xl font-bold text-gray-800">52 KK</h4>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex items-center space-x-4">
                <div class="p-3 rounded-xl bg-blue-50 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Jiwa Terdaftar</p>
                    <h4 class="text-xl font-bold text-gray-800">186 Jiwa</h4>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex items-center space-x-4">
                <div class="p-3 rounded-xl bg-amber-50 text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Kategori Rentan</p>
                    <h4 class="text-xl font-bold text-gray-800">42 Orang</h4>
                </div>
            </div>
        </div>

        <!-- Tabel Data Pengungsi -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <th class="py-3.5 px-6">No. KK & Kepala Keluarga</th>
                            <th class="py-3.5 px-6">Asal Desa/Dusun</th>
                            <th class="py-3.5 px-6 text-center">Jumlah Anggota</th>
                            <th class="py-3.5 px-6">Rincian Kategori Khusus</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">

                        <!-- Contoh Baris Data 1 -->
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 px-6">
                                <span class="font-bold text-gray-900">Bapak Ahmad Zaelani</span>
                                <p class="text-xs text-gray-400 mt-0.5">NIK: 3201**********12</p>
                            </td>
                            <td class="py-4 px-6 text-gray-600">
                                Dusun Sukamaju (RT 02/01)
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-1 text-xs font-semibold bg-purple-50 text-purple-700 rounded-full">5
                                    Jiwa</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-wrap gap-1.5">
                                    <span class="px-2 py-0.5 text-xs bg-blue-50 text-blue-700 rounded-md font-medium">1
                                        Balita</span>
                                    <span class="px-2 py-0.5 text-xs bg-amber-50 text-amber-700 rounded-md font-medium">1
                                        Lansia</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="#"
                                    class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 rounded-lg text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition shadow-sm">Edit</a>
                                <a href="#"
                                    class="inline-flex items-center px-2.5 py-1.5 border border-red-200 rounded-lg text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 transition">Hapus</a>
                            </td>
                        </tr>

                        <!-- Contoh Baris Data 2 -->
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 px-6">
                                <span class="font-bold text-gray-900">Ibu Siti Aminah</span>
                                <p class="text-xs text-gray-400 mt-0.5">NIK: 3201**********45</p>
                            </td>
                            <td class="py-4 px-6 text-gray-600">
                                Dusun Sukamaju (RT 03/01)
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-1 text-xs font-semibold bg-purple-50 text-purple-700 rounded-full">3
                                    Jiwa</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-wrap gap-1.5">
                                    <span class="px-2 py-0.5 text-xs bg-pink-50 text-pink-700 rounded-md font-medium">1 Ibu
                                        Hamil</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="#"
                                    class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 rounded-lg text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition shadow-sm">Edit</a>
                                <a href="#"
                                    class="inline-flex items-center px-2.5 py-1.5 border border-red-200 rounded-lg text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 transition">Hapus</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Paginasi Footer -->
            <div
                class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500 gap-2">
                <span>Menampilkan data Kartu Keluarga pengungsi aktif</span>
                <div class="flex items-center space-x-1">
                    <span
                        class="px-3 py-1 rounded bg-white border border-gray-300 text-gray-400 cursor-not-allowed">Sebelumnya</span>
                    <span class="px-3 py-1 rounded bg-purple-600 text-white font-medium">1</span>
                    <span
                        class="px-3 py-1 rounded bg-white border border-gray-300 text-gray-400 cursor-not-allowed">Selanjutnya</span>
                </div>
            </div>
        </div>

    </div>
@endsection
