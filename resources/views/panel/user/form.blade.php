@extends('panel.layouts.app')
@section('title', $data['title'])
@section('content')
@php $isEdit = isset($user); @endphp
<div class="container">
    <div class="row mt-3 mb-3 align-items-center">
        <div class="col">
            <h5 class="mb-0 fw-semibold">
                <i class="bx {{ $isEdit ? 'bx-edit' : 'bx-user-plus' }} me-1 text-primary"></i>
                {{ $isEdit ? 'Edit User: '.$user->name : 'Tambah User Baru' }}
            </h5>
            <small class="text-muted">
                <a href="{{ route('user-management.index') }}" class="text-muted text-decoration-none">
                    <i class="bx bx-chevron-left"></i> Kembali ke daftar user
                </a>
            </small>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show py-2">
        <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 pb-0 pt-3 px-4">
                    <h6 class="mb-0">
                        <i class="bx bx-user me-1"></i>
                        {{ $isEdit ? 'Informasi User' : 'Data User Baru' }}
                    </h6>
                </div>
                <div class="card-body px-4 py-3">
                    <form method="POST"
                          action="{{ $isEdit ? route('user-management.update', $user->id) : route('user-management.store') }}">
                        @csrf
                        @if($isEdit) @method('PUT') @endif

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name ?? '') }}"
                                   placeholder="Masukkan nama lengkap" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email ?? '') }}"
                                   placeholder="contoh@email.com" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                Role <span class="text-danger">*</span>
                            </label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach([
                                    'developer' => ['label'=>'Developer', 'color'=>'danger',  'desc'=>'Akses penuh ke semua fitur sistem'],
                                    'admin'     => ['label'=>'Admin',     'color'=>'warning', 'desc'=>'Akses panel admin'],
                                    'member'    => ['label'=>'Member',    'color'=>'primary', 'desc'=>'Pengguna biasa dengan akses dashboard undangan'],
                                ] as $roleKey => $roleInfo)
                                <option value="{{ $roleKey }}"
                                    {{ old('role', $user->role ?? '') === $roleKey ? 'selected' : '' }}>
                                    {{ $roleInfo['label'] }} — {{ $roleInfo['desc'] }}
                                </option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2 d-flex gap-2 flex-wrap">
                                <span class="badge bg-danger">Developer</span>
                                <span class="small text-muted">Akses penuh</span>
                                <span class="badge bg-warning ms-2">Admin</span>
                                <span class="small text-muted">Panel admin</span>
                                <span class="badge bg-primary ms-2">Member</span>
                                <span class="small text-muted">Dashboard undangan</span>
                            </div>
                        </div>

                        <hr class="my-3">

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                Password
                                @if($isEdit)
                                <span class="text-muted fw-normal">(kosongkan jika tidak ingin mengubah)</span>
                                @else
                                <span class="text-danger">*</span>
                                @endif
                            </label>
                            <div class="input-group">
                                <input type="password" name="password" id="passwordInput"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="{{ $isEdit ? 'Password baru (opsional)' : 'Minimal 6 karakter' }}"
                                       {{ $isEdit ? '' : 'required' }}>
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="bx bx-show" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold small">
                                Konfirmasi Password
                                @if(!$isEdit)<span class="text-danger">*</span>@endif
                            </label>
                            <input type="password" name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password"
                                   {{ $isEdit ? '' : 'required' }}>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx {{ $isEdit ? 'bx-save' : 'bx-user-plus' }} me-1"></i>
                                {{ $isEdit ? 'Simpan Perubahan' : 'Tambah User' }}
                            </button>
                            <a href="{{ route('user-management.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                            @if($isEdit && $user->id !== auth()->id())
                            <button type="button" class="btn btn-outline-danger ms-auto btn-delete-confirm"
                                    data-url="{{ route('user-management.destroy', $user->id) }}"
                                    data-name="{{ $user->name }}">
                                <i class="bx bx-trash me-1"></i> Hapus User
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            @if($isEdit)
            {{-- Status Aktif Card (hanya untuk member yang punya akun) --}}
            @if($user->acc)
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body px-4 py-3">
                    <h6 class="mb-3 small fw-semibold text-muted text-uppercase">
                        <i class="bx bx-toggle-left me-1"></i> Status Akun
                    </h6>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            @if($user->acc->actived == 1)
                                <span class="badge bg-success fs-6 px-3 py-2">
                                    <i class="bx bx-check-circle me-1"></i> Aktif
                                </span>
                                <p class="text-muted small mt-1 mb-0">Akun dapat digunakan untuk login dan mengakses dashboard.</p>
                            @else
                                <span class="badge bg-secondary fs-6 px-3 py-2">
                                    <i class="bx bx-x-circle me-1"></i> Non-aktif
                                </span>
                                <p class="text-muted small mt-1 mb-0">Akun diblokir, user tidak dapat mengakses dashboard.</p>
                            @endif
                        </div>
                        <div>
                            @if($user->acc->actived == 1)
                            <button type="button" class="btn btn-outline-warning btn-sm btn-toggle-status"
                                    data-url="{{ route('user-management.toggle-active', $user->id) }}"
                                    data-active="1" data-name="{{ $user->name }}">
                                <i class="bx bx-user-minus me-1"></i> Non-aktifkan
                            </button>
                            @else
                            <button type="button" class="btn btn-outline-success btn-sm btn-toggle-status"
                                    data-url="{{ route('user-management.toggle-active', $user->id) }}"
                                    data-active="0" data-name="{{ $user->name }}">
                                <i class="bx bx-user-check me-1"></i> Aktifkan
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Info Card --}}
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body px-4 py-3">
                    <h6 class="mb-3 small fw-semibold text-muted text-uppercase">Informasi Akun</h6>
                    <div class="row g-2 small">
                        <div class="col-5 text-muted">ID User</div>
                        <div class="col-7 fw-semibold">#{{ $user->id }}</div>
                        <div class="col-5 text-muted">Bergabung</div>
                        <div class="col-7">{{ $user->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</div>
                        <div class="col-5 text-muted">Terakhir update</div>
                        <div class="col-7">{{ $user->updated_at->locale('id')->translatedFormat('d F Y, H:i') }}</div>
                        @if($user->role === 'member' && $user->inv)
                        <div class="col-5 text-muted">Undangan</div>
                        <div class="col-7">
                            <a href="{{ route('member.show', $user->inv->id) }}" class="text-primary text-decoration-none">
                                <i class="bx bx-link-external me-1"></i>Lihat undangan
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Delete Confirm Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title text-danger"><i class="bx bx-trash me-1"></i> Hapus User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Yakin ingin menghapus user <strong id="deleteUserName"></strong>?</p>
                <small class="text-muted">Aksi ini tidak dapat dibatalkan.</small>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm btn-danger" id="confirmDelete">
                    <i class="bx bx-trash me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('script')
<script>
// Toggle password visibility
document.getElementById('togglePassword')?.addEventListener('click', function () {
    var input = document.getElementById('passwordInput');
    var icon  = document.getElementById('toggleIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bx-show', 'bx-hide');
    } else {
        input.type = 'password';
        icon.classList.replace('bx-hide', 'bx-show');
    }
});

// Toggle aktif / non-aktif
document.querySelector('.btn-toggle-status')?.addEventListener('click', function () {
    var btn    = this;
    var url    = btn.dataset.url;
    var active = parseInt(btn.dataset.active);
    var name   = btn.dataset.name;
    var label  = active === 1 ? 'non-aktifkan' : 'aktifkan';

    if (!confirm('Yakin ingin ' + label + ' akun "' + name + '"?')) return;

    btn.disabled = true;
    fetch(url, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        // Reload halaman agar status terupdate
        window.location.reload();
    })
    .catch(function() {
        btn.disabled = false;
        alert('Gagal mengubah status akun.');
    });
});

// Delete confirm
var deleteUrl = '';
document.querySelector('.btn-delete-confirm')?.addEventListener('click', function () {
    deleteUrl = this.dataset.url;
    document.getElementById('deleteUserName').textContent = this.dataset.name;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
});

document.getElementById('confirmDelete')?.addEventListener('click', function () {
    fetch(deleteUrl, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        window.location.href = '{{ route("user-management.index") }}';
    })
    .catch(() => alert('Gagal menghapus user.'));
});
</script>
@endpush
