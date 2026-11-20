@extends('layouts.customer')

@section('title', 'Profil Saya')

@section('content')
<div class="page-header mb-4">
    <h1 class="page-title">Profil Saya</h1>
    <p class="page-subtitle">Kelola informasi akun dan keamanan Anda</p>
</div>

<div class="row g-4">

    {{-- Profile Info Card --}}
    <div class="col-lg-4">
        <div class="hs-card text-center p-4">
            <div class="profile-avatar-wrapper mb-3">
                <div style="width:96px;height:96px;border-radius:50%;background:#E5E9EF;display:flex;align-items:center;justify-content:center;margin:0 auto;overflow:hidden;">
                    <i class="bi bi-person-fill" style="font-size:48px;color:#9DA7B4;"></i>
                </div>
            </div>
            <h5 class="fw-semibold mb-1" style="color:#202938;">{{ auth()->user()->name }}</h5>
            <p class="text-muted small mb-2">{{ auth()->user()->email }}</p>
            <span class="hs-badge hs-badge-primary">Pelanggan</span>
            <hr class="my-3">
            <div class="text-start">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-telephone" style="color:#687386;width:16px;"></i>
                    <span class="small" style="color:#687386;">{{ auth()->user()->phone ?? 'Belum diisi' }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-calendar3" style="color:#687386;width:16px;"></i>
                    <span class="small" style="color:#687386;">Bergabung {{ auth()->user()->created_at?->format('F Y') ?? now()->format('F Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Profile --}}
    <div class="col-lg-8">
        <div class="hs-card p-4 mb-4">
            <h6 class="fw-semibold mb-4" style="color:#202938;">Informasi Pribadi</h6>

            <form action="{{ route('customer.profile.update') }}" method="POST" id="profileForm">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12">
                        <label class="hs-label">Nama Lengkap</label>
                        <input type="text" name="name" class="hs-input @error('name') is-invalid @enderror"
                               value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <div class="hs-error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="hs-label">Email</label>
                        <input type="email" name="email" class="hs-input @error('email') is-invalid @enderror"
                               value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div class="hs-error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="hs-label">Nomor Telepon</label>
                        <input type="tel" name="phone" class="hs-input @error('phone') is-invalid @enderror"
                               value="{{ old('phone', auth()->user()->phone) }}" placeholder="08xxxxxxxxxx">
                        @error('phone')
                            <div class="hs-error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="hs-btn hs-btn-primary" id="submitProfile">
                        <i class="bi bi-check2 me-1"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- Change Password --}}
        <div class="hs-card p-4">
            <h6 class="fw-semibold mb-4" style="color:#202938;">Ubah Password</h6>

            <form action="{{ route('customer.profile.password') }}" method="POST" id="passwordForm">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12">
                        <label class="hs-label">Password Saat Ini</label>
                        <div class="hs-input-group">
                            <input type="password" name="current_password" id="currentPwd"
                                   class="hs-input @error('current_password') is-invalid @enderror" required>
                            <button type="button" class="hs-input-icon" onclick="togglePassword('currentPwd', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <div class="hs-error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="hs-label">Password Baru</label>
                        <div class="hs-input-group">
                            <input type="password" name="password" id="newPwd"
                                   class="hs-input @error('password') is-invalid @enderror" required>
                            <button type="button" class="hs-input-icon" onclick="togglePassword('newPwd', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="hs-error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="hs-label">Konfirmasi Password Baru</label>
                        <div class="hs-input-group">
                            <input type="password" name="password_confirmation" id="confirmPwd"
                                   class="hs-input" required>
                            <button type="button" class="hs-input-icon" onclick="togglePassword('confirmPwd', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="hs-alert hs-alert-warning mb-3">
                        <i class="bi bi-shield-exclamation me-2"></i>
                        Gunakan password yang kuat dan unik. Minimal 8 karakter.
                    </div>
                    <button type="submit" class="hs-btn hs-btn-secondary">
                        <i class="bi bi-lock me-1"></i>Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}

document.getElementById('profileForm').addEventListener('submit', function(e) {
    const btn = document.getElementById('submitProfile');
    btn.disabled = true;
    btn.innerHTML = '<span class="hs-spinner-sm me-1"></span>Menyimpan...';
});
</script>
@endpush
