<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProviderProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('providerProfile')->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $users = $query->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:100',
            'email'            => 'required|email|unique:users,email',
            'phone'            => 'nullable|string|max:20',
            'password'         => 'required|string|min:6',
            'role'             => 'required|in:customer,provider,admin',
            // Field khusus teknisi / mitra
            'expertise'        => 'nullable|string|max:150',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'nik'              => 'nullable|string|max:20',
            'service_area'     => 'nullable|string|max:255',
            'bio'              => 'nullable|string|max:1000',
            'auto_verify'      => 'nullable|boolean',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'is_active' => true,
        ]);

        // Jika menambahkan Teknisi / Mitra, buat profil teknisinya
        if ($request->role === 'provider') {
            $isVerified = $request->has('auto_verify') || $request->auto_verify;

            ProviderProfile::create([
                'user_id'              => $user->id,
                'nik'                  => $request->nik ?: '3174' . rand(100000000000, 999999999999),
                'expertise'            => $request->expertise ?: 'Teknisi Handal Berpengalaman',
                'experience_years'     => $request->experience_years ?: 3,
                'bio'                  => $request->bio ?: 'Teknisi profesional terdaftar resmi di platform HomeService.',
                'primary_service_area' => $request->service_area ?: 'Jakarta, Depok, Tangerang, Bekasi',
                'rating'               => 5.0,
                'total_reviews'        => 0,
                'completed_jobs'       => 0,
                'verification_status'  => $isVerified ? 'verified' : 'pending',
                'is_available'         => true,
            ]);
        }

        $label = $request->role === 'provider' ? 'Teknisi / Mitra' : ucfirst($request->role);
        return back()->with('success', "{$label} \"{$user->name}\" berhasil ditambahkan ke sistem.");
    }

    public function toggle(User $user)
    {
        // Cegah admin menonaktifkan akun sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Akun {$user->name} berhasil {$status}.");
    }

    public function destroy(User $user)
    {
        // Cegah admin menghapus akun sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $name = $user->name;
        $role = $user->role === 'provider' ? 'Teknisi / Mitra' : 'Pengguna';

        $user->delete();

        return back()->with('success', "{$role} \"{$name}\" berhasil dihapus permanen dari sistem.");
    }
}
