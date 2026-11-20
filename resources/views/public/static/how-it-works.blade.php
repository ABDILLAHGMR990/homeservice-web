@extends('layouts.app')

@section('title', 'Cara Kerja Pemesanan Jasa - HomeService')

@section('content')
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 48px 0;">
  <div class="hs-container" style="text-align: center; max-width: 760px;">
    <span style="color: var(--hs-secondary); font-weight: 700; text-transform: uppercase; font-size: 0.8125rem; letter-spacing: 0.05em;">Panduan Pengguna</span>
    <h1 style="font-size: 2.5rem; color: var(--hs-primary); margin-top: 8px; margin-bottom: 16px;">
      Bagaimana HomeService Bekerja
    </h1>
    <p class="hs-subtitle">
      Alur pemesanan transparan dari memilih spesialisasi perbaikan hingga pekerjaan selesai dengan proteksi garansi penuh.
    </p>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container" style="max-width: 860px;">
    <div style="display: flex; flex-direction: column; gap: 32px;">
      <!-- Step 1 -->
      <div class="hs-card" style="display: flex; gap: 24px; padding: 32px; align-items: flex-start;">
        <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--hs-primary); color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; flex-shrink: 0;">
          1
        </div>
        <div>
          <h3 style="font-size: 1.25rem; margin-bottom: 8px;">Pilih Layanan & Deskripsikan Kendala</h3>
          <p style="color: var(--hs-text-secondary); line-height: 1.6; font-size: 0.9375rem;">
            Buka katalog layanan HomeService, pilih kategori yang relevan (seperti Service AC, Instalasi Listrik, atau Plumbing). Masukkan deskripsi kendala yang Anda alami secara spesifik agar teknisi dapat menyiapkan peralatan kerja yang tepat dari awal.
          </p>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="hs-card" style="display: flex; gap: 24px; padding: 32px; align-items: flex-start;">
        <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--hs-primary); color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; flex-shrink: 0;">
          2
        </div>
        <div>
          <h3 style="font-size: 1.25rem; margin-bottom: 8px;">Tentukan Jadwal & Pilih Mitra Teknisi</h3>
          <p style="color: var(--hs-text-secondary); line-height: 1.6; font-size: 0.9375rem;">
            Pilih tanggal dan jam kedatangan yang sesuai dengan waktu luang Anda di rumah. Anda dapat memilih teknisi favorit Anda sendiri berdasarkan ulasan atau membiarkan sistem menyalurkan pesanan ke teknisi terdekat yang paling siap.
          </p>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="hs-card" style="display: flex; gap: 24px; padding: 32px; align-items: flex-start;">
        <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--hs-primary); color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; flex-shrink: 0;">
          3
        </div>
        <div>
          <h3 style="font-size: 1.25rem; margin-bottom: 8px;">Pantau Status Pekerjaan Realtime</h3>
          <p style="color: var(--hs-text-secondary); line-height: 1.6; font-size: 0.9375rem;">
            Lacak setiap tahapan secara langsung: saat teknisi menerima pesanan (Accepted), sedang dalam perjalanan menuju rumah Anda (On The Way), hingga saat perbaikan sedang berlangsung (In Progress).
          </p>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="hs-card" style="display: flex; gap: 24px; padding: 32px; align-items: flex-start;">
        <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--hs-secondary); color: var(--hs-primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; flex-shrink: 0;">
          4
        </div>
        <div>
          <h3 style="font-size: 1.25rem; margin-bottom: 8px;">Penyelesaian Pembayaran & Proteksi Garansi 14 Hari</h3>
          <p style="color: var(--hs-text-secondary); line-height: 1.6; font-size: 0.9375rem;">
            Setelah pekerjaan dites dan disetujui, bayar secara praktis menggunakan uang tunai langsung ke teknisi atau pembayaran online Midtrans. Bukti transaksi dan kartu garansi digital otomatis tersimpan di riwayat pesanan Anda.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
