@extends('panel.layouts.app')
@section('title', 'Manajemen User')
@section('content')
<div class="container">
    <div class="row mt-3 mb-2 align-items-center">
        <div class="col">
            <h5 class="mb-0 fw-semibold">
                <i class="bx bx-group me-1 text-primary"></i> Manajemen User & Role
            </h5>
            <small class="text-muted">Kelola semua pengguna dan hak akses sistem</small>
        </div>
        <div class="col-auto">
            <a href="{{ route('user-management.create') }}" class="btn btn-primary btn-sm">
                <i class="bx bx-user-plus me-1"></i> Tambah User
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    @php
        $totalAll       = \App\Models\User::count();
        $totalDev       = \App\Models\User::where('role','developer')->count();
        $totalAdmin     = \App\Models\User::where('role','admin')->count();
        $totalMember    = \App\Models\User::where('role','member')->count();
    @endphp
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="fs-2 fw-bold text-dark">{{ $totalAll }}</div>
                <div class="small text-muted">Total User</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="fs-2 fw-bold text-danger">{{ $totalDev }}</div>
                <div class="small text-muted">Developer</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="fs-2 fw-bold text-warning">{{ $totalAdmin }}</div>
                <div class="small text-muted">Admin</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="fs-2 fw-bold text-primary">{{ $totalMember }}</div>
                <div class="small text-muted">Member</div>
            </div>
        </div>
    </div>

    {{-- Filter Role --}}
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body py-2 px-3 d-flex align-items-center gap-2 flex-wrap">
            <span class="small text-muted me-1">Filter Role:</span>
            <button class="btn btn-sm btn-outline-secondary role-filter active" data-role="all">Semua</button>
            <button class="btn btn-sm btn-outline-danger role-filter" data-role="developer">Developer</button>
            <button class="btn btn-sm btn-outline-warning role-filter" data-role="admin">Admin</button>
            <button class="btn btn-sm btn-outline-primary role-filter" data-role="member">Member</button>
        </div>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
        <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="dataTables" id="userTable" data-list="{{ $data['list'] }}">
                <thead>
                    <tr>
                        <th>Nama / Email</th>
                        <th>Role</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
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
<link rel="stylesheet" href="{{ asset('modules/datatable/datatables.min.css') }}">
@endpush

@push('script')
<script src="{{ asset('modules/datatable/datatables.min.js') }}"></script>
<script>
(function () {
    var currentRole = 'all';
    var table = $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $('#userTable').data('list'),
            type: 'POST',
            data: function (d) {
                d._token = $('meta[name="csrf-token"]').attr('content');
                d.role   = currentRole;
            }
        },
        columns: [
            { data: 'name',   orderable: false },
            { data: 'role',   orderable: false },
            { data: 'date',   orderable: false },
            { data: 'action', orderable: false, className: 'text-end' }
        ],
        language: {
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_-_END_ dari _TOTAL_ data',
            paginate: { previous: '‹', next: '›' },
            emptyTable: 'Tidak ada data',
            zeroRecords: 'Data tidak ditemukan'
        }
    });

    // Role filter
    $('.role-filter').on('click', function () {
        $('.role-filter').removeClass('active');
        $(this).addClass('active');
        currentRole = $(this).data('role');
        table.ajax.reload();
    });

    // Delete
    var deleteUrl = '';
    $(document).on('click', '.btn-delete-user', function () {
        deleteUrl = $(this).data('url');
        $('#deleteUserName').text($(this).data('name'));
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').on('click', function () {
        $.ajax({
            url: deleteUrl,
            type: 'DELETE',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function (res) {
                $('#deleteModal').modal('hide');
                table.ajax.reload();
            },
            error: function (xhr) {
                alert(xhr.responseJSON?.message ?? 'Gagal menghapus user.');
            }
        });
    });
})();
</script>
@endpush
