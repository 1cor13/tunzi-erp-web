@extends('layouts.auths')
@section('title', 'Verify E-mail Address')
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
                <h3 class="account-title">{{ __('Verify E-mail Address') }}</h3>
                <p class="account-subtitle">
                    <small>{{ __('One last step') }}</small>
                </p>

                <!-- Account Form -->
                <div class="">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address ('. Auth::user()->email .').') }}
                        </div>
                    @endif

                    {{ __('Hey '. explode(' ', Auth::user()->name)[0] .',') }}
                    <br>
                    {{ __(' Before proceeding, please check your email, ') }} <b>{{ Auth::user()->email }}</b> {{ __(' for a verification link.') }}
                    <br><br>
                    {{ __('If you did not receive the email ') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 ml-0 mt-3 mb-3 align-baseline text-info" style="padding: 1px;"><b>{{ __('click here to request another') }}</b></button>.
                    </form>
                    <div class="mb-0 mt-3 col-md-6 offset-md-6">
                        <button class="btn btn-primary text-white btn-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-1 text-success"></i>  {{ __('Sign out') }} </button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </div>
                </div>  
                <!-- /Account Form -->
            </div>
        </div>
    </div>
</div>
@endsection