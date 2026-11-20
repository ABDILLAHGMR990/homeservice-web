@extends('layouts.app')

@section('title', 'Pendaftaran Mitra Teknisi - HomeService')

@section('content')
<div class="hs-section" style="min-height: calc(100vh - 160px); display: flex; align-items: center;">
  <div class="hs-container" style="max-width: 600px;">
    <div class="hs-card" style="padding: 40px 32px; box-shadow: var(--hs-shadow-md);">
      <div style="text-align: center; margin-bottom: 28px;">
        <div class="hs-brand-icon" style="margin: 0 auto 12px auto; width: 48px; height: 48px; font-size: 1.5rem; background: var(--hs-secondary); color: var(--hs-primary);">
          <i class="bi bi-tools"></i>
        </div>
        <h1 style="font-size: 1.6rem; color: var(--hs-primary); margin-bottom: 6px;">Pendaftaran Mitra Teknisi</h1>
        <p style="font-size: 0.875rem; color: var(--hs-text-secondary);">Gabung bersama ribuan teknisi profesional dengan pesanan rutin setiap hari</p>
      </div>

      <form action="{{ route('register.post') }}" method="POST" data-loading-state>
        @csrf
        <input type="hidden" name="role" value="provider">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
          <div class="hs-form-group">
            <label class="hs-label">Nama Lengkap Sesuai KTP</label>
            <input type="text" name="name" class="hs-input @error('name') hs-input-error @enderror" placeholder="Nama lengkap Anda" value="{{ old('name') }}" required autofocus>
            @error('name')
              <span class="hs-error-msg">{{ $message }}</span>
            @enderror
          </div>

          <div class="hs-form-group">
            <label class="hs-label">Nomor WhatsApp Aktif</label>
            <input type="tel" name="phone" class="hs-input @error('phone') hs-input-error @enderror" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" required>
            @error('phone')
              <span class="hs-error-msg">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Alamat Email</label>
          <input type="email" name="email" class="hs-input @error('email') hs-input-error @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required>
          @error('email')
            <span class="hs-error-msg">{{ $message }}</span>
          @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 16px;">
          <div class="hs-form-group">
            <label class="hs-label">Keahlian Utama</label>
            <select name="expertise" class="hs-select" required>
              <option value="">Pilih Spesialisasi</option>
              <option value="Service AC">Service AC & Pendingin</option>
              <option value="Instalasi Listrik">Instalasi Listrik & Panel</option>
              <option value="Perbaikan Listrik">Perbaikan Listrik & Korsleting</option>
              <option value="Plumbing & Air">Plumbing & Pipa Air</option>
              <option value="Cleaning Service">Cleaning Service & Sanitasi</option>
              <option value="Perbaikan Perabot">Perbaikan Perabot Kayu & Interior</option>
              <option value="Tukang Bangunan">Tukang Bangunan & Atap</option>
              <option value="Pengecatan Rumah">Pengecatan Rumah</option>
              <option value="Pengendalian Hama">Pengendalian Hama</option>
              <option value="Perbaikan Elektronik">Perbaikan Elektronik Rumah Tangga</option>
            </select>
          </div>

          <div class="hs-form-group">
            <label class="hs-label">Lama Pengalaman</label>
            <select name="experience_years" class="hs-select" required>
              <option value="1">1 - 2 Tahun</option>
              <option value="3">3 - 5 Tahun</option>
              <option value="6">6 - 8 Tahun</option>
              <option value="9">Lebih dari 8 Tahun</option>
            </select>
          </div>
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Wilayah Operasional Utama</label>
          <select name="service_area" class="hs-select" required>
            <option value="Jakarta Selatan">Jakarta Selatan</option>
            <option value="Jakarta Barat">Jakarta Barat</option>
            <option value="Jakarta Pusat">Jakarta Pusat</option>
            <option value="Jakarta Timur">Jakarta Timur</option>
            <option value="Jakarta Utara">Jakarta Utara</option>
            <option value="Tangerang & Tangsel">Tangerang & Tangerang Selatan</option>
            <option value="Depok">Depok</option>
            <option value="Bekasi">Bekasi</option>
            <option value="Bogor">Bogor</option>
          </select>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
          <div class="hs-form-group">
            <label class="hs-label">Kata Sandi</label>
            <input type="password" name="password" class="hs-input @error('password') hs-input-error @enderror" placeholder="Minimal 8 karakter" required>
            @error('password')
              <span class="hs-error-msg">{{ $message }}</span>
            @enderror
          </div>

          <div class="hs-form-group">
            <label class="hs-label">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" class="hs-input" placeholder="Ulangi sandi" required>
          </div>
        </div>

        <div style="background: var(--hs-secondary-surface); border: 1px solid #FCD34D; border-radius: var(--hs-radius-md); padding: 12px; margin-bottom: 24px; font-size: 0.8125rem; color: #B45309;">
          <i class="bi bi-shield-lock-fill"></i> <strong>Catatan:</strong> Setelah registrasi akun, Anda akan diminta mengunggah foto KTP asli di dashboard untuk verifikasi sebelum dapat menerima pesanan pelanggan.
        </div>

        <button type="submit" class="hs-btn hs-btn-secondary hs-btn-lg" style="width: 100%; margin-bottom: 20px;">
          Daftar Sebagai Mitra Teknisi <i class="bi bi-arrow-right"></i>
        </button>

        <div style="text-align: center; font-size: 0.875rem; color: var(--hs-text-secondary);">
          Sudah terdaftar sebagai mitra? <a href="{{ route('login') }}" style="color: var(--hs-primary); font-weight: 600;">Masuk di Sini</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
