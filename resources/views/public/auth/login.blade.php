@extends('layouts.app')

@section('title', 'Masuk ke Akun - HomeService')

@section('content')
<div class="hs-section" style="min-height: calc(100vh - 160px); display: flex; align-items: center;">
  <div class="hs-container" style="max-width: 480px;">
    <div class="hs-card" style="padding: 40px 32px; box-shadow: var(--hs-shadow-md);">
      <div style="text-align: center; margin-bottom: 28px;">
        <div class="hs-brand-icon" style="margin: 0 auto 12px auto; width: 48px; height: 48px; font-size: 1.5rem;">
          <i class="bi bi-house-gear-fill"></i>
        </div>
        <h1 style="font-size: 1.6rem; color: var(--hs-primary); margin-bottom: 6px;">Selamat Datang Kembali</h1>
        <p style="font-size: 0.875rem; color: var(--hs-text-secondary);">Masuk ke akun HomeService Anda</p>
      </div>

      <!-- Quick Demo Credentials Box for Testing -->
      <div style="background: var(--hs-bg-main); border: 1px dashed var(--hs-border); border-radius: var(--hs-radius-md); padding: 14px; margin-bottom: 24px;">
        <div style="font-size: 0.75rem; font-weight: 700; color: var(--hs-primary); margin-bottom: 6px; text-transform: uppercase;">
          <i class="bi bi-info-circle-fill" style="color: var(--hs-secondary);"></i> Akun Demo Cepat (Klik untuk Isi):
        </div>
        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
          <button type="button" class="hs-btn hs-btn-outline hs-btn-sm" style="font-size: 0.75rem; padding: 4px 8px;" onclick="fillLogin('pelanggan@homeservice.id', 'password123')">
            Customer
          </button>
          <button type="button" class="hs-btn hs-btn-outline hs-btn-sm" style="font-size: 0.75rem; padding: 4px 8px;" onclick="fillLogin('teknisi@homeservice.id', 'password123')">
            Teknisi Mitra
          </button>
          <button type="button" class="hs-btn hs-btn-outline hs-btn-sm" style="font-size: 0.75rem; padding: 4px 8px;" onclick="fillLogin('admin@homeservice.id', 'password123')">
            Admin
          </button>
        </div>
      </div>

      <form action="{{ route('login.post') }}" method="POST" data-loading-state>
        @csrf
        <div class="hs-form-group">
          <label class="hs-label">Alamat Email</label>
          <input type="email" name="email" id="login-email" class="hs-input @error('email') hs-input-error @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
          @error('email')
            <span class="hs-error-msg">{{ $message }}</span>
          @enderror
        </div>

        <div class="hs-form-group">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 7px;">
            <label class="hs-label" style="margin-bottom: 0;">Kata Sandi</label>
            <a href="#" style="font-size: 0.8125rem; color: var(--hs-secondary); font-weight: 500;">Lupa Sandi?</a>
          </div>
          <input type="password" name="password" id="login-password" class="hs-input @error('password') hs-input-error @enderror" placeholder="••••••••" required>
          @error('password')
            <span class="hs-error-msg">{{ $message }}</span>
          @enderror
        </div>

        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 24px; font-size: 0.875rem; color: var(--hs-text-secondary);">
          <input type="checkbox" name="remember" id="remember" style="accent-color: var(--hs-primary);">
          <label for="remember" style="cursor: pointer;">Ingat sesi saya di perangkat ini</label>
        </div>

        <button type="submit" class="hs-btn hs-btn-primary hs-btn-lg" style="width: 100%; margin-bottom: 20px;">
          Masuk ke Akun <i class="bi bi-box-arrow-in-right"></i>
        </button>

        <div style="text-align: center; font-size: 0.875rem; color: var(--hs-text-secondary);">
          Belum memiliki akun? <a href="{{ route('register') }}" style="color: var(--hs-primary); font-weight: 600;">Daftar Pelanggan</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function fillLogin(email, pass) {
    document.getElementById('login-email').value = email;
    document.getElementById('login-password').value = pass;
  }
</script>
@endsection
