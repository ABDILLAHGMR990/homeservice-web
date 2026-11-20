@extends('layouts.app')

@section('title', 'Cuci & Maintenance AC Split - HomeService')

@section('content')
<!-- Header Breadcrumb -->
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 24px 0;">
  <div class="hs-container">
    <div style="display: flex; gap: 8px; font-size: 0.8125rem; color: var(--hs-text-secondary);">
      <a href="{{ url('/') }}">Beranda</a>
      <span>/</span>
      <a href="{{ route('public.services.index') }}">Semua Layanan</a>
      <span>/</span>
      <a href="{{ route('public.services.index', ['category' => 'service-ac']) }}">Service AC</a>
      <span>/</span>
      <span style="color: var(--hs-primary); font-weight: 600;">Cuci & Maintenance AC Split</span>
    </div>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container">
    <div style="display: grid; grid-template-columns: 1fr 380px; gap: 40px; align-items: start;">
      <!-- Left Column: Service Details & Content -->
      <div>
        <div style="border-radius: var(--hs-radius-lg); overflow: hidden; height: 380px; margin-bottom: 24px; box-shadow: var(--hs-shadow-sm);">
          <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?q=80&w=1000&auto=format&fit=crop" alt="Cuci & Maintenance AC Split" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

        <div style="display: flex; gap: 10px; margin-bottom: 12px; align-items: center;">
          <span class="hs-badge" style="background: var(--hs-primary-surface); color: var(--hs-primary); font-size: 0.8125rem;">
            Kategori: Service AC
          </span>
          <span style="display: flex; align-items: center; gap: 4px; font-size: 0.875rem; color: #F59E0B; font-weight: 700;">
            <i class="bi bi-star-fill"></i> 4.9 <span style="color: var(--hs-text-secondary); font-weight: 400;">(420 Ulasan Terverifikasi)</span>
          </span>
        </div>

        <h1 style="font-size: 2.25rem; color: var(--hs-primary); margin-bottom: 18px;">
          Cuci & Maintenance AC Split (0.5 - 2 PK)
        </h1>

        <div class="hs-card" style="margin-bottom: 32px; background: #FFFFFF;">
          <h3 style="font-size: 1.15rem; margin-bottom: 12px;">Deskripsi Layanan</h3>
          <p style="color: var(--hs-text-primary); line-height: 1.7; font-size: 0.9375rem; margin-bottom: 18px;">
            Layanan cuci AC profesional berkala untuk mengembalikan kesejukan udara ruangan, menghemat konsumsi listrik, dan mencegah kebocoran air akibat talang yang tersumbat lendir kotoran. Menggunakan mesin pompa steam jet bertekanan pas sehingga kisi-kisi evaporator aluminium tetap aman dan tidak bengkok.
          </p>

          <h4 style="font-size: 0.9375rem; font-weight: 700; color: var(--hs-primary); margin-bottom: 10px;">Cakupan Pekerjaan yang Termasuk:</h4>
          <ul style="list-style: none; display: flex; flex-direction: column; gap: 8px; font-size: 0.875rem; color: var(--hs-text-secondary); margin-bottom: 20px;">
            <li style="display: flex; gap: 8px; align-items: center;"><i class="bi bi-check2" style="color: #16A36A; font-weight: 800; font-size: 1.1rem;"></i> Pembersihan casing penutup depan, kisi swing, dan filter udara.</li>
            <li style="display: flex; gap: 8px; align-items: center;"><i class="bi bi-check2" style="color: #16A36A; font-weight: 800; font-size: 1.1rem;"></i> Penyemprotan evaporator unit indoor dan talang pembuangan air.</li>
            <li style="display: flex; gap: 8px; align-items: center;"><i class="bi bi-check2" style="color: #16A36A; font-weight: 800; font-size: 1.1rem;"></i> Pembersihan kisi kondensor luar (unit outdoor kompresor).</li>
            <li style="display: flex; gap: 8px; align-items: center;"><i class="bi bi-check2" style="color: #16A36A; font-weight: 800; font-size: 1.1rem;"></i> Pengecekan arus listrik kompresor (Ampere) & suhu hembusan dingin.</li>
            <li style="display: flex; gap: 8px; align-items: center;"><i class="bi bi-check2" style="color: #16A36A; font-weight: 800; font-size: 1.1rem;"></i> Garansi perbaikan 14 hari bila timbul rembesan air pasca pencucian.</li>
          </ul>

          <div style="background: var(--hs-bg-main); border-left: 4px solid var(--hs-secondary); padding: 14px 18px; border-radius: var(--hs-radius-xs); font-size: 0.8125rem; color: var(--hs-text-secondary);">
            <strong>Catatan Teknisi:</strong> Pengisian freon tambahan atau perbaikan spare part kapasitor/kompresor dikenakan biaya terpisah sesuai persetujuan pemilik setelah pengecekan di lokasi.
          </div>
        </div>

        <!-- Teknisi yang Melayani -->
        <div style="margin-bottom: 36px;">
          <h3 style="font-size: 1.3rem; margin-bottom: 18px;">Teknisi Tersedia untuk Layanan Ini</h3>
          <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px;">
            <x-technician-card
              name="Budi Santoso"
              skill="Spesialis AC & Pendingin"
              avatar="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=300&auto=format&fit=crop"
              rating="4.9"
              completedJobs="320"
              experienceYears="7"
              url="{{ route('public.technicians.show', ['username' => 'budi-santoso']) }}">
              Siap melayani Jakarta Selatan, Pusat & Tangerang.
            </x-technician-card>

            <x-technician-card
              name="Ahmad Fauzi"
              skill="Teknisi AC Split & Inverter"
              avatar="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300&auto=format&fit=crop"
              rating="4.8"
              completedJobs="215"
              experienceYears="5"
              url="{{ route('public.technicians.show', ['username' => 'ahmad-fauzi']) }}">
              Siap melayani Jakarta Barat & Tangerang Selatan.
            </x-technician-card>
          </div>
        </div>

        <!-- Ulasan Pelanggan -->
        <div>
          <h3 style="font-size: 1.3rem; margin-bottom: 18px;">Ulasan & Penilaian Pelanggan</h3>
          <div class="hs-card" style="padding: 24px;">
            <!-- Review Row 1 -->
            <div style="border-bottom: 1px solid var(--hs-border); padding-bottom: 18px; margin-bottom: 18px;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="font-weight: 600; color: var(--hs-primary);">Hendrik Setiawan</span>
                <span style="font-size: 0.75rem; color: var(--hs-text-muted);">3 hari lalu</span>
              </div>
              <div style="color: #F59E0B; font-size: 0.8125rem; margin-bottom: 6px;">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.5;">
                Pengerjaan rapi sekali. Teknisi bawa plastik corong air sendiri jadi kasur bawah AC aman kering tidak kena cipratan. AC langsung dingin menusuk lagi.
              </p>
            </div>

            <!-- Review Row 2 -->
            <div>
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="font-weight: 600; color: var(--hs-primary);">Nadya Priscillia</span>
                <span style="font-size: 0.75rem; color: var(--hs-text-muted);">1 minggu lalu</span>
              </div>
              <div style="color: #F59E0B; font-size: 0.8125rem; margin-bottom: 6px;">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
              </div>
              <p style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.5;">
                Sangat tepat waktu, sopan santun teknisinya. Ditunjukkan juga kondisi filter sebelum dan sesudah dicuci. Recommended banget buat anak kos.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Sticky Booking Action Card -->
      <div style="position: sticky; top: 96px;">
        <div class="hs-card" style="box-shadow: var(--hs-shadow-md); border-color: #CBD5E1;">
          <div style="font-size: 0.8125rem; color: var(--hs-text-secondary); margin-bottom: 4px;">Biaya Standar Mulai Dari</div>
          <div style="font-size: 2rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading); margin-bottom: 16px;">
            Rp 75.000 <span style="font-size: 0.875rem; font-weight: 400; color: var(--hs-text-secondary);">/ Unit</span>
          </div>

          <div style="background-color: var(--hs-bg-main); border-radius: var(--hs-radius-md); padding: 14px; margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.875rem;">
              <span style="color: var(--hs-text-secondary);"><i class="bi bi-clock"></i> Estimasi Durasi</span>
              <strong>45 - 60 Menit</strong>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.875rem;">
              <span style="color: var(--hs-text-secondary);"><i class="bi bi-shield-check"></i> Perlindungan</span>
              <strong style="color: #16A36A;">Garansi 14 Hari</strong>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 0.875rem;">
              <span style="color: var(--hs-text-secondary);"><i class="bi bi-geo-alt"></i> Jangkauan</span>
              <strong>Jabodetabek</strong>
            </div>
          </div>

          <a href="{{ route('customer.bookings.create', ['service' => 'cuci-maintenance-ac-split']) }}" class="hs-btn hs-btn-primary hs-btn-lg" style="width: 100%; margin-bottom: 12px; font-size: 1rem;">
            Pesan Sekarang <i class="bi bi-calendar2-check"></i>
          </a>

          <div style="text-align: center; font-size: 0.75rem; color: var(--hs-text-muted);">
            <i class="bi bi-lock-fill"></i> Pembayaran aman, dana diteruskan ke teknisi hanya setelah pekerjaan selesai.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
