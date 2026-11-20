@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan Layanan - HomeService')

@section('content')
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 40px 0;">
  <div class="hs-container" style="max-width: 840px;">
    <h1 style="font-size: 2.25rem; color: var(--hs-primary); margin-bottom: 8px;">Syarat dan Ketentuan Layanan</h1>
    <p class="hs-subtitle">Terakhir Diperbarui: 1 Januari 2026</p>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container" style="max-width: 840px;">
    <div class="hs-card" style="padding: 36px; line-height: 1.8; font-size: 0.9375rem; color: var(--hs-text-primary);">
      <h3 style="font-size: 1.25rem; margin-bottom: 12px; color: var(--hs-primary);">1. Definisi dan Ketentuan Umum</h3>
      <p style="margin-bottom: 20px;">
        HomeService ("Platform") adalah sistem marketplace berbasis web yang memfasilitasi temu-hubung antara pengguna jasa rumah tangga ("Pelanggan") dan penyedia jasa perbaikan independen ("Mitra Teknisi"). Penggunaan platform ini tunduk pada syarat dan ketentuan yang mengikat secara hukum di Republik Indonesia.
      </p>

      <h3 style="font-size: 1.25rem; margin-bottom: 12px; color: var(--hs-primary);">2. Alur Transaksi dan Pembayaran</h3>
      <p style="margin-bottom: 20px;">
        Pelanggan dapat memilih metode pembayaran Tunai (Cash) atau Online Payment melalui payment gateway resmi Midtrans. Dalam metode Tunai, Pelanggan membayar langsung sejumlah nominal invoice yang disepakati kepada Mitra Teknisi saat pekerjaan dinyatakan selesai (Completed). Harga pesanan mencakup biaya jasa tenaga kerja, di luar suku cadang atau komponen tambahan yang disepakati bersama di lokasi pengerjaan.
      </p>

      <h3 style="font-size: 1.25rem; margin-bottom: 12px; color: var(--hs-primary);">3. Ketentuan Garansi Perbaikan 14 Hari</h3>
      <p style="margin-bottom: 20px;">
        Setiap pesanan yang berstatus Selesai (Completed) mendapatkan proteksi garansi pengerjaan ulang selama 14 (empat belas) hari kalender. Garansi mencakup kendala berulang pada objek perbaikan yang sama akibat kekurangtelitian teknis pengerjaan, dan tidak berlaku untuk kerusakan yang disebabkan oleh faktor eksternal (bencana alam, korsleting pasokan PLN, atau kelalaian pemakaian Pelanggan).
      </p>

      <h3 style="font-size: 1.25rem; margin-bottom: 12px; color: var(--hs-primary);">4. Hak dan Kewajiban Mitra Teknisi</h3>
      <p style="margin-bottom: 20px;">
        Mitra Teknisi wajib menjaga sopan santun, menggunakan identitas resmi, membawa peralatan kerja yang aman, dan mematuhi Standar Operasional Prosedur (SOP) HomeService. Mitra dilarang meminta biaya di luar persetujuan tertulis di platform atau melakukan transaksi offline langsung dengan Pelanggan tanpa melalui pencatatan sistem HomeService.
      </p>

      <h3 style="font-size: 1.25rem; margin-bottom: 12px; color: var(--hs-primary);">5. Pembatalan dan Pengembalian Dana</h3>
      <p>
        Pembatalan oleh Pelanggan saat status pesanan masih Menunggu Teknisi (Pending) atau Diterima (Accepted) tidak dikenakan biaya denda. Pelanggan berhak mengajukan pengaduan resmi via platform apabila terjadi perselisihan tarif atau hasil kerja yang tidak sesuai.
      </p>
    </div>
  </div>
</div>
@endsection
