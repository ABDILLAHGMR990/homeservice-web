<?php

namespace App\Http\Controllers\Public\Auth;

use App\Http\Controllers\Controller;
use App\Models\ProviderProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return view('public.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau password salah.']);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        return $this->redirectByRole($user->role)
            ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Anda telah keluar.');
    }

    public function showRegister()
    {
        return view('public.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:100',
            'email'                 => 'required|email|unique:users,email',
            'phone'                 => 'required|string|max:20',
            'password'              => ['required', 'confirmed', Password::min(8)],
            'agree_terms'           => 'accepted',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'customer',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('customer.dashboard')
            ->with('success', 'Akun berhasil dibuat. Selamat datang di HomeService!');
    }

    public function showProviderRegister()
    {
        return view('public.auth.provider-register');
    }

    public function registerProvider(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|string|max:20',
            'password'   => ['required', 'confirmed', Password::min(8)],
            'city'       => 'required|string|max:100',
            'bio'        => 'required|string|max:1000',
            'agree_terms'=> 'accepted',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'provider',
        ]);

        ProviderProfile::create([
            'user_id'              => $user->id,
            'bio'                  => $request->bio,
            'phone'                => $request->phone,
            'city'                 => $request->city,
            'verification_status'  => 'pending',
            'is_available'         => false,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('provider.verification.index')
            ->with('success', 'Pendaftaran berhasil! Silakan lengkapi dokumen verifikasi Anda.');
    }

    private function redirectByRole(string $role)
    {
        return match ($role) {
            'admin'    => redirect()->route('admin.dashboard'),
            'provider' => redirect()->route('provider.dashboard'),
            default    => redirect()->route('customer.dashboard'),
        };
    }
}
