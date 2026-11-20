@extends('layouts.app')

@section('title', 'Daftar Akun Pelanggan - HomeService')

@section('content')
<div class="hs-section" style="min-height: calc(100vh - 160px); display: flex; align-items: center;">
  <div class="hs-container" style="max-width: 520px;">
    <div class="hs-card" style="padding: 40px 32px; box-shadow: var(--hs-shadow-md);">
      <div style="text-align: center; margin-bottom: 28px;">
        <div class="hs-brand-icon" style="margin: 0 auto 12px auto; width: 48px; height: 48px; font-size: 1.5rem;">
          <i class="bi bi-person-plus-fill"></i>
        </div>
        <h1 style="font-size: 1.6rem; color: var(--hs-primary); margin-bottom: 6px;">Buat Akun Pelanggan</h1>
        <p style="font-size: 0.875rem; color: var(--hs-text-secondary);">Mulai pesan layanan rumah tangga bergaransi dengan mudah</p>
      </div>

      <form action="{{ route('register.post') }}" method="POST" data-loading-state>
        @csrf
        <input type="hidden" name="role" value="customer">

        <div class="hs-form-group">
          <label class="hs-label">Nama Lengkap</label>
          <input type="text" name="name" class="hs-input @error('name') hs-input-error @enderror" placeholder="Contoh: Dian Anggraini" value="{{ old('name') }}" required autofocus>
          @error('name')
            <span class="hs-error-msg">{{ $message }}</span>
          @enderror
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Nomor WhatsApp Aktif</label>
          <input type="tel" name="phone" class="hs-input @error('phone') hs-input-error @enderror" placeholder="Contoh: 081234567890" value="{{ old('phone') }}" required>
          @error('phone')
            <span class="hs-error-msg">{{ $message }}</span>
          @enderror
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Alamat Email</label>
          <input type="email" name="email" class="hs-input @error('email') hs-input-error @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required>
          @error('email')
            <span class="hs-error-msg">{{ $message }}</span>
          @enderror
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Kata Sandi</label>
          <input type="password" name="password" class="hs-input @error('password') hs-input-error @enderror" placeholder="Minimal 8 karakter" required>
          @error('password')
            <span class="hs-error-msg">{{ $message }}</span>
          @enderror
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Konfirmasi Kata Sandi</label>
          <input type="password" name="password_confirmation" class="hs-input" placeholder="Ulangi kata sandi" required>
        </div>

        <div style="margin-bottom: 24px; font-size: 0.8125rem; color: var(--hs-text-secondary); line-height: 1.5;">
          Dengan mendaftar, Anda menyetujui <a href="{{ route('public.terms') }}" style="color: var(--hs-primary); font-weight: 600;">Syarat & Ketentuan</a> serta <a href="{{ route('public.privacy') }}" style="color: var(--hs-primary); font-weight: 600;">Kebijakan Privasi</a> HomeService.
        </div>

        <button type="submit" class="hs-btn hs-btn-primary hs-btn-lg" style="width: 100%; margin-bottom: 20px;">
          Daftar Sekarang <i class="bi bi-arrow-right"></i>
        </button>

        <div style="text-align: center; font-size: 0.875rem; color: var(--hs-text-secondary);">
          Sudah memiliki akun? <a href="{{ route('login') }}" style="color: var(--hs-primary); font-weight: 600;">Masuk di Sini</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
