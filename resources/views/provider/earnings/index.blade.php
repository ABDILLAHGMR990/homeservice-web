@extends('layouts.provider')

@section('title', 'Pendapatan & Saldo Mitra - HomeService')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Pendapatan & Saldo Penghasilan</h1>
    <p class="page-subtitle">
      Rekapitulasi omzet pengerjaan, potongan bagi hasil platform, dan pencairan dana ke rekening bank.
    </p>
  </div>
  <button type="button" class="hs-btn hs-btn-primary" onclick="openWithdrawModal()">
    <i class="bi bi-bank2"></i> Tarik Saldo ke Rekening
  </button>
</div>

<!-- Financial Summary Cards -->
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 32px;">
  <div class="hs-card" style="padding: 24px; border-left: 4px solid var(--hs-success);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
      <span style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary);">Saldo Siap Ditarik</span>
      <span class="hs-badge hs-badge-success"><i class="bi bi-lightning-charge-fill"></i> BI-FAST Aktif</span>
    </div>
    <div id="available-balance-display" class="hs-tabular" style="font-size: 2rem; font-weight: 800; color: var(--hs-success); font-family: var(--hs-font-heading);">
      Rp 1.485.000
    </div>
    <div id="selected-bank-summary" style="font-size: 0.78125rem; color: var(--hs-text-secondary); margin-top: 8px; display: flex; align-items: center; gap: 6px;">
      <i class="bi bi-credit-card-2-front" style="color: var(--hs-primary);"></i>
      <span>Rekening Utama: <strong>BCA 8820-1928-33</strong> ({{ auth()->user()->name ?? 'Budi Santoso' }})</span>
    </div>
  </div>

  <div class="hs-card" style="padding: 24px;">
    <div style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary); margin-bottom: 8px;">Total Penghasilan Bersih (Net)</div>
    <div class="hs-tabular" style="font-size: 2rem; font-weight: 800; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      Rp 3.420.000
    </div>
    <div style="font-size: 0.78125rem; color: var(--hs-text-muted); margin-top: 8px;">
      Total akumulasi bulan berjalan (Setelah bagi hasil 10%)
    </div>
  </div>

  <div class="hs-card" style="padding: 24px;">
    <div style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary); margin-bottom: 8px;">Kontribusi Bagi Hasil Platform (10%)</div>
    <div class="hs-tabular" style="font-size: 2rem; font-weight: 800; color: var(--hs-danger); font-family: var(--hs-font-heading);">
      Rp 380.000
    </div>
    <div style="font-size: 0.78125rem; color: var(--hs-text-muted); margin-top: 8px;">
      Biaya operasional sistem, asuransi kerja, & layanan CS
    </div>
  </div>
</div>

<!-- Ledger Transaction History Table -->
<div class="hs-card" style="padding: 0; overflow: hidden;">
  <div style="padding: 18px 24px; border-bottom: 1px solid var(--hs-border); background: #F8FAFC; display: flex; justify-content: space-between; align-items: center;">
    <h3 style="font-size: 1.05rem; font-weight: 700; color: var(--hs-primary); margin: 0;">Riwayat Transaksi Finansial</h3>
    <span style="font-size: 0.8125rem; color: var(--hs-text-secondary);"><i class="bi bi-shield-check text-success me-1"></i> Tercatat otomatis & real-time</span>
  </div>

  <div class="hs-table-responsive" style="border: none; border-radius: 0;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Tanggal & Waktu</th>
          <th>Kode Referensi</th>
          <th>Deskripsi Transaksi</th>
          <th>Tarif Kotor (Gross)</th>
          <th>Komisi Platform (10%)</th>
          <th>Mutasi Bersih (Net)</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody id="earnings-ledger-tbody">
        <tr>
          <td>Hari Ini, 09:15 WIB</td>
          <td><strong style="color: var(--hs-primary);">HS-2026-001</strong></td>
          <td>Cuci AC Split (Dian Anggraini)</td>
          <td>Rp 75.000</td>
          <td style="color: var(--hs-danger);">- Rp 7.500</td>
          <td><strong style="color: var(--hs-success);">+ Rp 67.500</strong></td>
          <td><span class="hs-badge hs-badge-pending">Proses Kerja</span></td>
        </tr>
        <tr>
          <td>14 Nov 2026, 15:40 WIB</td>
          <td><strong style="color: var(--hs-primary);">HS-2025-077</strong></td>
          <td>Isi Ulang Freon R32 (Ferry K.)</td>
          <td>Rp 150.000</td>
          <td style="color: var(--hs-danger);">- Rp 15.000</td>
          <td><strong style="color: var(--hs-success);">+ Rp 135.000</strong></td>
          <td><span class="hs-badge hs-badge-completed">Lunas Masuk Saldo</span></td>
        </tr>
        <tr>
          <td>10 Nov 2026, 11:20 WIB</td>
          <td><strong style="color: var(--hs-primary);">WD-2026-012</strong></td>
          <td>Pencairan Saldo ke Bank BCA (8820-1928-33)</td>
          <td>-</td>
          <td>Rp 0 (Gratis)</td>
          <td><strong style="color: var(--hs-primary);">- Rp 1.000.000</strong></td>
          <td><span class="hs-badge hs-badge-completed">Berhasil Ditransfer</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- =========================================================================
     MODAL SIMULASI TARIK SALDO KE REKENING BANK (BCA, MANDIRI, BNI, BRI, DLL)
     ========================================================================= -->
<div id="modal-withdraw" class="hs-modal-overlay" style="display: none;">
  <div class="hs-modal hs-modal-lg" style="max-width: 640px;">
    <!-- Header Modal -->
    <div class="hs-modal-header">
      <div style="display: flex; align-items: center; gap: 12px;">
        <div style="width: 40px; height: 40px; border-radius: 10px; background: var(--hs-primary); color: var(--hs-secondary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="bi bi-bank2"></i>
        </div>
        <div>
          <h3 class="hs-modal-title">Tarik Saldo ke Rekening Bank / E-Wallet</h3>
          <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">Pencairan instan bebas biaya admin via jaringan BI-FAST</div>
        </div>
      </div>
      <button type="button" class="hs-modal-close" onclick="closeWithdrawModal()">&times;</button>
    </div>

    <!-- STEP 1: FORM PENARIKAN -->
    <form id="withdraw-form-step" onsubmit="handleWithdrawSubmit(event)">
      <div class="hs-modal-body" style="padding: 24px;">
        <!-- Info Saldo Tersedia -->
        <div style="background: linear-gradient(135deg, #0F2540 0%, #18365B 100%); color: #FFFFFF; padding: 18px 22px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px;">
          <div>
            <div style="font-size: 0.75rem; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Saldo Tersedia Saat Ini</div>
            <div id="modal-balance-text" class="hs-tabular" style="font-size: 1.65rem; font-weight: 800; color: #FBBF24; font-family: var(--hs-font-heading); margin-top: 2px;">Rp 1.485.000</div>
          </div>
          <div style="text-align: right;">
            <span style="background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.4); color: #6EE7B7; padding: 4px 10px; border-radius: 999px; font-size: 0.72rem; font-weight: 600;">
              <i class="bi bi-shield-check"></i> Gratis Biaya Admin
            </span>
            <div style="font-size: 0.72rem; color: #CBD5E1; margin-top: 6px;">Min. Tarik: Rp 50.000</div>
          </div>
        </div>

        <!-- Pilih Bank Tujuan (BCA, Mandiri, BNI, BRI, BSI, CIMB, DANA, GoPay) -->
        <div class="hs-form-group">
          <label class="hs-label">Pilih Bank atau E-Wallet Tujuan <span class="text-danger">*</span></label>
          <div id="bank-grid-selector" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">
            <!-- BCA -->
            <button type="button" class="bank-option-card active" data-bank="Bank Central Asia (BCA)" data-code="014" data-color="#005BAA" onclick="selectBankOption(this)" style="border: 2px solid var(--hs-primary); background: var(--hs-primary-surface); border-radius: 10px; padding: 10px 8px; cursor: pointer; text-align: center; transition: all 160ms ease;">
              <div style="background: #005BAA; color: #FFF; font-weight: 800; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px; display: inline-block; margin-bottom: 4px; letter-spacing: 0.03em;">BCA</div>
              <div style="font-size: 0.72rem; font-weight: 600; color: var(--hs-text-primary);">Bank BCA</div>
            </button>

            <!-- Mandiri -->
            <button type="button" class="bank-option-card" data-bank="Bank Mandiri" data-code="008" data-color="#003D79" onclick="selectBankOption(this)" style="border: 1.5px solid var(--hs-border); background: #FFF; border-radius: 10px; padding: 10px 8px; cursor: pointer; text-align: center; transition: all 160ms ease;">
              <div style="background: #003D79; color: #FFB700; font-weight: 800; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px; display: inline-block; margin-bottom: 4px;">MANDIRI</div>
              <div style="font-size: 0.72rem; font-weight: 600; color: var(--hs-text-primary);">Bank Mandiri</div>
            </button>

            <!-- BNI -->
            <button type="button" class="bank-option-card" data-bank="Bank Negara Indonesia (BNI)" data-code="009" data-color="#F15A23" onclick="selectBankOption(this)" style="border: 1.5px solid var(--hs-border); background: #FFF; border-radius: 10px; padding: 10px 8px; cursor: pointer; text-align: center; transition: all 160ms ease;">
              <div style="background: #006677; color: #FFF; font-weight: 800; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px; display: inline-block; margin-bottom: 4px;">BNI</div>
              <div style="font-size: 0.72rem; font-weight: 600; color: var(--hs-text-primary);">Bank BNI</div>
            </button>

            <!-- BRI -->
            <button type="button" class="bank-option-card" data-bank="Bank Rakyat Indonesia (BRI)" data-code="002" data-color="#00529C" onclick="selectBankOption(this)" style="border: 1.5px solid var(--hs-border); background: #FFF; border-radius: 10px; padding: 10px 8px; cursor: pointer; text-align: center; transition: all 160ms ease;">
              <div style="background: #00529C; color: #FFF; font-weight: 800; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px; display: inline-block; margin-bottom: 4px;">BRI</div>
              <div style="font-size: 0.72rem; font-weight: 600; color: var(--hs-text-primary);">Bank BRI</div>
            </button>

            <!-- BSI -->
            <button type="button" class="bank-option-card" data-bank="Bank Syariah Indonesia (BSI)" data-code="451" data-color="#00A39D" onclick="selectBankOption(this)" style="border: 1.5px solid var(--hs-border); background: #FFF; border-radius: 10px; padding: 10px 8px; cursor: pointer; text-align: center; transition: all 160ms ease;">
              <div style="background: #00A39D; color: #FFF; font-weight: 800; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px; display: inline-block; margin-bottom: 4px;">BSI</div>
              <div style="font-size: 0.72rem; font-weight: 600; color: var(--hs-text-primary);">Bank Syariah</div>
            </button>

            <!-- CIMB Niaga -->
            <button type="button" class="bank-option-card" data-bank="CIMB Niaga" data-code="022" data-color="#790008" onclick="selectBankOption(this)" style="border: 1.5px solid var(--hs-border); background: #FFF; border-radius: 10px; padding: 10px 8px; cursor: pointer; text-align: center; transition: all 160ms ease;">
              <div style="background: #B8121A; color: #FFF; font-weight: 800; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px; display: inline-block; margin-bottom: 4px;">CIMB</div>
              <div style="font-size: 0.72rem; font-weight: 600; color: var(--hs-text-primary);">CIMB Niaga</div>
            </button>

            <!-- DANA -->
            <button type="button" class="bank-option-card" data-bank="E-Wallet DANA" data-code="DANA" data-color="#118EEA" onclick="selectBankOption(this)" style="border: 1.5px solid var(--hs-border); background: #FFF; border-radius: 10px; padding: 10px 8px; cursor: pointer; text-align: center; transition: all 160ms ease;">
              <div style="background: #118EEA; color: #FFF; font-weight: 800; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px; display: inline-block; margin-bottom: 4px;">DANA</div>
              <div style="font-size: 0.72rem; font-weight: 600; color: var(--hs-text-primary);">Saldo DANA</div>
            </button>

            <!-- GoPay -->
            <button type="button" class="bank-option-card" data-bank="E-Wallet GoPay" data-code="GOPAY" data-color="#00AED6" onclick="selectBankOption(this)" style="border: 1.5px solid var(--hs-border); background: #FFF; border-radius: 10px; padding: 10px 8px; cursor: pointer; text-align: center; transition: all 160ms ease;">
              <div style="background: #00AED6; color: #FFF; font-weight: 800; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px; display: inline-block; margin-bottom: 4px;">GOPAY</div>
              <div style="font-size: 0.72rem; font-weight: 600; color: var(--hs-text-primary);">Saldo GoPay</div>
            </button>
          </div>
          <input type="hidden" id="withdraw-bank-name" value="Bank Central Asia (BCA)">
        </div>

        <!-- Nomor Rekening & Nama Pemilik -->
        <div class="row g-3" style="margin-bottom: 18px;">
          <div class="col-md-6">
            <label class="hs-label">Nomor Rekening / No. Tujuan <span class="text-danger">*</span></label>
            <input type="text" id="withdraw-account-number" class="hs-input hs-tabular" value="8820192833" placeholder="Masukkan nomor rekening..." required>
          </div>
          <div class="col-md-6">
            <label class="hs-label">Nama Pemilik Rekening <span class="text-danger">*</span></label>
            <div style="position: relative;">
              <input type="text" id="withdraw-account-holder" class="hs-input" value="{{ strtoupper(auth()->user()->name ?? 'BUDI SANTOSO') }}" placeholder="Nama sesuai buku tabungan" required>
              <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: var(--hs-success); font-size: 0.75rem; font-weight: 700;">
                <i class="bi bi-patch-check-fill"></i> Valid
              </span>
            </div>
          </div>
        </div>

        <!-- Input Nominal & Quick Nominal Chips -->
        <div class="hs-form-group" style="margin-bottom: 16px;">
          <label class="hs-label">Nominal Penarikan (Rp) <span class="text-danger">*</span></label>
          <div class="hs-input-group addon-left">
            <span class="hs-input-addon-left">Rp</span>
            <input type="number" id="withdraw-amount-input" class="hs-input hs-tabular" min="50000" max="1485000" step="5000" value="500000" oninput="updateWithdrawPreview()" required style="font-size: 1.05rem; font-weight: 700;">
          </div>

          <!-- Quick Chips -->
          <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px;">
            <button type="button" class="hs-btn hs-btn-outline hs-btn-sm" onclick="setWithdrawAmount(250000)">Rp 250.000</button>
            <button type="button" class="hs-btn hs-btn-outline hs-btn-sm" onclick="setWithdrawAmount(500000)">Rp 500.000</button>
            <button type="button" class="hs-btn hs-btn-outline hs-btn-sm" onclick="setWithdrawAmount(1000000)">Rp 1.000.000</button>
            <button type="button" class="hs-btn hs-btn-secondary hs-btn-sm" onclick="setWithdrawAmount(currentBalance)">Tarik Semua</button>
          </div>
        </div>

        <!-- Ringkasan Pencairan -->
        <div style="background: #F8FAFC; border: 1px solid var(--hs-border); border-radius: 10px; padding: 14px 16px; font-size: 0.84375rem;">
          <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
            <span style="color: var(--hs-text-secondary);">Bank Tujuan</span>
            <strong id="preview-bank-label" style="color: var(--hs-primary);">Bank Central Asia (BCA)</strong>
          </div>
          <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
            <span style="color: var(--hs-text-secondary);">Biaya Admin Transfer (BI-FAST)</span>
            <strong style="color: var(--hs-success);">Rp 0 (Gratis)</strong>
          </div>
          <div style="display: flex; justify-content: space-between; padding-top: 8px; border-top: 1px dashed var(--hs-border);">
            <span style="font-weight: 700; color: var(--hs-primary);">Total Dana Diterima</span>
            <strong id="preview-net-amount" class="hs-tabular" style="font-size: 1rem; color: var(--hs-success);">Rp 500.000</strong>
          </div>
        </div>
      </div>

      <div class="hs-modal-footer">
        <button type="button" class="hs-btn hs-btn-outline-secondary" onclick="closeWithdrawModal()">Batal</button>
        <button type="submit" id="btn-submit-withdraw" class="hs-btn hs-btn-primary" data-no-loading>
          <i class="bi bi-send-check-fill"></i> Konfirmasi & Tarik Saldo
        </button>
      </div>
    </form>

    <!-- STEP 2: STRUK / BUKTI PENCAIRAN BERHASIL (Hidden initially) -->
    <div id="withdraw-receipt-step" style="display: none; padding: 28px 24px; text-align: center;">
      <div style="width: 64px; height: 64px; background: #ECFDF5; color: #059669; border: 2px solid #A7F3D0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 14px;">
        <i class="bi bi-check-lg"></i>
      </div>
      <span class="hs-badge hs-badge-success" style="margin-bottom: 8px;">BI-FAST TRANSFER BERHASIL</span>
      <h4 style="font-size: 1.35rem; font-weight: 800; color: var(--hs-primary); margin-bottom: 4px;">Permintaan Pencairan Diproses!</h4>
      <p style="font-size: 0.875rem; color: var(--hs-text-secondary); margin-bottom: 20px;">
        Dana telah diteruskan ke rekening tujuan Anda melalui sistem kliring otomatis.
      </p>

      <!-- Detail Struk Bank -->
      <div style="background: #F8FAFC; border: 1.5px dashed var(--hs-border-hover); border-radius: 12px; padding: 18px 20px; text-align: left; font-size: 0.84375rem; margin-bottom: 22px;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
          <span style="color: var(--hs-text-secondary);">No. Referensi</span>
          <strong id="receipt-ref" class="hs-tabular" style="color: var(--hs-primary);">WD-2026-089</strong>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
          <span style="color: var(--hs-text-secondary);">Bank / E-Wallet Tujuan</span>
          <strong id="receipt-bank" style="color: var(--hs-primary);">Bank Central Asia (BCA)</strong>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
          <span style="color: var(--hs-text-secondary);">Nomor Rekening</span>
          <strong id="receipt-acc" class="hs-tabular" style="color: var(--hs-primary);">8820192833 a/n BUDI SANTOSO</strong>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
          <span style="color: var(--hs-text-secondary);">Waktu Pencairan</span>
          <strong id="receipt-time" style="color: var(--hs-text-primary);">Baru saja (Real-time)</strong>
        </div>
        <div style="display: flex; justify-content: space-between; padding-top: 10px; border-top: 1px solid var(--hs-border);">
          <span style="font-weight: 700; color: var(--hs-primary);">Nominal Ditransfer</span>
          <strong id="receipt-amount" class="hs-tabular" style="font-size: 1.15rem; color: var(--hs-success);">Rp 500.000</strong>
        </div>
      </div>

      <div style="display: flex; justify-content: center; gap: 12px;">
        <button type="button" class="hs-btn hs-btn-outline" onclick="resetWithdrawForm()">
          <i class="bi bi-arrow-repeat"></i> Tarik Lagi
        </button>
        <button type="button" class="hs-btn hs-btn-primary" onclick="closeWithdrawModal()">
          <i class="bi bi-check2-circle"></i> Selesai & Tutup
        </button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  let currentBalance = 1485000;

  function formatRupiah(num) {
    return 'Rp ' + Number(num).toLocaleString('id-ID');
  }

  function openWithdrawModal() {
    resetWithdrawForm();
    const modal = document.getElementById('modal-withdraw');
    modal.style.display = 'flex';
    modal.classList.add('hs-modal-active');
    document.body.style.overflow = 'hidden';
  }

  function closeWithdrawModal() {
    const modal = document.getElementById('modal-withdraw');
    modal.classList.remove('hs-modal-active');
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }

  function selectBankOption(btn) {
    document.querySelectorAll('.bank-option-card').forEach(el => {
      el.classList.remove('active');
      el.style.border = '1.5px solid var(--hs-border)';
      el.style.background = '#FFFFFF';
    });
    btn.classList.add('active');
    btn.style.border = '2px solid var(--hs-primary)';
    btn.style.background = 'var(--hs-primary-surface)';

    const bankName = btn.getAttribute('data-bank');
    document.getElementById('withdraw-bank-name').value = bankName;
    document.getElementById('preview-bank-label').textContent = bankName;
  }

  function setWithdrawAmount(val) {
    const input = document.getElementById('withdraw-amount-input');
    input.value = Math.min(val, currentBalance);
    updateWithdrawPreview();
  }

  function updateWithdrawPreview() {
    const val = parseInt(document.getElementById('withdraw-amount-input').value) || 0;
    document.getElementById('preview-net-amount').textContent = formatRupiah(val);
  }

  function resetWithdrawForm() {
    document.getElementById('withdraw-form-step').style.display = 'block';
    document.getElementById('withdraw-receipt-step').style.display = 'none';
    document.getElementById('modal-balance-text').textContent = formatRupiah(currentBalance);
    document.getElementById('withdraw-amount-input').max = currentBalance;
  }

  function handleWithdrawSubmit(e) {
    e.preventDefault();
    const amount = parseInt(document.getElementById('withdraw-amount-input').value) || 0;
    const bank   = document.getElementById('withdraw-bank-name').value;
    const accNo  = document.getElementById('withdraw-account-number').value.trim();
    const holder = document.getElementById('withdraw-account-holder').value.trim();

    if (amount < 50000) {
      window.hsToast('Minimal penarikan saldo adalah Rp 50.000', 'warning');
      return;
    }
    if (amount > currentBalance) {
      window.hsToast('Saldo tidak mencukupi untuk nominal tersebut.', 'error');
      return;
    }

    const submitBtn = document.getElementById('btn-submit-withdraw');
    const origHtml  = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="hs-spinner-sm me-1"></span> Menghubungkan BI-FAST...';

    setTimeout(() => {
      submitBtn.disabled = false;
      submitBtn.innerHTML = origHtml;

      // Update balance
      currentBalance = Math.max(0, currentBalance - amount);
      document.getElementById('available-balance-display').textContent = formatRupiah(currentBalance);
      document.getElementById('modal-balance-text').textContent = formatRupiah(currentBalance);
      document.getElementById('selected-bank-summary').innerHTML =
        `<i class="bi bi-credit-card-2-front" style="color: var(--hs-primary);"></i>
         <span>Terakhir Ditarik ke: <strong>${bank} (${accNo})</strong> a/n ${holder}</span>`;

      // Populate Receipt
      const refCode = 'WD-2026-' + Math.floor(100 + Math.random() * 899);
      document.getElementById('receipt-ref').textContent    = refCode;
      document.getElementById('receipt-bank').textContent   = bank;
      document.getElementById('receipt-acc').textContent    = `${accNo} a/n ${holder.toUpperCase()}`;
      document.getElementById('receipt-amount').textContent = formatRupiah(amount);

      // Prepend new row to ledger table
      const tbody = document.getElementById('earnings-ledger-tbody');
      const tr = document.createElement('tr');
      tr.style.background = '#ECFDF5';
      tr.innerHTML = `
        <td>Baru Saja</td>
        <td><strong style="color: var(--hs-primary);">${refCode}</strong></td>
        <td>Pencairan Saldo ke ${bank} (${accNo} a/n ${holder})</td>
        <td>-</td>
        <td>Rp 0 (Gratis)</td>
        <td><strong style="color: var(--hs-primary);">- ${formatRupiah(amount)}</strong></td>
        <td><span class="hs-badge hs-badge-completed"><i class="bi bi-check-circle-fill"></i> Berhasil Ditransfer</span></td>
      `;
      tbody.prepend(tr);

      // Show Receipt Step
      document.getElementById('withdraw-form-step').style.display = 'none';
      document.getElementById('withdraw-receipt-step').style.display = 'block';

      if (window.hsToast) {
        window.hsToast(`Penarikan ${formatRupiah(amount)} ke ${bank} berhasil!`, 'success');
      }
    }, 650);
  }
</script>
@endpush
@endsection
