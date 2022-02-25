@extends('layouts.errors')
@section('title', '400 Bad Request')
@section('content')
	<div class="error-box">
		<h1>400</h1>
		<h3><i class="fa fa-warning"></i> {{ __('Oops! Bad Request!') }}</h3>
		<p>{{ __('The request was either not understood or not found.') }}</p>
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

<script type="">
	$(".mtn-card.mtn-card--link.p-0.mtn-card--cursor.d-flex.lazyloaded").css('background', function () { var bg = ('url(' + $(this).data("bg") + ') no-repeat center center'); return bg; });
</script>