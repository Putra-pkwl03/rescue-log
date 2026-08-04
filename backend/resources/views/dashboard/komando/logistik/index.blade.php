@extends('layouts.app')

@section('content')
    <!-- JUDUL & PENJELASAN HALAMAN (DISAMAKAN DENGAN DASHBOARD) -->
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Data Logistik</h1>
    <p class="text-base text-gray-700 mt-2">Kelola dan pantau ketersediaan stok barang serta pengajuan kebutuhan logistik posko.</p>
</div>

    <!-- BANNER AI PREDIKSI STOK LOGISTIK -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-700 via-indigo-700 to-blue-800 rounded-2xl p-6 text-white shadow-xl flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex items-start gap-4 z-10">
            <div class="w-12 h-12 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center shrink-0 text-amber-300">
                <i data-lucide="cpu" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h2 class="text-lg font-bold tracking-tight">AI Prediksi Stok Logistik</h2>
                    <span class="px-2.5 py-0.5 text-xs font-bold bg-amber-400 text-slate-900 rounded-md uppercase tracking-wider shadow-sm">AKTIF</span>
                </div>
                <p class="text-blue-100 text-sm leading-relaxed max-w-3xl">
                    Sistem mendeteksi lonjakan permintaan di <strong class="text-white font-semibold">Sektor Timur</strong>. Berdasarkan model Machine Learning, stok <strong class="text-amber-300 font-semibold">Beras dan Selimut</strong> diprediksi akan habis dalam waktu <strong class="text-amber-300 font-semibold">3 hari ke depan</strong>. Disarankan untuk segera melakukan pengadaan.
                </p>
            </div>
        </div>

        <div class="z-10 shrink-0">
            <a href="#" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-100 text-slate-900 font-semibold text-sm rounded-xl shadow-md transition-all">
                <span>Lihat Analisis Rinci</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>

<!-- 4 KOTAK STATISTIK / RINGKASAN (DIBERI JARAK ATAS & BAWAH: my-6) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 my-6">
        <!-- Card 1 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Total Jenis Barang</p>
                <h3 class="text-3xl font-bold text-slate-900">145</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100">
                <i data-lucide="box" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Kondisi Baik</p>
                <h3 class="text-3xl font-bold text-slate-900">132</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100">
                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Stok Menipis</p>
                <h3 class="text-3xl font-bold text-slate-900">8</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100">
                <i data-lucide="alert-triangle" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Dalam Pengiriman</p>
                <h3 class="text-3xl font-bold text-slate-900">5</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center border border-purple-100">
                <i data-lucide="truck" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- TAB NAVIGASI ATAS -->
<div class="flex border-b border-slate-200 gap-8 my-6">
    <a href="#" class="pb-3 text-blue-600 border-b-2 border-blue-600 font-semibold text-sm">Daftar Pengajuan</a>
    <a href="#" class="pb-3 text-slate-500 hover:text-slate-800 text-sm font-medium">Prediksi Kebutuhan (ML)</a>
    <a href="#" class="pb-3 text-slate-500 hover:text-slate-800 text-sm font-medium">Riwayat Pengajuan</a>
</div>

    <!-- FILTER & PENCARIAN -->
  <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex flex-wrap items-center justify-between gap-4 my-6">
    <div class="flex flex-wrap items-center gap-3 flex-1">
        <div class="relative min-w-[280px] flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" placeholder="Cari posko, nomor pengajuan, atau barang..." class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <select class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-600 focus:outline-none">
            <option value="">Semua Status</option>
            <option value="menunggu">Menunggu Persetujuan</option>
            <option value="disetujui">Disetujui</option>
            <option value="ditolak">Ditolak</option>
        </select>

        <select class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-600 focus:outline-none">
            <option value="">Semua Posko</option>
            <option value="sukamaju">Posko Kecil Sukamaju</option>
            <option value="harapan">Posko Kecil Harapan Jaya</option>
        </select>

        <div class="flex items-center gap-2 px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-600">
            <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i>
            <span>01/05/2025 - 08/05/2025</span>
        </div>
    </div>

    <button class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
        <i data-lucide="filter" class="w-4 h-4"></i>
        Filter
    </button>
</div>

    <!-- TABEL DATA -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 text-xs font-semibold uppercase tracking-wider border-b border-slate-200">
                        <th class="py-4 px-6">No. Pengajuan</th>
                        <th class="py-4 px-6">Posko Kecil</th>
                        <th class="py-4 px-6">Tanggal Pengajuan</th>
                        <th class="py-4 px-6">Total Item</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6">Ringkasan Kebutuhan</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                    <!-- Contoh Baris 1 -->
                    <tr>
                        <td class="py-4 px-6 font-medium text-slate-900">REQ-2025-000128</td>
                        <td class="py-4 px-6">
                            <div class="font-medium text-slate-900">Posko Kecil Sukamaju</div>
                            <div class="text-xs text-slate-500">Kec. Sukamaju, Kab. Mandiri</div>
                        </td>
                        <td class="py-4 px-6">
                            <div>08 Mei 2025</div>
                            <div class="text-xs text-slate-500">10:30 WIB</div>
                        </td>
                        <td class="py-4 px-6">
                            <div>6 Jenis</div>
                            <div class="text-xs text-slate-500">120 Item</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-amber-50 text-amber-700 rounded-full">Menunggu Persetujuan</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-1.5 text-xs text-slate-500">
                                <span class="w-6 h-6 bg-slate-100 rounded flex items-center justify-center font-bold">📦</span>
                                <span class="w-6 h-6 bg-slate-100 rounded flex items-center justify-center font-bold">🥛</span>
                                <span>+3 lainnya</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="inline-flex items-center gap-1 relative">
                                <button class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg">Detail</button>
                                <!-- Tombol Dropdown Aksi -->
                                <div class="relative dropdown-container">
                                    <button onclick="toggleDropdown(this)" class="p-1.5 bg-slate-100 hover:bg-slate-200 rounded-lg text-slate-600">
                                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                                    </button>
                                    <!-- Menu Dropdown -->
                                    <div class="hidden absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-xl shadow-lg py-1.5 z-50 text-left text-xs">
                                        <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-slate-50 text-slate-700"><i data-lucide="file-text" class="w-4 h-4"></i> Detail Lengkap</a>
                                        <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-slate-50 text-emerald-600"><i data-lucide="check-circle" class="w-4 h-4"></i> Setujui</a>
                                        <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-slate-50 text-blue-600"><i data-lucide="check" class="w-4 h-4"></i> Setujui Sebagian</a>
                                        <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-slate-50 text-red-600"><i data-lucide="x-circle" class="w-4 h-4"></i> Tolak</a>
                                        <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-slate-50 text-slate-600"><i data-lucide="history" class="w-4 h-4"></i> Riwayat</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="p-4 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500">
            <div>Menampilkan 1 - 5 dari 128 data</div>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 border border-slate-200 rounded hover:bg-slate-50">&lt;</button>
                <button class="px-3 py-1.5 bg-blue-600 text-white rounded font-medium">1</button>
                <button class="px-3 py-1.5 border border-slate-200 rounded hover:bg-slate-50">2</button>
                <button class="px-3 py-1.5 border border-slate-200 rounded hover:bg-slate-50">3</button>
                <span class="px-2">...</span>
                <button class="px-3 py-1.5 border border-slate-200 rounded hover:bg-slate-50">26</button>
                <button class="px-3 py-1.5 border border-slate-200 rounded hover:bg-slate-50">&gt;</button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT DROPDOWN -->
<script>
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        document.querySelectorAll('.dropdown-container div.absolute').forEach(el => {
            if (el !== dropdown) el.classList.add('hidden');
        });
        dropdown.classList.toggle('hidden');
    }

    window.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown-container')) {
            document.querySelectorAll('.dropdown-container div.absolute').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });
</script>
@endsection