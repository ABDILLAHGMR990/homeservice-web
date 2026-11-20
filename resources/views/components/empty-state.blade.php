@props([
  'icon' => 'bi-inbox',
  'title' => 'Belum Ada Data',
  'description' => 'Data yang Anda cari tidak ditemukan atau belum tersedia saat ini.',
  'actionUrl' => null,
  'actionText' => null
])

<div style="text-align: center; padding: 48px 24px; background: #FFFFFF; border: 1px dashed var(--hs-border); border-radius: var(--hs-radius-lg); margin: 24px 0;">
  <div style="width: 64px; height: 64px; background: var(--hs-bg-subtle); color: var(--hs-text-muted); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.75rem; margin-bottom: 16px;">
    <i class="bi {{ $icon }}"></i>
  </div>
  <h4 style="font-size: 1.15rem; color: var(--hs-primary); margin-bottom: 8px;">{{ $title }}</h4>
  <p style="color: var(--hs-text-secondary); font-size: 0.875rem; max-width: 420px; margin: 0 auto 20px auto; line-height: 1.6;">
    {{ $description }}
  </p>

  @if($actionUrl && $actionText)
    <a href="{{ $actionUrl }}" class="hs-btn hs-btn-primary hs-btn-sm">
      {{ $actionText }}
    </a>
  @endif
</div>
