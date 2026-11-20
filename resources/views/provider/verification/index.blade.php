@extends('layouts.provider')

@section('title', 'Verifikasi Identitas & KTP - HomeService')

@section('content')
<div style="margin-bottom: 24px;">
  <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Verifikasi Identitas Resmi Mitra</h1>
  <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
    Untuk menjaga kepercayaan pelanggan dan standar keamanan platform, semua mitra teknisi wajib mengunggah identitas asli.
  </p>
</div>

<div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 32px; align-items: start;">
  <!-- Left Column: Verification Form / Status -->
  <div class="hs-card">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; border-bottom: 1px solid var(--hs-border); padding-bottom: 16px;">
      <h3 style="font-size: 1.2rem; color: var(--hs-primary);">Status Dokumen Anda</h3>
      <span class="hs-badge" style="background: #E8F7F0; color: #16A36A; border: 1px solid #A7E6CA;">
        <i class="bi bi-patch-check-fill"></i> Terverifikasi Penuh
      </span>
    </div>

    <!-- Verified Info Card -->
    <div style="background: #E8F7F0; border: 1px solid #A7E6CA; border-radius: var(--hs-radius-md); padding: 18px; margin-bottom: 24px;">
      <div style="display: flex; gap: 12px; align-items: flex-start;">
        <i class="bi bi-shield-fill-check" style="color: #16A36A; font-size: 1.5rem;"></i>
        <div>
          <div style="font-weight: 700; color: #065F46; font-size: 1rem;">Akun Anda Telah Lolos Uji Verifikasi Tim Admin</div>
          <div style="font-size: 0.8125rem; color: #047857; margin-top: 4px; line-height: 1.5;">
            NIK dan dokumen sertifikasi Anda telah disetujui pada 12 Januari 2026. Anda berhak menerima seluruh pesanan pelanggan di wilayah operasional Anda.
          </div>
        </div>
      </div>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="hs-form-group">
        <label class="hs-label">Nomor Induk Kependudukan (NIK)</label>
        <input type="text" class="hs-input" value="3174052108890003" readonly style="background-color: var(--hs-bg-main); font-weight: 600;">
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Foto KTP Resmi (Tersimpan Aman Enkripsi)</label>
        <div style="display: flex; gap: 14px; align-items: center; background: var(--hs-bg-main); padding: 14px; border-radius: var(--hs-radius-md);">
          <i class="bi bi-file-earmark-lock2-fill" style="font-size: 1.75rem; color: var(--hs-primary);"></i>
          <div>
            <div style="font-weight: 600; font-size: 0.875rem;">ktp_budi_santoso_verified.jpg</div>
            <div style="font-size: 0.75rem; color: #16A36A;">Tervalidasi oleh Admin Operasional</div>
          </div>
        </div>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Dokumen Sertifikat Keahlian / BNSP</label>
        <div style="display: flex; gap: 14px; align-items: center; background: var(--hs-bg-main); padding: 14px; border-radius: var(--hs-radius-md);">
          <i class="bi bi-award-fill" style="font-size: 1.75rem; color: var(--hs-secondary);"></i>
          <div>
            <div style="font-weight: 600; font-size: 0.875rem;">sertifikat_bnsp_refrigerasi_2023.pdf</div>
            <div style="font-size: 0.75rem; color: #16A36A;">Terdaftar Resmi BNSP</div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Right Column: Privacy & Guidelines -->
  <div>
    <div class="hs-card" style="margin-bottom: 24px;">
      <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 12px;">Keamanan Data KTP Anda</h3>
      <p style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.6; margin-bottom: 16px;">
        HomeService mematuhi regulasi perlindungan data pribadi. Berkas KTP Anda:
      </p>
      <ul style="list-style: none; display: flex; flex-direction: column; gap: 10px; font-size: 0.8125rem; color: var(--hs-text-secondary);">
        <li style="display: flex; gap: 8px;"><i class="bi bi-shield-check" style="color: #16A36A;"></i> <strong>Tidak Pernah Dipublikasikan:</strong> Pelanggan hanya melihat nama dan foto profil Anda.</li>
        <li style="display: flex; gap: 8px;"><i class="bi bi-lock-fill" style="color: var(--hs-primary);"></i> <strong>Terenkripsi 256-bit:</strong> Dokumen fisik file tersimpan di server berstandar keamanan ISO 27001.</li>
        <li style="display: flex; gap: 8px;"><i class="bi bi-eye-slash-fill" style="color: var(--hs-secondary);"></i> <strong>Akses Terbatas:</strong> Hanya Tim Legal & Verifikasi resmi HomeService yang memiliki hak periksa.</li>
      </ul>
    </div>
  </div>
</div>
@endsection
