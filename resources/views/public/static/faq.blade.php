@extends('layouts.app')

@section('title', 'Pusat Bantuan & Pertanyaan Umum (FAQ) - HomeService')

@section('content')
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 48px 0;">
  <div class="hs-container" style="text-align: center; max-width: 760px;">
    <span style="color: var(--hs-secondary); font-weight: 700; text-transform: uppercase; font-size: 0.8125rem; letter-spacing: 0.05em;">Pusat Bantuan</span>
    <h1 style="font-size: 2.5rem; color: var(--hs-primary); margin-top: 8px; margin-bottom: 16px;">
      Pertanyaan yang Sering Diajukan
    </h1>
    <p class="hs-subtitle">
      Temukan jawaban cepat seputar pemesanan, verifikasi keamanan teknisi, metode pembayaran, dan klaim garansi.
    </p>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container" style="max-width: 860px;">
    <div style="display: flex; flex-direction: column; gap: 16px;">
      <!-- FAQ 1 -->
      <div class="hs-card" style="padding: 24px;">
        <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
          <i class="bi bi-question-circle" style="color: var(--hs-secondary);"></i>
          Bagaimana cara memastikan teknisi yang datang ke rumah aman dan terpercaya?
        </h3>
        <p style="font-size: 0.9375rem; color: var(--hs-text-secondary); line-height: 1.6;">
          Setiap calon mitra teknisi wajib mengunggah KTP asli, nomor telepon aktif, serta dokumen sertifikasi keterampilan yang diverifikasi secara manual oleh Tim Operasional HomeService. Anda dapat memeriksa nama, foto resmi, dan ulasan pelanggan sebelum menyetujui kunjungan teknisi.
        </p>
      </div>

      <!-- FAQ 2 -->
      <div class="hs-card" style="padding: 24px;">
        <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
          <i class="bi bi-question-circle" style="color: var(--hs-secondary);"></i>
          Bagaimana ketentuan klaim Garansi Perbaikan 14 Hari?
        </h3>
        <p style="font-size: 0.9375rem; color: var(--hs-text-secondary); line-height: 1.6;">
          Garansi berlaku 14 hari kalender terhitung sejak pekerjaan selesai (status Completed). Apabila terjadi masalah berulang pada titik pengerjaan yang sama, Anda cukup membuka halaman <strong>Customer Dashboard &gt; Pengaduan</strong> untuk mengajukan klaim kunjungan perbaikan ulang tanpa biaya jasa tambahan.
        </p>
      </div>

      <!-- FAQ 3 -->
      <div class="hs-card" style="padding: 24px;">
        <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
          <i class="bi bi-question-circle" style="color: var(--hs-secondary);"></i>
          Metode pembayaran apa saja yang didukung oleh HomeService?
        </h3>
        <p style="font-size: 0.9375rem; color: var(--hs-text-secondary); line-height: 1.6;">
          Kami mendukung dua metode pembayaran fleksibel:
          <br>1. <strong>Cash / Tunai:</strong> Pembayaran langsung kepada teknisi setelah seluruh pengerjaan selesai diperiksa.
          <br>2. <strong>Online Payment:</strong> Pembayaran instan via Virtual Account BCA/Mandiri/BRI/BNI, QRIS, dan GoPay/ShopeePay yang terintegrasi dengan Midtrans Payment Gateway.
        </p>
      </div>

      <!-- FAQ 4 -->
      <div class="hs-card" style="padding: 24px;">
        <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
          <i class="bi bi-question-circle" style="color: var(--hs-secondary);"></i>
          Apakah saya bisa membatalkan pesanan yang sudah dibuat?
        </h3>
        <p style="font-size: 0.9375rem; color: var(--hs-text-secondary); line-height: 1.6;">
          Pembatalan gratis dapat dilakukan selama status pesanan masih <em>Pending</em> atau <em>Accepted</em> (sebelum teknisi memulai perjalanan menuju lokasi). Jika teknisi sudah berstatus <em>On The Way</em> atau tiba di lokasi, biaya kompensasi transportasi wajar dapat dikenakan.
        </p>
      </div>

      <!-- FAQ 5 -->
      <div class="hs-card" style="padding: 24px;">
        <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
          <i class="bi bi-question-circle" style="color: var(--hs-secondary);"></i>
          Bagaimana jika dibutuhkan penggantian suku cadang (spare part)?
        </h3>
        <p style="font-size: 0.9375rem; color: var(--hs-text-secondary); line-height: 1.6;">
          Harga standar yang tertera di sistem adalah biaya jasa tenaga kerja teknisi. Apabila saat pengecekan dibutuhkan suku cadang pengganti (seperti kapasitor AC, kran baru, atau pipa), teknisi wajib menginformasikan perkiraan harga suku cadang tersebut terlebih dahulu dan meminta persetujuan Anda sebelum dipasang.
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
