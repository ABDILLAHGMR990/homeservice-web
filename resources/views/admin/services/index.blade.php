@extends('layouts.admin')

@section('title', 'Master Standar Layanan - HomeService Admin')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Master Standar Layanan</h1>
    <p class="page-subtitle">
      Tambah, ubah tarif, atau hapus layanan rumah tangga yang tampil di katalog publik.
    </p>
  </div>
  <button type="button" class="hs-btn hs-btn-primary" onclick="openServiceModal()">
    <i class="bi bi-plus-lg"></i> Tambah Master Layanan
  </button>
</div>

<div class="hs-card" style="padding: 0; overflow: hidden;">
  <div class="hs-table-responsive" style="border: none; border-radius: 0;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Nama Layanan</th>
          <th>Kategori</th>
          <th>Tarif Dasar</th>
          <th>Satuan</th>
          <th>Estimasi</th>
          <th>Status</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($services as $svc)
          <tr>
            <td>
              <div style="font-weight: 700; color: var(--hs-primary);">{{ $svc->name }}</div>
              <div class="hs-font-mono" style="font-size: 0.72rem; color: var(--hs-text-secondary);">{{ $svc->slug }}</div>
            </td>
            <td><span class="hs-badge hs-badge-neutral">{{ $svc->category->name ?? '-' }}</span></td>
            <td><strong class="hs-tabular" style="color: var(--hs-primary);">Rp {{ number_format($svc->base_price, 0, ',', '.') }}</strong></td>
            <td class="small">{{ \App\Models\Service::PRICE_UNITS[$svc->price_unit] ?? $svc->price_unit }}</td>
            <td class="hs-tabular small">{{ $svc->duration_estimate ?? $svc->estimated_duration_minutes ?? 60 }} Menit</td>
            <td>
              <span class="hs-badge {{ $svc->is_active ? 'hs-badge-completed' : 'hs-badge-neutral' }}">
                {{ $svc->is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </td>
            <td class="text-end">
              <div class="d-flex justify-content-end gap-2">
                <button type="button" class="hs-btn hs-btn-outline hs-btn-sm" title="Edit Layanan"
                  onclick='openEditServiceModal(@json($svc))'>
                  <i class="bi bi-pencil"></i> Edit
                </button>
                <form action="{{ route('admin.services.destroy', $svc) }}" method="POST"
                  onsubmit="return confirm('Hapus layanan {{ $svc->name }}?');">
                  @csrf @method('DELETE')
                  <button type="submit" class="hs-btn hs-btn-outline-danger hs-btn-sm" title="Hapus">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-5">
              <x-empty-state icon="bi-tools" title="Belum ada master layanan" description="Tambahkan layanan baru agar muncul di katalog publik." />
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($services->hasPages())
    <div class="px-4 py-3 border-top">
      {{ $services->links('vendor.pagination.homeservice') }}
    </div>
  @endif
</div>

<!-- Modal Tambah / Edit Master Layanan -->
<div id="modal-master-service" class="hs-modal-overlay" style="display: none;">
  <div class="hs-modal">
    <div class="hs-modal-header">
      <h3 id="modal-service-title" class="hs-modal-title">Tambah Standar Layanan Baru</h3>
      <button type="button" class="hs-modal-close" onclick="closeServiceModal()">&times;</button>
    </div>

    <form id="form-service" action="{{ route('admin.services.store') }}" method="POST">
      @csrf
      <input type="hidden" name="_method" id="svc-form-method" value="POST">
      <div class="hs-modal-body">
        <div class="hs-form-group">
          <label class="hs-label">Kategori <span class="text-danger">*</span></label>
          <select name="category_id" id="svc-category" class="hs-select" required>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Nama Layanan <span class="text-danger">*</span></label>
          <input type="text" name="name" id="svc-name" class="hs-input" placeholder="Contoh: Pembersihan Toren Air 500-1000 Liter" required>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="hs-label">Tarif (Rp) <span class="text-danger">*</span></label>
            <input type="number" name="base_price" id="svc-price" class="hs-input" placeholder="100000" min="0" required>
          </div>
          <div class="col-md-4">
            <label class="hs-label">Satuan Tarif</label>
            <select name="price_unit" id="svc-unit" class="hs-select" required>
              @foreach(\App\Models\Service::PRICE_UNITS as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="hs-label">Estimasi (Menit)</label>
            <input type="number" name="duration_estimate" id="svc-duration" class="hs-input" value="60" min="1">
          </div>
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Deskripsi Pekerjaan</label>
          <textarea name="description" id="svc-description" class="hs-textarea" rows="3" placeholder="Rincian pekerjaan yang tercakup dalam layanan ini..."></textarea>
        </div>

        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
          <input type="checkbox" name="is_active" id="svc-active" value="1" checked style="width: 17px; height: 17px; accent-color: var(--hs-primary);">
          <span class="fw-semibold small">Aktifkan di Katalog Publik</span>
        </label>
      </div>

      <div class="hs-modal-footer">
        <button type="button" class="hs-btn hs-btn-outline-secondary" onclick="closeServiceModal()">Batal</button>
        <button type="submit" class="hs-btn hs-btn-primary">
          <i class="bi bi-save"></i> Simpan Layanan
        </button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
function openServiceModal() {
  document.getElementById('modal-service-title').textContent = 'Tambah Standar Layanan Baru';
  document.getElementById('form-service').action = "{{ route('admin.services.store') }}";
  document.getElementById('svc-form-method').value = 'POST';
  document.getElementById('svc-name').value = '';
  document.getElementById('svc-price').value = '';
  document.getElementById('svc-unit').value = 'per_visit';
  document.getElementById('svc-duration').value = '60';
  document.getElementById('svc-description').value = '';
  document.getElementById('svc-active').checked = true;
  hsModal.open('modal-master-service');
}

function openEditServiceModal(svc) {
  document.getElementById('modal-service-title').textContent = 'Edit Layanan: ' + svc.name;
  document.getElementById('form-service').action = "{{ url('/admin/layanan') }}/" + svc.id;
  document.getElementById('svc-form-method').value = 'PUT';
  document.getElementById('svc-category').value = svc.category_id;
  document.getElementById('svc-name').value = svc.name || '';
  document.getElementById('svc-price').value = Math.round(svc.base_price || 0);
  document.getElementById('svc-unit').value = svc.price_unit || 'per_visit';
  document.getElementById('svc-duration').value = svc.duration_estimate || svc.estimated_duration_minutes || 60;
  document.getElementById('svc-description').value = svc.description || '';
  document.getElementById('svc-active').checked = !!svc.is_active;
  hsModal.open('modal-master-service');
}

function closeServiceModal() {
  hsModal.close('modal-master-service');
}
</script>
@endpush
@endsection
