@extends('layouts.auths')
@section('title', 'Confirm Reset Password')
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
                <h3 class="account-title">{{ __('Confirm password.') }}</h3>
                <p class="account-subtitle">
                    <small>
                        <i><small>{{ __('Confirm password.') }}</small></i>
                        <br class="m-2" />
                        <span>{{ __('Please confirm your password before continuing.') }}</span>
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

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autofocus autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md">
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit" style="padding: 1px;">{{ __('Confirm Password') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /Account Form -->
            </div>
        </div>
    </div>
</div>
@endsection