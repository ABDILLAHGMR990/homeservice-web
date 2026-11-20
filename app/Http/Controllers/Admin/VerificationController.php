<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProviderDocument;
use App\Models\ProviderProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $profiles = ProviderProfile::where('verification_status', $status)
            ->with(['user','documents'])
            ->latest()
            ->paginate(15);

        return view('admin.verifications.index', compact('profiles','status'));
    }

    public function approve(Request $request, ProviderProfile $profile)
    {
        $profile->update([
            'verification_status' => 'verified',
            'verified_at'         => now(),
            'rejection_reason'    => null,
        ]);

        $profile->documents()->update([
            'status'      => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Teknisi ' . $profile->user->name . ' berhasil diverifikasi.');
    }

    public function reject(Request $request, ProviderProfile $profile)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $profile->update([
            'verification_status' => 'rejected',
            'rejection_reason'    => $request->rejection_reason,
        ]);

        $profile->documents()->update([
            'status'           => 'rejected',
            'reviewed_by'      => Auth::id(),
            'reviewed_at'      => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        return back()->with('success', 'Verifikasi teknisi ' . $profile->user->name . ' ditolak.');
    }

    public function viewDocument(ProviderDocument $document): StreamedResponse
    {
        abort_unless(Auth::user()->role === 'admin', 403);

        if (!Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'Dokumen tidak ditemukan.');
        }

        return Storage::disk('private')->download($document->file_path);
    }
}
