@extends('member.layouts.app')
@section('title', Str::title($menu['title']))
@section('content')
<section class="position-relative py-3">
    @include('member.layouts.component', ['content'=>'breadcrumb', 'menu'=>$menu])

    <div class="row g-3">

        {{-- ── PUBLISH STATUS CARD ── --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <h5 class="mb-1 fw-semibold">
                                <i class="bx bx-globe me-1 text-primary"></i>
                                Status Undangan
                            </h5>
                            @if($data->publish === 'publish')
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success px-3 py-2 fs-6">
                                    <i class="bx bx-check-circle me-1"></i> Dipublikasikan
                                </span>
                                <small class="text-muted">Undangan dapat diakses oleh tamu melalui link.</small>
                            </div>
                            @else
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-secondary px-3 py-2 fs-6">
                                    <i class="bx bx-hide me-1"></i> Draft / Belum Publish
                                </span>
                                <small class="text-muted">Undangan hanya bisa dilihat melalui link preview.</small>
                            </div>
                            @endif
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            @if($data->publish === 'publish')
                            <button type="button" class="btn btn-outline-secondary btn-sm btn-toggle-publish"
                                    data-action="draft">
                                <i class="bx bx-hide me-1"></i> Sembunyikan
                            </button>
                            @else
                            <button type="button" class="btn btn-success btn-sm btn-toggle-publish"
                                    data-action="publish">
                                <i class="bx bx-globe me-1"></i> Publish Sekarang
                            </button>
                            @endif
                            @if($data->link)
                            <a href="{{ $data->link }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="bx bx-link-external me-1"></i> Buka Undangan
                            </a>
                            @endif
                        </div>
                    </div>

                    {{-- Link undangan --}}
                    @if($data->link)
                    <div class="mt-3 pt-3 border-top">
                        <label class="form-label small fw-semibold mb-1">Link Undangan</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm border-end-0"
                                   id="invitationLink" value="{{ $data->link }}" readonly>
                            <span class="input-group-text bg-white border-start-0 copy-text"
                                  data-text="{{ $data->link }}" style="cursor:pointer" title="Salin link">
                                <i class="bx bx-copy"></i>
                                <span style="display:none">Disalin</span>
                            </span>
                        </div>
                        <div class="mt-2 d-flex gap-2 flex-wrap">
                            <a href="https://wa.me/?text={{ urlencode('Anda diundang ke pernikahan kami 💍 Buka undangan di: '.$data->link) }}"
                               target="_blank" class="btn btn-sm btn-success">
                                <i class="bx bxl-whatsapp me-1"></i> Bagikan via WhatsApp
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ── E-INVITATION IMAGE ── --}}
        <div class="col-lg-7">
            <div class="bg-white shadow rounded p-3 mb-3">
                <h5 class="mb-2"><i class="bx bx-image me-1"></i> Foto Undangan Digital</h5>
                <p class="text-muted small mb-3">Foto ini digunakan sebagai thumbnail undangan saat dibagikan.</p>
                <div class="image-selector">
                    <div>
                        @if(Auth::user()->inv->file)
                        <img src="{{ url('storage/'.Auth::user()->inv->file) }}" class="set_invitation_image" alt="e-invitation">
                        @else
                        <img src="" class="set_invitation_image" alt="" style="display:none">
                        @endif
                    </div>
                    <div>
                        <div class="border-bottom py-2">
                            <label class="form-label small">Ganti Foto</label>
                            <button type="button" class="btn btn-creasik-primary btn-sm mb-1 change-data"
                                    data-image="for-invitation" data-bs-toggle="modal" data-bs-target="#storage">
                                <i class="bx bx-images me-1"></i> Penyimpanan
                            </button>
                        </div>
                        <div class="py-2">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-image"
                                    data-target="invitation_image">
                                <i class="bx bx-trash me-1"></i> Hilangkan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-6">
                    <button type="button" class="btn btn-primary w-100 figure-catcher"
                            data-url="{{ route('menu.einvitation-edit') }}">
                        <i class="bx bx-analyse me-1"></i> Generate Foto
                    </button>
                </div>
                <div class="col-6">
                    @if(Auth::user()->inv->file)
                    <a href="{{ url('storage/'.Auth::user()->inv->file) }}"
                       download="WeddingOf{{ ucwords(clean_str(implode('-', json_decode(Auth::user()->inv->title, true)))) }}.jpeg"
                       class="btn btn-outline-secondary w-100">
                        <i class="bx bx-download me-1"></i> Unduh
                    </a>
                    @else
                    <button class="btn btn-outline-secondary w-100" disabled>
                        <i class="bx bx-download me-1"></i> Unduh
                    </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- ── PREVIEW ── --}}
        <div class="col-lg-5">
            <div class="meta-image bg-white shadow mb-2">
                <figure class="figure-image theme">
                    @if(Auth::user()->inv->file)
                    <img src="{{ url('storage/'.Auth::user()->inv->file) }}" class="set_invitation_image" alt="">
                    @else
                    <img src="" class="set_invitation_image" alt="">
                    @endif
                    <div class="name">
                        <h1>{{ implode(' & ', json_decode(Auth::user()->inv->title, true) ?? ['-', '-']) }}</h1>
                        <span>{{ $data->date ? date('d . m . Y', strtotime($data->date)) : '-' }}</span>
                    </div>
                </figure>
                <div class="form-check form-switch d-flex flex-row-reverse justify-content-between p-2">
                    <input class="form-check-input change-style" type="checkbox" name="e-invitation_text" id="e-invitation_text">
                    <label class="form-check-label small" for="e-invitation_text">Sembunyikan teks</label>
                </div>
                <div class="form-check form-switch d-flex flex-row-reverse justify-content-between p-2">
                    <input class="form-check-input change-style" type="checkbox" name="e-invitation_color" id="e-invitation_color" @checked(true)>
                    <label class="form-check-label small" for="e-invitation_color">Warna teks sesuai tema</label>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('modules/datatable/datatables.min.css') }}">
<style>
    .meta-image > figure .name > h1 {
        font-family: {{ $data->preset->title->font ?? 'Arial' }};
    }
    .meta-image > figure .name > span {
        font-family: {{ $data->preset->content->font ?? 'Arial' }};
    }
    .meta-image > figure.theme .name > h1 {
        color: {{ $data->preset->title->color ?? '#000' }};
    }
    .meta-image > figure.theme .name > span {
        color: {{ $data->preset->content->color ?? '#333' }};
    }
</style>
@endpush

@push('script')
@include('member.layouts.component', ['content'=>'modal-storage', 'mode'=>'single'])
<script src="{{ asset('modules/datatable/datatables.min.js') }}"></script>
<script>
$(function() {
    // Toggle publish/draft
    $('.btn-toggle-publish').on('click', function() {
        var btn    = $(this);
        var action = btn.data('action');
        var label  = action === 'publish' ? 'publish' : 'sembunyikan';

        if (!confirm('Yakin ingin ' + label + ' undangan ini?')) return;

        btn.prop('disabled', true).html('<i class="bx bx-loader bx-spin me-1"></i> Memproses...');

        $.ajax({
            type: 'POST',
            url:  '{{ route("menu.einvitation-publish") }}',
            data: {
                _token: $('meta[name=csrf-token]').attr('content'),
                action: action
            },
            success: function(res) {
                // Reload halaman agar status terupdate
                if (typeof Swal !== 'undefined') {
                    Swal.mixin({
                        toast: true, position: 'top-end',
                        showConfirmButton: false, timer: 2500
                    }).fire({ icon: 'success', title: res.toast.title, text: res.toast.text });
                }
                setTimeout(function() { location.reload(); }, 1200);
            },
            error: function() {
                btn.prop('disabled', false).html(action === 'publish'
                    ? '<i class="bx bx-globe me-1"></i> Publish Sekarang'
                    : '<i class="bx bx-hide me-1"></i> Sembunyikan');
                alert('Gagal mengubah status. Coba lagi.');
            }
        });
    });

    // Ganti gambar dari storage
    $(".change-data").on('click', function() {
        $(".use-image").attr('data-image', $(this).data('image'));
    });

    // Toggle preview style
    $(".change-style").on('change', function() {
        if (this.name === 'e-invitation_color') {
            $(".meta-image").children('figure').toggleClass('theme');
        } else if (this.name === 'e-invitation_text') {
            $(".meta-image").children('figure').children('.name').toggleClass('d-none');
        }
    });

    // Hapus gambar
    $(".remove-image").on('click', function() {
        if ($(this).data('target') === 'invitation_image') {
            $(".set_invitation_image").attr('src', '').hide();
        }
        $(this).prop('disabled', true);
    });

    // Pilih dari storage
    $(".use-image").on('click', function() {
        $("input[name='storage_file[]']").each(function() {
            if ($(this).prop('checked')) {
                var source = $(this).val();
                var url    = $(this).siblings().children('img').attr('src');
                if ($('.use-image').data('image') === 'for-invitation') {
                    $(".set_invitation_image").attr('src', '{{ url("storage/") }}/' + source).show();
                    $('.remove-image').prop('disabled', false);
                }
            }
        });
        $("#storage").modal('hide');
    });
});
</script>
@endpush
