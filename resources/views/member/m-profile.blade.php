@extends('member.layouts.app')
@section('title', Str::title($menu['title']))
@php
	$display = [
		'parent_show__check' => ($data->preset->parent->show===true) ? false : true,
		'parent_show__input' => ($data->preset->parent->show===true) ? 'display:block' : 'display:none',
		'instagram_show__check' => ($data->preset->instagram->show===true) ? false : true,
		'instagram_show__input' => ($data->preset->instagram->show===true) ? 'display:block' : 'display:none',
	];
@endphp 
@section('content')
<section class="position-relative py-3">
	@include('member.layouts.component', ['content'=>'breadcrumb', 'menu'=>$menu])
	<form action="{{ route('save.setting', 'profile') }}" class="save-menu" method="post" enctype="multipart/form-data">
		@csrf
		@method('put')
		<div class="row g-3">
			<div class="col-12">
				<div class="bg-white shadow rounded p-3">
					<div class="form-check form-switch d-flex flex-row-reverse justify-content-between ps-0 py-1">
						<input class="form-check-input change-style" type="checkbox" name="profile_parent_show" id="profile_parent_show" @checked($display['parent_show__check'])>
						<label class="form-check-label" for="profile_parent_show">Sembunyikan <b>nama orang tua</b></label>
					</div>
					<div class="form-check form-switch d-flex flex-row-reverse justify-content-between ps-0 py-1">
						<input class="form-check-input change-style" type="checkbox" name="profile_instagram_show" id="profile_instagram_show" @checked($display['instagram_show__check'])>
						<label class="form-check-label" for="profile_instagram_show">Sembunyikan <b>instagram</b></label>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="bg-white shadow rounded p-3 mb-2">
					<h4>Profil mempelai pria</h4>
					<div class="mb-2">
						<div>
							<label for="profile_name_male" class="form-label">
								<var dir="profile_name_male">Nama pria</var>
							</label>
							<input type="text" name="profile_name_male" id="profile_name_male" class="form-control" value="{{ $data->preset->name->male }}" placeholder="Nama pria">
						</div>
					</div>
					<div class="mb-2 set_profile_instagram_show" @style($display['instagram_show__input'])>
						<div>
							<label for="profile_instagram_male" class="form-label">
								<var dir="profile_instagram_male">Akun instagram</var>
							</label>
							<div class="input-group">
								<span class="input-group-text bg-white"><i class="bx bx-at"></i></span>
								<input type="text" name="profile_instagram_male" id="profile_instagram_male" class="form-control border-start-0" value="{{ $data->preset->instagram->male }}" placeholder="Akun instagram">
							</div>
						</div>
					</div>
					<div class="mb-2 set_profile_parent_show" @style($display['parent_show__input'])>
						<div class="border rounded">
							<label for="parent" class="fw-bold pt-2 ps-2">Nama orang tua</label>
							<div class="select-tab border-bottom">
								<div class="ps-2">
									<label for="profile_parent_male_father" class="form-label">
										<var dir="profile_parent_male_father">Nama ayah</var>
									</label>
								</div>
								<div class="pe-2">
									<input type="text" name="profile_parent_male_father" id="profile_parent_male_father" class="form-control" value="{{ $data->preset->parent->male->father }}" placeholder="Nama ayah mempelai">
								</div>
							</div>
							<div class="select-tab border-bottom">
								<div class="ps-2">
									<label for="profile_parent_male_mother" class="form-label">
										<var dir="profile_parent_male_mother">Nama ibu</var>
									</label>
								</div>
								<div class="pe-2">
									<input type="text" name="profile_parent_male_mother" id="profile_parent_male_mother" class="form-control" value="{{ $data->preset->parent->male->mother }}" placeholder="Nama ibu mempelai">
								</div>
							</div>
							<div class="select-tab">
								<div class="ps-2">
									<label for="profile_parent_male_childhood" class="form-label">
										<var dir="profile_parent_male_childhood">Anak ke</var>
									</label>
								</div>
								<div class="pe-2">
									<input type="number" name="profile_parent_male_childhood" id="profile_parent_male_childhood" class="form-control" min="1" value="{{ $data->preset->parent->male->childhood }}" placeholder="Anak ke">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="bg-white shadow rounded p-3 mb-3">
					<h4>
						<var dir="profile_photo_male">Foto pria</var>
					</h4>
					<div class="image-selector">
						<div>
							@if ($data->preset->photo->male->method=='storage')
							<img src="{{ url('storage/sm/'.$data->preset->photo->male->image) }}" class="set_profile_photo_male" alt="">
							@elseif ($data->preset->photo->male->method=='avatar')
							<img src="{{ url('storage/avatar/'.$data->preset->photo->male->image) }}" class="set_profile_photo_male" alt="">
							@endif
						</div>
						<div>
							<div class="border-bottom py-2">
								<input type="file" name="profile_photo_male" id="profile_photo_male" class="change-img" accept=".jpg,.png,.jpeg">
								<input type="hidden" name="profile_photo_male__filename" value="{{ $data->preset->photo->male->image }}" readonly>
								<input type="hidden" name="profile_photo_male__method" value="{{ $data->preset->photo->male->method }}" readonly>
								<label class="form-label">
									<var dir="profile_photo_male__method">Ganti</var>
								</label>
								<label for="profile_photo_male" class="btn btn-creasik-primary d-inline-block mb-1">
									<i class="bx bx-upload"></i>
									<span>Unggah</span>
								</label>
								<button type="button" class="btn btn-creasik-primary mb-1" data-bs-toggle="modal" data-bs-target="#avatar-male">
									<i class="bx bx-user-circle"></i>
									<span>Avatar</span>
								</button>
								<button type="button" class="btn btn-creasik-primary mb-1 change-data" data-image="for-male" data-bs-toggle="modal" data-bs-target="#storage">
									<i class="bx bx-images"></i>
									<span>Penyimpanan</span>
								</button>
							</div>
							<div class="py-2">
								{{-- <button type="button" class="btn btn-light mb-1" @disabled(true)>
									<i class="bx bx-crop"></i>
									<span>Potong</span>
								</button> --}}
								<button type="button" class="btn btn-outline-danger remove-image" data-target="profile_photo_male">
									<i class="bx bx-trash"></i>
									<span>Hilangkan</span>
								</button>
							</div>
						</div>
					</div>
					<div class="py-2">
						<h6 class="m-1">Gunakan bingkai</h6>
						<figure class="assets-figure border p-2 mb-0 mx-1">
							{{-- Opsi tanpa bingkai --}}
							<label for="male_frame_none" class="item">
								<input type="radio" name="profile_photo_male_frame" id="male_frame_none" value=""
									@checked(empty($data->preset->photo->male->frame))>
								<span class="d-flex align-items-center justify-content-center border rounded"
									style="width:60px;height:60px;font-size:0.65rem;color:#aaa;background:#f8f9fa">
									Tanpa<br>Bingkai
								</span>
							</label>
							@foreach ($data->frame as $key => $item)
							<label for="male_frame_{{ $key }}" class="item">
								<input type="radio" name="profile_photo_male_frame" id="male_frame_{{ $key }}" value="{{ $item->content }}" @checked(!empty($data->preset->photo->male->frame) && $data->preset->photo->male->frame==$item->content)>
								{!! image(src:url('storage/frame/'.$item->content), alt:$item->title) !!}
							</label>
							@endforeach
						</figure>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="bg-white shadow rounded p-3 mb-2">
					<h4>Profil mempelai wanita</h4>
					<div class="mb-2">
						<div>
							<label for="profile_name_female" class="form-label">
								<var dir="profile_name_female">Nama wanita</var>
							</label>
							<input type="text" name="profile_name_female" id="profile_name_female" class="form-control" value="{{ $data->preset->name->female }}" placeholder="Nama wanita">
						</div>
					</div>
					<div class="mb-2 set_profile_instagram_show" @style($display['instagram_show__input'])>
						<div>
							<label for="profile_instagram_female" class="form-label">
								<var dir="profile_instagram_female">Akun instagram</var>
							</label>
							<div class="input-group">
								<span class="input-group-text bg-white"><i class="bx bx-at"></i></span>
								<input type="text" name="profile_instagram_female" id="profile_instagram_female" class="form-control border-start-0" value="{{ $data->preset->instagram->female }}" placeholder="Akun instagram">
							</div>
						</div>
					</div>
					<div class="mb-2 set_profile_parent_show" @style($display['parent_show__input'])>
						<div class="border rounded">
							<label for="parent" class="fw-bold pt-2 ps-2">Nama orang tua</label>
							<div class="select-tab border-bottom">
								<div class="ps-2">
									<label for="profile_parent_female_father" class="form-label">
										<var dir="profile_parent_female_father">Nama ayah</var>
									</label>
								</div>
								<div class="pe-2">
									<input type="text" name="profile_parent_female_father" id="profile_parent_female_father" class="form-control" value="{{ $data->preset->parent->female->father }}" placeholder="Nama ayah mempelai">
								</div>
							</div>
							<div class="select-tab border-bottom">
								<div class="ps-2">
									<label for="profile_parent_female_mother" class="form-label">
										<var dir="profile_parent_female_mother">Nama ibu</var>
									</label>
								</div>
								<div class="pe-2">
									<input type="text" name="profile_parent_female_mother" id="profile_parent_female_mother" class="form-control" value="{{ $data->preset->parent->female->mother }}" placeholder="Nama ibu mempelai">
								</div>
							</div>
							<div class="select-tab">
								<div class="ps-2">
									<label for="profile_parent_female_childhood" class="form-label">
										<var dir="profile_parent_female_childhood">Anak ke</var>
									</label>
								</div>
								<div class="pe-2">
									<input type="number" name="profile_parent_female_childhood" id="profile_parent_female_childhood" class="form-control" min="1" value="{{ $data->preset->parent->female->childhood }}" placeholder="Anak ke">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="bg-white shadow rounded p-3 mb-3">
					<h4>
						<var dir="profile_photo_female">Foto wanita</var>
					</h4>
					<div class="image-selector">
						<div>
							@if ($data->preset->photo->female->method=='storage')
							<img src="{{ url('storage/sm/'.$data->preset->photo->female->image) }}" class="set_profile_photo_female" alt="">
							@elseif ($data->preset->photo->female->method=='avatar')
							<img src="{{ url('storage/avatar/'.$data->preset->photo->female->image) }}" class="set_profile_photo_female" alt="">
							@endif
						</div>
						<div>
							<div class="border-bottom py-2">
								<input type="file" name="profile_photo_female" id="profile_photo_female" class="change-img" accept=".jpg,.png,.jpeg">
								<input type="hidden" name="profile_photo_female__filename" value="{{ $data->preset->photo->female->image }}" readonly>
								<input type="hidden" name="profile_photo_female__method" value="{{ $data->preset->photo->female->method }}" readonly>
								<label class="form-label">
									<var dir="profile_photo_female__method">Ganti</var>
								</label>
								<label for="profile_photo_female" class="btn btn-creasik-primary d-inline-block mb-1">
									<i class="bx bx-upload"></i>
									<span>Unggah</span>
								</label>
								<button type="button" class="btn btn-creasik-primary mb-1" data-bs-toggle="modal" data-bs-target="#avatar-female">
									<i class="bx bx-user-circle"></i>
									<span>Avatar</span>
								</button>
								<button type="button" class="btn btn-creasik-primary mb-1 change-data" data-image="for-female" data-bs-toggle="modal" data-bs-target="#storage">
									<i class="bx bx-images"></i>
									<span>Penyimpanan</span>
								</button>
							</div>
							<div class="py-2">
								{{-- <button type="button" class="btn btn-light mb-1" @disabled(true)>
									<i class="bx bx-crop"></i>
									<span>Potong</span>
								</button> --}}
								<button type="button" class="btn btn-outline-danger remove-image" data-target="profile_photo_female">
									<i class="bx bx-trash"></i>
									<span>Hilangkan</span>
								</button>
							</div>
						</div>
					</div>
					<div class="py-2">
						<h6 class="m-1">Gunakan bingkai</h6>
						<figure class="assets-figure border p-2 mb-0 mx-1">
							{{-- Opsi tanpa bingkai --}}
							<label for="female_frame_none" class="item">
								<input type="radio" name="profile_photo_female_frame" id="female_frame_none" value=""
									@checked(empty($data->preset->photo->female->frame))>
								<span class="d-flex align-items-center justify-content-center border rounded"
									style="width:60px;height:60px;font-size:0.65rem;color:#aaa;background:#f8f9fa">
									Tanpa<br>Bingkai
								</span>
							</label>
							@foreach ($data->frame as $key => $item)
							<label for="female_frame_{{ $key }}" class="item">
								<input type="radio" name="profile_photo_female_frame" id="female_frame_{{ $key }}" value="{{ $item->content }}" @checked(!empty($data->preset->photo->female->frame) && $data->preset->photo->female->frame==$item->content)>
								{!! image(src:url('storage/frame/'.$item->content), alt:$item->title) !!}
							</label>
							@endforeach
						</figure>
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
@include('member.layouts.component', ['content'=>'modal-avatar', 'gender'=>'male'])
@include('member.layouts.component', ['content'=>'modal-avatar', 'gender'=>'female'])
@include('member.layouts.component', ['content'=>'modal-storage', 'mode'=>'single'])
<script src="{{ asset('modules/datatable/datatables.min.js') }}" type="text/javascript"></script>
<script>
$(function() {
	// Pilih avatar dari modal
	$(".change-asset").on('change', function(e) {
		e.preventDefault();
		if (e.target.name === 'profile_avatar_male') {
			let avatar = $(this).siblings('img').attr('src'),
				source = $(this).val();
			$(".set_profile_photo_male").attr('src', avatar);
			$("input[name=profile_photo_male__filename]").val(source);
			$("input[name=profile_photo_male__method]").val('avatar');
			$("button.remove-image[data-target=profile_photo_male]").prop('disabled', false);
		} else if (e.target.name === 'profile_avatar_female') {
			let avatar = $(this).siblings('img').attr('src'),
				source = $(this).val();
			$(".set_profile_photo_female").attr('src', avatar);
			$("input[name=profile_photo_female__filename]").val(source);
			$("input[name=profile_photo_female__method]").val('avatar');
			$("button.remove-image[data-target=profile_photo_female]").prop('disabled', false);
		}
	});

	// Klik tombol penyimpanan
	$(".change-data").on('click', function(e) {
		e.preventDefault();
		$(".use-image").attr('data-image', $(this).data('image'));
	});

	// Upload foto langsung
	$(".change-img").on('change', function(e) {
		const file = e.target.files[0];
		if (!file) return;
		const reader = new FileReader();
		if (e.target.name === 'profile_photo_male') {
			reader.onload = r => $(".set_profile_photo_male").attr('src', r.target.result);
			reader.readAsDataURL(file);
			$("input[name=profile_photo_male__method]").val('upload');
			$("button.remove-image[data-target=profile_photo_male]").prop('disabled', false);
		} else if (e.target.name === 'profile_photo_female') {
			reader.onload = r => $(".set_profile_photo_female").attr('src', r.target.result);
			reader.readAsDataURL(file);
			$("input[name=profile_photo_female__method]").val('upload');
			$("button.remove-image[data-target=profile_photo_female]").prop('disabled', false);
		}
	});

	// Toggle tampilan orang tua & instagram
	$(".change-style").on('change', function(e) {
		const show = e.target.checked ? 'none' : 'inherit';
		if (e.target.name === 'profile_parent_show') {
			$(".set_profile_parent_show").css('display', show);
		} else if (e.target.name === 'profile_instagram_show') {
			$(".set_profile_instagram_show").css('display', show);
		}
	});

	// Hapus foto
	$(".remove-image").on('click', function(e) {
		e.preventDefault();
		const target = $(this).data('target');
		if (target === 'profile_photo_male') {
			$(".set_profile_photo_male").attr('src', '');
			$("input[name=profile_photo_male]").val('');
			$("input[name=profile_photo_male__filename]").val('');
			$("input[name=profile_photo_male__method]").val('none');
			$("input[name=profile_avatar_male]").prop('checked', false);
		} else if (target === 'profile_photo_female') {
			$(".set_profile_photo_female").attr('src', '');
			$("input[name=profile_photo_female]").val('');
			$("input[name=profile_photo_female__filename]").val('');
			$("input[name=profile_photo_female__method]").val('none');
			$("input[name=profile_avatar_female]").prop('checked', false);
		}
		$(this).prop('disabled', true);
	});

	// Pilih dari penyimpanan
	$(".use-image").on('click', function(e) {
		const target = $(this).data('image');
		$("input[name='storage_file[]']").each(function() {
			if ($(this).prop('checked')) {
				const source = $(this).val();
				const imgUrl = $(this).siblings().children('img').attr('src');
				if (target === 'for-male') {
					$(".set_profile_photo_male").attr('src', imgUrl);
					$("input[name=profile_photo_male__filename]").val(source);
					$("input[name=profile_photo_male__method]").val('storage');
					$("button.remove-image[data-target=profile_photo_male]").prop('disabled', false);
				} else if (target === 'for-female') {
					$(".set_profile_photo_female").attr('src', imgUrl);
					$("input[name=profile_photo_female__filename]").val(source);
					$("input[name=profile_photo_female__method]").val('storage');
					$("button.remove-image[data-target=profile_photo_female]").prop('disabled', false);
				}
			}
		});
		$("#storage").modal('hide');
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
						text:  (res.toast && res.toast.text)  ? res.toast.text  : 'Profil pasangan berhasil disimpan.'
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