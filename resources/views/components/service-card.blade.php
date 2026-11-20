@props([
  'title',
  'category',
  'price',
  'image',
  'rating' => 4.9,
  'reviewsCount' => 120,
  'url' => '#'
])

<div class="hs-service-card">
  <div class="hs-service-img-wrapper">
    <img src="{{ $image }}" alt="{{ $title }}" class="hs-service-img" loading="lazy">
    <div class="hs-service-category-pill">
      {{ $category }}
    </div>
  </div>

  <div class="hs-service-content">
    <div style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; color: #F59E0B; margin-bottom: 6px;">
      <i class="bi bi-star-fill"></i>
      <span style="font-weight: 700; color: var(--hs-text-primary);">{{ number_format($rating, 1) }}</span>
      <span style="color: var(--hs-text-secondary);">({{ $reviewsCount }} ulasan)</span>
    </div>

    <h3 class="hs-service-title">
      <a href="{{ $url }}">{{ $title }}</a>
    </h3>

    <p class="hs-service-desc">
      {{ $slot->isNotEmpty() ? $slot : 'Penyedia teknisi berpengalaman, peralatan kerja standar industri, dan bergaransi perbaikan.' }}
    </p>

    <div class="hs-service-meta">
      <div>
        <div class="hs-service-price-label">Mulai dari</div>
        <div class="hs-service-price">Rp {{ number_format($price, 0, ',', '.') }}</div>
      </div>
      <a href="{{ $url }}" class="hs-btn hs-btn-primary hs-btn-sm">
        Pesan Jasa <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</div>
