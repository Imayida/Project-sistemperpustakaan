<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // halaman login
    public function login()
    {
        return view('auth.login');
    }

    // proses login
    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // 🔥 redirect sesuai role
            if ($user->role == 'petugas') {
                return redirect('/petugas/dashboard');
            } else {
                return redirect('/dashboard');
            }
        }

        return back()->with('error','Email atau password salah');
    }

    // halaman register
    public function register()
    {
        return view('auth.register');
    }

    // proses register
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

    // logout
    public function logout()
{
    Auth::logout();
    return redirect('/login');
}
}
