<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Logistik - SiGap BPBD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
   
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body x-data="{ sidebarOpen: true }" class="bg-slate-50 font-sans antialiased text-gray-800 flex h-screen overflow-hidden">

    <!-- 1. SIDEBAR -->
    @include('layouts.sidebar')

    <!-- 2. CONTAINER KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- 3. NAVBAR -->
        @include('layouts.navbar')

        <!-- 4. AREA KONTEN HALAMAN -->
        <main class="flex-1 overflow-y-auto p-8 bg-[#f8fafc]">
            @yield('content')
        </main>
    </div>

    <!-- CDN SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Global Toast Notification (Kanan Atas) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Konfigurasi Mixin SweetAlert2 Toast di Kanan Atas
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end', 
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            // Trigger Notifikasi Sukses
            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            @endif

            // Trigger Notifikasi Gagal / Error
            @if(session('error'))
                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}"
                });
            @endif
        });
    </script>

    @stack('scripts')
</body>
</html>