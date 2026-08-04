@extends('layouts.master')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-sm border border-gray-100">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Daftarkan Posko Komando</h1>

    <form action="{{ route('admin.posko.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nama Posko</label>
            <input type="text" name="nama_posko" value="{{ old('nama_posko') }}"
                class="mt-1 block w-full border rounded px-3 py-2">
            @error('nama_posko') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}"
                class="mt-1 block w-full border rounded px-3 py-2">
            @error('penanggung_jawab') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Alamat</label>
            <input type="text" value="{{ $bpbd->alamat_kantor }}" disabled
                class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100 text-gray-500">
            <p class="text-xs text-gray-400 mt-1">Otomatis mengikuti alamat kantor BPBD</p>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Daftarkan</button>
    </form>
</div>
@endsection