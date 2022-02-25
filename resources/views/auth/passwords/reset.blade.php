@extends('layouts.auths')
@section('title', 'Reset Accout Password')
@section('content')
<div class="account-content">
    <!-- {{-- <a href="" class="btn btn-primary apply-btn">Apply Job</a> --}} -->
    <div class="container">
    
        <!-- Account Logo -->
        <div class="account-logo">
            <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.svg') }}" alt="{{ config('app.name') }}"></a>
        </div>
        <!-- /Account Logo -->

        <div class="account-box">
            <div class="account-wrapper">
                <h3 class="account-title">{{ __('Reset Password') }}</h3>
                <p class="account-subtitle">
                    <small>
                        <i><small>{{ __('One last step to go.') }}</small></i>
                        <br class="m-2" />
                        <span>{{ __('Enter your account email and new password below') }}</span>
                    </small>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </p>

                <!-- Account Form -->
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

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
                        <div class="col-md">
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit" style="padding: 1px;">{{ __('Reset Account Password') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="account-footer">
                        <p>Remember password or do not want to reset <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
                    </div>
                </form>
                <!-- /Account Form -->
            </div>
        </div>
    </div>
</div>
@endsection