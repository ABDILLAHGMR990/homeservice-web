<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\ProviderDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VerificationUploadController extends Controller
{
    public function index()
    {
        $profile   = Auth::user()->providerProfile;
        $documents = $profile?->documents()->get()->keyBy('document_type') ?? collect();

        return view('provider.verification.index', compact('profile','documents'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'document_type' => 'required|in:ktp,selfie_ktp,certificate,skck',
            'file'          => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $profile = Auth::user()->providerProfile;

        $path = $request->file('file')->store(
            'provider-documents/' . $profile->id,
            'private'
        );

        ProviderDocument::updateOrCreate(
            ['provider_profile_id' => $profile->id, 'document_type' => $request->document_type],
            ['file_path' => $path, 'status' => 'pending', 'reviewed_at' => null, 'rejection_reason' => null]
        );

        if ($profile->verification_status === 'rejected') {
            $profile->update(['verification_status' => 'pending', 'rejection_reason' => null]);
        }

        return back()->with('success', 'Dokumen berhasil diunggah. Menunggu review admin.');
    }
}
