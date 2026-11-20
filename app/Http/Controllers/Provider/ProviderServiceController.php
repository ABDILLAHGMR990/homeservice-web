<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProviderService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderServiceController extends Controller
{
    public function index()
    {
        $user     = Auth::user();
        $profile  = $user->providerProfile;

        $myServices = ProviderService::where('provider_profile_id', $profile->id)
            ->with('service.category')
            ->latest()
            ->get();

        $categories = Category::where('is_active', true)->get();

        return view('provider.services.index', compact('myServices','categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id'      => 'required|exists:services,id',
            'custom_price'    => 'nullable|numeric|min:0',
            'custom_duration' => 'nullable|integer|min:1',
            'notes'           => 'nullable|string|max:500',
        ]);

        $profile = Auth::user()->providerProfile;

        $exists = ProviderService::where('provider_profile_id', $profile->id)
            ->where('service_id', $request->service_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Layanan ini sudah ada di daftar Anda.');
        }

        ProviderService::create([
            'provider_profile_id' => $profile->id,
            'service_id'          => $request->service_id,
            'custom_price'        => $request->custom_price,
            'custom_duration'     => $request->custom_duration,
            'notes'               => $request->notes,
            'is_active'           => true,
        ]);

        return back()->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function destroy(ProviderService $providerService)
    {
        $profile = Auth::user()->providerProfile;
        abort_if($providerService->provider_profile_id !== $profile->id, 403);

        $providerService->delete();

        return back()->with('success', 'Layanan berhasil dihapus.');
    }

    public function toggleActive(ProviderService $providerService)
    {
        $profile = Auth::user()->providerProfile;
        abort_if($providerService->provider_profile_id !== $profile->id, 403);

        $providerService->update(['is_active' => !$providerService->is_active]);

        return back()->with('success', 'Status layanan berhasil diperbarui.');
    }
}
