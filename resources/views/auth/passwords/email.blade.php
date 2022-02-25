@extends('layouts.auths')
@section('title', 'Reset Password Link')
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
                    <i><small>{{ __('You can send a password reset link to your email.') }}</small></i>
                </p>

                <!-- Account Form -->
                <form action="{{ route('password.email') }}" method="POST">
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
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="i-know" id="i-know" {{ old('i-know') ? 'checked' : '' }}>

                                <label class="form-check-label" for="i-know">
                                    {{ __('I know what am doing') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit" style="padding: 1px;">{{ __('Send  Link') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="account-footer">
                        <p>Remember password? <a href="{{ route('login') }}">{{ __('Back to login') }}</a></p>
                    </div>
                </form>
                <!-- /Account Form -->
            </div>
        </div>
    </div>
</div>
@endsection