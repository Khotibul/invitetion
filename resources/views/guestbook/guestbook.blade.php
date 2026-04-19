@extends('guestbook.layouts.app')
@section('title', Str::title('buku tamu'))

@section('content')
<section class="py-3">
    <div class="row g-3">

        {{-- Search & Scan --}}
        <div class="col-12 col-lg-5">
            <div class="bg-white rounded shadow p-3">
                <h5 class="fw-bold mb-3"><i class="bx bx-search me-2 text-muted"></i>Cari Tamu</h5>
                <div class="input-group mb-2">
                    <input type="text" id="guestSearch" class="form-control form-control-lg" placeholder="Ketik nama tamu...">
                    <button class="btn btn-creasik-primary" type="button" id="searchBtn">
                        <i class="bx bx-search"></i>
                    </button>
                </div>
                <div id="searchResults" class="mt-2" style="display:none">
                    <div class="list-group" id="searchList"></div>
                </div>
                <p class="text-muted small mt-2 mb-0">
                    <i class="bx bx-info-circle me-1"></i>
                    Cari berdasarkan nama tamu untuk check-in
                </p>
            </div>
        </div>

        {{-- Menu --}}
        <div class="col-12 col-lg-7">
            <div class="bg-white rounded shadow p-3">
                <div class="preset-menu grid-3">
                    @foreach ($menu as $item)
                    @php
                        $isLocked = in_array($item['id'], ['reservation', 'table-management', 'souvenir'])
                            && (!Auth::user()->acc || Auth::user()->acc->guestbook == 0);
                        $url = $isLocked ? 'packages' : $item['url'];
                    @endphp
                    <a href="{{ route($url) }}" @class(['shadow-sm', 'rounded', 'p-3', 'lock' => $isLocked])>
                        <img src="{{ url('images/icons/'.$item['icon']) }}" alt="{{ $item['title'] }}">
                        <span>{{ Str::upper($item['title']) }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Stats & Guest List --}}
        <div class="col-12">
            <div class="bg-white rounded shadow p-3">
                <div class="row g-3">
                    <div class="col-12 col-lg-4">

                        {{-- Stats --}}
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="card border-0 shadow-sm text-center p-3">
                                    <div class="text-muted small">Total Tamu</div>
                                    <div class="fw-bold fs-4">{{ $data->guest }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card border-0 shadow-sm text-center p-3">
                                    <div class="text-muted small">Kuota</div>
                                    <div class="fw-bold fs-4" style="color:#2d7a4f">{{ $data->limitGuest }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card border-0 shadow-sm text-center p-3">
                                    <div class="text-muted small">Hadir</div>
                                    <div class="fw-bold fs-4 text-success">{{ $data->hadir }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card border-0 shadow-sm text-center p-3">
                                    <div class="text-muted small">Tidak Hadir</div>
                                    <div class="fw-bold fs-4 text-danger">{{ $data->tidak_hadir }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Kuota bar --}}
                        @if($data->limitGuest !== '∞' && (int)$data->limitGuest > 0)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Penggunaan kuota</span>
                                <span>{{ $data->guest }}/{{ $data->limitGuest }}</span>
                            </div>
                            <div class="progress" style="height:8px">
                                <div class="progress-bar bg-success" style="width:{{ min(100, ($data->guest / max(1, $data->limitGuest)) * 100) }}%"></div>
                            </div>
                        </div>
                        @endif

                        <a href="{{ route('menu.presenting') }}" class="btn btn-creasik-primary w-100 mb-2">
                            <i class="bx bx-list-check me-1"></i> Lihat Konfirmasi Kehadiran
                        </a>
                        <a href="{{ route('menu.share') }}" class="btn btn-outline-secondary w-100">
                            <i class="bx bx-share-alt me-1"></i> Kelola Tamu Undangan
                        </a>
                    </div>

                    <div class="col-12 col-lg-8">
                        <h6 class="fw-bold mb-2">Daftar Tamu Terbaru</h6>
                        <table class="dataTables w-100" data-list="{{ route('strbox.list', 'multiple') }}">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tipe</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
    let searchTimer;

    $('#guestSearch').on('input', function() {
        clearTimeout(searchTimer);
        const q = $(this).val().trim();
        if (q.length < 2) {
            $('#searchResults').hide();
            return;
        }
        searchTimer = setTimeout(() => searchGuest(q), 300);
    });

    $('#searchBtn').on('click', function() {
        searchGuest($('#guestSearch').val().trim());
    });

    function searchGuest(q) {
        if (!q) return;
        $.get('{{ route("menu.reservation-search") }}', { q }, function(data) {
            const list = $('#searchList').empty();
            if (data.length === 0) {
                list.append('<div class="list-group-item text-muted text-center">Tamu tidak ditemukan</div>');
            } else {
                data.forEach(g => {
                    const badge = g.arrived
                        ? '<span class="badge bg-success ms-auto">Hadir</span>'
                        : '<span class="badge bg-secondary ms-auto">Belum</span>';
                    list.append(`
                        <div class="list-group-item d-flex align-items-center gap-2">
                            <div class="flex-grow-1">
                                <div class="fw-semibold">${g.name}</div>
                                <small class="text-muted">${g.location} · ${g.type}</small>
                            </div>
                            ${badge}
                            <button class="btn btn-sm btn-creasik-primary checkin-btn" data-id="${g.id}">
                                ${g.arrived ? 'Batal' : 'Check-in'}
                            </button>
                        </div>
                    `);
                });
            }
            $('#searchResults').show();
        });
    }

    $(document).on('click', '.checkin-btn', function() {
        const id = $(this).data('id');
        $.post('{{ route("menu.reservation-checkin") }}', {
            _token: '{{ csrf_token() }}',
            guest_id: id
        }, function(res) {
            searchGuest($('#guestSearch').val().trim());
        });
    });
});
</script>
@endpush
