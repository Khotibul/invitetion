@extends('member.layouts.app')
@section('title', Str::title('invoice '.$invoice->content->invoice_number))
@php use Carbon\Carbon; @endphp

@section('content')
<section class="py-3">
    <div class="row justify-content-center g-3">
        <div class="col-lg-7">

            {{-- Breadcrumb --}}
            <nav class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('transaction') }}">Transaksi</a></li>
                    <li class="breadcrumb-item active">Invoice {{ $invoice->content->invoice_number }}</li>
                </ol>
            </nav>

            {{-- Invoice Card --}}
            <div class="card border-0 shadow-sm overflow-hidden">

                {{-- Status bar --}}
                <div class="text-white text-center py-2 fw-semibold text-uppercase letter-spacing-1 {{ $status['color'] }}" style="letter-spacing:2px; font-size:0.8rem">
                    @if($status['text'] === 'done')
                        <i class="bx bx-check-circle me-1"></i> Pembayaran Dikonfirmasi
                    @elseif($status['text'] === 'waiting confirmation')
                        <i class="bx bx-time me-1"></i> Menunggu Konfirmasi Admin
                    @else
                        <i class="bx bx-time-five me-1"></i> Menunggu Pembayaran
                    @endif
                </div>

                <div class="card-body p-4">

                    {{-- Header --}}
                    <div class="text-center mb-4">
                        <div class="mb-2" style="font-size:2.5rem; color:#2d7a4f">
                            <i class="bx bx-receipt"></i>
                        </div>
                        <h4 class="fw-bold mb-1">Risa Digital Invitation</h4>
                        <p class="text-muted small mb-0">Invoice Pembelian Paket Undangan</p>
                    </div>

                    {{-- Invoice meta --}}
                    <div class="row g-2 mb-4 p-3 rounded" style="background:#f8f9fa">
                        <div class="col-6">
                            <div class="small text-muted">No. Invoice</div>
                            <div class="fw-bold">{{ $invoice->content->invoice_number }}</div>
                        </div>
                        <div class="col-6 text-end">
                            <div class="small text-muted">Kode Pembayaran</div>
                            <div class="fw-bold">{{ $invoice->payment_code }}</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted">Tanggal</div>
                            <div>{{ Carbon::parse($invoice->date)->locale('id')->translatedFormat('d M Y') }}</div>
                        </div>
                        <div class="col-6 text-end">
                            <div class="small text-muted">Waktu</div>
                            <div>{{ Carbon::parse($invoice->created_at)->format('H:i') }} WIB</div>
                        </div>
                    </div>

                    {{-- Kepada --}}
                    <div class="mb-4">
                        <div class="small text-muted text-uppercase mb-1" style="letter-spacing:1px">Kepada</div>
                        <div class="fw-semibold">{{ $invoice->user->name }}</div>
                        <div class="text-muted small">{{ $invoice->user->email }}</div>
                    </div>

                    {{-- Item --}}
                    <div class="border rounded overflow-hidden mb-3">
                        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                            <div>
                                <div class="fw-semibold">{{ $invoice->pack?->title ?? 'Paket Tidak Diketahui' }}</div>
                                <div class="small text-muted">Paket Undangan Digital</div>
                            </div>
                            <div class="fw-semibold">{!! idr($invoice->pack?->price ?? 0) !!}</div>
                        </div>
                        @if(!empty($invoice->content->template_price) && (int)$invoice->content->template_price > 0)
                        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                            <div>
                                <div class="fw-semibold">Template Premium</div>
                                <div class="small text-muted">Biaya template</div>
                            </div>
                            <div class="fw-semibold">{!! idr((string)$invoice->content->template_price) !!}</div>
                        </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center p-3" style="background:#f0f9f4">
                            <div class="fw-bold">Total Pembayaran</div>
                            <div class="fw-bold fs-5" style="color:#2d7a4f">{!! idr($invoice->amount) !!}</div>
                        </div>
                    </div>

                    {{-- Metode --}}
                    <div class="d-flex justify-content-between small text-muted mb-4">
                        <span>Metode Pembayaran</span>
                        <span class="fw-semibold text-dark">
                            {{ $invoice->payment_link === '#manual' ? 'Transfer Manual' : 'Pembayaran Otomatis (Xendit)' }}
                        </span>
                    </div>

                    {{-- Action area --}}
                    @if($invoice->status === 'PENDING')

                        @if($invoice->payment_link === '#manual' && $bank_pay)
                        {{-- Manual payment instructions --}}
                        <div class="alert border rounded p-3 mb-3" style="background:#f0f9f4; border-color:#2d7a4f !important">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bank-item {{ $bank_pay->file }} flex-shrink-0">
                                    <code>{{ $bank_pay->file }}</code>
                                </div>
                                <div>
                                    <div class="fw-semibold mb-1">Transfer ke {{ $bank_pay->bank }}</div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-bold fs-5">{{ $bank_pay->content->code }}</span>
                                        <button type="button" class="btn btn-sm btn-outline-secondary copy-btn" data-text="{{ $bank_pay->content->code }}">
                                            <i class="bx bx-copy"></i>
                                        </button>
                                    </div>
                                    <div class="small text-muted">a.n. {{ $bank_pay->name }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="text-muted small text-center mb-3">
                            <i class="bx bx-info-circle me-1"></i>
                            Setelah transfer, upload bukti pembayaran di bawah ini untuk konfirmasi.
                        </div>

                        @if(!empty($invoice->content->payment) && $invoice->content->payment->image)
                        {{-- Proof already uploaded --}}
                        <div class="alert alert-warning small text-center mb-3">
                            <i class="bx bx-time me-1"></i>
                            Bukti pembayaran sudah dikirim. Menunggu konfirmasi admin.
                        </div>
                        <a href="#" class="btn btn-outline-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#confirmation-of-payment">
                            <i class="bx bx-refresh me-1"></i> Ganti Bukti Pembayaran
                        </a>
                        @else
                        <a href="#" class="btn btn-creasik-primary w-100 py-3" data-bs-toggle="modal" data-bs-target="#confirmation-of-payment">
                            <i class="bx bx-upload me-2"></i> Upload Bukti Pembayaran
                        </a>
                        @endif

                        @elseif($invoice->payment_link !== '#manual')
                        {{-- Xendit payment link --}}
                        <a href="{{ $invoice->payment_link }}" target="_blank" class="btn btn-creasik-primary w-100 py-3">
                            <i class="bx bx-credit-card me-2"></i> Bayar Sekarang
                            <i class="bx bx-link-external ms-1"></i>
                        </a>
                        <p class="text-center text-muted small mt-2">
                            Kamu akan diarahkan ke halaman pembayaran Xendit
                        </p>
                        @endif

                    @elseif($invoice->status === 'CONFIRMED')
                    <div class="text-center py-3">
                        <i class="bx bx-check-circle text-success" style="font-size:3rem"></i>
                        <p class="mt-2 text-success fw-semibold">Pembayaran berhasil dikonfirmasi!</p>
                        <a href="{{ route('member.main') }}" class="btn btn-creasik-primary">
                            <i class="bx bxs-widget me-1"></i> Ke Dashboard
                        </a>
                    </div>
                    @endif

                </div>
            </div>

            {{-- Proof image (if exists) --}}
            @if(!empty($invoice->content->payment) && !empty($invoice->content->payment->image))
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold small">Bukti Pembayaran</div>
                        <div class="text-muted small">
                            Dikirim: {{ Carbon::parse($invoice->content->payment->date)->locale('id')->translatedFormat('d M Y, H:i') }}
                        </div>
                    </div>
                    <a href="{{ url('storage/'.$invoice->content->payment->image) }}" data-fancybox="preview" class="btn btn-sm btn-outline-secondary">
                        <i class="bx bx-image me-1"></i> Lihat Bukti
                        <img src="{{ url('storage/'.$invoice->content->payment->image) }}" alt="bukti" class="ms-2 rounded" style="height:30px;width:40px;object-fit:cover">
                    </a>
                </div>
            </div>
            @endif

            {{-- Back link --}}
            <div class="text-center mt-3">
                <a href="{{ route('transaction') }}" class="text-muted small">
                    <i class="bx bx-arrow-back me-1"></i> Kembali ke Riwayat Transaksi
                </a>
            </div>

        </div>
    </div>
</section>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('modules/@fancyapps/fancybox/dist/jquery.fancybox.min.css') }}">
<style>
.bank-item { background-image: url('{{ url('images/bank/banks.png') }}') }
</style>
@endpush

@push('script')
@include('member.layouts.component', ['content' => 'confirmation-of-payment', 'id' => request()->id])
<script src="{{ asset('modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('[data-fancybox="preview"]').fancybox();

    // Copy to clipboard
    $(document).on('click', '.copy-btn', function() {
        const text = $(this).data('text');
        navigator.clipboard.writeText(text).then(() => {
            const btn = $(this);
            btn.html('<i class="bx bx-check"></i>');
            setTimeout(() => btn.html('<i class="bx bx-copy"></i>'), 1500);
        });
    });

    // Preview image before upload
    $(".change-img").on('change', function(e) {
        if (e.target.name === 'prove_image') {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (r) => $(".set_prove_image").attr('src', r.target.result);
                reader.readAsDataURL(file);
            }
        }
    });
});
</script>
@endpush
