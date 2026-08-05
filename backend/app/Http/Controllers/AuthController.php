<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Menampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Memproses Autentikasi Login
    public function login(Request $request)
    {
        // ==========================================
        // A. JIKA LOGIN MENGGUNAKAN KODE SUB POSKO
        // ==========================================
        if ($request->filled('kode_sub_posko')) {
            // Validasi input kode
            $request->validate([
                'kode_sub_posko' => ['required', 'string'],
            ]);

            // Cari user dengan role 'lapangan' yang memiliki kode_sub_posko sesuai
            $user = User::where('kode_sub_posko', $request->kode_sub_posko)
                        ->where('role', 'lapangan')
                        ->first();

            // Jika user ditemukan, langsung loginkan
            if ($user) {
                Auth::login($user, $request->boolean('remember'));
                $request->session()->regenerate();

                return redirect()->route('lapangan.dashboard');
            }

            // Jika kode sub posko salah / tidak ditemukan
            return back()->withErrors([
                'kode_sub_posko' => 'Kode Sub Posko tidak valid atau tidak ditemukan.',
            ])->onlyInput('kode_sub_posko');
        }

        // ==========================================
        // B. JIKA LOGIN MENGGUNAKAN EMAIL & PASSWORD
        // ==========================================
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial email & password
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Pengalihan berdasarkan Role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'komando') {
                return redirect()->route('komando.dashboard');
            } elseif ($user->role === 'lapangan') {
                return redirect()->route('lapangan.dashboard');
            }
        }

        // Jika login email/password gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // 3. Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }
}