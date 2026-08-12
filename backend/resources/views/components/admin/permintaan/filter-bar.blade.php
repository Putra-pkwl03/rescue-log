<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
    <form action="{{ route('komando.logistik.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3 w-full">
        
        <!-- Search Input -->
        <div class="relative w-full sm:w-80">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode pengajuan / pemohon..." class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
        </div>

        <!-- Filter Status -->
        <div class="w-full sm:w-48">
            <select name="status" onchange="this.form.submit()" class="w-full py-2 px-3 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                <option value="">-- Semua Status --</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu BPBD</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>Disetujui Sebagian</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        @if(request('search') || request('status'))
            <a href="{{ route('komando.logistik.index') }}" class="text-xs text-rose-600 hover:underline shrink-0">Reset Filter</a>
        @endif
    </form>
</div>