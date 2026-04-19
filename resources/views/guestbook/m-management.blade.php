@extends('guestbook.layouts.app')
@section('title', Str::title($menu['title']))

@section('content')
<section class="position-relative py-3">
    @include('guestbook.layouts.component', ['content' => 'breadcrumb', 'menu' => $menu])

    {{-- Stats --}}
    <div class="row g-3 mb-3">
        <div class="col-6">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small">Total Meja</div>
                <div class="fw-bold fs-3">{{ $data->total }}</div>
            </div>
        </div>
        <div class="col-6">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small">Total Kapasitas</div>
                <div class="fw-bold fs-3" style="color:#2d7a4f">
                    {{ $data->tables->sum('stock') ?? 0 }}
                </div>
            </div>
        </div>
    </div>

    {{-- Add table button --}}
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-creasik-primary" data-bs-toggle="modal" data-bs-target="#addTableModal">
            <i class="bx bx-plus me-1"></i> Tambah Meja
        </button>
    </div>

    {{-- Table list --}}
    <div class="bg-white rounded shadow p-3">
        <h5 class="fw-bold mb-3">Daftar Meja</h5>

        @if($data->tables->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Kode Meja</th>
                        <th>Kapasitas</th>
                        <th>Grade</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->tables as $table)
                    <tr>
                        <td><span class="fw-semibold">{{ $table->table_code }}</span></td>
                        <td>{{ $table->stock }} orang</td>
                        <td><span class="badge bg-info">{{ ucfirst($table->grade) }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger delete-table" data-id="{{ $table->id }}">
                                <i class="bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center text-muted py-4">
            <i class="bx bx-table" style="font-size:3rem"></i>
            <p class="mt-2">Belum ada meja terdaftar</p>
        </div>
        @endif
    </div>
</section>

{{-- Add Table Modal --}}
<div class="modal fade" id="addTableModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addTableForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Meja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Meja <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="table_code" placeholder="Contoh: A1, VIP-1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kapasitas (orang) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="table_stock" min="1" value="8" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Grade</label>
                        <select class="form-select" name="table_grade">
                            <option value="basic">Basic</option>
                            <option value="premium">Premium</option>
                            <option value="exclusive">Exclusive / VIP</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-creasik-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).ready(function() {
    // Add table
    $('#addTableForm').on('submit', function(e) {
        e.preventDefault();
        $.post('{{ route("menu.management-add") }}', $(this).serialize(), function(res) {
            location.reload();
        });
    });

    // Delete table
    $(document).on('click', '.delete-table', function() {
        if (!confirm('Hapus meja ini?')) return;
        const id = $(this).data('id');
        $.ajax({
            type: 'DELETE',
            url: '{{ url("guestbook/table-management") }}/' + id,
            data: { _token: '{{ csrf_token() }}' },
            success: () => location.reload()
        });
    });
});
</script>
@endpush
