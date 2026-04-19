@extends('member.layouts.app')
@section('title', Str::title('riwayat transaksi'))

@section('content')
<section class="py-3">

    {{-- Sub-nav --}}
    <ul class="nav nav-pills creasik-nav-pill mb-3">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="bx bx-user-circle"></i>
                <span>Profil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('packages') }}">
                <i class="bx bx-cart-alt"></i>
                <span>Pesan Undangan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('storage') }}">
                <i class="bx bx-images"></i>
                <span>Penyimpanan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">
                <i class="bx bx-receipt"></i>
                <span>Transaksi</span>
            </a>
        </li>
    </ul>

    {{-- Stats summary --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small mb-1">Total Transaksi</div>
                <div class="fw-bold fs-4" id="stat-total">-</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small mb-1">Dikonfirmasi</div>
                <div class="fw-bold fs-4 text-success" id="stat-confirmed">-</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small mb-1">Menunggu</div>
                <div class="fw-bold fs-4 text-warning" id="stat-pending">-</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small mb-1">Total Bayar</div>
                <div class="fw-bold fs-5 text-primary" id="stat-amount">-</div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
            <h6 class="mb-0 fw-bold"><i class="bx bx-list-ul me-2 text-muted"></i>Riwayat Transaksi</h6>
            <a href="{{ route('packages') }}" class="btn btn-sm btn-creasik-primary">
                <i class="bx bx-plus me-1"></i> Pesan Paket
            </a>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="dataTables w-100" data-columns="transaction" data-list="{{ route('transaction.list') }}">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Paket</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    {{-- Empty state (shown via JS if no data) --}}
    <div id="empty-state" class="text-center py-5" style="display:none">
        <i class="bx bx-receipt" style="font-size:4rem; color:#d4af37"></i>
        <h5 class="mt-3">Belum ada transaksi</h5>
        <p class="text-muted">Kamu belum pernah memesan paket undangan.</p>
        <a href="{{ route('packages') }}" class="btn btn-creasik-primary">
            <i class="bx bx-cart-alt me-1"></i> Pesan Sekarang
        </a>
    </div>

</section>
@endsection

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('modules/datatable/datatables.min.css') }}">
@endpush

@push('script')
<script src="{{ asset('modules/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Load stats via AJAX
    $.post('{{ route("transaction.list") }}', {
        _token: '{{ csrf_token() }}',
        draw: 1, start: 0, length: 1000,
        search: { value: '' }
    }, function(res) {
        const total = res.recordsTotal;
        let confirmed = 0, pending = 0, amount = 0;

        if (res.data) {
            res.data.forEach(row => {
                const status = row.status || '';
                if (status.includes('DONE') || status.includes('bg-success')) confirmed++;
                else pending++;
            });
        }

        $('#stat-total').text(total);
        $('#stat-confirmed').text(confirmed);
        $('#stat-pending').text(pending);

        if (total === 0) {
            $('#empty-state').show();
            $('table.dataTables').closest('.card').hide();
        }
    });
});
</script>
@endpush
