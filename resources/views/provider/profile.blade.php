@extends('layouts.provider')

@section('title', 'Profil Teknisi')

@section('content')
<div class="page-header mb-4">
    <h1 class="page-title">Profil Teknisi</h1>
    <p class="page-subtitle">Kelola profil profesional Anda yang dilihat pelanggan</p>
</div>

<div class="row g-4">

    {{-- Profile Card --}}
    <div class="col-lg-4">
        <div class="hs-card p-4 text-center mb-3">
            <div style="width:96px;height:96px;border-radius:50%;background:#E5E9EF;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;overflow:hidden;">
                <i class="bi bi-person-fill" style="font-size:48px;color:#9DA7B4;"></i>
            </div>
            <h5 class="fw-semibold mb-1" style="color:#202938;">{{ auth()->user()->name }}</h5>
            <p class="text-muted small mb-2">{{ auth()->user()->email }}</p>

            @php $profile = $profile ?? auth()->user()->providerProfile; @endphp
            @if($profile)
                <div class="d-flex align-items-center justify-content-center gap-1 mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= round($profile->rating_avg ?? 0) ? '-fill' : '' }}" style="color:#F59E0B;font-size:14px;"></i>
                    @endfor
                    <span class="ms-1 small" style="color:#687386;">{{ number_format($profile->rating_avg ?? 0, 1) }}</span>
                </div>
                <span class="hs-badge {{ $profile->isVerified() ? 'hs-badge-success' : 'hs-badge-warning' }}">
                    <i class="bi bi-{{ $profile->isVerified() ? 'patch-check' : 'clock' }} me-1"></i>
                    {{ $profile->isVerified() ? 'Terverifikasi' : 'Menunggu Verifikasi' }}
                </span>
            @endif

            <hr class="my-3">

            <div class="text-start">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-briefcase" style="color:#687386;width:16px;"></i>
                    <span class="small" style="color:#687386;">{{ $profile?->total_jobs_done ?? 0 }} pekerjaan selesai</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-star" style="color:#687386;width:16px;"></i>
                    <span class="small" style="color:#687386;">{{ $profile?->total_reviews ?? 0 }} ulasan</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt" style="color:#687386;width:16px;"></i>
                    <span class="small" style="color:#687386;">{{ $profile?->city ?? 'Belum diisi' }}</span>
                </div>
            </div>
        </div>

        {{-- Availability Toggle --}}
        @if($profile?->isVerified())
        <div class="hs-card p-4">
            <h6 class="fw-semibold mb-3" style="color:#202938;">Status Ketersediaan</h6>
            <form action="{{ route('provider.profile.availability') }}" method="POST">
                @csrf @method('PUT')
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="fw-medium" style="color:#202938;">Terima Pesanan</div>
                        <div class="small" style="color:#687386;">
                            {{ $profile->is_available ? 'Aktif menerima pesanan' : 'Tidak menerima pesanan' }}
                        </div>
                    </div>
                    <button type="submit" class="hs-btn hs-btn-sm {{ $profile->is_available ? 'hs-btn-danger' : 'hs-btn-success' }}">
                        {{ $profile->is_available ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </div>
            </form>
        </div>
        @endif
    </div>

    {{-- Edit Profile --}}
    <div class="col-lg-8">
        <div class="hs-card p-4 mb-4">
            <h6 class="fw-semibold mb-4" style="color:#202938;">Informasi Akun</h6>

            <form action="{{ route('provider.profile.update') }}" method="POST">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="hs-label">Nama Lengkap</label>
                        <input type="text" name="name" class="hs-input" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="hs-label">Email</label>
                        <input type="email" name="email" class="hs-input" value="{{ auth()->user()->email }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="hs-label">Nomor Telepon</label>
                        <input type="tel" name="phone" class="hs-input" value="{{ auth()->user()->phone }}">
                    </div>
                    <div class="col-md-6">
                        <label class="hs-label">Kota / Kabupaten</label>
                        <input type="text" name="city" class="hs-input" value="{{ $profile?->city }}">
                    </div>
                    <div class="col-12">
                        <label class="hs-label">Deskripsi / Bio Profesional</label>
                        <textarea name="bio" class="hs-textarea" rows="4"
                                  placeholder="Ceritakan pengalaman dan keahlian Anda kepada calon pelanggan...">{{ $profile?->bio }}</textarea>
                        <div class="hs-hint">Deskripsi yang baik meningkatkan kepercayaan pelanggan.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="hs-label">Tahun Pengalaman</label>
                        <input type="number" name="experience_years" class="hs-input" min="0" max="50"
                               value="{{ $profile?->experience_years ?? 0 }}">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="hs-btn hs-btn-primary">
                        <i class="bi bi-check2 me-1"></i>Simpan Profil
                    </button>
                </div>
            </form>
        </div>

        {{-- Change Password --}}
        <div class="hs-card p-4">
            <h6 class="fw-semibold mb-4" style="color:#202938;">Ubah Password</h6>

            <form action="{{ route('provider.profile.password') }}" method="POST">
                @csrf @method('PUT')

                <div class="row g-3">
                    <div class="col-12">
                        <label class="hs-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="hs-input" required>
                    </div>
                    <div class="col-md-6">
                        <label class="hs-label">Password Baru</label>
                        <input type="password" name="password" class="hs-input" required>
                    </div>
                    <div class="col-md-6">
                        <label class="hs-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="hs-input" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="hs-btn hs-btn-secondary">
                        <i class="bi bi-lock me-1"></i>Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
