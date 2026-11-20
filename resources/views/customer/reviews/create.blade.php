@extends('layouts.customer')

@section('title', 'Beri Ulasan Pelayanan - HomeService')

@section('content')
<div style="margin-bottom: 24px;">
  <a href="{{ route('customer.bookings.index') }}" class="hs-btn hs-btn-ghost hs-btn-sm">
    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
  </a>
</div>

<div class="hs-container" style="max-width: 640px; margin: 0 auto;">
  <div class="hs-card" style="padding: 36px;">
    <div style="text-align: center; margin-bottom: 28px;">
      <div style="width: 52px; height: 52px; background: var(--hs-secondary-light); color: var(--hs-secondary); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 12px;">
        <i class="bi bi-star-fill"></i>
      </div>
      <h1 style="font-size: 1.6rem; color: var(--hs-primary); margin-bottom: 6px;">Beri Ulasan Kinerja Teknisi</h1>
      <p style="font-size: 0.875rem; color: var(--hs-text-secondary);">
        Penilaian jujur Anda sangat membantu menjaga standar kualitas dan membantu pengguna lain memilih teknisi.
      </p>
    </div>

    <!-- Booking Target Summary -->
    <div style="background: var(--hs-bg-main); padding: 16px; border-radius: var(--hs-radius-md); margin-bottom: 24px; display: flex; align-items: center; gap: 14px;">
      <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=120&auto=format&fit=crop" alt="Agus Wibowo" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
      <div>
        <div style="font-weight: 700; color: var(--hs-primary);">Pesanan #HS-2025-084</div>
        <div style="font-size: 0.8125rem; color: var(--hs-text-secondary);">Perbaikan Keran Bocor Wastafel • Teknisi: Agus Wibowo</div>
      </div>
    </div>

    <form action="#" method="POST" data-loading-state>
      @csrf
      <!-- Overall Rating Star Selector -->
      <div style="text-align: center; margin-bottom: 28px;">
        <label class="hs-label" style="margin-bottom: 12px; font-size: 1rem;">Kepuasan Keseluruhan</label>
        <div id="star-rating" style="display: inline-flex; gap: 12px; font-size: 2.25rem; color: #E5E9EF; cursor: pointer;">
          <i class="bi bi-star-fill" data-star="1" onclick="setRating(1)"></i>
          <i class="bi bi-star-fill" data-star="2" onclick="setRating(2)"></i>
          <i class="bi bi-star-fill" data-star="3" onclick="setRating(3)"></i>
          <i class="bi bi-star-fill" data-star="4" onclick="setRating(4)"></i>
          <i class="bi bi-star-fill" data-star="5" onclick="setRating(5)"></i>
        </div>
        <input type="hidden" name="rating" id="selected-rating" value="5">
        <div id="rating-text" style="font-size: 0.875rem; font-weight: 600; color: #F59E0B; margin-top: 8px;">
          Sangat Memuaskan (5 / 5)
        </div>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Ceritakan Pengalaman Anda</label>
        <textarea name="comment" class="hs-textarea" placeholder="Apakah teknisi datang tepat waktu? Bagaimana kerapian pekerjaannya?..." required style="min-height: 120px;"></textarea>
      </div>

      <button type="submit" class="hs-btn hs-btn-primary hs-btn-lg" style="width: 100%;">
        Kirim Ulasan Pelayanan <i class="bi bi-send-fill"></i>
      </button>
    </form>
  </div>
</div>

<script>
  function setRating(score) {
    document.getElementById('selected-rating').value = score;
    const stars = document.querySelectorAll('#star-rating i');
    stars.forEach((star, idx) => {
      if (idx < score) {
        star.style.color = '#F59E0B';
      } else {
        star.style.color = '#E5E9EF';
      }
    });

    const labels = {
      1: 'Sangat Mengecewakan (1 / 5)',
      2: 'Kurang Puas (2 / 5)',
      3: 'Cukup Baik (3 / 5)',
      4: 'Bagus & Puas (4 / 5)',
      5: 'Sangat Memuaskan (5 / 5)'
    };
    document.getElementById('rating-text').innerText = labels[score];
  }
  // Initialize 5 stars on load
  setRating(5);
</script>
@endsection
