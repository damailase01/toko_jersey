<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
{
    // Validasi input (email dan password)
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    // Jika validasi gagal, kembali ke form login dengan pesan error
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Cek apakah kredensial (email dan password) cocok
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Cek peran pengguna (role-based redirection)
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Halaman admin
        } elseif ($user->role === 'customer') {
            return redirect()->route('customer.dashboard'); // Halaman customer
        } else {
            Auth::logout(); // Logout jika peran tidak dikenali
            return redirect()->route('login')->withErrors(['error' => 'Role tidak dikenali.']);
        }
    } else {
        // Jika gagal login, tampilkan pesan kesalahan
        return redirect()->back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}

}
