<div
    class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
    <!-- Form Search & Filter Status -->
    <form action="{{ route('komando.pengajuan.index') }}" method="GET"
        class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto flex-1">

        <!-- Input Search -->
        <div class="relative w-full sm:w-72">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari kode pengajuan / bencana..."
                class="w-full h-10 pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
        </div>

        <!-- Filter Status -->
        <div class="w-full sm:w-52">
            <select name="status" onchange="this.form.submit()"
                class="w-full h-10 px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none cursor-pointer bg-white">
                <option value="">-- Semua Status --</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending (Menunggu)
                </option>
                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui Penuh
                </option>
                <option value="disetujui_sebagian" {{ request('status') == 'disetujui_sebagian' ? 'selected' : '' }}>
                    Disetujui Sebagian</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <!-- Tombol Reset Filter Oranye -->
        @if (request('search') || request('status'))
            <a href="{{ route('komando.pengajuan.index') }}"
                class="w-full sm:w-auto h-10 px-4 inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-lg transition shadow-sm whitespace-nowrap shrink-0">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                    </path>
                </svg>
                Reset Filter
            </a>
        @endif
    </form>

    <!-- Tombol Tambah Pengajuan -->
    <button onclick="openModalCreate()" type="button"
        class="w-full md:w-auto shrink-0 h-10 inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition shadow-sm whitespace-nowrap cursor-pointer">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Buat Pengajuan Kebutuhan
    </button>
</div>
