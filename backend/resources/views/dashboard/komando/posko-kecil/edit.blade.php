@extends('layouts.app')

@section('title', 'Edit Posko Kecil - SiGap BPBD')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 pb-12">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Posko Kecil</h1>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui informasi dan lokasi posko lapangan.</p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('komando.posko-kecil.show', $subPosko->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 rounded-xl text-xs font-semibold shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    {{-- Form Edit --}}
    <form action="{{ route('komando.posko-kecil.update', $subPosko->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm space-y-6">
        @csrf
        @method('PUT')

        {{-- Section 1: Informasi Utama --}}
        <div>
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4">Informasi Utama Posko</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                {{-- Nama Posko --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Posko <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_posko" value="{{ old('nama_posko', $subPosko->nama_posko) }}" required placeholder="Contoh: Posko Lapangan Kebonagung"
                           class="w-full text-xs rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 @error('nama_posko') border-rose-500 @enderror">
                    @error('nama_posko') <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Bencana Terkait --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Bencana Terkait <span class="text-rose-500">*</span></label>
                    <select name="bencana_id" required class="w-full text-xs rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 @error('bencana_id') border-rose-500 @enderror">
                        <option value="">-- Pilih Bencana --</option>
                        @foreach($bencanaAktif as $bencana)
                            <option value="{{ $bencana->id }}" {{ old('bencana_id', $subPosko->bencana_id) == $bencana->id ? 'selected' : '' }}>
                                {{ $bencana->jenis_bencana }} - {{ $bencana->lokasi ?? 'Umum' }}
                            </option>
                        @endforeach
                    </select>
                    @error('bencana_id') <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Penanggung Jawab --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Penanggung Jawab <span class="text-rose-500">*</span></label>
                    <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab', $subPosko->penanggung_jawab) }}" required placeholder="Nama Lengkap PJ"
                           class="w-full text-xs rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 @error('penanggung_jawab') border-rose-500 @enderror">
                    @error('penanggung_jawab') <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Kontak HP --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">No. WhatsApp / HP</label>
                    <input type="text" name="kontak_hp" value="{{ old('kontak_hp', $subPosko->kontak_hp) }}" placeholder="08xxxxxxxxxx"
                           class="w-full text-xs rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 @error('kontak_hp') border-rose-500 @enderror">
                    @error('kontak_hp') <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Jumlah Petugas --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jumlah Petugas (Estimasi)</label>
                    <input type="number" min="0" name="jumlah_petugas" value="{{ old('jumlah_petugas', $subPosko->jumlah_petugas) }}" placeholder="0"
                           class="w-full text-xs rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 @error('jumlah_petugas') border-rose-500 @enderror">
                    @error('jumlah_petugas') <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Upload Foto Posko --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Foto Posko (Opsional)</label>
                    <div class="flex items-center gap-3">
                        @if($subPosko->foto)
                            <img src="{{ asset('storage/' . $subPosko->foto) }}" alt="Preview Foto" class="w-10 h-10 object-cover rounded-lg border border-slate-200">
                        @endif
                        <input type="file" name="foto" accept="image/*"
                               class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                    </div>
                    @error('foto') <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- Section 2: Lokasi & Koordinat --}}
        <div>
            <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4">Lokasi & Pemetaan</h3>
            <div class="space-y-4">
                {{-- Alamat / Deskripsi Lokasi --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat / Deskripsi Lokasi</label>
                    <textarea name="lokasi" rows="2" placeholder="Jl. Raya Kebonagung No. 12, RT 02/RW 05..."
                              class="w-full text-xs rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 @error('lokasi') border-rose-500 @enderror">{{ old('lokasi', $subPosko->lokasi) }}</textarea>
                    @error('lokasi') <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Map Picker --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Klik Peta untuk Mengubah Koordinat</label>
                    <div id="mapPicker" class="h-64 rounded-xl border border-slate-200 overflow-hidden z-0 mb-3"></div>
                </div>

                {{-- Input Latitude & Longitude --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Latitude</label>
                        <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $subPosko->latitude) }}" readonly placeholder="-7.xxxxxx"
                               class="w-full text-xs bg-slate-50 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('latitude') <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Longitude</label>
                        <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $subPosko->longitude) }}" readonly placeholder="110.xxxxxx"
                               class="w-full text-xs bg-slate-50 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('longitude') <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit Buttons --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('komando.posko-kecil.show', $subPosko->id) }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition">
                Batal
            </a>
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-sm transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const defaultLat = {{ $subPosko->latitude ?? -7.7956 }};
            const defaultLng = {{ $subPosko->longitude ?? 110.3695 }};

            const map = L.map('mapPicker').setView([defaultLat, defaultLng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            let marker;

            // Jika latitude & longitude awal ada, pasang marker
            @if($subPosko->latitude && $subPosko->longitude)
                marker = L.marker([defaultLat, defaultLng]).addTo(map);
            @endif

            // Klik peta untuk memilih lokasi baru
            map.on('click', function (e) {
                const lat = e.latlng.lat.toFixed(6);
                const lng = e.latlng.lng.toFixed(6);

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(map);
                }
            });
        });
    </script>
@endpush