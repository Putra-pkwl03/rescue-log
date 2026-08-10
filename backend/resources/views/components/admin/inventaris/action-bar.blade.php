<div class="p-5 border-b border-gray-200 bg-gray-50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div class="relative flex-1 max-w-md">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </span>
        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari nama barang atau kategori..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
    </div>

    <div class="flex items-center space-x-3">
        <span class="text-sm font-semibold text-gray-600">Filter Kategori:</span>
        <select id="kategoriFilter" onchange="filterTable()" class="bg-white border border-gray-300 text-gray-700 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 shadow-sm">
            <option value="">Semua Kategori</option>
            <option value="Makanan & Minuman">Makanan & Minuman</option>
            <option value="Medis & Kesehatan">Medis & Kesehatan</option>
            <option value="Perlengkapan & Tenda">Perlengkapan & Tenda</option>
            <option value="Pakaian & Selimut">Pakaian & Selimut</option>
        </select>
    </div>
</div>

<script>
function filterTable() {
    let search = document.getElementById('searchInput').value.toLowerCase();
    let kategori = document.getElementById('kategoriFilter').value.toLowerCase();
    let rows = document.querySelectorAll('#inventarisTableBody tr.item-row');

    rows.forEach(row => {
        let nama = row.getAttribute('data-nama').toLowerCase();
        let kat = row.getAttribute('data-kategori').toLowerCase();
        
        let matchSearch = nama.includes(search) || kat.includes(search);
        let matchKategori = kategori === '' || kat === kategori;

        if (matchSearch && matchKategori) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>