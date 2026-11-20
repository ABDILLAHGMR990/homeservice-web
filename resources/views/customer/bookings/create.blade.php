@extends('layouts.customer')

@section('title', 'Buat Pesanan Layanan Baru - HomeService')

@section('content')
<div style="margin-bottom: 24px;">
  <a href="{{ route('public.services.index') }}" class="hs-btn hs-btn-ghost hs-btn-sm">
    <i class="bi bi-arrow-left"></i> Kembali ke Katalog Layanan
  </a>
</div>

<div style="margin-bottom: 28px;">
  <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Pemesanan Layanan Rumah Tangga</h1>
  <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
    Lengkapi detail jadwal, alamat pengerjaan, dan metode pembayaran Anda.
  </p>
</div>

<form action="{{ route('customer.bookings.store') }}" method="POST" data-loading-state>
  @csrf
  <div style="display: grid; grid-template-columns: 1fr 380px; gap: 32px; align-items: start;">
    <!-- Left Column: Form Steps -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
      <!-- Step 1: Service Confirmation -->
      <div class="hs-card">
        <h3 style="font-size: 1.15rem; color: var(--hs-primary); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
          <span style="width: 28px; height: 28px; background: var(--hs-primary); color: #FFF; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.875rem;">1</span>
          Layanan yang Dipilih
        </h3>

        <div style="background: var(--hs-bg-main); padding: 16px; border-radius: var(--hs-radius-md); display: flex; justify-content: space-between; align-items: center;">
          <div>
            <div style="font-weight: 700; color: var(--hs-primary); font-size: 1.05rem;">Cuci & Maintenance AC Split (0.5 - 2 PK)</div>
            <div style="font-size: 0.8125rem; color: var(--hs-text-secondary); margin-top: 2px;">Kategori: Service AC • Termasuk Garansi 14 Hari</div>
          </div>
          <div style="text-align: right;">
            <div style="font-size: 1.1rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">Rp 75.000</div>
            <span style="font-size: 0.75rem; color: var(--hs-text-secondary);">per unit</span>
          </div>
        </div>

        <div style="margin-top: 16px; display: flex; align-items: center; justify-content: space-between;">
          <label class="hs-label" style="margin-bottom: 0;">Jumlah Unit AC</label>
          <div style="display: flex; align-items: center; gap: 10px;">
            <button type="button" class="hs-btn hs-btn-outline hs-btn-sm" onclick="adjustQty(-1)">-</button>
            <input type="number" name="quantity" id="booking-qty" value="1" min="1" max="10" style="width: 50px; text-align: center; border: 1px solid var(--hs-border); border-radius: 4px; padding: 6px; font-weight: 600;" readonly>
            <button type="button" class="hs-btn hs-btn-outline hs-btn-sm" onclick="adjustQty(1)">+</button>
          </div>
        </div>
      </div>

      <!-- Step 2: Schedule & Date -->
      <div class="hs-card">
        <h3 style="font-size: 1.15rem; color: var(--hs-primary); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
          <span style="width: 28px; height: 28px; background: var(--hs-primary); color: #FFF; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.875rem;">2</span>
          Jadwal Kedatangan Teknisi
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
          <div class="hs-form-group">
            <label class="hs-label">Tanggal Pelaksanaan</label>
            <input type="date" name="booking_date" class="hs-input" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
          </div>

          <div class="hs-form-group">
            <label class="hs-label">Pilihan Waktu (Slot Kedatangan)</label>
            <select name="booking_time" class="hs-select" required>
              <option value="09:00 - 11:00">Pagi (09:00 - 11:00 WIB)</option>
              <option value="11:00 - 13:00">Siang (11:00 - 13:00 WIB)</option>
              <option value="13:00 - 15:00">Siang (13:00 - 15:00 WIB)</option>
              <option value="15:00 - 17:00">Sore (15:00 - 17:00 WIB)</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Step 3: Service Address -->
      <div class="hs-card">
        <h3 style="font-size: 1.15rem; color: var(--hs-primary); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
          <span style="width: 28px; height: 28px; background: var(--hs-primary); color: #FFF; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.875rem;">3</span>
          Alamat Pengerjaan
        </h3>

        <div class="hs-form-group">
          <label class="hs-label">Pilih Alamat Tersimpan</label>
          <select name="address_id" class="hs-select">
            <option value="1">Rumah Pribadi - Jl. Tebet Barat Dalam Raya No. 42B, Jaksel</option>
            <option value="2">Kost Mahasiswa - Jl. Margonda Raya No. 18, Depok</option>
          </select>
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Deskripsi Kendala & Catatan Khusus untuk Teknisi</label>
          <textarea name="notes" class="hs-textarea" placeholder="Contoh: AC kamar bocor menetes air, tolong bawa tangga lipat..." required></textarea>
        </div>
      </div>

      <!-- Step 4: Payment Method -->
      <div class="hs-card">
        <h3 style="font-size: 1.15rem; color: var(--hs-primary); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
          <span style="width: 28px; height: 28px; background: var(--hs-primary); color: #FFF; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.875rem;">4</span>
          Metode Pembayaran
        </h3>

        <div style="display: flex; flex-direction: column; gap: 12px;">
          <label style="display: flex; align-items: center; justify-content: space-between; border: 1px solid var(--hs-border); border-radius: var(--hs-radius-md); padding: 16px; cursor: pointer;">
            <div style="display: flex; align-items: center; gap: 12px;">
              <input type="radio" name="payment_method" value="cash" checked style="accent-color: var(--hs-primary);">
              <div>
                <div style="font-weight: 600; color: var(--hs-primary);">Pembayaran Tunai (Cash ke Teknisi)</div>
                <div style="font-size: 0.8125rem; color: var(--hs-text-secondary);">Bayar langsung kepada mitra setelah pekerjaan selesai diuji.</div>
              </div>
            </div>
            <i class="bi bi-cash-stack" style="font-size: 1.5rem; color: var(--hs-secondary);"></i>
          </label>

          <label style="display: flex; align-items: center; justify-content: space-between; border: 1px solid var(--hs-border); border-radius: var(--hs-radius-md); padding: 16px; cursor: pointer;">
            <div style="display: flex; align-items: center; gap: 12px;">
              <input type="radio" name="payment_method" value="midtrans" style="accent-color: var(--hs-primary);">
              <div>
                <div style="font-weight: 600; color: var(--hs-primary);">Online Payment (Midtrans Gateway)</div>
                <div style="font-size: 0.8125rem; color: var(--hs-text-secondary);">Transfer Bank BCA/Mandiri/BRI, QRIS, GoPay atau ShopeePay.</div>
              </div>
            </div>
            <div style="display: flex; gap: 6px;">
              <span class="hs-badge hs-badge-neutral" style="font-size: 0.6875rem;">QRIS</span>
              <span class="hs-badge hs-badge-neutral" style="font-size: 0.6875rem;">Virtual Account</span>
            </div>
          </label>
        </div>
      </div>
    </div>

    <!-- Right Column: Order Summary Sidebar -->
    <div style="position: sticky; top: 96px;">
      <div class="hs-card" style="box-shadow: var(--hs-shadow-md); border-color: #CBD5E1;">
        <h3 style="font-size: 1.15rem; color: var(--hs-primary); margin-bottom: 16px;">Ringkasan Pesanan</h3>

        <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 10px;">
          <span style="color: var(--hs-text-secondary);">Cuci AC Split (<span id="summary-qty">1</span> Unit)</span>
          <span id="summary-subtotal">Rp 75.000</span>
        </div>

        <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 10px;">
          <span style="color: var(--hs-text-secondary);">Biaya Proteksi Garansi 14 Hari</span>
          <span style="color: #16A36A; font-weight: 600;">GRATIS</span>
        </div>

        <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 16px;">
          <span style="color: var(--hs-text-secondary);">Biaya Administrasi Transaksi</span>
          <span style="color: #16A36A; font-weight: 600;">Rp 0</span>
        </div>

        <div style="border-top: 1px solid var(--hs-border); padding-top: 14px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
          <span style="font-weight: 700; color: var(--hs-primary); font-size: 1rem;">Total Pembayaran</span>
          <span id="summary-total" style="font-size: 1.5rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
            Rp 75.000
          </span>
        </div>

        <button type="submit" class="hs-btn hs-btn-primary hs-btn-lg" style="width: 100%; margin-bottom: 14px;">
          Konfirmasi & Pesan Sekarang <i class="bi bi-arrow-right"></i>
        </button>

        <div style="font-size: 0.75rem; color: var(--hs-text-muted); text-align: center; line-height: 1.4;">
          <i class="bi bi-shield-check" style="color: #16A36A;"></i> Pesanan dilindungi oleh Kebijakan Kepuasan Pelanggan HomeService.
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  function adjustQty(amount) {
    const input = document.getElementById('booking-qty');
    let val = parseInt(input.value) + amount;
    if (val >= 1 && val <= 10) {
      input.value = val;
      const unitPrice = 75000;
      const total = val * unitPrice;
      document.getElementById('summary-qty').innerText = val;
      const formatted = 'Rp ' + total.toLocaleString('id-ID');
      document.getElementById('summary-subtotal').innerText = formatted;
      document.getElementById('summary-total').innerText = formatted;
    }
  }
</script>
@endsection
