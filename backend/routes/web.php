<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Komando;
use App\Http\Controllers\Lapangan;
use App\Http\Controllers\Admin\StokInventarisController;
use App\Http\Controllers\Admin\DistribusiController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\Komando\KomandoDistribusiController;

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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ============ ADMIN (BPBD) ============
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard Admin
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

        // Manajemen Posko Komando
        Route::post('/posko/store', [Admin\DashboardController::class, 'storePosko'])->name('posko.store');
        Route::post('/posko/{id}/aktifkan', [Admin\DashboardController::class, 'aktifkanPosko'])->name('posko.aktifkan');
        Route::post('/posko/{id}/selesaikan', [Admin\DashboardController::class, 'selesaikanPosko'])->name('bencana.finish');

        // Manajemen Bencana
        Route::get('/bencana', [Admin\BencanaController::class, 'index'])->name('bencana');

        // Navigasi Lain
        Route::get('/permintaan', fn() => view('dashboard.admin.permintaan.index'))->name('permintaan');

        // ===== MANAJEMEN STOK INVENTARIS =====
        Route::get('/inventaris', [StokInventarisController::class, 'index'])->name('inventaris');
        Route::post('/inventaris', [StokInventarisController::class, 'store'])->name('inventaris.store');
        Route::put('/inventaris/{id}', [StokInventarisController::class, 'update'])->name('inventaris.update');
        Route::delete('/inventaris/{id}', [StokInventarisController::class, 'destroy'])->name('inventaris.destroy');

        // ===== MANAJEMEN DISTRIBUSI LOGISTIK =====
        Route::get('/distribusi', [DistribusiController::class, 'index'])->name('distribusi');
        Route::post('/distribusi/kirim', [DistribusiController::class, 'store'])->name('distribusi.store');
        Route::put('/distribusi/{id}', [DistribusiController::class, 'update'])->name('distribusi.update');
        Route::delete('/distribusi/{id}', [DistribusiController::class, 'destroy'])->name('distribusi.destroy');

        Route::get('/laporan', fn() => view('dashboard.admin.laporan.index'))->name('laporan');
    });

    // ============ KOMANDO (Posko Komando) ============
    Route::middleware('role:komando')->prefix('komando')->name('komando.')->group(function () {
        Route::get('/dashboard', [Komando\DashboardController::class, 'index'])->name('dashboard');

        // Mengizinkan GET dan POST untuk proses persetujuan
        Route::get('/logistik', [Komando\KomandoLogistikController::class, 'index'])->name('logistik.index');
        Route::match(['get', 'post'], '/logistik/{id}/approve', [Komando\KomandoLogistikController::class, 'approve'])->name('logistik.approve');
        Route::match(['get', 'post'], '/logistik/{id}/approve-partial', [Komando\KomandoLogistikController::class, 'approvePartial'])->name('logistik.approve-partial');
        Route::match(['get', 'post'], '/logistik/{id}/reject', [Komando\KomandoLogistikController::class, 'reject'])->name('logistik.reject');

        Route::get('/distribusi', [KomandoDistribusiController::class, 'index'])->name('distribusi.index');
        Route::get('/pengajuan', fn() => view('dashboard.komando.pengajuan.index'))->name('pengajuan.index');
        Route::resource('posko-kecil', Komando\SubPoskoController::class)->names('posko-kecil');
    });

    // ============ LAPANGAN (Posko Kecil) ============
    Route::middleware('role:lapangan')->prefix('lapangan')->name('lapangan.')->group(function () {

        // Dashboard Lapangan
        Route::get('/dashboard', [Lapangan\DashboardLapanganController::class, 'index'])->name('dashboard');
        Route::post('/dokumentasi/upload', [Lapangan\DashboardLapanganController::class, 'uploadFoto'])->name('dokumentasi.upload');
        Route::delete('/dokumentasi/{id}', [Lapangan\DashboardLapanganController::class, 'hapusFoto'])->name('dokumentasi.hapus');

        // Pengajuan Logistik
        Route::resource('pengajuan', Lapangan\PengajuanController::class);

        // Pendataan Pengungsi
        Route::resource('pengungsi', Lapangan\PengungsiController::class);

        // API Endpoint Prediksi ML Standalone (JSON)
        Route::get('/predict-logistik', [PredictionController::class, 'predict'])->name('predict.logistik');

        // Penyaluran & Pencatatan Stok
        Route::resource('penyaluran', Lapangan\PenyaluranController::class);

        // Status Distribusi & Stok (Sesuaikan nama parameter {id})
        Route::get('/stok', [Lapangan\StokController::class, 'index'])->name('stok.index');
        Route::post('/stok/{id}/konfirmasi', [Lapangan\StokController::class, 'konfirmasiSampai'])->name('stok.konfirmasi');
    });
});