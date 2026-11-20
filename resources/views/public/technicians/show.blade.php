@extends('layouts.app')

@section('title', 'Profil Teknisi Budi Santoso - HomeService')

@section('content')
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 32px 0;">
  <div class="hs-container">
    <div style="display: flex; gap: 8px; font-size: 0.8125rem; color: var(--hs-text-secondary); margin-bottom: 14px;">
      <a href="{{ url('/') }}">Beranda</a>
      <span>/</span>
      <a href="{{ route('public.technicians.index') }}">Daftar Teknisi</a>
      <span>/</span>
      <span style="color: var(--hs-primary); font-weight: 600;">Budi Santoso</span>
    </div>

    <!-- Header Bio Profile -->
    <div style="display: flex; gap: 28px; align-items: center;">
      <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=300&auto=format&fit=crop" alt="Budi Santoso" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--hs-border);">
      <div>
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
          <h1 style="font-size: 1.85rem; color: var(--hs-primary);">Budi Santoso</h1>
          <span class="hs-badge" style="background: #E8F7F0; color: #16A36A; border: 1px solid #A7E6CA;">
            <i class="bi bi-patch-check-fill"></i> Terverifikasi Resmi
          </span>
        </div>
        <p style="color: var(--hs-text-secondary); font-size: 0.9375rem; margin-bottom: 10px;">
          Spesialis Refrigerasi & Tata Udara (AC) • Anggota Mitra Sejak 2023
        </p>
        <div style="display: flex; gap: 20px; font-size: 0.875rem; color: var(--hs-text-primary);">
          <span><i class="bi bi-star-fill" style="color: #F59E0B;"></i> <strong>4.9</strong> (320 Ulasan)</span>
          <span><i class="bi bi-briefcase-fill" style="color: var(--hs-primary);"></i> <strong>348</strong> Order Selesai</span>
          <span><i class="bi bi-clock-history" style="color: var(--hs-primary);"></i> <strong>7 Tahun</strong> Pengalaman</span>
          <span><i class="bi bi-geo-alt-fill" style="color: var(--hs-secondary);"></i> Jakarta Selatan, Depok</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container">
    <div style="display: grid; grid-template-columns: 1fr 360px; gap: 36px; align-items: start;">
      <!-- Left Column: Details, Services, Reviews -->
      <div>
        <!-- About Section -->
        <div class="hs-card" style="margin-bottom: 28px;">
          <h3 style="font-size: 1.15rem; margin-bottom: 12px;">Tentang Teknisi</h3>
          <p style="color: var(--hs-text-primary); line-height: 1.7; font-size: 0.9375rem; margin-bottom: 16px;">
            Halo! Saya Budi Santoso, teknisi pendingin ruangan bersertifikat BNSP. Berpengalaman menangani berbagai merk AC split seperti Daikin, Panasonic, Sharp, Gree, LG, hingga sistem inverter dan AC komersial. Mengedepankan ketelitian, kebersihan tempat pengerjaan, dan penggunaan alat steam jet bertekanan pas agar unit AC awet dan hemat energi.
          </p>
          <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <span class="hs-badge hs-badge-neutral">Sertifikasi BNSP Refrigerasi</span>
            <span class="hs-badge hs-badge-neutral">Keahlian AC Inverter</span>
            <span class="hs-badge hs-badge-neutral">Deteksi Kebocoran Pipa</span>
            <span class="hs-badge hs-badge-neutral">Peralatan Standar Industri</span>
          </div>
        </div>

        <!-- Services Handled by this Technician -->
        <div style="margin-bottom: 32px;">
          <h3 style="font-size: 1.25rem; margin-bottom: 16px;">Layanan yang Disediakan</h3>
          <div style="display: flex; flex-direction: column; gap: 14px;">
            <div class="hs-card" style="padding: 18px 22px; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <h4 style="font-size: 1.05rem; margin-bottom: 4px;">Cuci AC Split (0.5 - 2 PK)</h4>
                <div style="font-size: 0.8125rem; color: var(--hs-text-secondary);">Estimasi 45-60 menit • Garansi 14 hari</div>
              </div>
              <div style="text-align: right;">
                <div style="font-weight: 700; color: var(--hs-primary); font-size: 1.1rem; margin-bottom: 6px;">Rp 75.000</div>
                <a href="{{ route('customer.bookings.create', ['service' => 'cuci-ac-split', 'technician' => 'budi-santoso']) }}" class="hs-btn hs-btn-primary hs-btn-sm">Pilih</a>
              </div>
            </div>

            <div class="hs-card" style="padding: 18px 22px; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <h4 style="font-size: 1.05rem; margin-bottom: 4px;">Tambah / Isi Freon R32 / R410A</h4>
                <div style="font-size: 0.8125rem; color: var(--hs-text-secondary);">Estimasi 30-45 menit • Freon murni original</div>
              </div>
              <div style="text-align: right;">
                <div style="font-weight: 700; color: var(--hs-primary); font-size: 1.1rem; margin-bottom: 6px;">Rp 150.000</div>
                <a href="{{ route('customer.bookings.create', ['service' => 'isi-freon', 'technician' => 'budi-santoso']) }}" class="hs-btn hs-btn-primary hs-btn-sm">Pilih</a>
              </div>
            </div>

            <div class="hs-card" style="padding: 18px 22px; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <h4 style="font-size: 1.05rem; margin-bottom: 4px;">Bongkar Pasang Unit AC Baru / Pindahan</h4>
                <div style="font-size: 0.8125rem; color: var(--hs-text-secondary);">Estimasi 2-3 jam • Termasuk vacuum instalasi</div>
              </div>
              <div style="text-align: right;">
                <div style="font-weight: 700; color: var(--hs-primary); font-size: 1.1rem; margin-bottom: 6px;">Rp 250.000</div>
                <a href="{{ route('customer.bookings.create', ['service' => 'bongkar-pasang-ac', 'technician' => 'budi-santoso']) }}" class="hs-btn hs-btn-primary hs-btn-sm">Pilih</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Ulasan -->
        <div>
          <h3 style="font-size: 1.25rem; margin-bottom: 16px;">Ulasan Kinerja Pelanggan</h3>
          <div class="hs-card">
            <div style="border-bottom: 1px solid var(--hs-border); padding-bottom: 16px; margin-bottom: 16px;">
              <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                <strong>Gilang Ramadhan</strong>
                <span style="font-size: 0.75rem; color: var(--hs-text-muted);">Kemarin</span>
              </div>
              <div style="color: #F59E0B; font-size: 0.8125rem; margin-bottom: 6px;">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p style="font-size: 0.875rem; color: var(--hs-text-secondary);">Pak Budi sangat cekatan. AC bocor di kamar kos langsung beres tanpa banyak alasan. Diberi saran juga untuk rutin bersihkan filter sebulan sekali.</p>
            </div>

            <div>
              <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                <strong>Melati Kusuma</strong>
                <span style="font-size: 0.75rem; color: var(--hs-text-muted);">5 hari lalu</span>
              </div>
              <div style="color: #F59E0B; font-size: 0.8125rem; margin-bottom: 6px;">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p style="font-size: 0.875rem; color: var(--hs-text-secondary);">Sangat profesional. Membawa peralatan lengkap dan tangga lipat sendiri. Rapi dan ramah.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Direct Booking Widget -->
      <div style="position: sticky; top: 96px;">
        <div class="hs-card" style="box-shadow: var(--hs-shadow-md);">
          <h3 style="font-size: 1.15rem; margin-bottom: 14px;">Pesan Teknisi Ini Langsung</h3>
          <p style="font-size: 0.875rem; color: var(--hs-text-secondary); margin-bottom: 18px;">
            Atur jadwal kunjungan langsung ke rumah Anda dengan memilih layanan yang dibutuhkan.
          </p>

          <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; font-size: 0.8125rem; color: var(--hs-text-primary);">
            <div style="display: flex; align-items: center; gap: 8px;">
              <i class="bi bi-check-circle-fill" style="color: #16A36A;"></i> Status: <strong>Aktif Siap Menerima Order</strong>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
              <i class="bi bi-clock-fill" style="color: var(--hs-primary);"></i> Jam Operasional: <strong>08.00 - 18.00 WIB</strong>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
              <i class="bi bi-shield-fill-check" style="color: var(--hs-secondary);"></i> Garansi Pengerjaan: <strong>14 Hari</strong>
            </div>
          </div>

          <a href="{{ route('customer.bookings.create', ['technician' => 'budi-santoso']) }}" class="hs-btn hs-btn-secondary hs-btn-lg" style="width: 100%; text-align: center;">
            Buat Janji Temu <i class="bi bi-calendar-event"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
