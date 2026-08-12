<!-- MODAL KONFIRMASI STYLED TAILWIND -->
<div id="customConfirmModal" class="fixed inset-0 z-50 hidden bg-slate-900/70 backdrop-blur-xs flex items-center justify-center p-4 transition-all">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl border border-gray-100 text-center space-y-4">
        
        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>

        <div>
            <h4 class="text-base font-bold text-gray-900">Konfirmasi Penerimaan</h4>
            <p class="text-xs text-gray-500 mt-1">Apakah Anda yakin seluruh barang bantuan di atas telah diterima dengan lengkap di posko lapangan?</p>
        </div>

        <form id="modalConfirmForm" method="POST" action="">
            @csrf
            <div class="grid grid-cols-2 gap-3 pt-2">
                <button type="button" onclick="closeConfirmModal()" class="w-full py-2.5 bg-gray-100 hover:bg-gray-200 rounded-xl text-gray-700 text-xs font-bold transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition shadow-sm cursor-pointer">
                    Ya, Sudah Sesuai
                </button>
            </div>
        </form>

    </div>
</div>