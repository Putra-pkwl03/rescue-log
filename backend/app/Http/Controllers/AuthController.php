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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Pengalihan berdasarkan Role
            $user = Auth::user();
            
            // if ($user->role === 'admin') {
            //     return redirect()->intended('/dashboard/admin');
            // } elseif ($user->role === 'koordinator_komando') {
            //     return redirect()->intended('/dashboard/komando');
            // } else {
            //     return redirect()->intended('/dashboard/lapangan');
            // }

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
                }

                elseif ($user->role === 'koordinator_komando') {
                    return redirect()->route('komando.dashboard');
                }

                elseif ($user->role === 'lapangan') {
                    return redirect()->route('lapangan.dashboard');
                }
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

        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }
}