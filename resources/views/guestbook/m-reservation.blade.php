@extends('guestbook.layouts.app')
@section('title', Str::title($menu['title']))

@section('content')
<section class="position-relative py-3">
    @include('guestbook.layouts.component', ['content' => 'breadcrumb', 'menu' => $menu])

    {{-- Stats --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small">Total Tamu</div>
                <div class="fw-bold fs-3">{{ $data->total }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small">Sudah Check-in</div>
                <div class="fw-bold fs-3 text-success">{{ $data->checked }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small">Belum Check-in</div>
                <div class="fw-bold fs-3 text-warning">{{ $data->total - $data->checked }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small">Persentase</div>
                <div class="fw-bold fs-3" style="color:#2d7a4f">
                    {{ $data->total > 0 ? round(($data->checked / $data->total) * 100) : 0 }}%
                </div>
            </div>
        </div>
    </div>

    {{-- Search --}}
    <div class="bg-white rounded shadow p-3 mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-search"></i></span>
            <input type="text" id="reservationSearch" class="form-control" placeholder="Cari nama tamu...">
        </div>
    </div>

    {{-- Guest list --}}
    <div class="bg-white rounded shadow p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 fw-bold">Daftar Tamu</h5>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-secondary filter-btn active" data-filter="all">Semua</button>
                <button class="btn btn-sm btn-outline-success filter-btn" data-filter="arrived">Hadir</button>
                <button class="btn btn-sm btn-outline-warning filter-btn" data-filter="pending">Belum</button>
            </div>
        </div>

        <div id="guestList">
            @forelse($data->guests as $guest)
            @php
                $nameData = $guest->name_data ?? [];
                $isArrived = in_array($guest->id, $data->arrived);
            @endphp
            <div class="guest-item d-flex align-items-center gap-3 p-2 border-bottom"
                 data-arrived="{{ $isArrived ? 'arrived' : 'pending' }}"
                 data-name="{{ strtolower($nameData['name'] ?? '') }}">
                <div class="flex-grow-1">
                    <div class="fw-semibold">{{ $nameData['name'] ?? '-' }}</div>
                    <small class="text-muted">
                        {{ $nameData['location'] ?? '-' }}
                        &middot;
                        <span class="badge bg-light text-dark">{{ ucfirst($guest->type) }}</span>
                    </small>
                </div>
                @if($isArrived)
                <span class="badge bg-success">Hadir</span>
                @else
                <span class="badge bg-secondary">Belum</span>
                @endif
                <button class="btn btn-sm {{ $isArrived ? 'btn-outline-danger' : 'btn-creasik-primary' }} checkin-btn"
                        data-id="{{ $guest->id }}"
                        data-arrived="{{ $isArrived ? '1' : '0' }}">
                    {{ $isArrived ? 'Batal' : 'Check-in' }}
                </button>
            </div>
            @empty
            <div class="text-center text-muted py-4">
                <i class="bx bx-user-x" style="font-size:3rem"></i>
                <p class="mt-2">Belum ada tamu terdaftar</p>
                <a href="{{ route('menu.share') }}" class="btn btn-sm btn-creasik-primary">Tambah Tamu</a>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('script')
<script>
$(document).ready(function() {
    // Search filter
    $('#reservationSearch').on('input', function() {
        const q = $(this).val().toLowerCase();
        $('.guest-item').each(function() {
            const name = $(this).data('name');
            $(this).toggle(name.includes(q));
        });
    });

    // Status filter
    $('.filter-btn').on('click', function() {
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        const filter = $(this).data('filter');
        $('.guest-item').each(function() {
            if (filter === 'all') {
                $(this).show();
            } else {
                $(this).toggle($(this).data('arrived') === filter);
            }
        });
    });

    // Check-in toggle
    $(document).on('click', '.checkin-btn', function() {
        const btn = $(this);
        const id = btn.data('id');
        btn.prop('disabled', true);

        $.post('{{ route("menu.reservation-checkin") }}', {
            _token: '{{ csrf_token() }}',
            guest_id: id
        }, function(res) {
            location.reload();
        }).fail(function() {
            btn.prop('disabled', false);
        });
    });
});
</script>
@endpush
