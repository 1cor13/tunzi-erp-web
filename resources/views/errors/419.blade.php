@extends('layouts.errors')
@section('title', '419 - Session Expired')
@section('content')
	<div class="error-box">
		<h1>419</h1>
		<h3><i class="fa fa-warning"></i> {{ __('Oops! Previous Session Expired!') }}</h3>
		<p>{{ __('The resource you\'re accessing has expired with it\'s session. Please refresh the page or login to continue.') }}</p>
		{{-- <a href="{{ url('/') }}" class="btn btn-custom"> {{ __('Back to Home') }}</a> --}}

		@if(URL::previous() != Request::fullUrl())
		<div class="row">
            <a href="{{ URL::previous() }}" class="btn btn-custom col-md-5 offset-md-1 mt-1 text-white"> <i class="la la-link"></i> Go back </a>
            <a href="{{ route('home') }}" class="btn btn-custom col-md-5 offset-md-1 mt-1 text-white"> <i class="la la-home"></i> Home </a>
        </div>
        @else
        <div class="btn btn-custom col-md-12">
            <a href="{{ route('home') }}" class="text-white"> <i class="la la-home"></i> Home </a>
        </div>
        @endif
	</div>
@endsection