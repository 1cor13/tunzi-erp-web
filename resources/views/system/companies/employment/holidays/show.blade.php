@extends('layouts.site')

@php( $page_name = 'Show Employee Holidays' )

@section('title', $page_name)
@section('styles')
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">{{ $page_name }}</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><i class="la la-home mt-1 mr-1"></i> {{ $page_name }}</li>
            </ul>
        </div>
    </div>
</div>
@include('layouts.includes.notifications')



@endsection
@section('scripts')

@endsection