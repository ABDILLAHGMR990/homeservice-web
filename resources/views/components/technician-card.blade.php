@props([
  'name',
  'skill',
  'avatar',
  'rating' => 4.9,
  'completedJobs' => 140,
  'experienceYears' => 5,
  'isVerified' => true,
  'url' => '#'
])

<div class="hs-technician-card">
  <div class="hs-tech-header">
    <img src="{{ $avatar }}" alt="{{ $name }}" class="hs-tech-avatar" loading="lazy">
    <div class="hs-tech-info">
      <h4>
        <a href="{{ $url }}">{{ $name }}</a>
        @if($isVerified)
          <i class="bi bi-patch-check-fill" style="color: #16A36A; font-size: 1rem;" title="Terverifikasi KTP & Keahlian"></i>
        @endif
      </h4>
      <div class="hs-tech-skill">{{ $skill }}</div>
    </div>
  </div>

  <div class="hs-tech-stats">
    <div>
      <div class="hs-tech-stat-val">
        <i class="bi bi-star-fill" style="color: #F59E0B; font-size: 0.85rem;"></i> {{ number_format($rating, 1) }}
      </div>
      <div class="hs-tech-stat-lbl">Rating</div>
    </div>
    <div>
      <div class="hs-tech-stat-val">{{ $completedJobs }}+</div>
      <div class="hs-tech-stat-lbl">Pekerjaan</div>
    </div>
    <div>
      <div class="hs-tech-stat-val">{{ $experienceYears }} Thn</div>
      <div class="hs-tech-stat-lbl">Pengalaman</div>
    </div>
  </div>

  <div class="hs-tech-desc">
    {{ $slot->isNotEmpty() ? $slot : 'Teknisi profesional bergaransi, siap dipanggil ke rumah dengan standar keselamatan kerja.' }}
  </div>

  <a href="{{ $url }}" class="hs-btn hs-btn-outline hs-btn-sm" style="width: 100%; text-align: center; margin-top: auto;">
    Lihat Profil &amp; Jadwal
  </a>
</div>
