<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MasyarakatAuthController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('kecamatan.home');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik'       => 'required|digits:16|unique:users,nik',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'telepon'   => 'required|string|max:20',
            'kelurahan' => 'required|in:Alang-Alang Lebar,Karya Baru,Talang Kelapa,Srijaya',
            'alamat'    => 'required|string',
            'password'  => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nik'       => $request->nik,
            'name'      => $request->name,
            'email'     => $request->email,
            'telepon'   => $request->telepon,
            'kelurahan' => $request->kelurahan,
            'alamat'    => $request->alamat,
            'role'      => 'masyarakat',
            'password'  => Hash::make($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('kecamatan.home')
            ->with('success_daftar', 'Selamat datang, ' . $user->name . '! Akun berhasil dibuat.');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('kecamatan.home');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $login = $request->login;

        // Coba login pakai NIK
        $field = is_numeric($login) && strlen($login) === 16 ? 'nik' : 'email';

        if (Auth::attempt([$field => $login, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()
                ->route('kecamatan.home')
                ->with('success_daftar', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        return back()
            ->withErrors(['login' => 'NIK atau email dan password tidak cocok.'])
            ->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('kecamatan.home');
    }
}