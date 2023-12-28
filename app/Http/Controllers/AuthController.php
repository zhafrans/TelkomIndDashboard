<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil
            return redirect()->intended('/admin/dashboard');
        } else {
            // Jika autentikasi gagal
            return redirect()->route('login')->with('error', 'Username atau password salah.');
        }
    }


    // Menangani proses logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
