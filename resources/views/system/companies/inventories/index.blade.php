@extends('layouts.site')

@php( $page_name = 'Inventory - ' . $data->appName )

@section('title', $page_name)
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('sidebar')
     @include('layouts.includes.side-inventory')
@endsection
@section('content')
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">{{ $page_name }}</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
				<li class="breadcrumb-item active">{{ $page_name }}</li>
			</ul>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="{{ route('products.create') }}" class="btn add-btn" data-toggle="modal" data-target="#add_product"><i class="fa fa-plus"></i> Add Product</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal"> Import</a>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal"> Export</a>
		</div>
	</div>
</div>
@include('layouts.includes.notifications')

<div class="row">







</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
@endsection