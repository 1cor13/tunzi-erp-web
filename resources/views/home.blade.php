@extends('layouts.site')

@php( $page_name = 'Home Panel' )

@section('title', $page_name)
@section('styles')
<style>
    .card { border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0; }
    .card-header { border-top: 10px!important; }
</style>
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

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="main-card mb-4 card">
            <div class="card-body">
                <h3 class="float-left ">
                    Howdy {{ explode(' ', trim(Auth::user()->name))[0] }},
                    <br>
                    <small class="text-muted">Your profile is not complete, please proceed to register your business or get to join your colleagues in one</small>
                </h3>
                <div class="float-right">
                    <div class="btn-group dropdown-container form-group show">
                        <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-info">
                            Quick Menu
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Find Help</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="min-height: 25vh; border-radius: 15px; border: thin solid #667eea">
            <div class="card-body">
                <div class="col-12 p-2 bg-primary text-white">{{ config('app.name') }} Profile</div>
                <div class="grid-menu grid-menu-3col">
                    <div class="no-gutters row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="min-height: 25vh; border-radius: 15px; border: thin solid #009efb">
            <div class="card-body">
                <div class="col-12 p-2 bg-info text-white">Recent Messages</div>
                <div class="grid-menu grid-menu-3col">
                    <div class="no-gutters row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="min-height: 25vh; border-radius: 15px; border: thin solid #55ce63">
            <div class="card-body">
                <div class="col-12 p-2 bg-success text-white">Notifications</div>
                <div class="grid-menu grid-menu-3col">
                    <div class="no-gutters row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="min-height: 25vh; border-radius: 15px; border: thin solid #ffbc34">
            <div class="card-body">
                <div class="col-12 p-2 bg-warning text-black">Business Status</div>
                <div class="grid-menu grid-menu-3col">
                    <div class="no-gutters row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="min-height: 25vh; border-radius: 15px; border: thin solid #ffbc34">
            <div class="card-body">
                <div class="col-12 p-2 bg-warning text-black">Tracking Status</div>
                <div class="grid-menu grid-menu-3col">
                    <div class="no-gutters row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="min-height: 25vh; border-radius: 15px; border: thin solid #ffbc34">
            <div class="card-body">
                <div class="col-12 p-2 bg-warning text-black">Modules & Subscriptions</div>
                <div class="grid-menu grid-menu-3col">
                    <div class="no-gutters row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

@endsection