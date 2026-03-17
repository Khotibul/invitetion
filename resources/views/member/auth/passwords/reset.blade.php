@extends('member.layouts.auth')
@section('title', Str::title('buat password baru'))
@section('content')
<div class="auth__title text-center py-3">
	<h1>{{ Str::upper('buat password baru') }}</h1>
	<p>Masukkan password baru untuk akun kamu.</p>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="sign-form bg-white p-3">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <label for="email" class="form-label">{{ Str::title('email') }}</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ Str::title('password baru') }}</label>
                    <input type="password" name="password" id="password" class="form-control form-control-sm" required autocomplete="new-password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ Str::title('konfirmasi password') }}</label>
                    <input type="password" name="password_confirmation" id="password-confirm" class="form-control form-control-sm" required autocomplete="new-password">
                </div>
                <div class="text-center py-2">
                    <button type="submit" class="btn btn-creasik-primary text-uppercase w-100">
                        <i class="bx bx-lock-open"></i>
                        <span>Simpan password</span>
                    </button>
                </div>
            </form>
        </div>
        <div class="text-center py-3">
            <a href="{{ route('signin') }}" class="text-creasik-primary">{{ Str::title('kembali ke masuk') }}</a>
        </div>
    </div>
</div>
@endsection
