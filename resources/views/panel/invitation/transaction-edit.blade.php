@extends('panel.layouts.app')
@section('title', Str::title($data['title']))
@php use Carbon\Carbon; @endphp
@section('content')
<div class="container">
    <div class="mt-3 mb-3 d-flex align-items-center gap-2">
        <button type="button" class="btn-back btn btn-outline-secondary btn-sm">
            <i class="bx bx-chevron-left"></i>
            <span>Kembali</span>
        </button>
        <h5 class="mb-0 fw-semibold">
            <i class="bx bx-edit me-1 text-primary"></i> Edit Transaksi
        </h5>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show py-2">
        <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show py-2">
        <i class="bx bx-error-circle me-1"></i>
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $err)
            <li class="small">{{ $err }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-3">
        {{-- Info Transaksi --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 pt-3 pb-0 px-3">
                    <h6 class="mb-0"><i class="bx bx-info-circle me-1"></i> Info Transaksi</h6>
                </div>
                <div class="card-body px-3 py-2">
                    <table class="table table-sm mb-0">
                        <tr>
                            <td class="text-muted small" style="width:40%">No. Invoice</td>
                            <td class="fw-semibold small text-primary">
                                {{ $invoice->content->invoice_number ?? '-' }}:{{ $invoice->payment_code }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted small">User</td>
                            <td class="small">
                                {{ $invoice->user->name ?? '-' }}
                                <br><span class="text-muted">{{ $invoice->user->email ?? '' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Metode</td>
                            <td class="small">
                                {{ $invoice->payment_link === '#manual' ? 'Transfer Manual' : 'Otomatis (Xendit)' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Status saat ini</td>
                            <td class="small">
                                @if($invoice->status === 'CONFIRMED')
                                    <span class="badge bg-success">Confirmed</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Dibuat</td>
                            <td class="small">
                                {{ Carbon::parse($invoice->created_at)->locale('id')->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer border-0 px-3 py-2">
                    <a href="{{ route('invoice-transaction.show', $invoice->id) }}"
                       class="btn btn-outline-secondary btn-sm w-100">
                        <i class="bx bx-show me-1"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        {{-- Form Edit --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 pt-3 pb-0 px-3">
                    <h6 class="mb-0"><i class="bx bx-edit me-1"></i> Ubah Data Transaksi</h6>
                </div>
                <div class="card-body px-3 py-3">
                    <form method="POST" action="{{ route('invoice-transaction.update', $invoice->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="row g-3">
                            {{-- Status --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select name="status"
                                        class="form-select @error('status') is-invalid @enderror"
                                        required>
                                    <option value="PENDING"
                                        {{ old('status', $invoice->status) === 'PENDING' ? 'selected' : '' }}>
                                        Pending — Menunggu
                                    </option>
                                    <option value="CONFIRMED"
                                        {{ old('status', $invoice->status) === 'CONFIRMED' ? 'selected' : '' }}>
                                        Confirmed — Selesai
                                    </option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-1">
                                    <i class="bx bx-info-circle me-1"></i>
                                    Status CONFIRMED akan mengaktifkan paket user.
                                </small>
                            </div>

                            {{-- Tanggal --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">
                                    Tanggal Transaksi <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="date"
                                       class="form-control @error('date') is-invalid @enderror"
                                       value="{{ old('date', $invoice->date) }}"
                                       required>
                                @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Paket --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">
                                    Paket <span class="text-danger">*</span>
                                </label>
                                <select name="package_id"
                                        class="form-select @error('package_id') is-invalid @enderror"
                                        required>
                                    <option value="">-- Pilih Paket --</option>
                                    @foreach($packages as $pkg)
                                    <option value="{{ $pkg->id }}"
                                        {{ old('package_id', $invoice->package_id) == $pkg->id ? 'selected' : '' }}>
                                        {{ $pkg->title }} — Rp {{ number_format($pkg->price, 0, ',', '.') }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('package_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jumlah Bayar --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">
                                    Jumlah Bayar <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="amount"
                                           class="form-control @error('amount') is-invalid @enderror"
                                           value="{{ old('amount', $invoice->amount) }}"
                                           min="0" step="1000" required>
                                </div>
                                @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('invoice-transaction.show', $invoice->id) }}"
                               class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
