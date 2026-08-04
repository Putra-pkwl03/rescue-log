<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Komando; // <-- 1. Import Namespace Controller Komando

Route::get('/', function () {
    if (Auth::check()) {
        return match (Auth::user()->role) {
            'admin'    => redirect()->route('admin.dashboard'),
            'komando'  => redirect()->route('komando.dashboard'),
            'lapangan' => redirect()->route('lapangan.dashboard'),
            default    => redirect()->route('login'),
        };
    }
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ============ ADMIN (BPBD) ============
    Route::middleware('role:admin')->prefix('dashboard/admin')->name('admin.')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/permintaan', fn () => view('dashboard.admin.permintaan.index'))->name('permintaan');
        Route::get('/inventaris', fn () => view('dashboard.admin.inventaris.index'))->name('inventaris');
        Route::get('/distribusi', fn () => view('dashboard.admin.distribusi.index'))->name('distribusi');
        Route::get('/laporan', fn () => view('dashboard.admin.laporan.index'))->name('laporan');

        // Posko Komando
        Route::get('/posko/daftar', [Admin\PoskoController::class, 'create'])->name('posko.create');
        Route::post('/posko', [Admin\PoskoController::class, 'store'])->name('posko.store');

        // Bencana
        Route::get('/bencana', [Admin\BencanaController::class, 'index'])->name('bencana');
        Route::get('/bencana/aktifkan', [Admin\BencanaController::class, 'showAktifkan'])->name('bencana.aktifkan.form');
        Route::post('/bencana/aktifkan', [Admin\BencanaController::class, 'aktifkan'])->name('bencana.aktifkan');
        Route::post('/bencana/nonaktifkan', [Admin\BencanaController::class, 'nonaktifkan'])->name('bencana.nonaktifkan');
    });

    // ============ KOMANDO (Posko Komando) ============
    Route::middleware('role:komando')->prefix('komando')->name('komando.')->group(function () {
        // 2. Hubungkan route dashboard ke Controller khusus Komando
        Route::get('/dashboard', [Komando\DashboardController::class, 'index'])->name('dashboard');
    });

    // ============ LAPANGAN (Posko Kecil) ============
    Route::middleware('role:lapangan')->prefix('lapangan')->name('lapangan.')->group(function () {
        Route::get('/dashboard', fn () => view('dashboard.lapangan.index'))->name('dashboard');
    });
});