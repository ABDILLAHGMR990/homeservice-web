@extends('layouts.admin')

@section('title', 'Manajemen Pengguna & Teknisi')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h1 class="page-title">Manajemen Pengguna & Teknisi</h1>
        <p class="page-subtitle">Kelola seluruh akun pelanggan, mitra teknisi, dan admin platform HomeService</p>
    </div>
    <div>
        <button type="button" class="hs-btn hs-btn-primary" onclick="openAddUserModal()">
            <i class="bi bi-person-plus-fill me-1"></i> Tambah Teknisi / Mitra
        </button>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success d-flex align-items-center mb-4" style="background:#E8F7F0;border:1px solid #A3E6C7;color:#0F5132;padding:12px 18px;border-radius:var(--hs-radius-md);">
    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
    <div>{{ session('success') }}</div>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger d-flex align-items-center mb-4" style="background:#FDE8E8;border:1px solid #F8B4B4;color:#9B1C1C;padding:12px 18px;border-radius:var(--hs-radius-md);">
    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
    <div>{{ session('error') }}</div>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger mb-4" style="background:#FDE8E8;border:1px solid #F8B4B4;color:#9B1C1C;padding:12px 18px;border-radius:var(--hs-radius-md);">
    <div class="fw-bold mb-1"><i class="bi bi-x-circle me-1"></i> Terjadi kesalahan pada input data:</div>
    <ul class="mb-0 ps-3">
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="hs-stat-card">
            <div class="hs-stat-icon" style="background:#EEF2FF;color:#4F46E5;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="hs-stat-value">{{ \App\Models\User::where('role','customer')->count() }}</div>
                <div class="hs-stat-label">Total Pelanggan</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="hs-stat-card">
            <div class="hs-stat-icon" style="background:#ECFDF5;color:#059669;">
                <i class="bi bi-person-badge-fill"></i>
            </div>
            <div>
                <div class="hs-stat-value">{{ \App\Models\User::where('role','provider')->count() }}</div>
                <div class="hs-stat-label">Total Teknisi / Mitra</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="hs-stat-card">
            <div class="hs-stat-icon" style="background:#FEF3C7;color:#D97706;">
                <i class="bi bi-person-fill-gear"></i>
            </div>
            <div>
                <div class="hs-stat-value">{{ \App\Models\User::where('role','admin')->count() }}</div>
                <div class="hs-stat-label">Administrator</div>
            </div>
        </div>
    </div>
</div>

{{-- Filter & Search --}}
<div class="hs-card p-4 mb-4">
    <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex gap-3 flex-wrap align-items-end">
        <div style="flex:1;min-width:220px;">
            <label class="hs-label">Cari Pengguna</label>
            <div class="hs-search-wrap">
                <i class="bi bi-search hs-search-icon"></i>
                <input type="text" name="search" class="hs-input hs-input-search"
                       placeholder="Nama, email, atau no telp..." value="{{ request('search') }}">
            </div>
        </div>
        <div style="min-width:140px;">
            <label class="hs-label">Role</label>
            <select name="role" class="hs-select">
                <option value="">Semua Role</option>
                <option value="provider" {{ request('role') === 'provider' ? 'selected' : '' }}>Teknisi / Mitra</option>
                <option value="customer" {{ request('role') === 'customer' ? 'selected' : '' }}>Pelanggan</option>
                <option value="admin"    {{ request('role') === 'admin'    ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div style="min-width:140px;">
            <label class="hs-label">Status</label>
            <select name="status" class="hs-select">
                <option value="">Semua Status</option>
                <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="hs-btn hs-btn-primary">
                <i class="bi bi-funnel me-1"></i>Filter
            </button>
            @if(request()->hasAny(['search','role','status']))
                <a href="{{ route('admin.users.index') }}" class="hs-btn hs-btn-outline-secondary">Reset</a>
            @endif
        </div>
    </form>
</div>

{{-- Users Table --}}
<div class="hs-card overflow-hidden">
    <div class="hs-table-header d-flex align-items-center justify-content-between px-4 py-3">
        <h6 class="fw-semibold mb-0" style="color:#202938;">
            Daftar Pengguna & Teknisi
            <span class="hs-badge hs-badge-secondary ms-2">{{ $users->total() }}</span>
        </h6>
    </div>
    <div class="hs-table-wrap">
        <table class="hs-table">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Role</th>
                    <th>Status Akun</th>
                    <th>Tanggal Daftar</th>
                    <th>Pesanan</th>
                    <th class="text-end" style="min-width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="hs-avatar" style="background:#E5E9EF;color:#687386;font-weight:600;font-size:14px;width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                {{ $user->initials }}
                            </div>
                            <div>
                                <div class="fw-medium" style="color:#202938;">{{ $user->name }}</div>
                                <div class="small" style="color:#687386;">{{ $user->email }}</div>
                                @if($user->phone)
                                    <div class="small" style="color:#687386;"><i class="bi bi-telephone me-1"></i>{{ $user->phone }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="hs-badge" style="background:#FEF3C7;color:#92400E;">
                                <i class="bi bi-shield-fill me-1"></i>Admin
                            </span>
                        @elseif($user->role === 'provider')
                            <span class="hs-badge hs-badge-primary">
                                <i class="bi bi-person-badge me-1"></i>Teknisi
                            </span>
                            @if($user->providerProfile)
                                <div class="mt-1">
                                    @if($user->providerProfile->verification_status === 'verified')
                                        <span class="hs-badge hs-badge-success" style="font-size:10px;">
                                            <i class="bi bi-patch-check me-1"></i>Terverifikasi
                                        </span>
                                    @elseif($user->providerProfile->verification_status === 'pending')
                                        <span class="hs-badge hs-badge-warning" style="font-size:10px;">Menunggu</span>
                                    @else
                                        <span class="hs-badge hs-badge-danger" style="font-size:10px;">Ditolak</span>
                                    @endif
                                </div>
                            @endif
                        @else
                            <span class="hs-badge" style="background:#EEF2FF;color:#4338CA;">
                                <i class="bi bi-person me-1"></i>Pelanggan
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="hs-badge {{ $user->is_active ? 'hs-badge-success' : 'hs-badge-danger' }}">
                            <i class="bi bi-circle-fill me-1" style="font-size:7px;vertical-align:middle;"></i>
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div style="color:#202938;font-size:14px;">
                            {{ $user->created_at?->format('d M Y') ?? '-' }}
                        </div>
                        <div class="small" style="color:#687386;">
                            {{ $user->created_at?->diffForHumans() ?? '-' }}
                        </div>
                    </td>
                    <td>
                        @if($user->role === 'customer')
                            <span class="fw-medium" style="color:#202938;">
                                {{ $user->customerBookings()->count() }}
                            </span>
                            <span class="small" style="color:#687386;">pesanan</span>
                        @elseif($user->role === 'provider')
                            <span class="fw-medium" style="color:#202938;">
                                {{ $user->providerBookings()->count() }}
                            </span>
                            <span class="small" style="color:#687386;">dikerjakan</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end align-items-center gap-2">
                            {{-- Toggle Active --}}
                            <form action="{{ route('admin.users.toggle', $user) }}" method="POST">
                                @csrf @method('PUT')
                                <button type="submit"
                                    class="hs-btn hs-btn-sm {{ $user->is_active ? 'hs-btn-outline-danger' : 'hs-btn-outline-success' }}"
                                    title="{{ $user->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                                    <i class="bi bi-{{ $user->is_active ? 'slash-circle' : 'check-circle' }}"></i>
                                </button>
                            </form>

                            {{-- Delete User / Technician --}}
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin MENGHAPUS PERMANEN {{ $user->role === 'provider' ? 'teknisi/mitra' : 'pengguna' }} \'{{ $user->name }}\'? Semua data terkait akan dihapus.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="hs-btn hs-btn-sm hs-btn-outline-danger" title="Hapus Pengguna/Teknisi" style="background:#FFF1F2;border-color:#FECDD3;color:#E11D48;">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <x-empty-state
                            icon="bi-people"
                            title="Tidak ada pengguna ditemukan"
                            description="Coba ubah filter pencarian Anda atau tambahkan teknisi baru." />
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="px-4 py-3 border-top" style="border-color:#E5E9EF;">
        {{ $users->withQueryString()->links('vendor.pagination.homeservice') }}
    </div>
    @endif
</div>

{{-- MODAL TAMBAH TEKNISI / MITRA --}}
<div id="modalAddUser" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; overflow-y:auto; padding:20px; align-items:center; justify-content:center;">
    <div style="background:#FFFFFF; border-radius:var(--hs-radius-lg); max-width:600px; width:100%; margin:auto; box-shadow:var(--hs-shadow-lg); overflow:hidden;">
        <div style="padding:20px 24px; border-bottom:1px solid var(--hs-border); display:flex; justify-content:space-between; align-items:center; background:#F8FAFC;">
            <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:36px; height:36px; background:#EEF2FF; color:var(--hs-primary); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.2rem;">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <div>
                    <h5 style="margin:0; font-size:1.1rem; font-weight:700; color:var(--hs-primary);">Tambah Teknisi / Pengguna Baru</h5>
                    <div style="font-size:0.75rem; color:var(--hs-text-secondary);">Input data mitra teknisi agar langsung aktif melayani pelanggan</div>
                </div>
            </div>
            <button type="button" onclick="closeAddUserModal()" style="background:none; border:none; font-size:1.4rem; color:var(--hs-text-muted); cursor:pointer;">&times;</button>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" style="padding:24px;">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="hs-label">Role Akun <span class="text-danger">*</span></label>
                    <select name="role" id="modalRoleSelect" class="hs-select" required onchange="toggleProviderFields()">
                        <option value="provider" selected>Teknisi / Mitra Kerja</option>
                        <option value="customer">Pelanggan Rumah</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="hs-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="hs-input" placeholder="Contoh: Hendra Kusuma" required>
                </div>

                <div class="col-md-6">
                    <label class="hs-label">Alamat Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="hs-input" placeholder="hendra@homeservice.id" required>
                </div>

                <div class="col-md-6">
                    <label class="hs-label">Nomor WhatsApp / HP <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="hs-input" placeholder="081234567890" required>
                </div>

                <div class="col-md-12">
                    <label class="hs-label">Password Sementara <span class="text-danger">*</span></label>
                    <input type="text" name="password" class="hs-input" value="password123" required>
                    <div style="font-size:0.75rem; color:var(--hs-text-secondary); margin-top:4px;">Default: <code>password123</code> (pengguna dapat mengubahnya di profil).</div>
                </div>
            </div>

            {{-- Kolom Spesifik Teknisi --}}
            <div id="providerSpecificFields" style="margin-top:20px; padding-top:16px; border-top:1px dashed var(--hs-border);">
                <div style="font-weight:600; font-size:0.875rem; color:var(--hs-primary); margin-bottom:12px; display:flex; align-items:center; gap:6px;">
                    <i class="bi bi-tools text-warning"></i> Detail Profil Teknisi / Mitra
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="hs-label">Keahlian Utama / Spesialisasi</label>
                        <input type="text" name="expertise" class="hs-input" placeholder="Contoh: Service AC & Pipa Bocor">
                    </div>

                    <div class="col-md-6">
                        <label class="hs-label">Pengalaman Kerja (Tahun)</label>
                        <input type="number" name="experience_years" class="hs-input" value="5" min="0" max="50">
                    </div>

                    <div class="col-md-6">
                        <label class="hs-label">Nomor NIK KTP</label>
                        <input type="text" name="nik" class="hs-input" placeholder="16 digit NIK" maxlength="16">
                    </div>

                    <div class="col-md-6">
                        <label class="hs-label">Area Jangkauan Layanan</label>
                        <input type="text" name="service_area" class="hs-input" placeholder="Jakarta Selatan, Depok, dll.">
                    </div>

                    <div class="col-md-12">
                        <label class="hs-label">Deskripsi Singkat / Bio Teknisi</label>
                        <textarea name="bio" class="hs-textarea" rows="2" placeholder="Pengalaman, sertifikasi BNSP, atau keahlian khusus..."></textarea>
                    </div>

                    <div class="col-md-12">
                        <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:0.875rem; color:var(--hs-text-primary);">
                            <input type="checkbox" name="auto_verify" value="1" checked style="width:18px; height:18px; accent-color:var(--hs-secondary);">
                            <span><strong>Langsung Verifikasi Teknisi (Status: Verified)</strong> — Teknisi langsung dapat menerima pesanan tanpa perlu unggah ulang KTP manual.</span>
                        </label>
                    </div>
                </div>
            </div>

            <div style="margin-top:24px; display:flex; justify-content:flex-end; gap:12px;">
                <button type="button" class="hs-btn hs-btn-outline-secondary" onclick="closeAddUserModal()">Batal</button>
                <button type="submit" class="hs-btn hs-btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan Teknisi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddUserModal() {
    const modal = document.getElementById('modalAddUser');
    if (modal) {
        modal.style.display = 'flex';
    }
}

function closeAddUserModal() {
    const modal = document.getElementById('modalAddUser');
    if (modal) {
        modal.style.display = 'none';
    }
}

function toggleProviderFields() {
    const roleSelect = document.getElementById('modalRoleSelect');
    const fields = document.getElementById('providerSpecificFields');
    if (roleSelect && fields) {
        if (roleSelect.value === 'provider') {
            fields.style.display = 'block';
        } else {
            fields.style.display = 'none';
        }
    }
}

// Close on backdrop click
document.addEventListener('click', function(e) {
    const modal = document.getElementById('modalAddUser');
    if (e.target === modal) {
        closeAddUserModal();
    }
});
</script>
@endsection
