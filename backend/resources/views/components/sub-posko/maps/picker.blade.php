@props([
    'latInputId' => 'latitude',
    'lngInputId' => 'longitude',
    'latValue' => old('latitude'),
    'lngValue' => old('longitude'),
    'height' => '380px'
])

<div class="space-y-3">
    {{-- Header Control & Button Deteksi --}}
    <div class="flex items-center justify-between">
        <span class="text-xs text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-full font-medium">
            Klik peta / geser marker untuk ubah lokasi
        </span>
        <button type="button" id="btn-auto-locate" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded-lg text-xs font-semibold transition border border-indigo-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Deteksi Lokasi Saya
        </button>
    </div>

    {{-- Container Peta --}}
    <div id="map" class="w-full rounded-lg border border-gray-300 shadow-inner z-0" style="height: {{ $height }};"></div>

    {{-- Input Hidden/Display Latitude Longitude --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Latitude</label>
            <input type="text" id="{{ $latInputId }}" name="{{ $latInputId }}" value="{{ $latValue ?? '-7.7956' }}" placeholder="-7.xxxxx" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm font-mono bg-gray-50">
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Longitude</label>
            <input type="text" id="{{ $lngInputId }}" name="{{ $lngInputId }}" value="{{ $lngValue ?? '110.3695' }}" placeholder="110.xxxxx" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm font-mono bg-gray-50">
        </div>
    </div>
</div>

@push('styles')
    {{-- Leaflet CSS & Fullscreen Plugin CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-fullscreen@1.0.2/dist/leaflet.fullscreen.css" />
    <style>
        .leaflet-pane { z-index: 10 !important; }
        .leaflet-top, .leaflet-bottom { z-index: 20 !important; }
    </style>
@endpush

@push('scripts')
    {{-- Leaflet JS & Fullscreen Plugin JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-fullscreen@1.0.2/dist/Leaflet.fullscreen.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const latInput = document.getElementById('{{ $latInputId }}');
            const lngInput = document.getElementById('{{ $lngInputId }}');
            const btnAutoLocate = document.getElementById('btn-auto-locate');

            let initialLat = parseFloat(latInput.value) || -7.7956;
            let initialLng = parseFloat(lngInput.value) || 110.3695;

            // 1. Definisikan Multi Layer
            const osmStreet = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap'
            });

            const esriSatellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 18,
                attribution: 'Tiles &copy; Esri'
            });

            // 2. Inisialisasi Peta dengan Fitur Fullscreen
            const map = L.map('map', {
                center: [initialLat, initialLng],
                zoom: 14,
                layers: [osmStreet],
                fullscreenControl: true, 
                fullscreenControlOptions: { position: 'topleft' }
            });

            // 3. Tambahkan Toggle Pengontrol Layer
            const baseMaps = {
                "Peta Jalan": osmStreet,
                "Satelit": esriSatellite
            };
            L.control.layers(baseMaps, null, { position: 'topright' }).addTo(map);

            // 4. Tambahkan Marker Draggable
            let marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);

            function updateInputs(lat, lng) {
                latInput.value = lat.toFixed(6);
                lngInput.value = lng.toFixed(6);
            }

            // Event Klik & Drag Marker
            map.on('click', function (e) {
                marker.setLatLng(e.latlng);
                updateInputs(e.latlng.lat, e.latlng.lng);
            });

            marker.on('dragend', function () {
                const pos = marker.getLatLng();
                updateInputs(pos.lat, pos.lng);
            });

            // Sync Manual Input ke Marker
            function updateFromInputs() {
                const lat = parseFloat(latInput.value);
                const lng = parseFloat(lngInput.value);
                if (!isNaN(lat) && !isNaN(lng)) {
                    marker.setLatLng([lat, lng]);
                    map.panTo([lat, lng]);
                }
            }
            latInput.addEventListener('change', updateFromInputs);
            lngInput.addEventListener('change', updateFromInputs);

            // 5. Fungsi Deteksi Geolocation Otomatis
            function autoDetectLocation(isInitial = false) {
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;

                            marker.setLatLng([lat, lng]);
                            map.setView([lat, lng], 16);
                            updateInputs(lat, lng);
                        },
                        function (error) {
                            if (!isInitial) alert("Gagal mendeteksi lokasi. Pastikan izin lokasi (GPS) di browser aktif.");
                        },
                        { enableHighAccuracy: true, timeout: 10000 }
                    );
                } else if (!isInitial) {
                    alert("Browser Anda tidak mendukung deteksi lokasi.");
                }
            }

            // Jalankan deteksi otomatis saat pertama kali dibuka jika belum ada old value
            @if(!old('latitude'))
                autoDetectLocation(true);
            @endif

            // Tombol Manual Trigger Deteksi Lokasi
            btnAutoLocate.addEventListener('click', () => autoDetectLocation(false));
        });
    </script>
@endpush