@extends('layouts.master')

@section('content')
<!-- Header Posko Komando -->
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Posko Komando</h1>
        <p class="text-gray-600 mt-1">
            Menaungi Operasional Bencana: <span class="font-semibold text-red-600">{{ $posko->bencana->jenis_bencana ?? 'Siaga Operasional' }}</span>
        </p>
    </div>
    <div class="mt-4 md:mt-0">
        <span class="px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">
            ● Status: {{ ucfirst($posko->status) }}
        </span>
    </div>
</div>

<!-- SECTION KODE AKSES PETUGAS LAPANGAN (Fitur Kunci) -->
<div class="bg-linear-to-r from-blue-600 to-indigo-700 rounded-lg p-6 text-white mb-8 shadow-md">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold">Kode Akses Posko Lapangan</h2>
            <p class="text-blue-100 text-sm mt-1">
                Bagikan kode ini kepada tim lapangan untuk mendaftarkan atau masuk sebagai Posko Kecil.
            </p>
        </div>
        <div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-lg px-6 py-3 text-center">
            <span class="block text-xs uppercase tracking-wider text-blue-200 font-semibold">Kode Undangan</span>
            <span class="text-2xl font-mono font-extrabold tracking-widest text-white">
                {{ $posko->kode_undangan ?? 'BELUM SET' }}
            </span>
        </div>
    </div>
</div>

<!-- Ringkasan Statistik Operasional -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
        <p class="text-sm font-medium text-gray-500">Total Posko Kecil Active</p>
        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $posko->children_count ?? 0 }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
        <p class="text-sm font-medium text-gray-500">Total Pengungsi Terdata</p>
        <p class="text-3xl font-bold text-green-600 mt-2">0 Jiwa</p>
    </div>
    <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
        <p class="text-sm font-medium text-gray-500">Permintaan Logistik Masuk</p>
        <p class="text-3xl font-bold text-orange-500 mt-2">0 Masuk</p>
    </div>
</div>

<!-- Daftar Posko Kecil dibawah Nauangan -->
<div class="bg-white rounded-lg border border-gray-100 shadow-sm p-6 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold text-gray-800">Daftar Posko Kecil / Lapangan</h2>
    </div>

    @if($posko->children->isEmpty())
        <div class="text-center py-8 text-gray-500">
            <p class="mb-2">Belum ada Posko Kecil yang terhubung.</p>
            <p class="text-xs">Gunakan Kode Akses di atas untuk menambahkan petugas/posko lapangan.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="p-3">Nama Posko</th>
                        <th class="p-3">Lokasi</th>
                        <th class="p-3">Penanggung Jawab</th>
                        <th class="p-3">Kapasitas</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($posko->children as $child)
                        <tr>
                            <td class="p-3 font-semibold text-gray-800">{{ $child->nama_posko }}</td>
                            <td class="p-3">{{ $child->lokasi ?? '-' }}</td>
                            <td class="p-3">{{ $child->penanggung_jawab }} ({{ $child->kontak_hp }})</td>
                            <td class="p-3">{{ $child->kapasitas_maksimal }} Jiwa</td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded font-medium bg-green-100 text-green-700">
                                    {{ $child->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection