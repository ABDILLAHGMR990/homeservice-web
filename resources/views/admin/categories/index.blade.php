@extends('layouts.admin')

@section('title', 'Master Kategori Layanan - HomeService Admin')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Master Kategori Layanan</h1>
    <p class="page-subtitle">
      Kelola kategori spesialisasi layanan rumah tangga pada platform HomeService secara langsung.
    </p>
  </div>
  <button type="button" class="hs-btn hs-btn-primary" onclick="openCategoryModal()">
    <i class="bi bi-plus-lg"></i> Tambah Kategori Baru
  </button>
</div>

<div class="hs-card" style="padding: 0; overflow: hidden;">
  <div class="hs-table-responsive" style="border: none; border-radius: 0;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Kategori</th>
          <th>Slug URL</th>
          <th>Icon</th>
          <th>Jumlah Layanan</th>
          <th>Status</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categories as $index => $cat)
          <tr>
            <td class="hs-font-mono">{{ $categories->firstItem() + $index }}</td>
            <td>
              <strong style="color: var(--hs-primary);">{{ $cat->name }}</strong>
              @if($cat->description)
                <div class="small" style="color: var(--hs-text-secondary);">{{ Str::limit($cat->description, 60) }}</div>
              @endif
            </td>
            <td><code class="hs-font-mono" style="font-size: 0.78rem; color: var(--hs-primary);">{{ $cat->slug }}</code></td>
            <td><i class="bi {{ $cat->icon ?: 'bi-grid' }}" style="font-size: 1.2rem; color: var(--hs-primary);"></i></td>
            <td class="hs-tabular">{{ $cat->services_count ?? $cat->services()->count() }} Layanan</td>
            <td>
              <span class="hs-badge {{ $cat->is_active ? 'hs-badge-completed' : 'hs-badge-neutral' }}">
                {{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </td>
            <td class="text-end">
              <div class="d-flex justify-content-end gap-2">
                <button type="button" class="hs-btn hs-btn-outline hs-btn-sm" title="Edit Kategori"
                  onclick='openEditCategoryModal(@json($cat))'>
                  <i class="bi bi-pencil"></i> Edit
                </button>
                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                  onsubmit="return confirm('Hapus kategori {{ $cat->name }}?');">
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
              <x-empty-state icon="bi-folder" title="Belum ada kategori" description="Klik Tambah Kategori Baru untuk memulai." />
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($categories->hasPages())
    <div class="px-4 py-3 border-top">
      {{ $categories->links('vendor.pagination.homeservice') }}
    </div>
  @endif
</div>

<!-- Modal Tambah / Edit Kategori -->
<div id="modal-category" class="hs-modal-overlay" style="display: none;">
  <div class="hs-modal">
    <div class="hs-modal-header">
      <h3 id="modal-category-title" class="hs-modal-title">Tambah Kategori Baru</h3>
      <button type="button" class="hs-modal-close" onclick="closeCategoryModal()">&times;</button>
    </div>

    <form id="form-category" action="{{ route('admin.categories.store') }}" method="POST">
      @csrf
      <input type="hidden" name="_method" id="cat-form-method" value="POST">
      <div class="hs-modal-body">
        <div class="hs-form-group">
          <label class="hs-label">Nama Kategori <span class="text-danger">*</span></label>
          <input type="text" name="name" id="cat-name" class="hs-input" placeholder="Contoh: Otomotif & Cuci Mobil" required>
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Class Icon (Bootstrap Icons)</label>
          <input type="text" name="icon" id="cat-icon" class="hs-input hs-font-mono" placeholder="bi-tools" value="bi-tools">
          <div class="hs-hint">Contoh: <code>bi-snow</code>, <code>bi-lightning-charge</code>, <code>bi-droplet-half</code>, <code>bi-stars</code></div>
        </div>

        <div class="hs-form-group">
          <label class="hs-label">Deskripsi Singkat</label>
          <textarea name="description" id="cat-description" class="hs-textarea" rows="2" placeholder="Penjelasan cakupan layanan kategori ini..."></textarea>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="hs-label">Urutan Tampil</label>
            <input type="number" name="sort_order" id="cat-sort-order" class="hs-input" value="0" min="0">
          </div>
          <div class="col-md-6 d-flex align-items-end">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; padding-bottom: 10px;">
              <input type="checkbox" name="is_active" id="cat-active" value="1" checked style="width: 17px; height: 17px; accent-color: var(--hs-primary);">
              <span class="fw-semibold small">Tampilkan ke Publik</span>
            </label>
          </div>
        </div>
      </div>

      <div class="hs-modal-footer">
        <button type="button" class="hs-btn hs-btn-outline-secondary" onclick="closeCategoryModal()">Batal</button>
        <button type="submit" class="hs-btn hs-btn-primary">
          <i class="bi bi-save"></i> Simpan Kategori
        </button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
function openCategoryModal() {
  document.getElementById('modal-category-title').textContent = 'Tambah Kategori Baru';
  document.getElementById('form-category').action = "{{ route('admin.categories.store') }}";
  document.getElementById('cat-form-method').value = 'POST';
  document.getElementById('cat-name').value = '';
  document.getElementById('cat-icon').value = 'bi-tools';
  document.getElementById('cat-description').value = '';
  document.getElementById('cat-sort-order').value = '0';
  document.getElementById('cat-active').checked = true;
  hsModal.open('modal-category');
}

function openEditCategoryModal(cat) {
  document.getElementById('modal-category-title').textContent = 'Edit Kategori: ' + cat.name;
  document.getElementById('form-category').action = "{{ url('/admin/kategori') }}/" + cat.id;
  document.getElementById('cat-form-method').value = 'PUT';
  document.getElementById('cat-name').value = cat.name || '';
  document.getElementById('cat-icon').value = cat.icon || 'bi-tools';
  document.getElementById('cat-description').value = cat.description || '';
  document.getElementById('cat-sort-order').value = cat.sort_order ?? 0;
  document.getElementById('cat-active').checked = !!cat.is_active;
  hsModal.open('modal-category');
}

function closeCategoryModal() {
  hsModal.close('modal-category');
}
</script>
@endpush
@endsection
