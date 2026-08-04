@props(['poskos' => [], 'poskoAktif' => 0, 'poskoSiaga' => 0, 'poskoNonaktif' => 0])

<div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-3">
    <div class="flex items-center justify-between">
        <h3 class="text-sm font-bold text-slate-900">Peta Sebaran Posko</h3>
        <span class="text-xs text-slate-400 font-medium">2 Layer Map</span>
    </div>
    
    {{-- Leaflet Container --}}
    <div id="poskoMap" class="h-64 rounded-xl overflow-hidden border border-slate-200 z-0"></div>

    {{-- Legend --}}
    <div class="flex items-center justify-around text-xs pt-1 border-t border-slate-100">
        <div class="flex items-center gap-1.5">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
            <span class="text-slate-600">Aktif: <strong class="text-slate-800">{{ $poskoAktif }}</strong></span>
        </div>
        <div class="flex items-center gap-1.5">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
            <span class="text-slate-600">Siaga: <strong class="text-slate-800">{{ $poskoSiaga }}</strong></span>
        </div>
        <div class="flex items-center gap-1.5">
            <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
            <span class="text-slate-600">Nonaktif: <strong class="text-slate-800">{{ $poskoNonaktif }}</strong></span>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* Penyesuaian Style Tombol Fullscreen agar menyatu dengan Control Leaflet Zoom (+/-) */
        .leaflet-custom-btn {
            background-color: #ffffff !important;
            width: 30px !important;
            height: 30px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            border-bottom: 1px solid #ccc !important;
            text-decoration: none !important;
            color: #334155 !important;
        }
        .leaflet-custom-btn:hover {
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Default Coordinates (misal: Yogyakarta)
            const defaultLat = -7.7956;
            const defaultLng = 110.3695;

            // 1. Layer Street View
            const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap'
            });

            // 2. Layer Satellite View
            const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 18,
                attribution: '&copy; Esri'
            });

            // Inisialisasi Peta
            const map = L.map('poskoMap', {
                center: [defaultLat, defaultLng],
                zoom: 10,
                layers: [streetLayer]
            });

            // Layer Control
            const baseMaps = {
                "Peta Jalan": streetLayer,
                "Satelit": satelliteLayer
            };
            L.control.layers(baseMaps).addTo(map);

            // =========================================================
            // CUSTOM FULLSCREEN CONTROL (PURE JS + SVG HEROICONS)
            // =========================================================
            const FullscreenControl = L.Control.extend({
                options: { position: 'topleft' },
                onAdd: function (map) {
                    const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
                    const button = L.DomUtil.create('a', 'leaflet-custom-btn', container);
                    button.href = '#';
                    button.title = 'Layar Penuh';
                    button.setAttribute('role', 'button');

                    // Icon SVG Layar Penuh (Expand)
                    const iconExpand = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75v4.5m0-4.5h-4.5m4.5 0L15 9m5.25 11.25v-4.5m0 4.5h-4.5m4.5 0L15 15"/></svg>`;
                    
                    // Icon SVG Keluar Layar Penuh (Compress)
                    const iconCompress = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5M15 15l5.25 5.25"/></svg>`;

                    button.innerHTML = iconExpand;

                    const mapContainer = document.getElementById('poskoMap');

                    L.DomEvent.disableClickPropagation(button);
                    L.DomEvent.on(button, 'click', function (e) {
                        L.DomEvent.stop(e);

                        if (!document.fullscreenElement) {
                            if (mapContainer.requestFullscreen) {
                                mapContainer.requestFullscreen();
                            } else if (mapContainer.webkitRequestFullscreen) {
                                mapContainer.webkitRequestFullscreen();
                            } else if (mapContainer.msRequestFullscreen) {
                                mapContainer.msRequestFullscreen();
                            }
                        } else {
                            if (document.exitFullscreen) {
                                document.exitFullscreen();
                            } else if (document.webkitExitFullscreen) {
                                document.webkitExitFullscreen();
                            } else if (document.msExitFullscreen) {
                                document.msExitFullscreen();
                            }
                        }
                    });

                    // Event listener saat mode fullscreen berubah
                    const onFullscreenChange = function () {
                        if (document.fullscreenElement) {
                            button.innerHTML = iconCompress;
                            button.title = 'Keluar Layar Penuh';
                        } else {
                            button.innerHTML = iconExpand;
                            button.title = 'Layar Penuh';
                        }
                        // Resize peta secara otomatis agar tile peta terisi penuh
                        setTimeout(() => map.invalidateSize(), 200);
                    };

                    document.addEventListener('fullscreenchange', onFullscreenChange);
                    document.addEventListener('webkitfullscreenchange', onFullscreenChange);
                    document.addEventListener('mozfullscreenchange', onFullscreenChange);
                    document.addEventListener('MSFullscreenChange', onFullscreenChange);

                    return container;
                }
            });

            // Tambahkan kontrol ke peta
            map.addControl(new FullscreenControl());

            // Data Posko & Marker
            const poskoData = @json($poskos);
            const markers = [];

            if (poskoData.length > 0) {
                poskoData.forEach(posko => {
                    if (posko.latitude && posko.longitude) {
                        const marker = L.marker([posko.latitude, posko.longitude])
                            .bindPopup(`
                                <div class="text-xs font-sans">
                                    <strong class="text-sm font-bold block mb-1">${posko.nama_posko}</strong>
                                    <p class="text-slate-500 mb-1">${posko.lokasi || '-'}</p>
                                    <span class="px-2 py-0.5 text-[10px] rounded-full text-white ${posko.status === 'aktif' ? 'bg-emerald-600' : (posko.status === 'siaga' ? 'bg-amber-600' : 'bg-rose-600')}">
                                        ${posko.status.toUpperCase()}
                                    </span>
                                </div>
                            `);
                        
                        marker.addTo(map);
                        markers.push([posko.latitude, posko.longitude]);
                    }
                });

                if (markers.length > 0) {
                    const bounds = L.latLngBounds(markers);
                    map.fitBounds(bounds, { padding: [20, 20] });
                }
            }
        });
    </script>
@endpush