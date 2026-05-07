@extends('panel.layouts.app')
@section('title', Str::title($data['title']))
@section('content')
<div class="container">
	<form action="{{ $data['form']['action'] }}" method="post" enctype="multipart/form-data" class="{{ $data['form']['class'] }} my-3">
		@csrf
		@if ($data['form']['class']=='form-update')
			@method('PATCH')
		@endif
		<div class="card border-0 my-3">
			<div class="card-header p-3">
				<div class="form-group d-flex justify-content-between">
					<button type="button" class="btn-back btn btn-outline-secondary">
						<i class="bx bx-chevron-left"></i>
						<span>{{ Str::title('kembali') }}</span>
					</button>
					<button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-original-title="CTRL + S" data-bs-placement="bottom">
						<i class="bx bx-save"></i>
						<span>{{ Str::title('simpan') }}</span>
					</button>
				</div>
			</div>
			<div class="card-body p-3">
				<div class="row">
					<div class="col-12">
						<div class="form-group mb-3">
							<label for="title" class="form-label mb-1">{{ __('judul') }}</label>
							<input type="text" name="title" id="title" class="form-control form-control-lg counting-input" placeholder="{{ __('isi disini') }}" value="{{ $template->title ?? old('title') }}" maxlength="110">
							<ul class="list-unstyled small">
								<li><span class="counting fw-bold">{{ strlen($template->title ?? null) }}</span>/110</li>
							</ul>
						</div>
					</div>

					{{-- ── Kolom kiri: Preset warna/font + foto pasangan + foto sampul ── --}}
					<div class="col-12 col-lg-8">
						<label class="form-label mb-1">{{ __('preset') }}</label>
						<div class="border rounded">

							{{-- Warna & Font --}}
							<div class="p-3 border-bottom">
								<div class="row g-3">
									<div class="col-6">
										<div class="form-group mb-2">
											<label for="title_color" class="d-block form-label mb-1">Warna judul</label>
											<input class="border-0" type="color" id="title_color" name="title_color" value="{{ $template->preset->design->title->color ?? '#000000' }}" required>
										</div>
										<div class="form-group">
											<label for="content_color" class="d-block form-label mb-1">Warna konten</label>
											<input class="border-0" type="color" id="content_color" name="content_color" value="{{ $template->preset->design->content->color ?? '#333333' }}" required>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group mb-2">
											<label for="button_color" class="d-block form-label mb-1">Warna tombol (teks)</label>
											<input class="border-0" type="color" id="button_color" name="button_color" value="{{ $template->preset->design->button->color ?? '#ffffff' }}" required>
											<label class="d-block form-label mb-1 mt-1">Warna tombol (latar)</label>
											<input class="border-0" type="color" id="button_background" name="button_background" value="{{ $template->preset->design->button->background ?? '#2d7a4f' }}" required>
										</div>
										<div class="form-group">
											<label for="background" class="d-block form-label mb-1">Warna latar</label>
											<input class="border-0" type="color" id="background" name="background" value="{{ $template->preset->design->background ?? '#ffffff' }}" required>
										</div>
									</div>
									<div class="col-12 col-lg-6">
										<div class="form-group mb-2">
											<label for="title_font" class="d-block form-label mb-1">Font judul</label>
											<select class="form-select" id="title_font" name="title_font">
												@foreach ($data['font'] as $item)
												<option value="{{ $item->content }}" style="font-family: '{{ $item->content }}'" @selected(isitsame($item->content, $template->preset->design->title->font ?? ''))>{{ $item->title }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-6">
										<div class="form-group mb-2">
											<label for="content_font" class="d-block form-label mb-1">Font konten</label>
											<select class="form-select" id="content_font" name="content_font">
												@foreach ($data['font'] as $item)
												<option value="{{ $item->content }}" style="font-family: '{{ $item->content }}'" @selected(isitsame($item->content, $template->preset->design->content->font ?? ''))>{{ $item->title }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>

							{{-- Foto Pasangan & Foto Sampul --}}
							<div class="p-3">
								<div class="row g-3">

									{{-- Foto Pria Default --}}
									<div class="col-12 col-lg-6">
										<div class="form-group mb-2">
											<label for="photo_male" class="d-block form-label mb-1">
												<i class="bx bx-male me-1 text-primary"></i>Foto pria (default)
											</label>
											<select class="form-select preview-image-option" id="photo_male" name="photo_male">
												@foreach ($data['avatar-male'] as $item)
												<option value="{{ $item->content }}"
													data-url="{{ url('storage/avatar/'.$item->content) }}"
													@selected(isitsame($item->content, get_preset_value($template->preset, 'profile.photo.male.image', '9d348c30-9331-11ec-b089-ad70ef6b2563.png')))>
													{{ $item->title }}
												</option>
												@endforeach
											</select>
											<img id="preview-photo-male"
												src="{{ url('storage/avatar/'.get_preset_value($template->preset, 'profile.photo.male.image', '9d348c30-9331-11ec-b089-ad70ef6b2563.png')) }}"
												class="img-fluid rounded mt-2 border"
												style="max-height:80px;max-width:80px;object-fit:cover"
												alt="foto pria">
										</div>
									</div>

									{{-- Foto Wanita Default --}}
									<div class="col-12 col-lg-6">
										<div class="form-group mb-2">
											<label for="photo_female" class="d-block form-label mb-1">
												<i class="bx bx-female me-1 text-danger"></i>Foto wanita (default)
											</label>
											<select class="form-select preview-image-option" id="photo_female" name="photo_female">
												@foreach ($data['avatar-female'] as $item)
												<option value="{{ $item->content }}"
													data-url="{{ url('storage/avatar/'.$item->content) }}"
													@selected(isitsame($item->content, get_preset_value($template->preset, 'profile.photo.female.image', '4a1f7960-9331-11ec-8fa8-a3a23f6da840.png')))>
													{{ $item->title }}
												</option>
												@endforeach
											</select>
											<img id="preview-photo-female"
												src="{{ url('storage/avatar/'.get_preset_value($template->preset, 'profile.photo.female.image', '4a1f7960-9331-11ec-8fa8-a3a23f6da840.png')) }}"
												class="img-fluid rounded mt-2 border"
												style="max-height:80px;max-width:80px;object-fit:cover"
												alt="foto wanita">
										</div>
									</div>

									{{-- ══ Foto Sampul Default ══ --}}
									<div class="col-12">
										<hr class="my-2">
										<label class="form-label fw-semibold mb-2">
											<i class="bx bx-image-alt me-1 text-success"></i>Foto Sampul Default
											<small class="text-muted fw-normal ms-1">(gambar cover undangan saat preview)</small>
										</label>

										{{-- Hidden inputs yang dikirim ke controller --}}
										<input type="hidden" name="cover_image_method" id="cover_image_method"
											value="{{ get_preset_value($template->preset ?? null, 'cover.description.image.method', 'none') }}">
										<input type="hidden" name="cover_image_file" id="cover_image_file"
											value="{{ get_preset_value($template->preset ?? null, 'cover.description.image.image', '') }}">

										<div class="row g-2 align-items-start">
											<div class="col-12 col-lg-7">
												{{-- Tombol aksi --}}
												<div class="d-flex gap-2 flex-wrap mb-2">
													{{-- Upload langsung --}}
													<label class="btn btn-sm btn-outline-primary mb-0" style="cursor:pointer">
														<i class="bx bx-upload me-1"></i>Unggah Foto
														<input type="file" id="cover-file-input" accept="image/jpeg,image/png,image/jpg" hidden>
													</label>
													{{-- Hapus --}}
													<button type="button" class="btn btn-sm btn-outline-danger" id="btn-cover-remove">
														<i class="bx bx-trash me-1"></i>Hapus
													</button>
												</div>
												{{-- Upload progress --}}
												<div id="cover-upload-progress" class="d-none mb-2">
													<div class="progress" style="height:6px">
														<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:100%"></div>
													</div>
													<small class="text-muted">Mengunggah...</small>
												</div>
												{{-- Status --}}
												<div id="cover-upload-status" class="d-none"></div>
												<small class="text-muted d-block">
													<i class="bx bx-info-circle me-1"></i>
													Format JPG/PNG, maks 2MB. Foto ini menjadi gambar sampul default saat template dipreview.
												</small>
											</div>
											<div class="col-12 col-lg-5">
												{{-- Preview foto sampul --}}
												<div id="cover-preview-box"
													class="border rounded d-flex align-items-center justify-content-center overflow-hidden"
													style="height:110px;background:#f8f9fa;position:relative">
													@php
														$cvMethod = get_preset_value($template->preset ?? null, 'cover.description.image.method', 'none');
														$cvFile   = get_preset_value($template->preset ?? null, 'cover.description.image.image', '');
														$cvSrc    = null;
														if ($cvFile && $cvMethod !== 'none') {
															if ($cvMethod === 'asset')        $cvSrc = asset($cvFile);
															elseif ($cvMethod === 'storage')  $cvSrc = url('storage/sm/'.$cvFile);
															elseif ($cvMethod === 'avatar')   $cvSrc = url('storage/avatar/'.$cvFile);
															else                              $cvSrc = url('storage/'.$cvFile);
														}
													@endphp
													@if($cvSrc)
													<img id="cover-preview-img" src="{{ $cvSrc }}" alt="cover"
														style="width:100%;height:100%;object-fit:cover">
													@else
													<div id="cover-preview-empty" class="text-center text-muted p-2">
														<i class="bx bx-image" style="font-size:2rem"></i>
														<p class="small mb-0 mt-1">Belum ada foto sampul</p>
													</div>
													@endif
												</div>
											</div>
										</div>
									</div>
									{{-- ══ End Foto Sampul ══ --}}

								</div>
							</div>
						</div>
					</div>

					{{-- ── Kolom kanan: Publish, Preview, Thumbnail kartu, Harga ── --}}
					<div class="col-12 col-lg-4">

						{{-- Publish toggle --}}
						<div class="card border mb-3">
							<div class="card-body">
								@if ($data['form']['class']=='form-update' && $template->url=='no-file')
								<div class="alert alert-danger mb-0" role="alert">
									<i class="bx bx-error"></i>
									<span>Template tidak ditemukan</span>
								</div>
								@else
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="publish" id="publish" value="publish"
										{{ ($data['form']['class']=='form-update' && $template->publish=='publish') ? 'checked' : null }}
										@disabled(($data['form']['class']=='form-update') ? false : true)>
									<label class="form-check-label" for="publish">{{ Str::title('publish') }}</label>
								</div>
								@endif
							</div>
						</div>

						{{-- Link preview --}}
						@if ($data['form']['class']=='form-update' && $template->url!='no-file')
						<div class="mb-3">
							<a href="{{ route('preview-template.index', $template->slug) }}" target="_BLANK" class="btn text-primary w-100 border shadow-sm">
								<i class="bx bx-link-external"></i>
								<span>{{ Str::title('preview') }}</span>
							</a>
						</div>
						@endif

						{{-- ══ Thumbnail Kartu Template ══ --}}
						<div class="card border mb-3">
							<div class="card-body p-3">
								<label class="form-label fw-semibold mb-2">
									<i class="bx bx-image me-1 text-primary"></i>{{ Str::title('thumbnail kartu') }}
									<small class="text-muted fw-normal d-block mt-1">Gambar yang tampil di kartu daftar template</small>
								</label>
								<div class="btn-group d-flex justify-content-between mb-2">
									<label for="upload-file" class="btn btn-outline-primary change-file-type" data-file-type="upload-file" style="cursor:pointer">
										<i class="bx bx-upload" data-bs-toggle="tooltip" data-bs-original-title="Unggah Foto" data-bs-placement="bottom"></i>
										<input type="file" name="upload_file" id="upload-file" class="choose-image" hidden accept="image/png,image/jpeg">
									</label>
									<button type="button" class="btn btn-outline-info border-start-0 change-file-type"
										data-bs-toggle="modal" data-bs-target="#single-storage-modal"
										data-file-type="image">
										<i class="bx bx-image" data-bs-toggle="tooltip" data-bs-original-title="Buka Penyimpanan" data-bs-placement="bottom"></i>
									</button>
								</div>
								<input type="hidden" name="file_type" id="input-file-type" value="{{ $template->file_type ?? old('file_type') }}" readonly>
								<div id="thumbail-preview">
									@if ($data['form']['class']=='form-update' && $template->file)
									<div>
										<div class="item-image">
											@if ($template->file_type=='image')
											{!! image(src:url('storage/'.$template->file), alt:$template->file) !!}
											@endif
											<div class="overlay">
												<button title="button" class="remove unchoose-image">&times;</button>
												<h4>{{ Str::title($template->file_type ?? 'image') }}</h4>
												<input type="hidden" name="file" value="{{ $template->file }}">
											</div>
										</div>
									</div>
									@endif
								</div>
							</div>
						</div>

						{{-- Harga & Grade --}}
						<div class="card border mb-3">
							<div class="card-body">
								<div class="form-group">
									<label for="price" class="form-label mb-1">{{ __('harga') }}</label>
									<div class="input-group mb-3">
										<span class="input-group-text">Rp.</span>
										<input type="number" name="price" id="price" class="form-control" placeholder="{{ __('isi disini') }}" value="{{ $template->price ?? old('price', 0) }}" min="0">
									</div>
									<label for="grade" class="form-label mb-1">{{ __('katalog') }}</label>
									<select name="grade" id="grade" class="form-control select2">
										@forelse (['basic', 'premium', 'exclusive'] as $item)
										<option value="{{ $item }}" {{ ($data['form']['class']=='form-update' && $template->grade==$item) ? 'selected' : null }}>{{ Str::title($item) }}</option>
										@empty
										<option>{{ __('empty') }}</option>
										@endforelse
									</select>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Great+Vibes&family=Kaushan+Script&family=Nova+Cut&family=Raleway&family=Righteous&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('modules/datatable/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('modules/select2/dist/css/select2.min.css') }}">
<style>
/* Preview foto pasangan */
#preview-photo-male, #preview-photo-female {
    transition: opacity .2s;
}
/* Cover preview box */
#cover-preview-box img {
    transition: opacity .3s;
}
</style>
@endpush

@push('script')
@include('panel.layouts.storage-modal', ['mode'=>'single'])
<script src="{{ asset('modules/datatable/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('modules/select2/dist/js/select2.min.js') }}" type="text/javascript"></script>
<script>
$(function() {

    // ══════════════════════════════════════════════
    // 1. Preview foto pasangan saat dropdown berubah
    // ══════════════════════════════════════════════
    $(".preview-image-option").on('change', function() {
        var url = $(this).find(':selected').data('url');
        var target = (this.id === 'photo_male') ? '#preview-photo-male' : '#preview-photo-female';
        $(target).attr('src', url);
    });

    // ══════════════════════════════════════════════
    // 2. Upload foto sampul via AJAX (tanpa submit form utama)
    // ══════════════════════════════════════════════
    $('#cover-file-input').on('change', function() {
        var file = this.files[0];
        if (!file) return;

        // Validasi sisi klien
        var allowed = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowed.includes(file.type)) {
            showCoverStatus('danger', '<i class="bx bx-error me-1"></i>Hanya file JPG atau PNG yang diizinkan.');
            this.value = '';
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            showCoverStatus('danger', '<i class="bx bx-error me-1"></i>Ukuran file maksimal 2MB.');
            this.value = '';
            return;
        }

        // Tampilkan preview lokal dulu (langsung)
        var reader = new FileReader();
        reader.onload = function(e) {
            setCoverPreview(e.target.result);
        };
        reader.readAsDataURL(file);

        // Upload via AJAX ke endpoint khusus
        var formData = new FormData();
        formData.append('_token', $('meta[name=csrf-token]').attr('content'));
        formData.append('cover_file', file);

        $('#cover-upload-progress').removeClass('d-none');
        $('#cover-upload-status').addClass('d-none');

        $.ajax({
            url: '{{ route("template.cover.upload") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                $('#cover-upload-progress').addClass('d-none');
                if (res.success) {
                    // Simpan ke hidden input
                    $('#cover_image_method').val('storage');
                    $('#cover_image_file').val(res.file);
                    // Update preview dengan URL dari server
                    setCoverPreview(res.url);
                    showCoverStatus('success', '<i class="bx bx-check-circle me-1"></i>Foto sampul berhasil diunggah.');
                } else {
                    showCoverStatus('danger', '<i class="bx bx-error me-1"></i>' + (res.message || 'Gagal mengunggah.'));
                    resetCoverPreview();
                }
            },
            error: function(xhr) {
                $('#cover-upload-progress').addClass('d-none');
                var msg = 'Gagal mengunggah foto sampul.';
                try {
                    var err = JSON.parse(xhr.responseText);
                    if (err.errors && err.errors.cover_file) msg = err.errors.cover_file[0];
                    else if (err.message) msg = err.message;
                } catch(e) {}
                showCoverStatus('danger', '<i class="bx bx-error me-1"></i>' + msg);
                resetCoverPreview();
            }
        });

        // Reset input file agar bisa upload ulang file yang sama
        this.value = '';
    });

    // ══════════════════════════════════════════════
    // 3. Hapus foto sampul
    // ══════════════════════════════════════════════
    $('#btn-cover-remove').on('click', function() {
        $('#cover_image_method').val('none');
        $('#cover_image_file').val('');
        resetCoverPreview();
        showCoverStatus('secondary', '<i class="bx bx-info-circle me-1"></i>Foto sampul dihapus. Simpan untuk menyimpan perubahan.');
    });

    // ══════════════════════════════════════════════
    // Helper functions
    // ══════════════════════════════════════════════
    function setCoverPreview(src) {
        $('#cover-preview-box').html(
            '<img id="cover-preview-img" src="' + src + '" alt="cover" style="width:100%;height:100%;object-fit:cover">'
        );
    }

    function resetCoverPreview() {
        $('#cover-preview-box').html(
            '<div id="cover-preview-empty" class="text-center text-muted p-2">' +
            '<i class="bx bx-image" style="font-size:2rem"></i>' +
            '<p class="small mb-0 mt-1">Belum ada foto sampul</p>' +
            '</div>'
        );
    }

    function showCoverStatus(type, html) {
        $('#cover-upload-status')
            .removeClass('d-none alert-success alert-danger alert-secondary alert-warning')
            .addClass('alert alert-' + type + ' py-1 px-2 small')
            .html(html);
    }

});
</script>
@endpush
