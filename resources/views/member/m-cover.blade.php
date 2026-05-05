@extends('member.layouts.app')
@section('title', Str::title($menu['title']))
@php
    // Pastikan semua key preset cover ada dengan nilai default
    $preset = $data->preset;
    $imgMethod = $preset->description->image->method ?? 'none';
    $imgFile   = $preset->description->image->image  ?? '';
@endphp
@section('content')
<section class="position-relative py-3">
    @include('member.layouts.component', ['content'=>'breadcrumb', 'menu'=>$menu])
    <form action="{{ route('save.setting', 'cover') }}" class="save-menu" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="bg-white shadow-sm rounded p-3">
                    <h4>Nama pasangan</h4>
                    <div class="select-tab">
                        <div>
                            <label for="cover_name_female" class="form-label">
                                <var dir="cover_name_female">Nama wanita</var>
                            </label>
                        </div>
                        <div>
                            <input type="text" name="cover_name_female" id="cover_name_female" class="form-control"
                                   value="{{ $preset->name->female ?? '' }}" placeholder="Nama wanita">
                        </div>
                    </div>
                    <div class="select-tab border-bottom">
                        <div>
                            <label for="cover_name_male" class="form-label">
                                <var dir="cover_name_male">Nama pria</var>
                            </label>
                        </div>
                        <div>
                            <input type="text" name="cover_name_male" id="cover_name_male" class="form-control"
                                   value="{{ $preset->name->male ?? '' }}" placeholder="Nama pria">
                        </div>
                    </div>
                    <div class="select-tab border-bottom mb-2">
                        <div>
                            <label for="cover_name_size" class="form-label">
                                <var dir="cover_name_size">Ukuran teks:</var>
                                <b class="set_cover_name_size">{{ $preset->name->size ?? 48 }}</b>
                            </label>
                        </div>
                        <div>
                            <input type="range" name="cover_name_size" id="cover_name_size"
                                   class="form-range change-style"
                                   value="{{ $preset->name->size ?? 48 }}" min="12" max="82" step="2">
                        </div>
                    </div>
                    <div class="select-tab border-bottom mb-2">
                        <div>
                            <label class="form-label">
                                <var dir="cover_name_style">Style</var>
                            </label>
                        </div>
                        <div class="flex-column align-items-start">
                            @foreach ($data->style as $key => $item)
                            <span class="form-check">
                                <input type="radio" name="cover_name_style" id="style{{ $key }}"
                                       class="form-check-input" value="{{ $key }}"
                                       @checked(($preset->name->style ?? 'default') === $key)>
                                <label for="style{{ $key }}" class="form-check-label me-2">{{ $item }}</label>
                            </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="cover_content" class="form-label">
                            <var dir="cover_content">Teks sampul</var>
                        </label>
                        <textarea name="cover_content" id="cover_content" class="form-control"
                                  placeholder="Teks sampul">{{ $preset->content ?? '' }}</textarea>
                    </div>
                    <div class="select-tab border-bottom">
                        <div>
                            <label for="cover_button" class="form-label">
                                <var dir="cover_button">Tombol buka</var>
                            </label>
                        </div>
                        <div>
                            <input type="text" name="cover_button" id="cover_button" class="form-control"
                                   value="{{ $preset->button ?? 'Buka Undangan' }}" placeholder="Tombol buka">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-white shadow-sm rounded p-3 mb-3">
                    <h4>Deskripsi</h4>
                    <div class="border-bottom mb-2">
                        <label for="cover_description_top" class="form-label">
                            <var dir="cover_description_top">Teks bagian atas</var>
                        </label>
                        <textarea name="cover_description_top" id="cover_description_top" class="form-control"
                                  placeholder="Teks bagian atas">{{ $preset->description->top ?? '' }}</textarea>
                    </div>
                    <div class="border-bottom mb-2">
                        <label for="cover_description_bottom" class="form-label">
                            <var dir="cover_description_bottom">Teks bagian bawah</var>
                        </label>
                        <textarea name="cover_description_bottom" id="cover_description_bottom" class="form-control"
                                  placeholder="Teks bagian bawah">{{ $preset->description->bottom ?? '' }}</textarea>
                    </div>
                </div>
                <div class="bg-white shadow-sm rounded p-3">
                    <h4>
                        <var dir="cover_description_image">Foto Sampul</var>
                    </h4>
                    <div class="image-selector">
                        <div>
                            @if($imgMethod === 'storage' && $imgFile)
                            <img src="{{ url('storage/sm/'.$imgFile) }}" class="set_cover_description_image" alt="foto sampul">
                            @elseif($imgMethod === 'avatar' && $imgFile)
                            <img src="{{ url('storage/avatar/'.$imgFile) }}" class="set_cover_description_image" alt="foto sampul">
                            @else
                            <img src="" class="set_cover_description_image" alt="" style="display:none">
                            @endif
                        </div>
                        <div>
                            <div class="border-bottom py-2">
                                <input type="file" name="cover_description_image" id="cover_description_image"
                                       class="change-img" accept=".jpg,.png,.jpeg">
                                <input type="hidden" name="cover_description_image__filename"
                                       value="{{ $imgFile }}" readonly>
                                <input type="hidden" name="cover_description_image__method"
                                       value="{{ $imgMethod }}" readonly>
                                <label class="form-label">
                                    <var dir="cover_description_image__method">Ganti</var>
                                </label>
                                <label for="cover_description_image" class="btn btn-creasik-primary d-inline-block mb-1">
                                    <i class="bx bx-upload"></i>
                                    <span>Unggah</span>
                                </label>
                                <button type="button" class="btn btn-creasik-primary mb-1"
                                        data-bs-toggle="modal" data-bs-target="#avatar-none">
                                    <i class="bx bx-user-circle"></i>
                                    <span>Avatar</span>
                                </button>
                                <button type="button" class="btn btn-creasik-primary mb-1 change-data"
                                        data-image="for-cover" data-bs-toggle="modal" data-bs-target="#storage">
                                    <i class="bx bx-images"></i>
                                    <span>Penyimpanan</span>
                                </button>
                            </div>
                            <div class="py-2">
                                <button type="button" class="btn btn-outline-danger remove-image"
                                        data-target="cover_description_image"
                                        @disabled(!$imgFile)>
                                    <i class="bx bx-trash"></i>
                                    <span>Hilangkan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="save-button">
            <button type="submit">
                <i class="bx bx-save"></i>
                <span>simpan</span>
            </button>
        </div>
    </form>
</section>
@endsection

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('modules/datatable/datatables.min.css') }}">
@endpush

@push('script')
@include('member.layouts.component', ['content'=>'modal-avatar', 'gender'=>'none'])
@include('member.layouts.component', ['content'=>'modal-storage', 'mode'=>'single'])
<script src="{{ asset('modules/datatable/datatables.min.js') }}"></script>
<script>
$(function() {
    // Pilih avatar
    $(".change-asset").on('change', function(e) {
        if (e.target.name === 'cover_avatar_none') {
            const avatar = $(this).siblings('img').attr('src');
            const source = $(this).val();
            $(".set_cover_description_image").attr('src', avatar).show();
            $("input[name=cover_description_image__filename]").val(source);
            $("input[name=cover_description_image__method]").val('avatar');
            $(".remove-image[data-target=cover_description_image]").prop('disabled', false);
        }
    });

    // Pilih dari penyimpanan
    $(".change-data").on('click', function() {
        $(".use-image").attr('data-image', $(this).data('image'));
    });

    $(".use-image").on('click', function() {
        const target = $(this).data('image');
        $("input[name='storage_file[]']").each(function() {
            if ($(this).prop('checked')) {
                const source = $(this).val();
                const imgUrl = $(this).siblings().children('img').attr('src');
                if (target === 'for-cover') {
                    $(".set_cover_description_image").attr('src', imgUrl).show();
                    $("input[name=cover_description_image__filename]").val(source);
                    $("input[name=cover_description_image__method]").val('storage');
                    $(".remove-image[data-target=cover_description_image]").prop('disabled', false);
                }
            }
        });
        $("#storage").modal('hide');
    });

    // Upload langsung
    $(".change-img").on('change', function(e) {
        if (e.target.name === 'cover_description_image') {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = r => $(".set_cover_description_image").attr('src', r.target.result).show();
                reader.readAsDataURL(file);
                $("input[name=cover_description_image__method]").val('upload');
                $(".remove-image[data-target=cover_description_image]").prop('disabled', false);
            }
        }
    });

    // Slider ukuran teks
    $(".change-style").on('change', function(e) {
        if (e.target.name === 'cover_name_size') {
            $(".set_cover_name_size").text(e.target.value);
        }
    });

    // Hapus foto
    $(".remove-image").on('click', function(e) {
        e.preventDefault();
        if ($(this).data('target') === 'cover_description_image') {
            $(".set_cover_description_image").attr('src', '').hide();
            $("input[name=cover_description_image]").val('');
            $("input[name=cover_description_image__filename]").val('');
            $("input[name=cover_description_image__method]").val('none');
            $("input[name=cover_avatar_none]").prop('checked', false);
            $(this).prop('disabled', true);
        }
    });

    // ── AJAX submit — cegah form submit normal, tampilkan toast seperti menu lain ──
    $("form.save-menu").off('submit').on('submit', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var $form  = $(this),
            action = $form.attr('action'),
            $btn   = $form.find('button[type=submit]'),
            csrf   = $('meta[name=csrf-token]').attr('content');

        // Loading state
        $btn.prop('disabled', true);
        $btn.find('i').removeClass('bx-save').addClass('bx-loader bx-spin');
        $btn.find('span').text('Menyimpan...');
        $('sup[role=alert]').remove();

        $.ajax({
            type:        'POST',
            url:         action,
            data:        new FormData(this),
            contentType: false,
            processData: false,
            cache:       false,
            headers:     { 'X-CSRF-TOKEN': csrf },
            success: function(res) {
                $btn.prop('disabled', false);
                $btn.find('i').removeClass('bx-loader bx-spin').addClass('bx-check');
                $btn.find('span').text('Tersimpan!');
                setTimeout(function() {
                    $btn.find('i').removeClass('bx-check').addClass('bx-save');
                    $btn.find('span').text('simpan');
                }, 2500);
                // Tampilkan toast sukses
                if (typeof Swal !== 'undefined') {
                    Swal.mixin({
                        toast: true, position: 'top-end',
                        showConfirmButton: false, timer: 3500, timerProgressBar: true
                    }).fire({
                        icon:  (res.toast && res.toast.icon)  ? res.toast.icon  : 'success',
                        title: (res.toast && res.toast.title) ? res.toast.title : 'Disimpan!',
                        text:  (res.toast && res.toast.text)  ? res.toast.text  : 'Sampul undangan berhasil disimpan.'
                    });
                }
            },
            error: function(xhr) {
                $btn.prop('disabled', false);
                $btn.find('i').removeClass('bx-loader bx-spin').addClass('bx-save');
                $btn.find('span').text('simpan');
                $('sup[role=alert]').remove();
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(field, msg) {
                        $('var[dir=' + field + ']').after(
                            '<sup role="alert" style="color:red;margin-left:4px" title="' + (Array.isArray(msg) ? msg[0] : msg) + '">!</sup>'
                        );
                    });
                }
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon: 'warning', title: 'Periksa kembali', text: 'Lengkapi semua field yang diperlukan.', confirmButtonColor: '#2d7a4f' });
                }
            }
        });
    });
});
</script>
@endpush