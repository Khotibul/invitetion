@extends('member.layouts.auth')
@section('title', Str::title('konfirmasi password'))
@section('content')
<div class="auth__title text-center py-3">
	<h1>{{ Str::upper('konfirmasi password') }}</h1>
	<p>Masukkan password untuk melanjutkan.</p>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="sign-form bg-white p-3">
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="mb-3">
                    <label for="password" class="form-label">{{ Str::title('kata sandi') }}</label>
                    <input type="password" name="password" id="password" class="form-control form-control-sm" required autocomplete="current-password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="text-center py-2">
                    <button type="submit" class="btn btn-creasik-primary text-uppercase w-100">
                        <i class="bx bx-check-circle"></i>
                        <span>Konfirmasi</span>
                    </button>
                </div>
                <div class="text-center pt-3">
                    @if (Route::has('password.request'))
                        <a class="text-creasik-primary" href="{{ route('password.request') }}">{{ Str::title('lupa password?') }}</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
