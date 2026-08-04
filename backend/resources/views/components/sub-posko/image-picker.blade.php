@props([
    'name' => 'foto',
    'label' => 'Foto Dokumentasi Posko',
    'value' => null, // Path foto yang sudah ada (untuk form edit)
])

@php
    $id = $name . '_' . Str::random(5);
    $imageUrl = $value ? Storage::url($value) : null;
@endphp

<div>
    @if($label)
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            {{ $label }}
        </label>
    @endif

    {{-- File Input --}}
    <input type="file" name="{{ $name }}" id="{{ $id }}-input" accept="image/png, image/jpeg, image/jpg, image/webp" class="hidden">

    {{-- Drop Zone Area --}}
    <div id="{{ $id }}-drop-zone" class="relative group border-2 border-dashed border-slate-300 hover:border-indigo-500 bg-slate-50/50 hover:bg-indigo-50/30 rounded-2xl p-5 text-center cursor-pointer transition-all duration-200">
        
        {{-- Prompt Belum Ada File --}}
        <div id="{{ $id }}-prompt" class="space-y-2 {{ $imageUrl ? 'hidden' : '' }}">
            <div class="w-12 h-12 mx-auto rounded-full bg-white shadow-sm border border-slate-200 flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="text-xs text-slate-600">
                <span class="font-semibold text-indigo-600 hover:underline">Klik untuk pilih</span> atau drag & drop gambar di sini
            </div>
            <p class="text-[10px] text-slate-400">PNG, JPG, WEBP hingga 3MB</p>
        </div>

        {{-- Preview Container --}}
        <div id="{{ $id }}-preview-container" class="{{ $imageUrl ? '' : 'hidden' }} relative rounded-xl overflow-hidden group/preview border border-slate-200">
            <img id="{{ $id }}-preview" src="{{ $imageUrl ?? '#' }}" alt="Preview" class="w-full h-44 object-cover">
            <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover/preview:opacity-100 transition-opacity flex items-center justify-center gap-2">
                <button type="button" id="{{ $id }}-btn-change" class="px-3 py-1.5 bg-white/90 hover:bg-white text-slate-800 text-xs font-semibold rounded-lg shadow-sm backdrop-blur-sm transition">
                    Ganti Gambar
                </button>
                <button type="button" id="{{ $id }}-btn-remove" class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                    Hapus
                </button>
            </div>
        </div>

    </div>
    @error($name) <span class="text-xs text-rose-500 mt-1.5 block font-medium">{{ $message }}</span> @enderror
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropZone = document.getElementById('{{ $id }}-drop-zone');
        const fileInput = document.getElementById('{{ $id }}-input');
        const uploadPrompt = document.getElementById('{{ $id }}-prompt');
        const previewContainer = document.getElementById('{{ $id }}-preview-container');
        const imagePreview = document.getElementById('{{ $id }}-preview');
        const btnChangeImage = document.getElementById('{{ $id }}-btn-change');
        const btnRemoveImage = document.getElementById('{{ $id }}-btn-remove');

        dropZone.addEventListener('click', (e) => {
            if (e.target !== btnRemoveImage && e.target !== btnChangeImage) {
                fileInput.click();
            }
        });

        btnChangeImage.addEventListener('click', (e) => {
            e.stopPropagation();
            fileInput.click();
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.add('border-indigo-600', 'bg-indigo-50/50');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.remove('border-indigo-600', 'bg-indigo-50/50');
            }, false);
        });

        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFileSelect(files[0]);
            }
        });

        fileInput.addEventListener('change', function (e) {
            if (this.files && this.files[0]) {
                handleFileSelect(this.files[0]);
            }
        });

        function handleFileSelect(file) {
            if (!file.type.match('image.*')) {
                alert('Silakan pilih berkas berupa gambar (PNG, JPG, WEBP).');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                uploadPrompt.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }

        btnRemoveImage.addEventListener('click', (e) => {
            e.stopPropagation();
            fileInput.value = '';
            imagePreview.src = '#';
            previewContainer.classList.add('hidden');
            uploadPrompt.classList.remove('hidden');
        });
    });
</script>