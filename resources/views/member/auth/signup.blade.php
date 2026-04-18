@extends('member.layouts.auth')
@section('title', Str::title('daftar'))
@section('content')
@php
	$googleReady = config('services.google.client_id') && config('services.google.client_secret') && config('services.google.redirect');
	$isManual = request()->get('manual') == '1';
@endphp

@if (!$isManual)
	<div class="text-center py-3">
		<h1>{{ Str::upper('daftar') }}</h1>
		<p>Daftar otomatis menggunakan akun Google.</p>
	</div>
	<div class="row justify-content-center">
		<div class="col-12 col-lg-6">
			<div class="sign-form bg-white rounded p-3 text-center">
				@if($errors->any())
					<div class="alert alert-danger small text-start mb-3" role="alert">
						{{ $errors->first() }}
					</div>
				@endif
				<a href="{{ '/auth/redirect' }}" class="login-with-google-btn w-100 d-inline-block">
					<span>Google</span>
				</a>
				<div class="pt-2">
					<a href="{{ route('signup') }}?manual=1" class="text-creasik-primary">{{ Str::title('opsi manual (dev)') }}</a>
				</div>
				@if (!$googleReady)
					<div class="pt-3 small text-muted text-start">
						<div>Google OAuth belum dikonfigurasi di .env.</div>
						<div>Isi GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET, GOOGLE_REDIRECT_URI.</div>
					</div>
				@endif
			</div>
		</div>
	</div>
	<div class="text-center py-3">Sudah punya akun? <a href="{{ route('signin') }}" class="text-creasik-primary">{{ Str::title('masuk disini') }}</a></div>
@else
	<div class="text-center py-3">
		<h1>{{ Str::upper('daftar') }}</h1>
		<p>Daftar manual (mode dev).</p>
	</div>
	<div class="row justify-content-center">
		<div class="col-12 col-lg-6">
			<div class="sign-form bg-white rounded p-3">
				<section id="step1">
					<form action="{{ route('signup-store', 1) }}" method="post" class="register">
						@csrf
						<div class="mb-2">
							<label for="email" class="form-label">
								<var dir="email">{{ Str::title('email') }}</var>
							</label>
							<input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="email">
							<small class="text-danger"></small>
						</div>
						<div class="mb-2">
							<label for="password" class="form-label">
								<var dir="password">{{ Str::title('kata sandi') }}</var>
							</label>
							<input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="password">
							<small class="text-danger"></small>
						</div>
						<div class="mb-2">
							<label for="password_confirmation" class="form-label">
								<var dir="password_confirmation">{{ Str::title('konfirmasi sandi') }}</var>
							</label>
							<input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm" placeholder="password">
							<small class="text-danger"></small>
						</div>                    
						<div class="text-center py-2">
							<button type="submit" name="submit" id="submit" class="btn btn-creasik-primary w-100 mb-1 px-4">
								<i class="bx bx-user-check"></i>
								<span>{{ Str::title('daftar sekarang') }}</span>
							</button>
							<hr class="spliter" data-text="atau">
							<a href="{{ '/auth/redirect' }}" class="login-with-google-btn">
								<span>Google</span>
							</a>
						</div>
					</form>
				</section>
				<section id="step2" @style('display:none')>
					<form action="{{ route('signup-store', 2) }}" method="post" class="register">
						@csrf
						<input type="hidden" name="email" class="set_email" readonly>
						<input type="hidden" name="password" class="set_password" readonly>
						<div class="mb-2">
							<label for="female_name" class="form-label">
								<var dir="female_name">{{ Str::title('nama wanita') }}</var>
							</label>
							<input type="text" name="female_name" id="female_name" class="form-control form-control-sm" placeholder="nama calon pengantin wanita">
							<small class="text-danger"></small>
						</div>
						<div class="mb-2">
							<label for="male_name" class="form-label">
								<var dir="male_name">{{ Str::title('nama pria') }}</var>
							</label>
							<input type="text" name="male_name" id="male_name" class="form-control form-control-sm" placeholder="nama calon pengantin pria">
							<small class="text-danger"></small>
						</div>
						<div class="mb-2">
							<label for="subdomain" class="form-label">
								<var dir="subdomain">{{ Str::title('subdomain') }}</var>
							</label>
							<div class="input-group input-group-sm">
								<span class="input-group-text bg-white pe-0">https://creasikdigital.com/</span>
								<input type="text" name="subdomain" id="subdomain" class="form-control border-start-0 ps-0" placeholder="subdomain undangan">
							</div>
						</div>
						<div class="mb-2">
							<label for="bundle" class="form-label">
								<var dir="bundle">{{ Str::title('pilih paket') }}</var>
							</label>
							<div class="package-list rounded">
								@foreach ($data->package as $item)
								<input type="radio" name="bundle" id="pack{{ $item->id }}" value="{{ $item->id }}" data-price="{{ $item->price }}">
								<label for="pack{{ $item->id }}" class="d-flex justify-content-between">
									<b>{{ $item->title }}</b>
									<span>{!! idr($item->price) !!}</span>
								</label>
								@endforeach
							</div>
						</div>
						<div class="mb-2">
							<label for="preset" class="form-label">
								<var dir="preset">{{ Str::title('pilih templat') }}</var>
							</label>
							<div class="template-list rounded inlined w-100">
								@foreach ($data->template as $item)
								<figure>
									<sup class="badge {{ $item->grade }}">{{ $item->grade }}</sup>
									<input type="radio" name="preset" id="temp{{ $item->id }}" value="{{ $item->id }}" data-price="{{ $item->price ?? 0 }}">
									<label for="temp{{ $item->id }}">
										<img src="{{ Str::startsWith($item->file, 'template/') ? asset($item->file) : url('storage/'.$item->file) }}" alt="">
										<span>{{ $item->title }}</span>
										<small class="text-muted d-block">{!! idr((string) ($item->price ?? 0)) !!}</small>
									</label>
								</figure>
								@endforeach
							</div>
						</div>
						<div class="payment-method mb-2" @style('display:none')>
							<label for="payment" class="form-label">
								<var dir="payment">{{ Str::title('pembayaran') }}</var>
							</label>
							<div class="package-list">
								<input type="radio" name="payment" id="fastPayment" value="fast">
								<label for="fastPayment" class="d-flex justify-content-between">
									<b>Pembayaran cepat</b>
									<span class="modal-info" data-bs-toggle="modal" data-bs-target="#modal-info" data-text="Setelah pembayaran dilakukan, akun kamu otomatis aktif.">
										<i class="bx bx-info-circle"></i>
									</span>
								</label>
								<input type="radio" name="payment" id="manualPayment" value="manual">
								<label for="manualPayment" class="d-flex justify-content-between">
									<b>Pembayaran manual</b>
									<span class="modal-info" data-bs-toggle="modal" data-bs-target="#modal-info" data-text="Setelah pembayaran dilakukan, kamu harus mengkonfirmasi bukti pembayaran pada admin kami untuk mengaktifkan akun.">
										<i class="bx bx-info-circle"></i>
									</span>
								</label>
							</div>
							<var dir="bank"></var>
							<div class="bank-list" @style('display:none')>
								@foreach ($data->bank as $key => $item)
								<label for="bank{{ $key }}">
									<input type="radio" name="bank" id="bank{{ $key }}" value="{{ base64_encode($item->id) }}">
									<div class="bank-item {{ $item->file }}">
										<code>{{ $item->file }}</code>
									</div>
								</label>
								@endforeach
							</div>
						</div>
						<div class="text-center py-2">
							<button type="submit" name="submit" id="submit" class="btn btn-creasik-primary w-100 mb-1 px-4">
								<i class="bx bx-check-circle"></i>
								<span>{{ Str::title('lanjutkan') }}</span>
							</button>
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
	<div class="text-center py-3">Sudah punya akun? <a href="{{ route('signin') }}?manual=1" class="text-creasik-primary">{{ Str::title('masuk disini') }}</a></div>
	<div class="modal fade" id="modal-info" tabindex="-1" aria-labelledby="presetsLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body text-center"></div>
				<div class="modal-footer p-2">
					<button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
						<i class="bx bx-thumbs-up"></i>
						<span>Oke</span>
					</button>
				</div>
			</div>
		</div>
	</div>
@endif
@endsection

@push('style')
@if ($isManual)
<style>
	.bank-list .bank-item {
		background-image: url('{{ url('images/bank/banks.png') }}') }
</style>
@endif
@endpush

@push('script')
@if (!$isManual && $googleReady)
<script>
	location.assign("{{ url('/auth/redirect') }}");
</script>
@endif
@if ($isManual)
<script>
	$(".modal-info").on('click', function(e) {
		let info = $(this).data('text');
		$("#modal-info").find('.modal-body').text(info);
	});
	function updatePaymentVisibility() {
		let packPrice = parseInt($("input[name=bundle]:checked").data('price') || 0, 10);
		let templatePrice = parseInt($("input[name=preset]:checked").data('price') || 0, 10);
		let total = packPrice + templatePrice;

		if (total > 0) {
			$(".payment-method").fadeIn();
		} else {
			$(".payment-method").fadeOut();
			$(".bank-list").fadeOut();
			$("input[name=payment]").prop('checked', false);
			$("input[name=bank]").prop('checked', false);
		}
	}
	$("input[name=bundle], input[name=preset]").on('change', updatePaymentVisibility);
	updatePaymentVisibility();
	$("input[name=payment]").on('change', function(e) {
		let next = $(".bank-list");
		if (e.target.value=='manual') {
			next.fadeIn();
		} else {
			next.fadeOut();
		}
	});
	$(".register").on('submit', function(e) {
		e.preventDefault();
		let action = $(this).attr('action'),
			submit = $(this).find('button[type=submit]');
		$.ajax({
			type: 'post',
			url : action,
			dataType: 'json',
			data: $(this).serialize(),
			error: function(q,w,e) {
				submit.text('Coba Lagi');
				submit.prop('disabled', false);
				$.each(q.responseJSON.errors, function(index, value) {
					$(`var[dir=${index}]`).after(`<sup role="alert" data-bs-toggle="tooltip" data-bs-placement="right" title="${value}">!</sup>`);
				});
			},
			beforeSend: function() {
				$("sup[role=alert]").remove();
				submit.prop('disabled', true);
				submit.text('Memeriksa data...');
			},
			success: function(response) {
				if (response.code==200) {
					if (response.command=='next') {
						$("input.set_email").val(response.return.email);
						$("input.set_password").val(response.return.password);
						$("#step1").css('display', 'none');
						$("#step2").css('display', 'block');
					} else if (response.command=='start') {
						$("#step2").css('display', 'none');
						location.assign(response.redirect);
					}
				} else if (response.code==500) {
					submit.text('Coba Lagi');
					submit.prop('disabled', false);
					$.each(response.message, function(index, value) {
						$(`[name=${index}]`).after(`<sup>${value}</sup>`);
					});
				}
			}
		});
	});
</script>
@endif
@endpush
