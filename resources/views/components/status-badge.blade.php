@props(['status'])

@php
  $labels = [
    'pending' => 'Menunggu Teknisi',
    'accepted' => 'Diterima Teknisi',
    'on_the_way' => 'Teknisi Menuju Lokasi',
    'in_progress' => 'Sedang Dikerjakan',
    'completed' => 'Pekerjaan Selesai',
    'cancelled' => 'Dibatalkan',
    'rejected' => 'Ditolak'
  ];

  $classes = [
    'pending' => 'hs-badge-pending',
    'accepted' => 'hs-badge-accepted',
    'on_the_way' => 'hs-badge-on-the-way',
    'in_progress' => 'hs-badge-in-progress',
    'completed' => 'hs-badge-completed',
    'cancelled' => 'hs-badge-cancelled',
    'rejected' => 'hs-badge-rejected'
  ];

  $statusKey = strtolower($status);
  $label = $labels[$statusKey] ?? ucfirst(str_replace('_', ' ', $status));
  $class = $classes[$statusKey] ?? 'hs-badge-neutral';
@endphp

<span class="hs-badge {{ $class }}">
  <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i>
  {{ $label }}
</span>
