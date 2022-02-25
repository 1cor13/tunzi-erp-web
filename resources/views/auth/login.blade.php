@extends('layouts.auths')
@section('title', 'Login')
@section('content')
<div class="account-content">
	<!-- <a href="javascript:void(0);" class="btn btn-primary apply-btn">Apply Job</a> -->
	<div class="container">
	
		<!-- Account Logo -->
		<div class="account-logo">
			<a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.svg') }}" alt="{{ config('app.name') }}"></a>
		</div>
		<!-- /Account Logo -->
		
		<div class="account-box">
			<div class="account-wrapper">
				<h3 class="account-title">{{ __('Login') }}</h3>
				<p class="account-subtitle">
					<i><small>{{ __('Welcome, Please enter your credentials to continue') }}</small></i>
				</p>
				
				<!-- Account Form -->
				<form action="{{ route('login') }}" method="POST">
					@csrf

					<div class="form-group">
						<label>{{ __('E-Mail Address') }}</label>
						<input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus>
						@error('email')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{{ $message }}</strong>
			                </span>
			            @enderror
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col">
								<label>{{ __('Password') }}</label>
							</div>
							@if (Route::has('password.request'))
							<div class="col-auto">
								<a class="text-muted" href="{{ route('password.request') }}">
									{{ __('Forgot Password!') }}
								</a>
							</div>
							@endif
						</div>
						<input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
						@error('password')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{{ $message }}</strong>
			                </span>
			            @enderror
					</div>
					<div class="form-group row">
			            <div class="col-md-6">
			                <div class="form-check">
			                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

			                    <label class="form-check-label" for="remember">
			                        {{ __('Remember Me') }}
			                    </label>
			                </div>
			            </div>
			            <div class="col-md-6">
			            	<div class="form-group text-center">
								<button class="btn btn-primary account-btn" type="submit" style="padding: 1px;">{{ __('Login') }}</button>
							</div>
			            </div>
			        </div>
					<div class="account-footer">
						<p>Don't have an account yet? <a href="{{ route('register') }}">{{ __('Register') }}</a></p>
					</div>
				</form>
				<!-- /Account Form -->
			</div>
		</div>
	</div>
</div>
@endsection