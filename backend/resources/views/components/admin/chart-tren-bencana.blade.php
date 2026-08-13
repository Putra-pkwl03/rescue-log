<div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-full">
    <div>
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-sm font-bold text-gray-800">Tren Kejadian Bencana</h2>
            <select class="text-[11px] border border-gray-200 rounded-lg px-2 py-1 bg-gray-50 text-gray-600 font-medium focus:outline-none">
                <option>7 Hari Terakhir</option>
                <option>30 Hari Terakhir</option>
            </select>
        </div>
        
        <div class="h-44 w-full relative my-2">
            <canvas id="chartTren"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-3 mt-3">
        <div class="bg-red-50/60 p-2.5 rounded-xl border border-red-100">
            <span class="text-[10px] font-semibold text-gray-500">Total Bencana</span>
            <div class="flex items-baseline gap-1.5">
                <span class="text-base font-extrabold text-gray-900">8</span>
                <span class="text-[10px] font-bold text-emerald-600">▼ 20% <span class="font-normal text-gray-400">bln lalu</span></span>
            </div>
        </div>
        <div class="bg-emerald-50/60 p-2.5 rounded-xl border border-emerald-100">
            <span class="text-[10px] font-semibold text-gray-500">Bencana Selesai</span>
            <div class="flex items-baseline gap-1.5">
                <span class="text-base font-extrabold text-gray-900">6</span>
                <span class="text-[10px] font-bold text-emerald-600">▲ 50% <span class="font-normal text-gray-400">bln lalu</span></span>
            </div>
        </div>
    </div>
</div>