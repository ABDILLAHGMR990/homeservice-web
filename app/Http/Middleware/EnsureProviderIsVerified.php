<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProviderIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->role !== 'provider') {
            return redirect()->route('login');
        }

        $profile = $user->providerProfile;

        if (!$profile || $profile->verification_status !== 'verified') {
            return redirect()->route('provider.verification.index')
                ->with('warning', 'Akun Anda belum terverifikasi. Lengkapi dokumen verifikasi terlebih dahulu.');
        }

        return $next($request);
    }
}
