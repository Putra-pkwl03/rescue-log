<?php

namespace App\Http\Controllers;

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
        // Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $nama = $user->name ?? 'Pengguna';
            $message = "Selamat datang kembali, {$nama}!";

            // Pengalihan berdasarkan Role
            return match ($user->role) {
                'admin'    => redirect()->route('admin.dashboard')->with('success', $message),
                'komando', 'koordinator_komando' => redirect()->route('komando.dashboard')->with('success', $message),
                'lapangan' => redirect()->route('lapangan.dashboard')->with('success', $message),
                default    => redirect()->route('login'),
            };
        }

        // Jika login gagal
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

        return redirect('/login')->with('success', 'Anda telah berhasil keluar dari akun.');
    }
}