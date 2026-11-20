@extends('layouts.admin')

@section('title', 'Pengaturan Platform')

@section('content')
<div class="page-header mb-4">
    <h1 class="page-title">Pengaturan Platform</h1>
    <p class="page-subtitle">Konfigurasi komisi, garansi, dan aturan platform HomeService</p>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf @method('PUT')

            {{-- Commission Settings --}}
            <div class="hs-card p-4 mb-4">
                <h6 class="fw-semibold mb-4" style="color:#202938;">
                    <i class="bi bi-percent me-2" style="color:#F59E0B;"></i>Pengaturan Komisi
                </h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="hs-label">Komisi Platform (%)</label>
                        <div class="hs-input-group">
                            <input type="number" name="platform_commission_percent"
                                   class="hs-input" step="0.5" min="0" max="100"
                                   value="{{ old('platform_commission_percent', $settings->platform_commission_percent) }}"
                                   required>
                            <span class="hs-input-addon">%</span>
                        </div>
                        <div class="hs-hint">Persentase yang dipotong dari setiap transaksi.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="hs-label">Minimal Penarikan (Rp)</label>
                        <div class="hs-input-group">
                            <span class="hs-input-addon-left">Rp</span>
                            <input type="number" name="min_withdrawal_amount"
                                   class="hs-input" min="0" step="10000"
                                   value="{{ old('min_withdrawal_amount', $settings->min_withdrawal_amount) }}"
                                   required style="padding-left:48px;">
                        </div>
                        <div class="hs-hint">Minimal saldo yang bisa ditarik oleh teknisi.</div>
                    </div>
                </div>
            </div>

            {{-- Service Settings --}}
            <div class="hs-card p-4 mb-4">
                <h6 class="fw-semibold mb-4" style="color:#202938;">
                    <i class="bi bi-gear me-2" style="color:#F59E0B;"></i>Aturan Layanan
                </h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="hs-label">Masa Garansi (hari)</label>
                        <div class="hs-input-group">
                            <input type="number" name="warranty_days"
                                   class="hs-input" min="0" max="365"
                                   value="{{ old('warranty_days', $settings->warranty_days) }}"
                                   required>
                            <span class="hs-input-addon">hari</span>
                        </div>
                        <div class="hs-hint">Garansi komplain setelah pekerjaan selesai.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="hs-label">Auto-Complete (jam)</label>
                        <div class="hs-input-group">
                            <input type="number" name="auto_complete_hours"
                                   class="hs-input" min="1" max="168"
                                   value="{{ old('auto_complete_hours', $settings->auto_complete_hours) }}"
                                   required>
                            <span class="hs-input-addon">jam</span>
                        </div>
                        <div class="hs-hint">Pesanan otomatis selesai jika tidak ada respon.</div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="hs-btn hs-btn-primary">
                    <i class="bi bi-check2 me-1"></i>Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    {{-- Sidebar Info --}}
    <div class="col-lg-4">
        <div class="hs-card p-4 mb-4">
            <h6 class="fw-semibold mb-3" style="color:#202938;">Ringkasan Platform</h6>
            <div class="d-flex justify-content-between py-2 border-bottom" style="border-color:#E5E9EF;">
                <span style="color:#687386;font-size:14px;">Total Pengguna</span>
                <span class="fw-semibold" style="color:#202938;">
                    {{ \App\Models\User::count() }}
                </span>
            </div>
            <div class="d-flex justify-content-between py-2 border-bottom" style="border-color:#E5E9EF;">
                <span style="color:#687386;font-size:14px;">Total Teknisi Aktif</span>
                <span class="fw-semibold" style="color:#202938;">
                    {{ \App\Models\ProviderProfile::where('verification_status','verified')->count() }}
                </span>
            </div>
            <div class="d-flex justify-content-between py-2 border-bottom" style="border-color:#E5E9EF;">
                <span style="color:#687386;font-size:14px;">Total Pesanan</span>
                <span class="fw-semibold" style="color:#202938;">
                    {{ \App\Models\Booking::count() }}
                </span>
            </div>
            <div class="d-flex justify-content-between py-2">
                <span style="color:#687386;font-size:14px;">Total Kategori</span>
                <span class="fw-semibold" style="color:#202938;">
                    {{ \App\Models\Category::count() }}
                </span>
            </div>
        </div>

        <div class="hs-alert hs-alert-warning">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Perhatian:</strong> Perubahan komisi hanya berlaku untuk transaksi baru. Transaksi yang sedang berjalan tidak terpengaruh.
        </div>
    </div>
</div>
@endsection
