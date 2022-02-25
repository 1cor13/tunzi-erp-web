@extends('layouts.auths')
@section('title', 'Register')
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
				<h3 class="account-title">{{ __('Create An Account') }}</h3>
				<p class="account-subtitle">
					<i><small>{{ __('Create an account with ' . config('app.name') . ' to be able to use the services') }}</small></i>
				</p>

				<!-- Account Form -->
				<form action="{{ route('register') }}" method="POST">
					@csrf

					<div class="form-group">
						<label for="name" class="col-form-label text-md-right">{{ __('Full Names') }}</label>
						<input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus>
						@error('name')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{{ $message }}</strong>
			                </span>
			            @enderror
					</div>

					<div class="form-group">
						<label>{{ __('E-Mail Address') }}</label>
						<input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
						@error('email')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{{ $message }}</strong>
			                </span>
			            @enderror
					</div>




					<div class="form-group">
			            <label for="password">{{ __('Password') }}</label>

			            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

			            @error('password')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{{ $message }}</strong>
			                </span>
			            @enderror
			        </div>

			        <div class="form-group">
			            <label for="password-confirm">{{ __('Confirm Password') }}</label>
			            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
			        </div>


					<div class="form-group row">
			            <div class="col-md-6">
			                <div class="form-check">
			                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

			                    <label class="form-check-label" for="remember">
			                        {{ __('Accept terms and conditions') }}
			                    </label>
			                </div>
			            </div>
			            <div class="col-md-6">
			            	<div class="form-group text-center">
								<button class="btn btn-primary account-btn" type="submit"  style="padding: 1px;">{{ __('Register') }}</button>
							</div>
			            </div>
			        </div>
					<div class="account-footer">
						<p>Already have an account <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
					</div>
				</form>
				<!-- /Account Form -->
			</div>
		</div>
	</div>
</div>
@endsection