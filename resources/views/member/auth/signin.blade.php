@extends('member.layouts.auth')
@section('title', Str::title('masuk'))
@section('content')
@php
	$googleReady = config('services.google.client_id') && config('services.google.client_secret') && config('services.google.redirect');
	$isManual = request()->get('manual') == '1';
@endphp

@if ($isManual)
	<div class="auth__title text-center py-3">
		<h1>{{ Str::upper('masuk') }}</h1>
		<p>Masuk manual (mode dev).</p>
	</div>
	<div class="row justify-content-center">
		<div class="col-lg-6">
			<div class="sign-form bg-white p-3">
				<form action="{{ route('signin-store') }}" method="post" class="login">
					@csrf
					<div class="mb-3">
						<label for="email" class="form-label">{{ Str::title('email') }}</label>
						<input type="email" name="email" id="email" class="form-control form-control-sm" value="{{ old('email') ?? null }}" placeholder="email">
						@error('email')
							<small class="text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">{{ Str::title('kata sandi') }}</label>
						<input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="password">
						@error('password')
							<small class="text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="text-center py-2">
						<button type="submit" name="submit" id="submit" class="btn btn-creasik-primary text-uppercase w-100">
							<i class="bx bx-log-in"></i>
							<span>{{ Str::title('masuk') }}</span>
						</button>
						<div class="pt-2">
							<a href="{{ route('password.request') }}" class="text-creasik-primary">{{ Str::title('lupa password?') }}</a>
						</div>
						<hr class="spliter" data-text="atau">
						<a href="{{ '/auth/redirect' }}" class="login-with-google-btn">
							<span>Google</span>
						</a>
					</div>
				</form>
			</div>
			<div class="text-center py-3">Belum punya akun? <a href="{{ route('signup') }}?manual=1" class="text-creasik-primary">{{ Str::title('buat akun baru') }}</a></div>
		</div>
	</div>
@else
	<div class="auth__title text-center py-3">
		<h1>{{ Str::upper('masuk') }}</h1>
		<p>Masuk otomatis menggunakan akun Google.</p>
	</div>
	<div class="row justify-content-center">
		<div class="col-lg-6">
			<div class="sign-form bg-white p-3 text-center">
				@if($errors->any())
					<div class="alert alert-danger small text-start mb-3" role="alert">
						{{ $errors->first() }}
					</div>
				@endif
				<a href="{{ '/auth/redirect' }}" class="login-with-google-btn w-100 d-inline-block">
					<span>Google</span>
				</a>
				<div class="pt-2">
					<a href="{{ route('signin') }}?manual=1" class="text-creasik-primary">{{ Str::title('opsi manual (dev)') }}</a>
				</div>
				@if (!$googleReady)
					<div class="pt-3 small text-muted text-start">
						<div>Google OAuth belum dikonfigurasi di .env.</div>
						<div>Isi GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET, GOOGLE_REDIRECT_URI.</div>
					</div>
				@endif
			</div>
			<div class="text-center py-3">Belum punya akun? <a href="{{ route('signup') }}" class="text-creasik-primary">{{ Str::title('daftar dengan google') }}</a></div>
		</div>
	</div>
@endif
@endsection

@push('style')
@endpush

@push('script')
@if (!$isManual && $googleReady)
<script>
	location.assign("{{ url('/auth/redirect') }}");
</script>
@endif
@endpush
