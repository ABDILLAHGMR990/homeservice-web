@extends('layouts.customer')

@section('title', 'Chat Teknisi - HomeService')

@section('content')
<div style="margin-bottom: 20px;">
  <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Pesan Langsung Teknisi</h1>
  <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
    Komunikasi langsung dengan teknisi yang sedang bertugas di lokasi Anda.
  </p>
</div>

<div class="hs-card" style="padding: 0; overflow: hidden; height: 560px; display: grid; grid-template-columns: 320px 1fr;">
  <!-- Left: Thread List -->
  <div style="border-right: 1px solid var(--hs-border); background: var(--hs-bg-main); display: flex; flex-direction: column;">
    <div style="padding: 16px; border-bottom: 1px solid var(--hs-border); background: #FFF;">
      <input type="text" class="hs-input" placeholder="Cari nama teknisi..." style="font-size: 0.8125rem; padding: 8px 12px;">
    </div>

    <div style="overflow-y: auto; flex-grow: 1;">
      <!-- Active Conversation Item -->
      <div style="padding: 16px; background: #FFF; border-left: 3px solid var(--hs-primary); border-bottom: 1px solid var(--hs-border); cursor: pointer; display: flex; gap: 12px; align-items: center;">
        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=120&auto=format&fit=crop" alt="Budi Santoso" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;">
        <div style="flex-grow: 1; overflow: hidden;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2px;">
            <div style="font-weight: 700; font-size: 0.875rem; color: var(--hs-primary);">Budi Santoso</div>
            <span style="font-size: 0.6875rem; color: var(--hs-text-muted);">09:18</span>
          </div>
          <div style="font-size: 0.75rem; color: var(--hs-text-secondary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            Baik bu, saya sudah di depan gang perumahan...
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Right: Message Bubbles Panel -->
  <div style="display: flex; flex-direction: column; background: #FFF;">
    <!-- Chat Header -->
    <div style="padding: 14px 20px; border-bottom: 1px solid var(--hs-border); display: flex; justify-content: space-between; align-items: center; background: #FFF;">
      <div style="display: flex; align-items: center; gap: 12px;">
        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=120&auto=format&fit=crop" alt="Budi Santoso" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
        <div>
          <div style="font-weight: 700; font-size: 0.9375rem; color: var(--hs-primary);">Budi Santoso (Teknisi AC)</div>
          <div style="font-size: 0.75rem; color: #16A36A;"><i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Sedang Aktif • Order #HS-2026-001</div>
        </div>
      </div>
      <a href="tel:081298765432" class="hs-btn hs-btn-outline hs-btn-sm" title="Telepon">
        <i class="bi bi-telephone"></i>
      </a>
    </div>

    <!-- Message Bubble Area -->
    <div style="flex-grow: 1; padding: 20px; overflow-y: auto; display: flex; flex-direction: column; gap: 14px; background: #FAFBFD;">
      <!-- Customer Message -->
      <div style="align-self: flex-end; max-width: 70%;">
        <div style="background: var(--hs-primary); color: #FFF; padding: 12px 16px; border-radius: 12px 12px 2px 12px; font-size: 0.875rem; line-height: 1.5;">
          Selamat pagi Pak Budi, rumah saya yang pagarnya hitam sebelah laundry ya pak.
        </div>
        <div style="font-size: 0.6875rem; color: var(--hs-text-muted); text-align: right; margin-top: 4px;">09:12 WIB</div>
      </div>

      <!-- Technician Reply -->
      <div style="align-self: flex-start; max-width: 70%;">
        <div style="background: #FFFFFF; border: 1px solid var(--hs-border); color: var(--hs-text-primary); padding: 12px 16px; border-radius: 12px 12px 12px 2px; font-size: 0.875rem; line-height: 1.5; box-shadow: var(--hs-shadow-xs);">
          Baik bu Dian, saya sudah dekat sekitar 300 meter lagi. Saya bawa tangga dan plastik cover AC nya. Terima kasih infonya bu.
        </div>
        <div style="font-size: 0.6875rem; color: var(--hs-text-muted); margin-top: 4px;">09:18 WIB</div>
      </div>
    </div>

    <!-- Message Input Bar -->
    <div style="padding: 14px 20px; border-top: 1px solid var(--hs-border); background: #FFF;">
      <form action="#" method="POST" style="display: flex; gap: 10px;" onsubmit="event.preventDefault(); window.showToast('Pesan terkirim ke teknisi!', 'success'); this.reset();">
        <input type="text" class="hs-input" placeholder="Ketik pesan untuk teknisi..." required style="flex-grow: 1;">
        <button type="submit" class="hs-btn hs-btn-primary">
          <i class="bi bi-send-fill"></i>
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
