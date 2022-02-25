@extends('layouts.site')

@php( $page_name = 'Settings' )

@section('title', $page_name)
@section('styles')
@endsection
@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">{{ $page_name }}</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ route('userhome') }}">
						<i class="la la-home"></i> Home
					</a>
				</li>
				<li class="breadcrumb-item active"><i class="la la-dashboard mt-1 mr-1"></i> {{ $page_name }}</li>
			</ul>
		</div>
	</div>
</div>
@include('layouts.includes.notifications')

<div class="row">
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="card dash-widget">
			<div class="card-body cs-pointer" onclick="window.open('{{ route('companies.index') }}' , '_self')">
				<span class="dash-widget-icon"><i class="fa fa-building"></i></span>
				<div class="dash-widget-info">
					<span>{{ __('Company') }}</span>
				</div>
			</div>
			<p>Change Company name, email, address, tax number etc</p>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="card dash-widget">
			<div class="card-body cs-pointer" onclick="window.open('{{ route('countries.index') }}' , '_self')">
				<span class="dash-widget-icon"><i class="fa fa-map-marker"></i></span>
				<div class="dash-widget-info">
					<span>{{ __('Countries') }}</span>
				</div>
			</div>
			<p>Set fixed fascal, time zone, date format and more locals </p>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="card dash-widget">
			<div class="card-body cs-pointer" onclick="window.open('{{ route('categories.index') }}' , '_self')">
				<span class="dash-widget-icon"><i class="fa fa-folder"></i></span>
				<div class="dash-widget-info">
					<span>{{ __('Categories') }}</span>
				</div>
			</div>
			<p>Unlimited catageories for income, expense and products</p>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
		<div class="card dash-widget">
			<div class="card-body cs-pointer" onclick="window.open('{{ route('currencies.index') }}' , '_self')">
				<span class="dash-widget-icon"><i class="fa fa-dollar"></i></span>
				<div class="dash-widget-info">
					<span>{{ __('Currencies') }}</span>
				</div>
			</div>
			<p>Create and manage currencies and set their rates</p>
		</div>
	</div>
</div>


@endsection
@section('scripts')

@endsection