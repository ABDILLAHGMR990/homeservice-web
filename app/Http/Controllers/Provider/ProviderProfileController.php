<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\ProviderProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProviderProfileController extends Controller
{
    public function edit()
    {
        $user    = Auth::user();
        $profile = $user->providerProfile;

        return view('provider.profile', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'             => 'required|string|max:100',
            'email'            => 'required|email|unique:users,email,' . $user->id,
            'phone'            => 'required|string|max:20',
            'bio'              => 'nullable|string|max:1000',
            'city'             => 'nullable|string|max:100',
            'experience_years' => 'nullable|integer|min:0|max:50',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $user->providerProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'bio'              => $request->bio,
                'city'             => $request->city,
                'phone'            => $request->phone,
                'experience_years' => $request->experience_years ?? 0,
            ]
        );

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function toggleAvailability()
    {
        $profile = Auth::user()->providerProfile;

        if (!$profile) {
            return back()->with('error', 'Profil teknisi tidak ditemukan.');
        }

        $profile->update(['is_available' => !$profile->is_available]);

        $status = $profile->is_available ? 'aktif menerima pesanan' : 'tidak menerima pesanan';

        return back()->with('success', "Status ketersediaan diubah: {$status}.");
    }
}
