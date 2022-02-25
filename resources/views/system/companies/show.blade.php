@extends('layouts.site')

@php( $page_name = $data->company->name )

@section('title', $page_name)
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">{{ $page_name }}</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="la la-home mt-1 mr-1"></i> {{ __('Home') }}</a></li>
                @permission('view_company_list')
                <li class="breadcrumb-item"><a href="{{ route('companies.index') }}"><i class="la la-cubes mt-1 mr-1"></i> {{ __('Companies') }}</a></li>
                @endpermission
                <li class="breadcrumb-item active"><i class="la la-group mt-1 mr-1"></i> {{ $page_name }}</li>
            </ul>
        </div>
    </div>
</div>
@include('layouts.includes.notifications')
<section class="content profile-page">
	<div class="card card-body p-0">
    	<div class="container-fluid">
			<div class="row clearfix">
		        <div class="col-md-12 p-l-0 p-r-0">
		            <section class="boxs-simple">
		            	@php($imagesArr = [ 'assets/img/rover.jpeg', 'assets/img/ballons.jpeg', 'assets/img/city.jpeg' ])
		                <div class="profile-header" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset( $imagesArr[rand(0,2)] ) }}') center center;"> 
		                    <div class="profile_info">
		                        <div class="profile-image"> <img src="{{ asset('files/defaults/profiles/male.jpg') }}" alt=""> </div>
		                        <h4 class="mb-0 p-2"><strong>{{ $data->company->name }}</strong></h4>
		                        <span class="text-muted">{{ $data->company->district_name . ($data->company->sub_county_id ? ', ' . $data->company->subcounty->county_name : '') . ('') }}</span>
		                        <div class="mt-10 pt-2 pb-2 top-icons">
		                            <button class="btn btn-raised btn-default bg-success text-white btn-sm col-md-2 m-1 below-image">Follow</button>
		                            <button class="btn btn-raised btn-default bg-primary text-white btn-sm col-md-2 m-1 below-image">Message</button>
		                        </div>
		                        <p class="social-icon">
		                            <a title="Twitter" href="#"><i class="la la-twitter"></i></a>
		                            <a title="Facebook" href="#"><i class="la la-facebook"></i></a>
		                            <a title="Google-plus" href="#"><i class="la la-twitter"></i></a>
		                            <a title="Dribbble" href="#"><i class="la la-dribbble"></i></a>
		                            <a title="Behance" href="#"><i class="la la-behance"></i></a>
		                            <a title="Instagram" href="#"><i class="la la-instagram "></i></a>
		                            <a title="Pinterest" href="#"><i class="la la-pinterest "></i></a>
		                        </p>
		                    </div>
		                </div>
		                <div class="profile-sub-header">
		                    <div class="box-list">
		                        <ul class="text-center">
		                            <li class="bg-inverse-info"> {{-- inverse / gradient --}}
		                                <a href="javascript:void(0);"><i class="fa fa-users"></i>
		                                <p>Store Fronts / Shops</p>
		                                </a>
		                            </li>
		                            <li class="bg-inverse-primary">
		                                <a href="javascript:void(0);"><i class="la la-camera"></i>
		                                <p>Gallery</p>
		                                </a>
		                            </li>
		                            <li class="bg-inverse-secondary">
		                                <a href="javascript:void(0);"><i class="la la-folder-open"></i>
		                                <p>Collections</p>
		                                </a>
		                            </li>
		                            <li class="bg-inverse-purple">
		                                <a href="javascript:void(0);"><i class="la la-group"></i>
		                                <p>Clients</p>
		                                </a> 
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </section>
		        </div>
		    </div>
		</div>

	</div>
</section>


@endsection
@section('scripts')

@endsection