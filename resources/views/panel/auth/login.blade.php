@extends('panel.layouts.auth')
@section('title', 'Admin Login')
@section('content')
<h4 class="mb-3">Control Panel</h4>
<form class="mb-3" action="{{ route('admin.login.store') }}" method="POST">
	@csrf
	<div class="mb-3">
		<label for="email" class="form-label">Email</label>
		<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="admin@email.com" autofocus>
		@error('email')
		<span class="text-danger small" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>
	<div class="mb-3">
		<label class="form-label" for="password">Password</label>
		<input type="password" id="password" class="form-control" name="password" placeholder="********" autocomplete="current-password">
		@error('password')
		<span class="text-danger small" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>
	<div class="mb-3">
		<button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
	</div>
</form>
@endsection

