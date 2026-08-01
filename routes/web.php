<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\AuthController;

// Redirect halaman utama secara cerdas
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard.admin'); 
    }

    return redirect()->route('login');
});

// Guest Routes (Hanya bisa diakses jika BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes (Hanya bisa diakses JIKA SUDAH login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Langsung lempar rute ke file view masing-masing role
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin.index');
    })->name('dashboard.admin');

    Route::get('/dashboard/komando', function () {
        return view('dashboard.komando.index');
    })->name('dashboard.komando');

    Route::get('/dashboard/lapangan', function () {
        return view('dashboard.lapangan.index');
    })->name('dashboard.lapangan');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ==========================================
    // RUTE KHUSUS ADMIN BPBD
    // ==========================================
    Route::prefix('admin')->name('admin.')->group(function () {
        // 1. Dashboard (Ubah nama route yang sebelumnya 'dashboard.admin' menjadi 'admin.dashboard')
        Route::get('/dashboard', function () {
            return view('dashboard.admin.index');
        })->name('dashboard');

        // 2. Manajemen Bencana
        Route::get('/bencana', function () {
            return view('dashboard.admin.bencana.index');
        })->name('bencana');

        // 3. Permintaan Kebutuhan
        Route::get('/permintaan', function () {
            return view('dashboard.admin.permintaan.index');
        })->name('permintaan');

        // 4. Inventaris & Prediksi ML
        Route::get('/inventaris', function () {
            return view('dashboard.admin.inventaris.index');
        })->name('inventaris');

        // 5. Distribusi
        Route::get('/distribusi', function () {
            return view('dashboard.admin.distribusi.index');
        })->name('distribusi');

        // 6. Laporan
        Route::get('/laporan', function () {
            return view('dashboard.admin.laporan.index');
        })->name('laporan');

        // 7. Data Master
        Route::get('/master', function () {
            return view('dashboard.admin.master.index');
        })->name('master');

        // 8. Manajemen Pengguna
        Route::get('/pengguna', function () {
            return view('dashboard.admin.pengguna.index');
        })->name('pengguna');
    });

    // (Rute untuk Komando & Lapangan biarkan seperti sebelumnya)
    Route::get('/dashboard/komando', function () { return view('dashboard.komando.index'); })->name('dashboard.komando');
    Route::get('/dashboard/lapangan', function () { return view('dashboard.lapangan.index'); })->name('dashboard.lapangan');
});