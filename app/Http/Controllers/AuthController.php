<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm(): View
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerasi session agar aman
            $request->session()->regenerate();

            // Redirect ke dashboard
            return redirect()->route('dashboard');
        }

        // Jika gagal login
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }

    // Dashboard
    public function showDashboard(): View
    {
        return view('dashboard');
    }
}