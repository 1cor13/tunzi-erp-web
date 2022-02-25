@extends('layouts.site')

@php( $page_name = ucfirst($type ?? 'My') . ' Messages' )

@section('title', $page_name)
@section('styles')
@endsection
@section('sidebar')
	@include('layouts.includes.side-messages')
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">{{ $page_name }}</h3>
            <ul class="breadcrumb">
            	<li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="la la-home"></i> Home</a></li>
                <li class="breadcrumb-item active"><i class="la la-envelope-open mt-1 mr-1"></i> {{ $page_name }}</li>
            </ul>
        </div>
    </div>
</div>
@include('layouts.includes.notifications')



@endsection
@section('scripts')

@endsection