@extends('member.layouts.app')
@section('title', Str::title('pembayaran undangan'))

@section('content')
<section class="py-3">

    <div class="row justify-content-center g-3">
        <div class="col-lg-7">

            {{-- Breadcrumb --}}
            <nav class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('packages') }}">Paket</a></li>
                    <li class="breadcrumb-item active">Pembayaran</li>
                </ol>
            </nav>

            <form action="{{ route('invoice-add', request()->id) }}" class="pay-for-upgrade" method="post">
                @csrf

                {{-- Ringkasan Paket --}}
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="mb-0 fw-bold"><i class="bx bx-package me-2 text-muted"></i>Ringkasan Paket</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            @if($data->package->file)
                            <figure class="border rounded p-2 mb-0 flex-shrink-0" style="width:70px">
                                <img src="{{ url('storage/xs/'.$data->package->file) }}" alt="{{ $data->package->title }}" class="w-100 rounded">
                            </figure>
                            @else
                            <div class="rounded d-flex align-items-center justify-content-center flex-shrink-0" style="width:70px;height:70px;background:#e8f5ee">
                                <i class="bx bx-package" style="font-size:2rem;color:#2d7a4f"></i>
                            </div>
                            @endif
                            <div>
                                <h5 class="mb-1 fw-bold">{{ $data->package->title }}</h5>
                                <span class="fs-5" style="color:#2d7a4f">{!! idr($data->package->price) !!}</span>
                                @if((int)$data->package->price === 0)
                                <span class="badge bg-success ms-1">Gratis</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                @if((int)$data->package->price > 0)
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="mb-0 fw-bold"><i class="bx bx-credit-card me-2 text-muted"></i>Metode Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <var dir="payment"></var>

                        <div class="d-flex flex-column gap-2 mb-3">
                            {{-- Fast Payment --}}
                            <label class="payment-option-card d-flex align-items-start gap-3 p-3 border rounded cursor-pointer" for="fastPayment" style="cursor:pointer">
                                <input type="radio" name="payment" id="fastPayment" value="fast" class="mt-1">
                                <div>
                                    <div class="fw-semibold">
                                        <i class="bx bx-zap text-warning me-1"></i> Pembayaran Cepat
                                    </div>
                                    <small class="text-muted">Bayar via Xendit (transfer bank, e-wallet, QRIS). Akun aktif otomatis setelah pembayaran.</small>
                                </div>
                            </label>

                            {{-- Manual Payment --}}
                            <label class="payment-option-card d-flex align-items-start gap-3 p-3 border rounded" for="manualPayment" style="cursor:pointer">
                                <input type="radio" name="payment" id="manualPayment" value="manual" class="mt-1">
                                <div>
                                    <div class="fw-semibold">
                                        <i class="bx bx-transfer text-info me-1"></i> Transfer Manual
                                    </div>
                                    <small class="text-muted">Transfer ke rekening kami, lalu upload bukti pembayaran. Akun aktif setelah dikonfirmasi admin.</small>
                                </div>
                            </label>
                        </div>

                        {{-- Bank list (muncul saat manual dipilih) --}}
                        <var dir="bank"></var>
                        <div class="bank-list-wrapper" style="display:none">
                            <p class="small text-muted mb-2"><i class="bx bx-info-circle me-1"></i>Pilih rekening tujuan transfer:</p>
                            @if(count($data->bank) > 0)
                            <div class="bank-list wide">
                                @foreach($data->bank as $key => $item)
                                <label for="bank{{ $key }}" style="cursor:pointer">
                                    <input type="radio" name="bank" id="bank{{ $key }}" value="{{ base64_encode($item->id) }}">
                                    <div class="bank-item {{ $item->file }}">
                                        <code>{{ $item->file }}</code>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            @else
                            <div class="alert alert-warning small">
                                <i class="bx bx-error me-1"></i> Belum ada rekening bank tersedia. Hubungi admin.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                {{-- Free package: hidden input --}}
                <input type="hidden" name="payment" value="free">
                @endif

                {{-- Ringkasan Total --}}
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total Pembayaran</span>
                            <span class="fs-4 fw-bold" style="color:#2d7a4f">{!! idr($data->package->price) !!}</span>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-creasik-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2" id="submitBtn">
                    <i class="bx bx-lock-alt fs-5"></i>
                    <span>{{ (int)$data->package->price === 0 ? 'Aktifkan Paket Gratis' : 'Lanjutkan Pembayaran' }}</span>
                    <i class="bx bx-right-arrow-circle fs-5"></i>
                </button>

                <p class="text-center text-muted small mt-2">
                    <i class="bx bx-shield-check me-1"></i> Transaksi aman & terenkripsi
                </p>
            </form>
        </div>
    </div>

</section>

{{-- Info Modal --}}
<div class="modal fade" id="modal-info" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center py-4"></div>
            <div class="modal-footer justify-content-center p-2">
                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">
                    <i class="bx bx-thumbs-up me-1"></i> Oke
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    .bank-list .bank-item { background-image: url('{{ url('images/bank/banks.png') }}') }
    .payment-option-card:has(input:checked) { border-color: #2d7a4f !important; background: #f0f9f4; }
</style>
@endpush

@push('script')
<script>
$(document).ready(function() {
    // Toggle bank list
    $("input[name=payment]").on('change', function() {
        if ($(this).val() === 'manual') {
            $(".bank-list-wrapper").fadeIn(200);
        } else {
            $(".bank-list-wrapper").fadeOut(200);
        }
    });

    // Form submit via AJAX
    $(".pay-for-upgrade").on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const btn = $('#submitBtn');
        const action = form.attr('action');

        $("sup[role=alert]").remove();
        btn.prop('disabled', true).html('<i class="bx bx-loader bx-spin me-2"></i> Memproses...');

        $.ajax({
            type: 'POST',
            url: action,
            dataType: 'json',
            data: form.serialize(),
            success: function(res) {
                if (res.code === 200) {
                    btn.html('<i class="bx bx-check me-2"></i> Berhasil! Mengalihkan...');
                    setTimeout(() => location.href = res.redirect, 800);
                } else {
                    btn.prop('disabled', false).html('<i class="bx bx-lock-alt me-2"></i> Lanjutkan Pembayaran');
                    if (res.message) {
                        $.each(res.message, function(k, v) {
                            $(`var[dir=${k}]`).after(`<div class="alert alert-danger small py-1 mt-1">${v}</div>`);
                        });
                    }
                }
            },
            error: function(xhr) {
                btn.prop('disabled', false).html('<i class="bx bx-error me-2"></i> Coba Lagi');
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(k, v) {
                        $(`var[dir=${k}]`).after(`<div class="alert alert-danger small py-1 mt-1">${v[0]}</div>`);
                    });
                }
            }
        });
    });
});
</script>
@endpush
