@extends('layouts.app')

@section('title', 'Detail Posko Kecil - SiGap BPBD')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 pb-12">

    {{-- Alert --}}
    <x-sub-posko.alert />

    <x-sub-posko.detail.header :subPosko="$subPosko" />

    {{-- Hero Card --}}
    <x-sub-posko.detail.hero-card :subPosko="$subPosko" />

    {{-- Navigation Tabs --}}
    <x-sub-posko.detail.nav-tabs />

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        {{-- LEFT COLUMN --}}
        <div class="lg:col-span-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <x-sub-posko.detail.info-general :subPosko="$subPosko" />
                <x-sub-posko.detail.info-summary :subPosko="$subPosko" />
            </div>

            <x-sub-posko.detail.user-table :users="$subPosko->users" />
        </div>

        {{-- RIGHT SIDEBAR --}}
        <div class="lg:col-span-4 space-y-6">
            <x-sub-posko.detail.mini-map :subPosko="$subPosko" />
            <x-sub-posko.detail.documentation :subPosko="$subPosko" />
        </div>

    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* CSS agar Peta Memenuhi Layar secara Sempurna saat Fullscreen */
        #mapWrapper:fullscreen {
            width: 100vw !important;
            height: 100vh !important;
            border-radius: 0 !important;
            background-color: #ffffff;
        }
        #mapWrapper:fullscreen #miniMap {
            height: 100vh !important;
            width: 100vw !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        let mapInstance;

        document.addEventListener('DOMContentLoaded', function () {
            const lat = {{ $subPosko->latitude ?? -7.7956 }};
            const lng = {{ $subPosko->longitude ?? 110.3695 }};

            // Layer 1: Peta Jalan (OpenStreetMap)
            const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap'
            });

            // Layer 2: Peta Satelit (Esri World Imagery)
            const satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 19,
                attribution: 'Tiles &copy; Esri'
            });

            // Inisialisasi Peta
            mapInstance = L.map('miniMap', {
                center: [lat, lng],
                zoom: 13,
                layers: [osm]
            });

            // Pilihan Control Layer
            const baseMaps = {
                "Peta Jalan": osm,
                "Satelit": satellite
            };

            L.control.layers(baseMaps).addTo(mapInstance);

            // Marker Posko
            @if($subPosko->latitude && $subPosko->longitude)
                L.marker([lat, lng])
                    .addTo(mapInstance)
                    .bindPopup(`
                        <div class="text-xs font-sans">
                            <strong class="font-bold block mb-1">{{ $subPosko->nama_posko }}</strong>
                            <p class="text-slate-500">{{ $subPosko->lokasi }}</p>
                        </div>
                    `)
                    .openPopup();
            @endif
        });

        // Event handler saat toggle fullscreen (memaksa Leaflet menggambar ulang ubin peta)
        document.addEventListener('fullscreenchange', function () {
            if (mapInstance) {
                setTimeout(() => {
                    mapInstance.invalidateSize();
                }, 150);
            }
        });

        function toggleMapFullscreen() {
            const mapContainer = document.getElementById('mapWrapper');
            if (!document.fullscreenElement) {
                if (mapContainer.requestFullscreen) {
                    mapContainer.requestFullscreen();
                } else if (mapContainer.webkitRequestFullscreen) {
                    mapContainer.webkitRequestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }
    </script>
@endpush