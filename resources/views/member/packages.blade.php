@extends('member.layouts.app')
@section('title', Str::title('pesan undangan'))
@php use Carbon\Carbon; @endphp

@section('content')
<section class="py-3">

    {{-- Header --}}
    <div class="text-center mb-4">
        <h3 class="fw-bold">Pilih Paket Undangan</h3>
        <p class="text-muted mb-0">Pilih paket yang sesuai kebutuhan pernikahan kamu</p>
        @if($data->activation)
        <span class="badge bg-success mt-1">
            <i class="bx bx-check-circle me-1"></i>
            Paket aktif: {{ $data->activation->pack?->title ?? '-' }}
            &mdash;
            @php
                $expDate = Carbon::parse($data->activation->date)->addDays(json_decode($data->activation->pack?->content ?? '{}')->active ?? 0);
            @endphp
            berakhir {{ $expDate->locale('id')->translatedFormat('d M Y') }}
        </span>
        @endif
    </div>

    {{-- Tab nav --}}
    <nav class="mb-3">
        <div class="creasik-nav-pill nav nav-pills justify-content-center" id="nav-package" role="tablist">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-digitalInvitation" type="button" role="tab">
                <i class="bx bx-envelope me-1"></i> Undangan Digital
            </button>
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-guestBook" type="button" role="tab">
                <i class="bx bx-book-open me-1"></i> Buku Tamu
            </button>
        </div>
    </nav>

    <div class="tab-content">
        {{-- Tab: Undangan Digital --}}
        <div class="tab-pane fade show active" id="nav-digitalInvitation" role="tabpanel">

            @if(count($data->package) === 0)
            <div class="alert alert-info text-center">
                <i class="bx bx-info-circle me-1"></i> Belum ada paket tersedia. Hubungi admin.
            </div>
            @else

            {{-- Package cards --}}
            <div class="row g-3 mb-4 justify-content-center">
                @foreach($data->package as $pkg)
                @php
                    $pkgContent = json_decode($pkg->content, true);
                    $isActive = $data->activation && $data->activation->package_id == $pkg->id;
                    $activeDays = $pkgContent['active'] ?? 0;
                    $isFree = (int)$pkg->price === 0;
                @endphp
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm @if($isActive) border-success @endif" style="border-top: 4px solid {{ $isActive ? '#2d7a4f' : '#d4af37' }} !important;">
                        @if($isActive)
                        <div class="text-center py-1" style="background:#2d7a4f; color:#fff; font-size:0.75rem; letter-spacing:1px;">
                            PAKET AKTIF KAMU
                        </div>
                        @endif
                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold mb-1">{{ $pkg->title }}</h5>
                            <div class="my-3">
                                @if($isFree)
                                <span class="fs-2 fw-bold text-success">Gratis</span>
                                @else
                                <span class="fs-2 fw-bold" style="color:#2d7a4f">{!! idr($pkg->price) !!}</span>
                                @endif
                            </div>
                            <p class="text-muted small mb-3">
                                <i class="bx bx-time me-1"></i>
                                Aktif selama
                                <strong>
                                    @if($activeDays >= 365)
                                        {{ round($activeDays/365) }} tahun
                                    @elseif($activeDays >= 30)
                                        {{ round($activeDays/30) }} bulan
                                    @else
                                        {{ $activeDays }} hari
                                    @endif
                                </strong>
                            </p>

                            {{-- Feature list --}}
                            <ul class="list-unstyled text-start small mb-4">
                                @foreach($data->feature->content as $key => $label)
                                @php $val = $pkgContent[$key] ?? false; @endphp
                                <li class="d-flex align-items-center py-1 border-bottom">
                                    <span class="me-2">
                                        @if($val === true)
                                            <i class="bx bx-check-circle text-success"></i>
                                        @elseif($val === false)
                                            <i class="bx bx-x-circle text-danger"></i>
                                        @else
                                            <i class="bx bx-info-circle text-warning"></i>
                                        @endif
                                    </span>
                                    <span class="flex-grow-1">{{ $label }}</span>
                                    <span class="text-muted ms-1">
                                        @if($val === true || $val === false)
                                        @elseif($key === 'active')
                                            @if($val >= 365) {{ round($val/365) }}th
                                            @elseif($val >= 30) {{ round($val/30) }}bln
                                            @else {{ $val }}hr @endif
                                        @elseif($key === 'template')
                                            {{ Str::title(implode(', ', (array)$val)) }}
                                        @else
                                            {{ Str::title($val) }}
                                        @endif
                                    </span>
                                </li>
                                @endforeach
                            </ul>

                            @if($isActive)
                            <button class="btn w-100 btn-outline-success" disabled>
                                <i class="bx bx-check me-1"></i> Paket Aktif
                            </button>
                            @else
                            <a href="{{ route('packages.payment', $pkg->id) }}" class="btn w-100 btn-creasik-primary">
                                <i class="bx bxs-cart me-1"></i>
                                {{ $isFree ? 'Aktifkan Gratis' : 'Pilih Paket' }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Feature comparison table --}}
            <div class="bg-white shadow-sm rounded overflow-hidden mb-3">
                <div class="p-3 border-bottom d-flex align-items-center">
                    <i class="bx bx-table me-2 text-muted"></i>
                    <strong>Perbandingan Fitur Lengkap</strong>
                </div>
                <div class="table-responsive">
                    <table class="table-package table mb-0">
                        <thead>
                            <tr>
                                <th class="bg-light">Fitur</th>
                                @foreach($data->package as $pkg)
                                <th class="text-center position-relative">
                                    @if($data->activation && $data->activation->package_id == $pkg->id)
                                    <small class="d-block text-success" style="font-size:0.7rem">✓ Aktif</small>
                                    @endif
                                    <b>{{ $pkg->title }}</b>
                                    <div class="small text-muted">{!! idr($pkg->price) !!}</div>
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data->feature->content as $key => $label)
                            <tr>
                                <th class="bg-light fw-semibold small">{{ $label }}</th>
                                @foreach($data->package as $pkg)
                                @php
                                    $pkgContent = json_decode($pkg->content, true);
                                    $val = $pkgContent[$key] ?? false;
                                    if ($val === true) $cell = '<i class="bx bx-check text-success fs-5"></i>';
                                    elseif ($val === false) $cell = '<i class="bx bx-x text-danger fs-5"></i>';
                                    elseif ($key === 'active')
                                        $cell = ($val >= 365 ? round($val/365).'th' : ($val >= 30 ? round($val/30).'bln' : $val.'hr'));
                                    elseif ($key === 'template')
                                        $cell = Str::title(implode(', ', (array)$val));
                                    else $cell = Str::title($val);
                                @endphp
                                <td class="text-center small">{!! $cell !!}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="bg-light"></th>
                                @foreach($data->package as $pkg)
                                @php $isActive = $data->activation && $data->activation->package_id == $pkg->id; @endphp
                                <th class="text-center py-3">
                                    <div class="fw-bold mb-2">{!! idr($pkg->price) !!}</div>
                                    @if($isActive)
                                    <button class="btn btn-sm btn-outline-success" disabled>Aktif</button>
                                    @else
                                    <a href="{{ route('packages.payment', $pkg->id) }}" class="btn btn-sm btn-creasik-primary">Pilih</a>
                                    @endif
                                </th>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @endif
        </div>

        {{-- Tab: Buku Tamu --}}
        <div class="tab-pane fade" id="nav-guestBook" role="tabpanel">
            <div class="text-center py-5">
                <i class="bx bx-book-open" style="font-size:4rem; color:#d4af37"></i>
                <h4 class="mt-3">Fitur Buku Tamu</h4>
                <p class="text-muted">Kelola tamu undangan, souvenir, dan konfirmasi kehadiran secara digital.</p>
                <span class="badge bg-warning text-dark px-3 py-2">Segera Hadir</span>
            </div>
        </div>
    </div>

</section>
@endsection
