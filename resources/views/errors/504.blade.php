@extends('layouts.errors')
@section('title', '504 - Timeout Error')
@section('content')
	<div class="error-box">
		<h1>404</h1>
		<h3><i class="fa fa-warning"></i> {{ __('Oops! You\'re Too Early!') }}</h3>
		<p>{{ __('Hello, the server timed out while processing your request. Please refresh the page or try another browser if this persists, please contact the site admin') }}</p>
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