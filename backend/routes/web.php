<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Root redirect — arahkan sesuai role yang login
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| Guest routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ============ ADMIN (BPBD) ============
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', fn() => view('dashboard.admin.index'))->name('dashboard');
        Route::get('/bencana', fn() => view('dashboard.admin.bencana.index'))->name('bencana');
        Route::get('/permintaan', fn() => view('dashboard.admin.permintaan.index'))->name('permintaan');
        Route::get('/inventaris', fn() => view('dashboard.admin.inventaris.index'))->name('inventaris');
        Route::get('/distribusi', fn() => view('dashboard.admin.distribusi.index'))->name('distribusi');
        Route::get('/laporan', fn() => view('dashboard.admin.laporan.index'))->name('laporan');
    });

    // ============ KOMANDO (Posko Komando) ============
    Route::middleware('role:koordinator_komando')->prefix('komando')->name('komando.')->group(function () {
        Route::get('/dashboard', fn() => view('dashboard.komando.index'))->name('dashboard');

        // Data Logistik
        Route::get('/logistik', [App\Http\Controllers\KomandoLogistikController::class, 'index'])->name('logistik.index');
        Route::post('/logistik/{id}/approve', [App\Http\Controllers\KomandoLogistikController::class, 'approve'])->name('logistik.approve');
        Route::post('/logistik/{id}/approve-partial', [App\Http\Controllers\KomandoLogistikController::class, 'approvePartial'])->name('logistik.approve-partial');
        Route::post('/logistik/{id}/reject', [App\Http\Controllers\KomandoLogistikController::class, 'reject'])->name('logistik.reject');

        // Distribusi Logistik
        Route::get('/distribusi', fn() => view('dashboard.komando.distribusi.index'))->name('distribusi.index');

        // Pengajuan Kebutuhan
        Route::get('/pengajuan', fn() => view('dashboard.komando.pengajuan.index'))->name('pengajuan.index');

        // Pendataan Pos Kecil
        Route::get('/posko-kecil', fn() => view('dashboard.komando.posko-kecil.index'))->name('posko-kecil.index');
    });

    // ============ LAPANGAN (Posko Kecil) ============
    Route::middleware('role:lapangan')->prefix('lapangan')->name('lapangan.')->group(function () {
        Route::get('/dashboard', fn() => view('dashboard.lapangan.index'))->name('dashboard');
        // menu lain menyusul
    });
});
