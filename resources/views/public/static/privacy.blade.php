@extends('layouts.app')

@section('title', 'Kebijakan Privasi Data - HomeService')

@section('content')
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 40px 0;">
  <div class="hs-container" style="max-width: 840px;">
    <h1 style="font-size: 2.25rem; color: var(--hs-primary); margin-bottom: 8px;">Kebijakan Privasi & Keamanan Data</h1>
    <p class="hs-subtitle">Prinsip Perlindungan Data Pribadi Pelanggan dan Mitra Teknisi HomeService</p>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container" style="max-width: 840px;">
    <div class="hs-card" style="padding: 36px; line-height: 1.8; font-size: 0.9375rem; color: var(--hs-text-primary);">
      <h3 style="font-size: 1.25rem; margin-bottom: 12px; color: var(--hs-primary);">1. Pengumpulan Informasi Pribadi</h3>
      <p style="margin-bottom: 20px;">
        Kami mengumpulkan informasi yang Anda berikan secara langsung saat mendaftar akun, seperti nama lengkap, alamat tempat tinggal, nomor telepon WhatsApp, dan alamat email. Untuk Mitra Teknisi, kami mengumpulkan foto identitas resmi (KTP), Surat Keterangan Catatan Kepolisian (SKCK), dan sertifikat keahlian guna keperluan verifikasi keamanan ketat.
      </p>

      <h3 style="font-size: 1.25rem; margin-bottom: 12px; color: var(--hs-primary);">2. Enkripsi dan Kerahasiaan Dokumen KTP</h3>
      <p style="margin-bottom: 20px;">
        Dokumen identitas (KTP) dan berkas verifikasi mitra teknisi disimpan dalam sistem penyimpanan terproteksi dengan enkripsi setara standar industri perbankan (AES-256). Dokumen tersebut <strong>tidak pernah dipublikasikan secara terbuka</strong> dan hanya dapat diakses oleh Administrator Terverifikasi untuk keperluan evaluasi akun.
      </p>

      <h3 style="font-size: 1.25rem; margin-bottom: 12px; color: var(--hs-primary);">3. Penggunaan Alamat dan Lokasi</h3>
      <p style="margin-bottom: 20px;">
        Alamat rumah dan catatan lokasi pelanggan hanya dibagikan kepada Teknisi yang secara resmi telah menerima (Accepted) pesanan yang bersangkutan untuk keperluan penunjuk rute pengerjaan perbaikan. Nomor telepon tidak akan pernah diperjualbelikan kepada pihak ketiga manapun untuk tujuan periklanan spam.
      </p>

      <h3 style="font-size: 1.25rem; margin-bottom: 12px; color: var(--hs-primary);">4. Hak Pengguna atas Data</h3>
      <p>
        Setiap pengguna memiliki hak mutlak untuk memperbarui data profil, mengubah kata sandi, menghapus alamat tersimpan, maupun mengajukan penutupan akun secara permanen melalui saluran resmi customer support HomeService.
      </p>
    </div>
  </div>
</div>
@endsection
