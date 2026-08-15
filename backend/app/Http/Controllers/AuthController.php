<?php

namespace App\Http\Controllers;

use App\Models\Posko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. OPSI A: Login menggunakan Kode Undangan Posko
        if ($request->filled('kode_undangan')) {
            $request->validate([
                'kode_undangan' => 'required|string|exists:poskos,kode_undangan',
            ], [
                'kode_undangan.exists' => 'Kode akses posko tidak ditemukan atau tidak valid.'
            ]);

            // Cari posko berdasarkan kode undangan
            $posko = Posko::where('kode_undangan', $request->kode_undangan)->first();

            if ($posko->status === 'nonaktif') {
                return back()->withErrors(['kode_undangan' => 'Posko ini sedang tidak aktif.']);
            }

            // Cari user petugas/penanggung jawab di posko ini
            $user = User::where('posko_id', $posko->id)->first();

            // Jika belum ada user di posko tersebut, buatkan user otomatis (opsional)
            if (!$user) {
                return back()->withErrors([
                    'kode_undangan' => 'Belum ada akun pengguna yang terhubung dengan posko ini.'
                ]);
            }

            // Forced login tanpa password
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended(route('lapangan.dashboard'))
                ->with('success', "Berhasil masuk ke Posko {$posko->nama_posko}!");
        }

        // 2. OPSI B: Login Standard (Email & Password)
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            

            // Pengalihan berdasarkan Role + Flash Message (Gunakan route() langsung)
            if ($user->role === 'admin' || $user->role === 'bpbd') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Berhasil login! Selamat datang di Dashboard Admin BPBD.');
            } 
            elseif (in_array($user->role, ['komando', 'koordinator_komando', 'posko_komando'])) {
                return redirect()->route('komando.dashboard')
                    ->with('success', 'Berhasil login! Selamat datang di Posko Komando.');
            } 
            elseif ($user->role === 'lapangan') {
                return redirect()->route('lapangan.dashboard')
                    ->with('success', 'Berhasil login! Selamat datang di Posko Lapangan.');
            }

            // Fallback jika role tidak terdaftar di atas
            return redirect('/login')->with('error', 'Role akun Anda tidak memiliki akses dashboard.');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}