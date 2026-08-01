<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiGap BPBD - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <!-- MEMANGGIL FILE SIDEBAR -->
        @include('layouts.partials.sidebar')

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navbar -->
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6">
                <div class="text-gray-800 text-xl font-semibold capitalize">
                    Panel {{ Auth::user()->role }}
                </div>
                <div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">
                            Keluar (Logout)
                        </button>
                    </form>
                </div>
            </header>

            <!-- Dynamic Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>