@extends('layouts.app')

@section('content')
<!-- JUDUL & PENJELASAN HALAMAN -->
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Data Logistik</h1>
    <p class="text-base text-gray-700 mt-2">Kelola dan pantau ketersediaan stok barang serta pengajuan kebutuhan logistik posko.</p>
</div>

<!-- ALERT NOTIFIKASI -->
@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
@endif

<!-- BANNER AI PREDIKSI STOK LOGISTIK -->
<div class="relative overflow-hidden bg-gradient-to-r from-blue-700 via-indigo-700 to-blue-800 rounded-2xl p-6 text-white shadow-xl flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-6">
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
                Sistem Machine Learning aktif memantau tren pengajuan dari seluruh posko lapangan. Kebutuhan barang secara otomatis terintegrasi langsung dengan baseline data pengungsi dan kondisi wilayah.
            </p>
        </div>
    </div>
</div>

<!-- 4 KOTAK STATISTIK RINGKASAN DATA -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 my-6">
    <!-- Card 1: Total Pengajuan -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Total Pengajuan</p>
            <h3 class="text-3xl font-bold text-slate-900">{{ $pengajuans->total() }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100">
            <i data-lucide="box" class="w-6 h-6"></i>
        </div>
    </div>

    <!-- Card 2: Disetujui -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Disetujui</p>
            <h3 class="text-3xl font-bold text-slate-900">{{ $pengajuans->where('status', 'approved')->count() }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100">
            <i data-lucide="check-circle-2" class="w-6 h-6"></i>
        </div>
    </div>

    <!-- Card 3: Menunggu ACC -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Menunggu ACC</p>
            <h3 class="text-3xl font-bold text-slate-900">{{ $pengajuans->where('status', 'pending')->count() }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100">
            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
        </div>
    </div>

    <!-- Card 4: Ditolak -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Ditolak</p>
            <h3 class="text-3xl font-bold text-slate-900">{{ $pengajuans->where('status', 'rejected')->count() }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center border border-rose-100">
            <i data-lucide="x-circle" class="w-6 h-6"></i>
        </div>
    </div>
</div>

<!-- TAB NAVIGASI ATAS -->
<div class="flex border-b border-slate-200 gap-8 my-6">
    <a href="{{ route('komando.logistik.index') }}" class="pb-3 text-blue-600 border-b-2 border-blue-600 font-semibold text-sm">Daftar Pengajuan</a>
</div>

<!-- FILTER & PENCARIAN -->
<form method="GET" action="{{ route('komando.logistik.index') }}" class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex flex-wrap items-center justify-between gap-4 my-6">
    <div class="flex flex-wrap items-center gap-3 flex-1">
        <!-- Input Pencarian -->
        <div class="relative min-w-[280px] flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor pengajuan atau posko..." class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <!-- Filter Status -->
        <select name="status" class="px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-600 focus:outline-none">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
            <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>Disetujui Sebagian</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </div>

    <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
        <i data-lucide="filter" class="w-4 h-4"></i>
        Filter
    </button>
</form>

<!-- TABEL DATA PENGAJUAN -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-600 text-xs font-semibold uppercase tracking-wider border-b border-slate-200">
                    <th class="py-4 px-6">No. Pengajuan</th>
                    <th class="py-4 px-6">Posko Kecil</th>
                    <th class="py-4 px-6">Tanggal Pengajuan</th>
                    <th class="py-4 px-6">Status</th>
                    <th class="py-4 px-6">Ringkasan Kebutuhan</th>
                    <th class="py-4 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                @forelse($pengajuans as $item)
                    <tr class="hover:bg-slate-50/50 transition">
                        <!-- No. Pengajuan -->
                        <td class="py-4 px-6 font-bold text-slate-900">
                            {{ $item->kode_pengajuan }}
                        </td>

                        <!-- Posko Kecil / User -->
                        <td class="py-4 px-6">
                            <div class="font-medium text-slate-900">{{ $item->user->name ?? 'Posko Lapangan' }}</div>
                            <div class="text-xs text-slate-500">{{ $item->user->email ?? '-' }}</div>
                        </td>

                        <!-- Tanggal -->
                        <td class="py-4 px-6">
                            <div>{{ $item->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-slate-500">{{ $item->created_at->format('H:i') }} WIB</div>
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4 px-6">
                            @if($item->status == 'pending')
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200 rounded-full">
                                    Menunggu Persetujuan
                                </span>
                            @elseif($item->status == 'approved')
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full">
                                    Disetujui Full
                                </span>
                            @elseif($item->status == 'partial')
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 rounded-full">
                                    Disetujui Sebagian
                                </span>
                            @else
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200 rounded-full">
                                    Ditolak
                                </span>
                            @endif
                        </td>

                        <!-- Ringkasan Kebutuhan Barang -->
                        <td class="py-4 px-6">
                            <div class="flex flex-wrap gap-1 text-xs">
                                @if($item->beras_kg > 0)
                                    <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded">Beras: {{ $item->beras_kg }} kg</span>
                                @endif
                                @if($item->air_minum_dus > 0)
                                    <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded">Air: {{ $item->air_minum_dus }} Dus</span>
                                @endif
                                @if($item->makanan_kaleng_pack > 0)
                                    <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded">Mkn Kaleng: {{ $item->makanan_kaleng_pack }} Pk</span>
                                @endif
                                <span class="text-slate-400 self-center">+ item lainnya</span>
                            </div>
                        </td>

                        <!-- Dropdown Aksi (ACC / Partial / Tolak) -->
                        <td class="py-4 px-6 text-right">
                            <div class="inline-flex items-center gap-1 relative">
                                <div class="relative dropdown-container">
                                    <button onclick="toggleDropdown(this)" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 rounded-lg text-slate-700 text-xs font-medium flex items-center gap-1">
                                        <span>Proses</span>
                                        <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                                    </button>

                                    <!-- Menu Dropdown Aksi -->
                                    <div class="hidden absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-xl shadow-lg py-1.5 z-50 text-left text-xs">
                                        
                                        @if($item->status == 'pending')
                                            <!-- Action 1: Approve Full -->
                                            <form action="{{ route('komando.logistik.approve', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Setujui pengajuan ini secara penuh?')" class="w-full flex items-center gap-2 px-4 py-2 hover:bg-emerald-50 text-emerald-600 font-medium">
                                                    <i data-lucide="check-circle" class="w-4 h-4"></i> Setujui (Full)
                                                </button>
                                            </form>

                                            <!-- Action 2: Approve Partial -->
                                            <form action="{{ route('komando.logistik.approve-partial', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Setujui pengajuan ini sebagian?')" class="w-full flex items-center gap-2 px-4 py-2 hover:bg-blue-50 text-blue-600 font-medium">
                                                    <i data-lucide="check" class="w-4 h-4"></i> Setujui Sebagian
                                                </button>
                                            </form>

                                            <!-- Action 3: Reject -->
                                            <form action="{{ route('komando.logistik.reject', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Tolak pengajuan dari posko ini?')" class="w-full flex items-center gap-2 px-4 py-2 hover:bg-rose-50 text-rose-600 font-medium">
                                                    <i data-lucide="x-circle" class="w-4 h-4"></i> Tolak Pengajuan
                                                </button>
                                            </form>
                                        @else
                                            <div class="px-4 py-2 text-slate-400 italic">Pengajuan sudah diproses</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 px-6 text-center text-slate-400">
                            Belum ada data pengajuan logistik dari posko lapangan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION DINAMIS LARAVEL -->
    <div class="p-4 border-t border-slate-200">
        {{ $pengajuans->links() }}
    </div>
</div>

<!-- SCRIPT DROPDOWN TOGGLE -->
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