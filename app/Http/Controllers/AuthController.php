<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ========================
    // HALAMAN LOGIN
    // ========================
    public function login()
    {
        return view('auth.login');
    }

    // ========================
    // PROSES LOGIN
    // ========================
    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // 🔥 REDIRECT SESUAI ROLE (INI YANG DIPERBAIKI)
            if ($user->role === 'kepala') {
                return redirect('/kepala/dashboard');
            } elseif ($user->role === 'petugas') {
                return redirect('/petugas/dashboard');
            } else {
                return redirect('/dashboard'); // anggota
            }
        }

        return back()->with('error','Email atau password salah');
    }

    // ========================
    // HALAMAN REGISTER
    // ========================
    public function register()
    {
        return view('auth.register');
    }

    // ========================
    // PROSES REGISTER
    // ========================
    public function prosesRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota' // default anggota
        ]);

        return redirect('/login')->with('success','Registrasi berhasil');
    }

    // ========================
    // LOGOUT
    // ========================
    public function logout(Request $request)
    {
        Auth::logout();

        // 🔥 biar session bersih (lebih aman)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
