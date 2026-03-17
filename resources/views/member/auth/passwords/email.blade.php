@extends('member.layouts.auth')
@section('title', Str::title('reset password'))
@section('content')
<div class="auth__title text-center py-3">
	<h1>{{ Str::upper('reset password') }}</h1>
	<p>Masukkan email untuk menerima link reset password.</p>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="sign-form bg-white p-3">
            @if (session('status'))
                <div class="alert alert-success small mb-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">{{ Str::title('email') }}</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="text-center py-2">
                    <button type="submit" class="btn btn-creasik-primary text-uppercase w-100">
                        <i class="bx bx-mail-send"></i>
                        <span>Kirim link reset</span>
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
