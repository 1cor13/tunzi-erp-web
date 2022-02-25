@extends('layouts.errors')
@section('title', '404 - Restricted Access')
@section('content')
	<div class="error-box">
		<h1>403</h1>
		<h3><i class="fa fa-warning"></i> {{ __('Oops! Insufficient Permissions.') }}</h3>
		<p>{{ __('Sorry your rights are insufficient to access the resource at the moment. Please contact your team lead or the administrator if you are sure there is an problem') }}</p>
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