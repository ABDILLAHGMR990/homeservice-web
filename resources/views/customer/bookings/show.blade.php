@extends('layouts.customer')

@section('title', 'Detail Pesanan HS-2026-001 - HomeService')

@section('content')
<!-- Back Breadcrumb -->
<div style="margin-bottom: 20px;">
  <a href="{{ route('customer.bookings.index') }}" class="hs-btn hs-btn-ghost hs-btn-sm">
    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
  </a>
</div>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
  <div>
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 4px;">
      <h1 style="font-size: 1.75rem; color: var(--hs-primary);">Pesanan #HS-2026-001</h1>
      <x-status-badge status="on_the_way" />
    </div>
    <p style="color: var(--hs-text-secondary); font-size: 0.875rem;">
      Dipesan pada 17 November 2026, 08:30 WIB
    </p>
  </div>

  <div style="display: flex; gap: 10px;">
    <a href="{{ route('customer.chat.index') }}" class="hs-btn hs-btn-outline">
      <i class="bi bi-chat-dots-fill"></i> Chat Teknisi
    </a>
    <a href="{{ route('customer.complaints.index') }}" class="hs-btn hs-btn-ghost" style="color: var(--hs-danger);">
      <i class="bi bi-flag"></i> Ajukan Kendala
    </a>
  </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 360px; gap: 28px; align-items: start;">
  <!-- Left Column: Tracking & Service Info -->
  <div>
    <!-- Status Machine Visual Tracking Card -->
    <div class="hs-card" style="margin-bottom: 24px;">
      <h3 style="font-size: 1.1rem; margin-bottom: 18px;">Pelacakan Tahapan Pekerjaan</h3>
      
      <div style="position: relative; padding-left: 32px; display: flex; flex-direction: column; gap: 24px;">
        <!-- Step 1 -->
        <div style="position: relative;">
          <div style="position: absolute; left: -32px; top: 0; width: 22px; height: 22px; border-radius: 50%; background: #16A36A; color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-size: 0.75rem;">
            <i class="bi bi-check-lg"></i>
          </div>
          <div style="font-weight: 600; color: var(--hs-primary); font-size: 0.9375rem;">Pesanan Berhasil Dibuat</div>
          <div style="font-size: 0.8125rem; color: var(--hs-text-secondary);">17 Nov 2026, 08:30 WIB - Pesanan masuk ke sistem antrean teknisi.</div>
        </div>

        <!-- Step 2 -->
        <div style="position: relative;">
          <div style="position: absolute; left: -32px; top: 0; width: 22px; height: 22px; border-radius: 50%; background: #16A36A; color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-size: 0.75rem;">
            <i class="bi bi-check-lg"></i>
          </div>
          <div style="font-weight: 600; color: var(--hs-primary); font-size: 0.9375rem;">Dikonfirmasi oleh Teknisi Budi Santoso</div>
          <div style="font-size: 0.8125rem; color: var(--hs-text-secondary);">17 Nov 2026, 08:45 WIB - Teknisi menyetujui jadwal dan menyiapkan perlengkapan.</div>
        </div>

        <!-- Step 3: Current -->
        <div style="position: relative;">
          <div style="position: absolute; left: -32px; top: 0; width: 22px; height: 22px; border-radius: 50%; background: var(--hs-secondary); color: var(--hs-primary); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800;">
            <i class="bi bi-bicycle"></i>
          </div>
          <div style="font-weight: 700; color: #B45309; font-size: 0.9375rem;">Teknisi Sedang Dalam Perjalanan Menuju Lokasi</div>
          <div style="font-size: 0.8125rem; color: var(--hs-text-secondary);">17 Nov 2026, 09:15 WIB - Estimasi waktu tiba di lokasi dalam 15-20 menit.</div>
        </div>

        <!-- Step 4 -->
        <div style="position: relative; opacity: 0.5;">
          <div style="position: absolute; left: -32px; top: 0; width: 22px; height: 22px; border-radius: 50%; background: var(--hs-border); color: var(--hs-text-muted); display: flex; align-items: center; justify-content: center; font-size: 0.75rem;">
            4
          </div>
          <div style="font-weight: 600; color: var(--hs-text-secondary); font-size: 0.9375rem;">Pekerjaan Sedang Berlangsung</div>
          <div style="font-size: 0.8125rem; color: var(--hs-text-muted);">Pemeriksaan dan pencucian unit di tempat.</div>
        </div>

        <!-- Step 5 -->
        <div style="position: relative; opacity: 0.5;">
          <div style="position: absolute; left: -32px; top: 0; width: 22px; height: 22px; border-radius: 50%; background: var(--hs-border); color: var(--hs-text-muted); display: flex; align-items: center; justify-content: center; font-size: 0.75rem;">
            5
          </div>
          <div style="font-weight: 600; color: var(--hs-text-secondary); font-size: 0.9375rem;">Selesai & Penerbitan Garansi 14 Hari</div>
          <div style="font-size: 0.8125rem; color: var(--hs-text-muted);">Uji coba dingin bersama dan penyelesaian pembayaran.</div>
        </div>
      </div>
    </div>

    <!-- Items Detail Table -->
    <div class="hs-card" style="margin-bottom: 24px;">
      <h3 style="font-size: 1.1rem; margin-bottom: 16px;">Rincian Layanan yang Dipesan</h3>
      <div class="hs-table-responsive" style="border: 1px solid var(--hs-border); border-radius: var(--hs-radius-md);">
        <table class="hs-table">
          <thead>
            <tr>
              <th>Deskripsi Item</th>
              <th>Jumlah</th>
              <th>Tarif Satuan</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div style="font-weight: 600; color: var(--hs-primary);">Cuci & Maintenance AC Split (0.5 - 2 PK)</div>
                <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">AC Kamar Utama, merk Daikin 1 PK</div>
              </td>
              <td>1 Unit</td>
              <td>Rp 75.000</td>
              <td><strong style="color: var(--hs-primary);">Rp 75.000</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Location & Customer Problem Notes -->
    <div class="hs-card">
      <h3 style="font-size: 1.1rem; margin-bottom: 16px;">Lokasi & Catatan Keluhan</h3>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div>
          <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--hs-text-muted); margin-bottom: 4px;">Alamat Pengerjaan</div>
          <div style="font-weight: 600; color: var(--hs-primary);">Rumah Pribadi (Ibu Dian)</div>
          <div style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.5; margin-top: 4px;">
            Jl. Tebet Barat Dalam Raya No. 42B, RT 04 / RW 02, Tebet Barat, Jakarta Selatan, DKI Jakarta 12810.
          </div>
          <div style="font-size: 0.8125rem; color: #B45309; margin-top: 6px;">
            <i class="bi bi-info-circle"></i> Patokan: Rumah pagar hitam samping laundry.
          </div>
        </div>

        <div>
          <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--hs-text-muted); margin-bottom: 4px;">Catatan Pelanggan</div>
          <div style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.6; background: var(--hs-bg-main); padding: 12px; border-radius: var(--hs-radius-md);">
            "AC kamar sudah 4 bulan belum dicuci, hembusan angin terasa kurang dingin dan ada sedikit tetesan air di pojok kanan bawah casing."
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Right Column: Technician Profile & Payment Box -->
  <div>
    <!-- Assigned Technician Card -->
    <div class="hs-card" style="margin-bottom: 24px;">
      <h3 style="font-size: 1.1rem; margin-bottom: 14px;">Teknisi yang Bertugas</h3>
      <div style="display: flex; gap: 14px; align-items: center; margin-bottom: 16px;">
        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=200&auto=format&fit=crop" alt="Budi Santoso" style="width: 56px; height: 56px; border-radius: 50%; object-fit: cover;">
        <div>
          <h4 style="font-size: 1rem; color: var(--hs-primary); margin-bottom: 2px;">
            Budi Santoso <i class="bi bi-patch-check-fill" style="color: #16A36A; font-size: 0.9rem;"></i>
          </h4>
          <div style="font-size: 0.8125rem; color: var(--hs-text-secondary);">Spesialis AC & Pendingin</div>
          <div style="font-size: 0.75rem; color: #F59E0B; margin-top: 2px;">
            <i class="bi bi-star-fill"></i> 4.9 (320 ulasan)
          </div>
        </div>
      </div>

      <div style="display: flex; flex-direction: column; gap: 8px;">
        <a href="https://wa.me/6281298765432" target="_blank" class="hs-btn hs-btn-outline hs-btn-sm" style="color: #16A36A; border-color: #A7E6CA;">
          <i class="bi bi-whatsapp"></i> WhatsApp Teknisi
        </a>
        <a href="{{ route('customer.chat.index') }}" class="hs-btn hs-btn-primary hs-btn-sm">
          <i class="bi bi-chat-dots-fill"></i> Chat di Aplikasi
        </a>
      </div>
    </div>

    <!-- Payment Summary Box -->
    <div class="hs-card">
      <h3 style="font-size: 1.1rem; margin-bottom: 14px;">Ringkasan Pembayaran</h3>
      <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 8px;">
        <span style="color: var(--hs-text-secondary);">Biaya Jasa Layanan</span>
        <span>Rp 75.000</span>
      </div>
      <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 8px;">
        <span style="color: var(--hs-text-secondary);">Biaya Perlindungan Garansi</span>
        <span style="color: #16A36A; font-weight: 600;">GRATIS</span>
      </div>
      <div style="border-top: 1px solid var(--hs-border); padding-top: 10px; margin-top: 10px; display: flex; justify-content: space-between; align-items: center;">
        <span style="font-weight: 700; color: var(--hs-primary);">Total Tagihan</span>
        <span style="font-size: 1.25rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">Rp 75.000</span>
      </div>

      <div style="margin-top: 16px; padding: 12px; background: var(--hs-bg-main); border-radius: var(--hs-radius-md); font-size: 0.8125rem;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
          <span style="color: var(--hs-text-secondary);">Metode Bayar:</span>
          <strong>Tunai (Cash ke Teknisi)</strong>
        </div>
        <div style="display: flex; justify-content: space-between;">
          <span style="color: var(--hs-text-secondary);">Status Bayar:</span>
          <span style="color: #B45309; font-weight: 600;">Menunggu Penyelesaian</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
