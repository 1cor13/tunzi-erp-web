@extends('layouts.errors')
@section('title', '500 - System Error')
@section('content')
	<div class="error-box">
		<h1>500</h1>
		<h3><i class="fa fa-warning"></i> {{ __('Oops! Server Error!') }}</h3>
		<p>{{ __('Sorry server is experiencing an error with this resource, please contact the administrator so that it can be fixed.') }}</p>
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