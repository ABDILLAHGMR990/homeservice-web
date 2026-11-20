@extends('layouts.provider')

@section('title', 'Detail & Proses Pekerjaan HS-2026-001 - HomeService')

@section('content')
<div style="margin-bottom: 20px;">
  <a href="{{ route('provider.bookings.index') }}" class="hs-btn hs-btn-ghost hs-btn-sm">
    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pekerjaan
  </a>
</div>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
  <div>
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 4px;">
      <h1 style="font-size: 1.75rem; color: var(--hs-primary);">Pekerjaan #HS-2026-001</h1>
      <x-status-badge status="on_the_way" />
    </div>
    <p style="color: var(--hs-text-secondary); font-size: 0.875rem;">
      Jadwal Kunjungan: Hari Ini, 17 November 2026, 10:00 WIB
    </p>
  </div>

  <div style="display: flex; gap: 10px;">
    <a href="https://wa.me/6281234567890" target="_blank" class="hs-btn hs-btn-outline" style="color: #16A36A; border-color: #A7E6CA;">
      <i class="bi bi-whatsapp"></i> Hubungi Pelanggan
    </a>
  </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 380px; gap: 28px; align-items: start;">
  <!-- Left Column: Details & Status Transition Actions -->
  <div>
    <!-- Interactive Status Transition Card (Core Workflow) -->
    <div class="hs-card" style="border: 2px solid var(--hs-primary); margin-bottom: 24px; background: #FFFFFF;">
      <h3 style="font-size: 1.15rem; color: var(--hs-primary); margin-bottom: 12px;">
        Pembaruan Status Tahapan Pekerjaan
      </h3>
      <p style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.5; margin-bottom: 20px;">
        Perbarui status Anda sesuai kondisi riil di lapangan. Pelanggan akan mendapatkan notifikasi otomatis di setiap tahap.
      </p>

      <form action="{{ route('provider.bookings.update-status', ['booking_code' => 'HS-2026-001']) }}" method="POST">
        @csrf
        <div style="background: var(--hs-bg-main); border-radius: var(--hs-radius-md); padding: 18px; margin-bottom: 20px;">
          <div style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary); margin-bottom: 6px;">
            Status Saat Ini:
          </div>
          <div style="font-weight: 700; color: #B45309; font-size: 1.1rem; display: flex; align-items: center; gap: 8px;">
            <i class="bi bi-bicycle"></i> Sedang Dalam Perjalanan Menuju Lokasi (On The Way)
          </div>
        </div>

        <div style="display: flex; gap: 12px;">
          <!-- Next Action Button -->
          <input type="hidden" name="status" value="in_progress">
          <button type="submit" class="hs-btn hs-btn-primary hs-btn-lg" style="flex-grow: 1;">
            <i class="bi bi-geo-alt-fill"></i> Konfirmasi Tiba di Lokasi & Mulai Kerjakan
          </button>
        </div>
      </form>
    </div>

    <!-- Customer Location & Destination Details -->
    <div class="hs-card" style="margin-bottom: 24px;">
      <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 16px;">Alamat Pengerjaan Pelanggan</h3>
      <div style="font-weight: 700; color: var(--hs-primary); font-size: 1.05rem; margin-bottom: 4px;">
        Dian Anggraini (Rumah Pribadi)
      </div>
      <div style="font-size: 0.9375rem; color: var(--hs-text-secondary); line-height: 1.6; margin-bottom: 14px;">
        Jl. Tebet Barat Dalam Raya No. 42B, RT 04 / RW 02, Tebet Barat, Jakarta Selatan, DKI Jakarta 12810.
      </div>

      <div style="background: #FEF6E8; border: 1px solid #FCD34D; border-radius: var(--hs-radius-md); padding: 12px 16px; font-size: 0.875rem; color: #B45309; margin-bottom: 16px;">
        <strong>Patokan Lokasi:</strong> Rumah pagar hitam tepat di samping laundry express.
      </div>

      <a href="https://maps.google.com/?q=Tebet+Barat+Dalam+Raya+Jakarta" target="_blank" class="hs-btn hs-btn-outline hs-btn-sm">
        <i class="bi bi-map-fill"></i> Buka Google Maps Rute Lokasi
      </a>
    </div>

    <!-- Complaint Notes -->
    <div class="hs-card">
      <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 12px;">Keluhan dari Pelanggan</h3>
      <div style="background: var(--hs-bg-main); padding: 16px; border-radius: var(--hs-radius-md); font-size: 0.875rem; color: var(--hs-text-primary); line-height: 1.6;">
        "AC kamar sudah 4 bulan belum dicuci, hembusan angin terasa kurang dingin dan ada sedikit tetesan air di pojok kanan bawah casing."
      </div>
    </div>
  </div>

  <!-- Right Column: Financial & Order Breakdown -->
  <div>
    <!-- Earnings Breakdown -->
    <div class="hs-card" style="margin-bottom: 24px;">
      <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 16px;">Rincian Bagi Hasil</h3>

      <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 10px;">
        <span style="color: var(--hs-text-secondary);">Tarif Layanan (Gross)</span>
        <strong>Rp 75.000</strong>
      </div>

      <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 14px;">
        <span style="color: var(--hs-text-secondary);">Potongan Komisi Platform (10%)</span>
        <span style="color: var(--hs-danger);">- Rp 7.500</span>
      </div>

      <div style="border-top: 1px solid var(--hs-border); padding-top: 14px; display: flex; justify-content: space-between; align-items: center;">
        <span style="font-weight: 700; color: var(--hs-primary);">Pendapatan Bersih Mitra</span>
        <span style="font-size: 1.35rem; font-weight: 700; color: #16A36A; font-family: var(--hs-font-heading);">
          Rp 67.500
        </span>
      </div>

      <div style="margin-top: 16px; padding: 12px; background: var(--hs-bg-main); border-radius: var(--hs-radius-md); font-size: 0.8125rem;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
          <span style="color: var(--hs-text-secondary);">Metode Bayar:</span>
          <strong>Tunai (Terima dari Pelanggan)</strong>
        </div>
        <div style="font-size: 0.75rem; color: var(--hs-text-muted); margin-top: 4px;">
          *Komisi platform sebesar Rp 7.500 akan dipotong otomatis dari saldo dompet deposit aplikasi Anda saat status Selesai.
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
