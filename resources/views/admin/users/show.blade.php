@extends('layouts.site')

@php( $page_name = $user->name . ' - User Profile' )

@section('title', $page_name)
@section('styles')
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">{{ $page_name }}</h3>
            <ul class="breadcrumb">
            	<li class="breadcrumb-item"><a href="{{ route('userhome') }}"> <i class="la la-home"></i> User Home</a></li>
		        <li class="breadcrumb-item"><a href="{{ route('admin') }}"> <i class="la la-user-plus"></i> Admin </a></li>
		        <li class="breadcrumb-item"><a href="{{ route('users.index') }}"> <i class="la la-users"></i> Users </a></li>
                <li class="breadcrumb-item active"><i class="la la-user mt-1 mr-1"></i> {{ $page_name }}</li>
            </ul>
        </div>
    </div>
</div>
@include('layouts.includes.notifications')



@endsection
@section('scripts')

@endsection