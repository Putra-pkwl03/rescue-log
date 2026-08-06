<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RESCUE-LOG BPBD</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Mencegah elemen berkedip/muncul sebelum Alpine selesai di-load */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#f4f7fb] min-h-screen antialiased flex flex-col justify-center">

    <!-- Konten Halaman Login Muncul di Sini (Tanpa Sidebar/Header) -->
    @yield('content')

    <script>lucide.createIcons();</script>
</body>
</html>