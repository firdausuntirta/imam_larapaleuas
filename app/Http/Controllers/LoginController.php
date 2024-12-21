<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        return view('login.login');  // Pastikan ada file 'login.login.blade.php' di folder resources/views/login
    }

    // Menangani form login setelah dikirim
    public function postLogin(Request $request)
    {
        // Validasi inputan dari user
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek apakah email dan password valid (sesuaikan dengan logika autentikasi yang kamu gunakan)
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika login berhasil, arahkan ke halaman admin
            return redirect()->route('dashboard');  // Ganti dengan route tujuan setelah login berhasil
        }

        // Jika login gagal, kembalikan dengan error
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ])->withInput();
    }
}
