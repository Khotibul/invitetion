@extends('member.layouts.auth')
@section('title', Str::title('daftar'))
@section('content')
<div class="auth__title text-center py-3">
	<h1>{{ Str::upper('daftar') }}</h1>
	<p>Daftar dan buat undangan pernikahanmu sendiri, sesuai dengan apa yang kamu mau.</p>
</div>
<div class="row justify-content-center">
	<div class="col-lg-6">
		<div class="sign-form bg-white p-3 text-center">
			<a href="{{ route('signup') }}" class="btn btn-creasik-primary w-100 text-uppercase">
				<i class="bx bx-user-plus"></i>
				<span>{{ Str::title('ke halaman daftar') }}</span>
			</a>
			<div class="text-center pt-3">Sudah punya akun? <a href="{{ route('signin') }}" class="text-creasik-primary">{{ Str::title('masuk disini') }}</a></div>
		</div>
	</div>
</div>
@endsection
