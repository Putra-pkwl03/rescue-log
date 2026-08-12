<div id="modalDetail" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-xl border border-gray-100 space-y-4">
        <div class="flex items-center justify-between border-b pb-3">
            <h3 class="text-lg font-bold text-gray-800">Detail Permintaan Logistik</h3>
            <button onclick="closeModalDetail()" class="text-gray-400 hover:text-gray-600 text-xl font-bold cursor-pointer">&times;</button>
        </div>

        <div class="space-y-3 text-sm text-gray-600">
            <p><strong>Status:</strong> <span id="detailStatus" class="font-semibold"></span></p>
            <p><strong>Catatan/Alasan:</strong> <span id="detailCatatan" class="italic text-gray-500"></span></p>
        </div>

        <div class="flex justify-end pt-4 border-t">
            <button onclick="closeModalDetail()" type="button" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg cursor-pointer transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function closeModalDetail() {
        document.getElementById('modalDetail').classList.add('hidden');
        document.getElementById('modalDetail').classList.remove('flex');
    }
</script>